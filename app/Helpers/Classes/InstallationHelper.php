<?php

namespace App\Helpers\Classes;

use App\Models;
use App\Models\OpenAIGenerator;
use App\Services\Extension\ExtensionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InstallationHelper
{
    public static function runInstallation(): void
    {
        $installationData = InstallationHelper::data();

        foreach ($installationData as $key => $value) {
            if (isset($value["table"])) {

                if (is_string($value["table"])) {
                    if (! Schema::hasTable($value["table"])) {
                        continue;
                    }
                } else {
                    if (! $value['table']) {
                        continue;
                    }
                }


                if (!isset($value["sql"])) {
                    continue;
                }

                foreach ($value["sql"] as $sqlData) {
                    if (isset($sqlData['condition'])) {
                        if ($sqlData['condition']) {

                            $files = $sqlData['files'] ?? [];

                            if (is_array($files)) {
                                foreach ($files as $file) {
                                    DB::unprepared(
                                        file_get_contents(
                                            resource_path($file)
                                        )
                                    );
                                }
                            }
                        }
                    }

                    if (isset($sqlData["callback"])) {
                        $callback = $sqlData["callback"];
                        if (is_callable($callback)) {
                            call_user_func($callback);
                        }
                    }
                }
            } else {
				// if there is a different variation.
            }
        }
    }


    public static function data(): array
    {
        return [
			[
                'table' => 'openai_filters',
                'sql' => [
                    [
                        'condition' => DB::table('openai_filters')->count() === 0,
						'files' => [
                            'dev_tools/openai_filters.sql',
                        ]
                    ]
                ]
            ],
			[
                'table' => 'openai',
                'sql' => [
                    [
                        'condition' => Models\OpenAIGenerator::count() === 0,
                        'files' => [
                            'dev_tools/openai_table.sql',
                        ]
                    ]
                ]
            ],
			[
                'table' => 'openai',
                'sql' => [
                    [
                        'condition' => false,
                        'files' => [
                            'dev_tools/new_openai_table_templates.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'frontend_tools',
                'sql' => [
                    [
                        'condition' => Models\FrontendTools::count() === 0,
                        'files' => [
                            'dev_tools/frontend_tools.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'faq',
                'sql'   => [
                   [
                       'condition' => Models\Faq::count() === 0,
                       'files' => [
                           'dev_tools/faq.sql'
                       ]
                   ]
                ]
            ],
            [
                'table' => 'frontend_future',
                'sql'   => [
                   [
                       'condition' => Models\FrontendFuture::count() === 0,
                       'files' => [
                           'dev_tools/frontend_future.sql'
                       ]
                   ]
                ]
            ],
            [
                'table' => 'howitworks',
                'sql'   => [
                    [
                        'condition' => Models\HowitWorks::count() === 0,
                        'files' => [
                            'dev_tools/howitworks.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'testimonials',
                'sql'   => [
                    [
                        'condition' => Models\Testimonials::count() === 0,
                        'files' => [
                            'dev_tools/testimonials.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'frontend_who_is_for',
                'sql'   => [
                    [
                        'condition' => Models\FrontendForWho::count() === 0,
                        'files' => [
                            'dev_tools/frontend_who_is_for.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'frontend_generators',
                'sql'   => [
                    [
                        'condition' => Models\FrontendGenerators::count() === 0,
                        'files' => [
                            'dev_tools/frontend_generators.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'clients',
                'sql'   => [
                    [
                        'condition' => Models\Clients::count() === 0,
                        'files' => [
                            'dev_tools/clients.sql'
                        ]
                    ]
                ]
            ],
			[
                'table' => 'chatbot',
                'sql'   => [
                    [
                        'condition' => Models\Chatbot\Chatbot::count() === 0,
                        'files' => [
                            'dev_tools/chatbot.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => ! Schema::hasTable('health_check_result_history_items'),
                'sql'   => [
                    [
                        'condition' => true,
                        'files' => [
                            'dev_tools/health_check_result_history_items.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'email_templates',
                'sql'   => [
                    [
                        'condition' => Models\EmailTemplates::count() === 0,
                        'files' => [
                            'dev_tools/email_templates.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'ads',
                'sql'   => [
                    [
                        'condition' => Models\Ad::count() === 0,
                        'files' => [
                            'dev_tools/ads.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'openai',
                'sql' => [
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_article_wizard_generator')->count() === 0,
                        'files' => [
                            'dev_tools/ai_wizard.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_vision')->count() === 0,
                        'files' => [
                            'dev_tools/ai_vision.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_pdf')->count() === 0,
                        'files' => [
                            'dev_tools/ai_pdf.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_chat_image')->count() === 0,
                        'files' => [
                            'dev_tools/ai_chat_image.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_rewriter')->count() === 0,
                        'files' => [
                            'dev_tools/ai_rewriter.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_webchat')->count() === 0,
                        'files' => [
                            'dev_tools/ai_webchat.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_pdf')->count() === 0,
                        'files' => [
                            'dev_tools/ai_filechat.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenAIGenerator::where('slug', 'ai_video')->count() === 0,
                        'files' => [
                            'dev_tools/ai_video.sql'
                        ]
                    ],
                ]
            ],
            [
                'table' => 'openai_chat_category',
                'sql'   => [
					[
                        'condition' => Models\OpenaiGeneratorChatCategory::count() === 0,
                        'files' => [
                            'dev_tools/openai_chat_categories_table.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenaiGeneratorChatCategory::where('slug', 'ai_vision')->count() === 0,
                        'files' => [
                            'dev_tools/ai_vision2.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenaiGeneratorChatCategory::where('slug', 'ai_pdf')->count() === 0,
                        'files' => [
                            'dev_tools/ai_pdf2.sql',
                            'dev_tools/ai_filechat2.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenaiGeneratorChatCategory::where('slug', 'ai_chat_image')->count() === 0,
                        'files' => [
                            'dev_tools/ai_chat_image2.sql'
                        ]
                    ],
                    [
                        'condition' => Models\OpenaiGeneratorChatCategory::where('slug', 'ai_webchat')->count() === 0,
                        'files' => [
                            'dev_tools/ai_webchat2.sql'
                        ]
                    ],
                ]
            ],
            [
                'table' => 'email_templates',
                'sql'   => [
                    [
                        'condition' => Models\EmailTemplates::count() === 0,
                        'files' => [
                            'dev_tools/team_email_templates.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'plans',
                'sql' => [
                    [
                        'condition' => Schema::hasColumn('plans', 'open_ai_items') && Schema::hasTable('openai'),
                        'callback' => function () {
                            $openaiItems = Models\OpenAIGenerator::query()->pluck('slug')->toArray();

                            $plans = Models\PaymentPlans::query()->get();

                            foreach ($plans as $plan) {
                                $plan->open_ai_items = $openaiItems;
                                $plan->save();
                            }
                        },
                    ]
                ]
            ],
            [
                'table' => 'openai',
                'sql' => [
                    [
                        'condition' => Schema::hasTable('settings') && Schema::hasColumn('settings', 'free_open_ai_items'),
                        'callback' => function () {
                            $openaiItems = Models\OpenAIGenerator::query()->pluck('slug')->toArray();
                            $setting = Models\Setting::first();

                            $setting->update([
                                'free_open_ai_items' => $openaiItems ?: [],
                            ]);
                        },
                    ]
                ]
            ],
            [
                'table' => (new Models\Page())->getTable(),
                'sql'   => [
                    [
                        'condition' => Models\Page::where('is_custom', 1)->count() === 0,
                        'files' => [
                            'dev_tools/inner_pages.sql'
                        ]
                    ]
                ]
            ],
			[
                'table' => (new Models\Currency())->getTable(),
                'sql'   => [
                    [
                        'condition' => Models\Currency::count() === 0,
                        'files' => [
                            'dev_tools/currency.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' =>'openai',
                'sql'   => [
                    [
                        'condition' => ! OpenAIGenerator::where('slug', 'ai_voiceover')->exists(),
                        'files' => [
                            'dev_tools/ai_voiceover.sql',
                            'dev_tools/ai_filter_voiceover.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'openai',
                'sql'   => [
                    [
                        'condition' => ! OpenAIGenerator::where('slug', 'ai_youtube')->exists(),
                        'files' => [
                            'dev_tools/ai_youtube.sql',
                            'dev_tools/ai_filter_youtube.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'openai',
                'sql'   => [
                    [
                        'condition' => ! OpenAIGenerator::where('slug', 'ai_rss')->exists(),
                        'files' => [
                            'dev_tools/ai_rss.sql',
                            'dev_tools/ai_filter_rss.sql'
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => true,
                        'files' => [
                            'dev_tools/extensions/version.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
						'condition' => Models\Extension::query()->where('slug', 'cloudflare-r2')->doesntExist(),
                        'files' => [
                            'dev_tools/extensions/cloudflare_r2.sql',
                        ],
                        'callback' => function () {
                            try {
                                Models\Extension::query()->where('slug', 'cloudflare-r2')->update([
                                    'licensed' => 0,
                                ]);

                                app(ExtensionService::class)->uninstall('cloudflare-r2');
                            }catch (\Exception $e) {
                            }
                        }
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'chat-setting')->doesntExist(),
                        'files' => [
                            'dev_tools/extensions/chat_setting.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
						'condition' => Models\Extension::query()->where('slug', 'chat-setting')->doesntExist(),
                        'files' => [
                            'dev_tools/extensions/wordpress.sql',
                        ],
                        'callback' => function () {
                            try {
                                Models\Extension::query()->where('slug', 'wordpress')->update([
                                    'licensed' => 0,
                                ]);
                                app(ExtensionService::class)->uninstall('wordpress');
                            }catch (\Exception $e) {
                            }
                        }
                    ]
                ]
            ],
            [
                'table' => 'integrations',
                'sql'   => [
                    [
                        'condition' => Models\Integration\Integration::query()->where('slug', 'wordpress')->doesntExist(),
                        'files' => [
                            'dev_tools/integrations/wordpress.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'integrations',
                'sql'   => [
                    [
                        'condition' => Models\Integration\Integration::query()->where('slug', 'wordpress')->exists(),
                        'callback' => function () {
                            try {
                                Models\Integration\Integration::query()->where('slug', 'wordpress')->update([
                                    'image' => 'images/integrations/wordpress.png',
                                ]);
                            }catch (\Exception $e) {
                            }
                        }
                    ]
                ]
            ],
//            [
//                'table' => 'extensions',
//                'sql'   => [
//                    [
//                        'condition' => Models\Extension::query()->where('slug', 'ai-template')->doesntExist(),
//                        'files' => [
//                            'dev_tools/extensions/ai_template.sql',
//                        ]
//                    ]
//                ]
//            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'newsletter')->exists(),
                        'files' => [
                            'dev_tools/extensions/newsletter_description.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'cloudflare-r2')->exists(),
                        'files' => [
                            'dev_tools/extensions/cloudflare_r2_description.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'chat-setting')->exists(),
                        'files' => [
                            'dev_tools/extensions/chat_setting_description.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'wordpress')->exists(),
                        'files' => [
                            'dev_tools/extensions/wordpress_description.sql',
                        ]
                    ]
                ]
            ],
            [
                'table' => 'extensions',
                'sql'   => [
                    [
                        'condition' => Models\Extension::query()->where('slug', 'webchat')->exists(),
                        'files' => [
                            'dev_tools/extensions/webchat_description.sql',
                        ]
                    ]
                ]
            ]
        ];
    }
}