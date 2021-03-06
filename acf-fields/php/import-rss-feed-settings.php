<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5bd2c7df04f83',
    'title' => __('Import RSS Feed - settings', 'import-rss-feed'),
    'fields' => array(
        0 => array(
            'key' => 'field_5bd2cc992a6e3',
            'label' => __('RSS Feeds', 'import-rss-feed'),
            'name' => 'import_rss_feed',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => 'field_5bd2ccee2a6e5',
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => __('Add feed', 'import-rss-feed'),
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_5bd2ccee2a6e5',
                    'label' => __('Name', 'import-rss-feed'),
                    'name' => 'name',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '30',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                1 => array(
                    'key' => 'field_5bd2ccca2a6e4',
                    'label' => __('URL', 'import-rss-feed'),
                    'name' => 'url',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '70',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
                2 => array(
                    'key' => 'field_5bd2cd1c2a6e6',
                    'label' => __('Post Type', 'import-rss-feed'),
                    'name' => 'post_type',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'post' => __('Posts', 'import-rss-feed'),
                        'page' => __('Pages', 'import-rss-feed'),
                        'event' => __('Event', 'import-rss-feed'),
                        'ticket' => __('Tickets', 'import-rss-feed'),
                        'listing' => __('Listings', 'import-rss-feed'),
                        'my-post-type' => __('My Post Type', 'import-rss-feed'),
                    ),
                    'default_value' => array(
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                3 => array(
                    'key' => 'field_5bd2ce8769988',
                    'label' => __('Post status', 'import-rss-feed'),
                    'name' => 'post_status',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'publish' => __('Publish', 'import-rss-feed'),
                        'draft' => __('Draft', 'import-rss-feed'),
                    ),
                    'default_value' => array(
                        0 => 'publish',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                4 => array(
                    'key' => 'field_5bd705c0dfe9b',
                    'label' => __('Post Author', 'import-rss-feed'),
                    'name' => 'post_author',
                    'type' => 'user',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'role' => '',
                    'allow_null' => 1,
                    'multiple' => 0,
                    'return_format' => 'id',
                ),
                5 => array(
                    'key' => 'field_5be55696bc8f6',
                    'label' => __('Import RSS thumbnail', 'import-rss-feed'),
                    'name' => 'rss_thumbnail',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                6 => array(
                    'key' => 'field_5be556f7bc8f7',
                    'label' => __('Look for OpenGraph thumbnail', 'import-rss-feed'),
                    'name' => 'opengraph_thumbnail',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        0 => array(
                            0 => array(
                                'field' => 'field_5be55696bc8f6',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
            ),
        ),
        1 => array(
            'key' => 'field_5bd2d4ef35289',
            'label' => __('Enable recurring imports', 'import-rss-feed'),
            'name' => 'import_rss_feed_recurring_imports',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => __('On', 'import-rss-feed'),
            'ui_off_text' => __('Off', 'import-rss-feed'),
        ),
        2 => array(
            'key' => 'field_5bd2d5993528a',
            'label' => __('Import frequency', 'import-rss-feed'),
            'name' => 'import_rss_feed_recurring_imports_frequency',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_5bd2d4ef35289',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'hourly' => __('Hourly', 'import-rss-feed'),
                'daily' => __('Daily', 'import-rss-feed'),
            ),
            'default_value' => array(
                0 => 'daily',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
        ),
        3 => array(
            'key' => 'field_5bd705165ec05',
            'label' => __('Manual import', 'import-rss-feed'),
            'name' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'new_lines' => '',
            'esc_html' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'rss-importer',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}