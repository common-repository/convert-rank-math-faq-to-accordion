<?php
// Plugin Menu
function INBRMFA_add_settings_page() {
    add_options_page('INBRMFA Settings', 'Rank Math FAQ Accordion', 'manage_options', 'inb-rmfa-settings', 'INBRMFA_render_settings_page');
}
add_action('admin_menu', 'INBRMFA_add_settings_page');

// Render settings page
function INBRMFA_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Rank Math FAQ Accordion Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('INBRMFA_settings');
            do_settings_sections('inb-rmfa-settings');
            submit_button();
            ?>
            <button type="button" id="INBRMFA_reset_settings" class="button button-secondary">Reset to Default</button>
        </form>
    </div>
    <?php
}

// Register settings
function INBRMFA_register_settings() {
    register_setting('INBRMFA_settings', 'INBRMFA_options', 'INBRMFA_sanitize_options');

    add_settings_section('INBRMFA_main_section', null, null, 'inb-rmfa-settings');
    
    add_settings_field('INBRMFA_plugin_enabled', 'Enable Plugin', 'INBRMFA_plugin_enabled_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_counter_enabled', 'Enable Counter', 'INBRMFA_counter_enabled_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_question_font_size', 'Question Font Size', 'INBRMFA_question_font_size_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_question_color', 'Question Color', 'INBRMFA_question_color_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_question_background_color', 'Question Background Color', 'INBRMFA_question_background_color_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_answer_font_size', 'Answer Font Size', 'INBRMFA_answer_font_size_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_answer_color', 'Answer Color', 'INBRMFA_answer_color_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_answer_background_color', 'Answer Background Color', 'INBRMFA_answer_background_color_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_border_color', 'Border Color', 'INBRMFA_border_color_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
    add_settings_field('INBRMFA_border_radius', 'Border Radius', 'INBRMFA_border_radius_callback', 'inb-rmfa-settings', 'INBRMFA_main_section');
}
add_action('admin_init', 'INBRMFA_register_settings');

// Settings callbacks
function INBRMFA_plugin_enabled_callback() {
    $options = get_option('INBRMFA_options');
    $enabled = isset($options['plugin_enabled']) ? $options['plugin_enabled'] : 0;
    echo '<input type="checkbox" name="INBRMFA_options[plugin_enabled]" value="1" ' . checked(1, $enabled, false) . '/>';
}

function INBRMFA_counter_enabled_callback() {
    $options = get_option('INBRMFA_options');
    $enabled = isset($options['counter_enabled']) ? $options['counter_enabled'] : 0;
    echo '<input type="checkbox" name="INBRMFA_options[counter_enabled]" value="1" ' . checked(1, $enabled, false) . '/>';
}

function INBRMFA_question_font_size_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = 18;
    $value = isset($options['question_font_size']) ? $options['question_font_size'] : $default_value;
    echo '<input type="number" style="width:60px;" min="1" name="INBRMFA_options[question_font_size]" value="' . esc_attr($value) . '" required /> px';
}

function INBRMFA_question_color_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = '#1d1d1d';
    $value = isset($options['question_color']) ? $options['question_color'] : $default_value;
    echo '<input type="color" name="INBRMFA_options[question_color]" value="' . esc_attr($value) . '" />';
}

function INBRMFA_question_background_color_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = '#e2f6ff';
    $value = isset($options['question_background_color']) ? $options['question_background_color'] : $default_value;
    echo '<input type="color" name="INBRMFA_options[question_background_color]" value="' . esc_attr($value) . '" />';
}

function INBRMFA_answer_font_size_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = 16;
    $value = isset($options['answer_font_size']) ? $options['answer_font_size'] : $default_value;
    echo '<input type="number" style="width:60px;" min="1" name="INBRMFA_options[answer_font_size]" value="' . esc_attr($value) . '" required /> px';
}

function INBRMFA_answer_color_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = '#1d1d1d';
    $value = isset($options['answer_color']) ? $options['answer_color'] : $default_value;
    echo '<input type="color" name="INBRMFA_options[answer_color]" value="' . esc_attr($value) . '" />';
}

function INBRMFA_answer_background_color_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = '#f3fbff';
    $value = isset($options['answer_background_color']) ? $options['answer_background_color'] : $default_value;
    echo '<input type="color" name="INBRMFA_options[answer_background_color]" value="' . esc_attr($value) . '" />';
}

function INBRMFA_border_color_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = '#c4edff';
    $value = isset($options['border_color']) ? $options['border_color'] : $default_value;
    echo '<input type="color" name="INBRMFA_options[border_color]" value="' . esc_attr($value) . '" />';
}

function INBRMFA_border_radius_callback() {
    $options = get_option('INBRMFA_options');
    $default_value = 4;
    $value = isset($options['border_radius']) ? $options['border_radius'] : $default_value;
    echo '<input type="number" style="width:60px;" min="1" name="INBRMFA_options[border_radius]" value="' . esc_attr($value) . '" required /> px';
}

