<?php

namespace PressWind\postType\Portfolio;

function register_custom_post_type()
{
    $labels = [
        'name' => _x('Portfolio', 'Post Type General Name', 'wp-performance'),
        'singular_name' => _x('Portfolio Project', 'Post Type Singular Name', 'wp-performance'),
        'menu_name' => __('Portfolio', 'wp-performance'),
        'name_admin_bar' => __('Portfolio', 'wp-performance'),
        'archives' => __('Portfolio Archives', 'wp-performance'),
        'attributes' => __('Portfolio Attributes', 'wp-performance'),
        'parent_item_colon' => __('Parent Portfolio Project:', 'wp-performance'),
        'all_items' => __('All Portfolio Projects', 'wp-performance'),
        'add_new_item' => __('Add New Portfolio Project', 'wp-performance'),
        'add_new' => __('Add New', 'wp-performance'),
        'new_item' => __('New Portfolio Project', 'wp-performance'),
        'edit_item' => __('Edit Portfolio Project', 'wp-performance'),
        'update_item' => __('Update Portfolio Project', 'wp-performance'),
        'view_item' => __('View Portfolio Project', 'wp-performance'),
        'view_items' => __('View Portfolio Projects', 'wp-performance'),
        'search_items' => __('Search Portfolio Projects', 'wp-performance'),
        'not_found' => __('Portfolio Project Not Found', 'wp-performance'),
        'not_found_in_trash' => __('Portfolio Project Not Found in Trash', 'wp-performance'),
        'featured_image' => __('Featured Image', 'wp-performance'),
        'set_featured_image' => __('Set Featured Image', 'wp-performance'),
        'remove_featured_image' => __('Remove Featured Image', 'wp-performance'),
        'use_featured_image' => __('Use as Featured Image', 'wp-performance'),
        'insert_into_item' => __('Insert into Portfolio Project', 'wp-performance'),
        'uploaded_to_this_item' => __('Uploaded to this Portfolio Project', 'wp-performance'),
        'items_list' => __('Portfolio Projects list', 'wp-performance'),
        'items_list_navigation' => __('Portfolio Projects list navigation', 'wp-performance'),
        'filter_items_list' => __('Filter portfolio projects list', 'wp-performance'),
    ];

    $args = [
        'label' => __('Portfolio Project', 'wp-performance'),
        'description' => __('Portfolio projects and case studies', 'wp-performance'),
        'labels' => $labels,
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
        ],
        'taxonomies' => [
            'category',
            'post_tag',
        ],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => 'portfolio',
        'rewrite' => [
            'slug' => 'portfolio',
            'with_front' => false,
        ],
        'can_export' => true,
        'capability_type' => 'post',
    ];


    register_post_type('portfolio', $args);
}

add_action('init', __NAMESPACE__.'\register_custom_post_type', 0);
