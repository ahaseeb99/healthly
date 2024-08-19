<?php

/*
|--------------------------------------------------------------------------
| Cache Themes
|--------------------------------------------------------------------------
|
| igaster/laravel-theme reads themes settings from json files inside
| each theme's folder. We will cache them in a single php file to
| avoid searching the filesystem for each Request. You can use
| 'theme:refresh-cache' to rebuild cache, or set config/themes.php
| 'cache' setting to false to disable completely
|
*/

return array (
  0 => 
  array (
    'name' => 'creative',
    'asset-path' => 'themes/creative',
    'extends' => 'default',
    'views-path' => 'creative',
  ),
  1 => 
  array (
    'name' => 'default',
    'asset-path' => 'themes/default',
    'extends' => '',
    'wideLayoutPaddingX' => '',
    'defaultVariations' => 
    array (
      'button' => 
      array (
        'variant' => 'primary',
        'hoverVariant' => 'none',
        'size' => 'md',
      ),
      'card' => 
      array (
        'variant' => 'outline',
        'size' => 'md',
        'roundness' => 'default',
      ),
      'table' => 
      array (
        'variant' => 'outline',
      ),
    ),
    'googleFonts' => 
    array (
      'Inter' => 
      array (
        0 => '400',
        1 => '500',
        2 => '600',
      ),
      'Golos+Text' => 
      array (
        0 => '400',
        1 => '500',
        2 => '600',
        3 => '700',
      ),
      'Onest' => 
      array (
        0 => '400',
        1 => '500',
        2 => '700',
      ),
    ),
    'views-path' => 'default',
  ),
  2 => 
  array (
    'name' => 'sleek',
    'asset-path' => 'themes/sleek',
    'extends' => 'default',
    'wideLayoutPaddingX' => 'px-4 lg:px-10',
    'defaultVariations' => 
    array (
      'card' => 
      array (
        'variant' => 'shadow',
        'roundness' => '4xl',
      ),
      'table' => 
      array (
        'variant' => 'shadow',
      ),
    ),
    'views-path' => 'sleek',
  ),
);