<?php

namespace App\Services\Extension\Traits;

use App\Helpers\Classes\Helper;
use App\Models\Extension;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

trait InstallExtension
{
    public function install(string $extensionSlug): bool|array
    {
        $dbExtension = Extension::query()->where('slug', $extensionSlug)->first();

        if ($dbExtension->licensed != 1) {
            return [
                'status' => false,
                'message' => trans('Invalid license key, please buy the extension first.')
            ];
        }

        $this->extensionSlug = $extensionSlug;

        $licenseKey = Helper::settingTwo('liquid_license_domain_key');

        $email = $this->checkLicense($licenseKey);

        if (! $email) {
            return [
                'status' => false,
                'message' => trans('Invalid license key')
            ];
        }

        $response = Http::get('https://portal.liquid-themes.com/api/extensions/download', [
            'email' => $email,
            'slug' => $extensionSlug,
            'license' => $licenseKey,
            'mode' => 'test',
            'version' => $dbExtension?->getAttribute('version') ?: 'v2'
        ]);

        if ($response->failed()) {
            return [
                'status' => false,
                'message' => trans('Failed to download extension')
            ];
        }

        $zipContent = $response->body();

        Storage::disk('local')->put('file.zip', $zipContent);

        $checkZip = $this->zipArchive->open(
            Storage::disk('local')->path('file.zip')
        );

        if ($checkZip) {

            $this->zipExtractPath = storage_path('app/zip-extract');

            $this->zipArchive->extractTo($this->zipExtractPath);

            $this->zipArchive->close();

            Storage::disk('local')->delete('file.zip');

            try {
                # index json
                $this->getIndexJson();

                if (empty($this->indexJsonArray)) {
                    return [
                        'status' => false,
                        'message' => trans('index.json not found')
                    ];
                }

                $this->deleteOldVersionFiles();

                # make dir
                $this->makeDir($extensionSlug);

                # run install query
                $this->runInstallQuery();

                # copy resource
                $this->copyResource();

                # copy view
                $this->copyRoute();

                # copy controllers
                $this->copyControllers();

                # copy files
                $this->copyFiles();

                # delete zip extract dir
                (new Filesystem)->deleteDirectory($this->zipExtractPath);

                Extension::query()->where('slug', $extensionSlug)
                    ->update([
                        'installed' => 1
                    ]);

                return [
                    'success' => true,
                    'status' => true,
                    'message' => trans('Extension installed successfully')
                ];

            }catch (Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
    }

    /**
     * Install query for extension
     *
     * @return void
     */
    public function runInstallQuery(): void
    {
        $data = data_get($this->indexJsonArray, 'migrations.install');

        if (empty($data)) {
            return;
        }

        foreach ($data as $value) {
            $table = data_get($value, 'condition.table');

            $column = data_get($value, 'condition.column', null);

            $sqlPath = $this->zipExtractPath . DIRECTORY_SEPARATOR . 'migrations'. DIRECTORY_SEPARATOR . data_get($value, 'path');

            if (
                Schema::hasTable($table)
                && File::exists($sqlPath)
                && is_null($column)
            ) {
                $installQuery = $this->installQuery(
                    $sqlPath
                );

                DB::unprepared($installQuery);
            } else if (
                Schema::hasTable($table)
                && File::exists($sqlPath)
                && $column
            ) {
                $installQuery = $this->installQuery(
                    $sqlPath
                );

                $column = data_get($value, 'condition.column');

                if (! Schema::hasColumn($table, $column)) {
                    DB::unprepared($installQuery);
                }
            }
        }
    }

    private function installQuery(string $sqlPath): bool|string
    {
        return file_get_contents($sqlPath);
    }

    public function copyResource(): void
    {
        $zipExtractPath = $this->zipExtractPath;

        $extensionSlug = $this->extensionSlug;

        File::copy(
            $zipExtractPath . DIRECTORY_SEPARATOR . 'index.json',
            resource_path("extensions/$extensionSlug/index.json")
        );

        $data = data_get($this->indexJsonArray, 'migrations.uninstall');

        if (empty($data) && ! is_array($data)) {
            return;
        }

        foreach ($data as $value) {
            $path = data_get($value, 'path');

            $sqlPath = $zipExtractPath . DIRECTORY_SEPARATOR . 'migrations'. DIRECTORY_SEPARATOR . $path;

            File::copy($sqlPath, resource_path("extensions/$extensionSlug/migrations/$path"));
        }
    }

    public function copyRoute(): void {
        $zipExtractPath = $this->zipExtractPath;

        $route = data_get($this->indexJsonArray, 'route');

        if (empty($route)) {
            return;
        }

        $routePath = $zipExtractPath. DIRECTORY_SEPARATOR . $route;

        if (File::exists($routePath)) {
            File::copy(
                $routePath,
                base_path("routes/extroutes/". basename($routePath))
            );
        }
    }

    public function copyControllers(): void
    {
        $zipExtractPath = $this->zipExtractPath;

        $controllers = data_get($this->indexJsonArray, 'controllers');

        if (! is_array($controllers)) {
            return;
        }

        foreach ($controllers as $controller) {

            $controllerPath = $zipExtractPath . DIRECTORY_SEPARATOR . $controller;

            if (! File::isDirectory(dirname(base_path($controller)))) {
                File::makeDirectory(dirname(base_path($controller)), 0777, true);
            }

            if (File::exists($controllerPath)) {
                File::copy(
                    $controllerPath,
                    base_path($controller)
                );
            }
        }
    }


    public function copyFiles(): void {

        $zipExtractPath = $zipExtractPath ?? $this->zipExtractPath;

        $files = data_get($this->indexJsonArray, 'stubs');

        if (empty($files) && ! is_array($files)) {
            return;
        }

        foreach ($files as  $key => $file) {

            $fileName = is_numeric($key) ? basename($file) : $key;

            $sourcePath = $zipExtractPath  . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $fileName;

            $destinationPath = base_path($file);

            Log::info("Copying $sourcePath to $destinationPath...");

            if (! File::isDirectory(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0777, true);
            }

            File::copy($sourcePath, $destinationPath);
        }
    }

    /**
     * Check license function
     *
     * @param string|null $licenseKey
     * @return bool|string|null
     */
    public function checkLicense(?string $licenseKey = null): null|bool|string
    {
        $licenseKey = $licenseKey ?? Helper::settingTwo('liquid_license_domain_key');

        $response = Http::get('https://portal.liquid-themes.com/api/license/' . DIRECTORY_SEPARATOR . $licenseKey);

        if ($response->failed()) {
            return false;
        }

        return $response->json('owner.email');
    }
}