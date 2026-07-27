<?php

namespace Env\PostType\Training;

function register_custom_post_type()
{
    $labels = [
        'name' => _x('Trainings', 'Post Type General Name', 'press-wind'),
        'singular_name' => _x('Training', 'Post Type Singular Name', 'press-wind'),
        'menu_name' => __('Trainings', 'press-wind'),
        'name_admin_bar' => __('Trainings', 'press-wind'),
        'archives' => __('Trainings Archives', 'press-wind'),
        'attributes' => __('Trainings Attributes', 'press-wind'),
        'parent_item_colon' => __('Parent Training:', 'press-wind'),
        'all_items' => __('All Trainings', 'press-wind'),
        'add_new_item' => __('Add New Training', 'press-wind'),
        'add_new' => __('Add New', 'press-wind'),
        'new_item' => __('New Training', 'press-wind'),
        'edit_item' => __('Edit Training', 'press-wind'),
        'update_item' => __('Update Training', 'press-wind'),
        'view_item' => __('View Training', 'press-wind'),
        'view_items' => __('View Trainings', 'press-wind'),
        'search_items' => __('Search Trainings', 'press-wind'),
        'not_found' => __('Training Not Found', 'press-wind'),
        'not_found_in_trash' => __('Training Not Found in Trash', 'press-wind'),
        'featured_image' => __('Featured Image', 'press-wind'),
        'set_featured_image' => __('Set Featured Image', 'press-wind'),
        'remove_featured_image' => __('Remove Featured Image', 'press-wind'),
        'use_featured_image' => __('Use as Featured Image', 'press-wind'),
        'insert_into_item' => __('Insert into Training', 'press-wind'),
        'uploaded_to_this_item' => __('Uploaded to this Training', 'press-wind'),
        'items_list' => __('Trainings list', 'press-wind'),
        'items_list_navigation' => __('Trainings list navigation', 'press-wind'),
        'filter_items_list' => __('Filter trainings list', 'press-wind'),
    ];

    $args = [
        'label' => __('Training', 'press-wind'),
        'description' => __('Training code', 'press-wind'),
        'labels' => $labels,
        'supports' => [
            'title',
            'editor',
            'custom-fields',
            //            'author',
        ],
        'taxonomies' => [
            'training-theme',
            'training-section',
        ],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'can_export' => true,
        'capability_type' => 'post',
    ];

    register_taxonomy('training-theme', 'training', [
        'public' => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'label' => 'Theme',
    ]);

    register_taxonomy('training-section', 'training', [
        'public' => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'label' => 'Section',
    ]);

    register_post_type('training', $args);
}

// add_action('init', __NAMESPACE__.'\register_custom_post_type', 0);
