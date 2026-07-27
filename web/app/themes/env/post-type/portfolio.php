<?php

namespace Env\PostType\Portfolio;

function register_custom_post_type()
{
    $labels = [
        'name' => _x('Portfolio', 'Post Type General Name', 'press-wind'),
        'singular_name' => _x('Portfolio Project', 'Post Type Singular Name', 'press-wind'),
        'menu_name' => __('Portfolio', 'press-wind'),
        'name_admin_bar' => __('Portfolio', 'press-wind'),
        'archives' => __('Portfolio Archives', 'press-wind'),
        'attributes' => __('Portfolio Attributes', 'press-wind'),
        'parent_item_colon' => __('Parent Portfolio Project:', 'press-wind'),
        'all_items' => __('All Portfolio Projects', 'press-wind'),
        'add_new_item' => __('Add New Portfolio Project', 'press-wind'),
        'add_new' => __('Add New', 'press-wind'),
        'new_item' => __('New Portfolio Project', 'press-wind'),
        'edit_item' => __('Edit Portfolio Project', 'press-wind'),
        'update_item' => __('Update Portfolio Project', 'press-wind'),
        'view_item' => __('View Portfolio Project', 'press-wind'),
        'view_items' => __('View Portfolio Projects', 'press-wind'),
        'search_items' => __('Search Portfolio Projects', 'press-wind'),
        'not_found' => __('Portfolio Project Not Found', 'press-wind'),
        'not_found_in_trash' => __('Portfolio Project Not Found in Trash', 'press-wind'),
        'featured_image' => __('Featured Image', 'press-wind'),
        'set_featured_image' => __('Set Featured Image', 'press-wind'),
        'remove_featured_image' => __('Remove Featured Image', 'press-wind'),
        'use_featured_image' => __('Use as Featured Image', 'press-wind'),
        'insert_into_item' => __('Insert into Portfolio Project', 'press-wind'),
        'uploaded_to_this_item' => __('Uploaded to this Portfolio Project', 'press-wind'),
        'items_list' => __('Portfolio Projects list', 'press-wind'),
        'items_list_navigation' => __('Portfolio Projects list navigation', 'press-wind'),
        'filter_items_list' => __('Filter portfolio projects list', 'press-wind'),
    ];

    $args = [
        'label' => __('Portfolio Project', 'press-wind'),
        'description' => __('Portfolio projects and case studies', 'press-wind'),
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
            'portfolio_type',
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
        'has_archive' => false,
        'can_export' => true,
        'capability_type' => 'post',
    ];


    register_post_type('portfolio', $args);
}

function register_portfolio_taxonomy()
{
    $labels = [
        'name' => _x('Rodzaj projektu', 'Taxonomy General Name', 'press-wind'),
        'singular_name' => _x('Rodzaj projektu', 'Taxonomy Singular Name', 'press-wind'),
        'menu_name' => __('Rodzaj projektu', 'press-wind'),
        'all_items' => __('Wszystkie rodzaje projektów', 'press-wind'),
        'parent_item' => __('Nadrzędny rodzaj projektu', 'press-wind'),
        'parent_item_colon' => __('Nadrzędny rodzaj projektu:', 'press-wind'),
        'new_item_name' => __('Nowy rodzaj projektu', 'press-wind'),
        'add_new_item' => __('Dodaj nowy rodzaj projektu', 'press-wind'),
        'edit_item' => __('Edytuj rodzaj projektu', 'press-wind'),
        'update_item' => __('Aktualizuj rodzaj projektu', 'press-wind'),
        'view_item' => __('Zobacz rodzaj projektu', 'press-wind'),
        'separate_items_with_commas' => __('Oddziel rodzaje projektów przecinkami', 'press-wind'),
        'add_or_remove_items' => __('Dodaj lub usuń rodzaje projektów', 'press-wind'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych', 'press-wind'),
        'popular_items' => __('Popularne rodzaje projektów', 'press-wind'),
        'search_items' => __('Szukaj rodzajów projektów', 'press-wind'),
        'not_found' => __('Nie znaleziono', 'press-wind'),
        'no_terms' => __('Brak rodzajów projektów', 'press-wind'),
        'items_list' => __('Lista rodzajów projektów', 'press-wind'),
        'items_list_navigation' => __('Nawigacja listy rodzajów projektów', 'press-wind'),
    ];

    $args = [
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'rodzaj-projektu',
            'with_front' => false,
        ],
    ];

    register_taxonomy('portfolio_type', 'portfolio', $args);
}

/**
 * Project meta (client / year / scope / stack) shown in the case-study
 * header (templates/single-portfolio.html) via core/post-meta block
 * bindings; editable in the Custom Fields panel.
 */
function register_portfolio_meta()
{
    $fields = [
        'env_client' => __('Klient', 'press-wind'),
        'env_year' => __('Rok', 'press-wind'),
        'env_scope' => __('Zakres', 'press-wind'),
        'env_stack' => __('Stack', 'press-wind'),
    ];

    foreach ($fields as $key => $label) {
        register_post_meta('portfolio', $key, [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
            'label' => $label,
            'sanitize_callback' => 'wp_strip_all_tags',
            'default' => '',
        ]);
    }
}

add_action('init', __NAMESPACE__.'\register_custom_post_type', 0);
add_action('init', __NAMESPACE__.'\register_portfolio_taxonomy', 0);
add_action('init', __NAMESPACE__.'\register_portfolio_meta');