// Sanitizing function
function INBRMFA_sanitize_options($input) {
    $sanitized_input = array();

    $sanitized_input['plugin_enabled'] = isset($input['plugin_enabled']) ? absint($input['plugin_enabled']) : 0;
    $sanitized_input['counter_enabled'] = isset($input['counter_enabled']) ? absint($input['counter_enabled']) : 0;
    $sanitized_input['question_font_size'] = isset($input['question_font_size']) ? absint($input['question_font_size']) : 18;
    $sanitized_input['question_color'] = isset($input['question_color']) ? sanitize_hex_color($input['question_color']) : '#1d1d1d';
    $sanitized_input['question_background_color'] = isset($input['question_background_color']) ? sanitize_hex_color($input['question_background_color']) : '#e2f6ff';
    $sanitized_input['answer_font_size'] = isset($input['answer_font_size']) ? absint($input['answer_font_size']) : 16;
    $sanitized_input['answer_color'] = isset($input['answer_color']) ? sanitize_hex_color($input['answer_color']) : '#1d1d1d';
    $sanitized_input['answer_background_color'] = isset($input['answer_background_color']) ? sanitize_hex_color($input['answer_background_color']) : '#f3fbff';
    $sanitized_input['border_color'] = isset($input['border_color']) ? sanitize_hex_color($input['border_color']) : '#c4edff';
    $sanitized_input['border_radius'] = isset($input['border_radius']) ? absint($input['border_radius']) : 4;

    return $sanitized_input;
}

// Load asset file for settings page
function INBRMFA_enqueue_admin_scripts($hook) {
    if ('settings_page_inb-rmfa-settings' !== $hook) {
        return;
    }
    wp_enqueue_script('INBRMFA-admin-js', INBRMFA_PLUGIN_URL . 'assets/js/inb-rm-faq-accordion-admin.js', array('jquery'), INBRMFA_CURRENT_VERSION, true);
}
add_action('admin_enqueue_scripts', 'INBRMFA_enqueue_admin_scripts');

// Load asset files
function INBRMFA_load_plugin_asset_files() {
    $options = get_option('INBRMFA_options', array('plugin_enabled' => 1, 'counter_enabled' => 0));
    
    if (!isset($options['plugin_enabled']) || !$options['plugin_enabled']) {
        return;
    }

    wp_enqueue_style( 'inb-rm-faq-accordion', INBRMFA_PLUGIN_URL . 'assets/css/inb-rm-faq-accordion.min.css', array(), INBRMFA_CURRENT_VERSION );
    wp_enqueue_script( 'inb-rm-faq-accordion-scriptjs', INBRMFA_PLUGIN_URL . 'assets/js/inb-rm-faq-accordion.min.js', array('jquery'), INBRMFA_CURRENT_VERSION, 'true' );

    if (isset($options['counter_enabled']) && $options['counter_enabled']) {
        wp_enqueue_style( 'inb-rm-faq-accordion-counter', INBRMFA_PLUGIN_URL . 'assets/css/inb-rm-faq-accordion-counter.min.css', array(), INBRMFA_CURRENT_VERSION );
    }

    $INBRMFA_inline_css = "
        #rank-math-faq .rank-math-list-item {
            border-color: " . esc_attr($options['border_color'] ?? '#c4edff') . ";
            border-radius: " . esc_attr($options['border_radius'] ?? '4') . "px;
        }
        #rank-math-faq .rank-math-question {
            font-size: " . esc_attr($options['question_font_size'] ?? '18') . "px;
            color: " . esc_attr($options['question_color'] ?? '#1d1d1d') . ";
            background-color: " . esc_attr($options['question_background_color'] ?? '#e2f6ff') . ";
        }
        #rank-math-faq .rank-math-answer {
            font-size: " . esc_attr($options['answer_font_size'] ?? '16') . "px;
            color: " . esc_attr($options['answer_color'] ?? '#1d1d1d') . ";
            background-color: " . esc_attr($options['answer_background_color'] ?? '#f3fbff') . ";
        }
        #rank-math-faq .rank-math-question.rm-faq-question-active {
            border-bottom: 1px solid " . esc_attr($options['border_color'] ?? '#c4edff') . ";
        }
    ";
    wp_add_inline_style('inb-rm-faq-accordion', $INBRMFA_inline_css);
}
add_action( 'wp_enqueue_scripts', 'INBRMFA_load_plugin_asset_files' );

// Reset Settings
function INBRMFA_reset_settings() {
    $default_options = array(
        'plugin_enabled' => 1,
        'counter_enabled' => 0,
        'question_font_size' => '18',
        'question_color' => '#1d1d1d',
        'question_background_color' => '#e2f6ff',
        'answer_font_size' => '16',
        'answer_color' => '#1d1d1d',
        'answer_background_color' => '#f3fbff',
        'border_color' => '#c4edff',
        'border_radius' => '4'
    );
    update_option('INBRMFA_options', $default_options);
    wp_send_json_success();
}
add_action('wp_ajax_INBRMFA_reset_settings', 'INBRMFA_reset_settings');
