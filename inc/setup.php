<?php
/**
 * Theme Setup
 *
 * @package Sector
 */

namespace Sector\Template;

/**
 * Register Post-type and Taxonomy
 */
if (function_exists('LibWp')) {
    LibWp()->postType()
        ->setName('book')
        ->setLabels([
            'name'          => _x('Books', 'Post type general name', 'textdomain'),
            'singular_name' => _x('Book', 'Post type singular name', 'textdomain'),
            'menu_name'     => _x('Books', 'Admin Menu text', 'textdomain'),
            'add_new'       => __('Add New', 'textdomain'),
            'edit_item'     => __('Edit Book', 'textdomain'),
            'view_item'     => __('View Book', 'textdomain'),
            'all_items'     => __('All Books', 'textdomain'),
        ])
        ->setFeatures([
            'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'
        ])
        ->setArgument('show_ui', true)
        ->register();

    LibWp()->taxonomy()
        ->setName('types')
        ->setPostTypes('book')
        ->setLabels([
            'name'          => _x('Types', 'taxonomy general name', 'textdomain'),
            'singular_name' => _x('Type', 'taxonomy singular name', 'textdomain'),
            'search_items'  => __('Search Types', 'textdomain'),
            'all_items'     => __('All Types', 'textdomain'),
            'edit_item'     => __('Edit Type', 'textdomain'),
            'add_new_item'  => __('Add New Type', 'textdomain'),
            'new_item_name' => __('New Type Name', 'textdomain'),
            'menu_name'     => __('Types', 'textdomain'),
        ])
        ->register();
}