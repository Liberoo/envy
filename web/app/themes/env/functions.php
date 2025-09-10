<?php

namespace WP_Performance;

if (! defined('WP_ENV')) {
  define('WP_ENV', 'development');
}

// inc, you can modify this files like you want
require_once dirname(__FILE__) . '/inc/gutenberg.php';
require_once dirname(__FILE__) . '/inc/login_assets.php';
require_once dirname(__FILE__) . '/inc/sortable.php';

// variations
require_once dirname(__FILE__) . '/inc/variations_blocks.php';

// binding meta
require_once dirname(__FILE__) . '/inc/binding-meta.php';

// post type
require_once dirname(__FILE__) . '/post-type/snippet.php';
require_once dirname(__FILE__) . '/post-type/training.php';

// pwa icons
if (file_exists(dirname(__FILE__) . '/inc/pwa_head.php')) {
  include dirname(__FILE__) . '/inc/pwa_head.php';
}

/**
 * Theme setup.
 */
function setup()
{
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  load_theme_textdomain('press-wind', get_template_directory() . '/languages');
}

add_action('after_setup_theme', __NAMESPACE__ . '\setup');

/**
 * init assets front
 */
if (class_exists('PressWind\PWVite')) {
  \PressWind\PWVite::init(port: 3000, path: '');
  \PressWind\PWVite::init(
    port: 4444,
    path: '/admin',
    position: 'editor',
    is_ts: false
  );
}

/** disable caching wp query */
function disable_caching($wp_query)
{
  if (WP_ENV === 'development') {
    $wp_query->query_vars['cache_results'] = false;
  }
}

add_action('parse_query', __NAMESPACE__ . '\disable_caching');

/**
 * Initialize block styles and other init functionality
 */
function init_theme() {
  add_filter('jpeg_quality', function () {
    return 100;
  }, 10, 2);

  register_block_style('core/image', [
    'name' => 'img-dropshadow',
    'label' => __('Drop Shadow', 'press-wind'),
  ]);

  register_block_style('core/image', [
    'name' => 'img-dropshadow-rounded',
    'label' => __('Drop Shadow Rounded', 'press-wind'),
  ]);

  register_block_style('core/heading', [
    'name' => 'text-gradient',
    'label' => __('Text Gradient', 'press-wind'),
  ]);

  register_block_style('core/heading', [
    'name' => 'text-effect',
    'label' => __('Text Effect', 'press-wind'),
  ]);

  register_block_style('core/heading', [
    'name' => 'title-hero',
    'label' => __('Title Hero', 'press-wind'),
  ]);

  register_block_style('core/paragraph', [
    'name' => 'underscore',
    'label' => __('Underscore', 'press-wind'),
  ]);
}

add_action('init', __NAMESPACE__ . '\init_theme');

/**
 * Enable Interactivity API support
 */
function enable_interactivity_api() {
    add_theme_support('interactivity');
    wp_enqueue_script('wp-interactivity');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enable_interactivity_api');

/**
 * Register Custom Blocks
 */
function register_kamil_test_block() {
    // Add block category
    add_filter('block_categories_all', function($categories) {
        return array_merge($categories, [
            [
                'slug'  => 'press-wind-blocks',
                'title' => 'Press Wind Blocks',
                'icon'  => 'star-filled'
            ]
        ]);
    });
    
    // Register the block
    $block_path = get_theme_file_path('blocks/kamil-test-block');
    if (file_exists($block_path . '/block.json')) {
        register_block_type($block_path);
    }
}

add_action('init', __NAMESPACE__ . '\register_kamil_test_block');

/**
 * Register RichText Example Block
 */
function register_richtext_example_block() {
    // Register the RichText example block
    $block_path = get_theme_file_path('blocks/richtext-example');
    if (file_exists($block_path . '/block.json')) {
        register_block_type($block_path);
        
        // Debug info
        if (WP_ENV === 'development') {
            error_log('✅ RichText Example Block registered: ' . $block_path);
        }
    } else {
        if (WP_ENV === 'development') {
            error_log('❌ RichText Example Block NOT found: ' . $block_path);
        }
    }
}

add_action('init', __NAMESPACE__ . '\register_richtext_example_block');
