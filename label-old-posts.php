<?php
/**
 * Plugin Name: Label Old Posts
 * Plugin URI: http://github/
 * Description: Label Old Posts: Help readers understand that an older post may not still be relevant
 * Version: 1.0
 * Author: Aaron Saray
 * Author URI: http://aaronsaray.com
 * License: MIT
 */

/**
 * My OSS Namespace and then this plugin
 */
Namespace AaronSaray\LabelOldPosts;

/**
 * Constant for plugin options
 */
define(__NAMESPACE__ . '\OPTIONS_FIELD', 'label-old-posts-plugin_options');

/**
 * When the plugin is installed, set the options
 */
function install()
{
    \add_option('label-old-posts-plugin_options', array('label-old-posts-plugin_option_date'=>'-2 years'));
}

/**
 * When plugin is removed, remove the option
 */
function remove()
{
    \delete_option('label-old-posts-plugin_options');
}

/**
 * Adding a menu item for the configuration options
 */
function admin_menu()
{
    add_options_page('Label Old Posts', 'Label Old Posts', 'manage_options', 'label-old-posts', __NAMESPACE__ . '\\options_page');
}

/**
 * The options page output
 */
function options_page()
{
    echo '<div><h2>Label Old Posts Settings</h2>';
    echo '<p>The following settings govern the functionality of the Label Old Posts plugin.</p>';
    echo '<form action="options.php" method="post">';

    \settings_fields(\AaronSaray\LabelOldPosts\OPTIONS_FIELD);
    \do_settings_sections('label-old-posts');

    echo '<input name="Submit" type="submit" value="';
    esc_attr_e('Save Changes');
    echo '">';

    echo '</form>';
    echo '</div>';
}

/**
 * Adds the settings fields
 */
function admin_init()
{
    register_setting(\AaronSaray\LabelOldPosts\OPTIONS_FIELD, 'label-old-posts-plugin_options', __NAMESPACE__ . '\\plugin_options_validate');
    add_settings_section('label-old-posts-plugin_main', 'Date Settings', __NAMESPACE__ . '\\plugin_options_main_section_text', 'label-old-posts');
    add_settings_field('label-old-posts-plugin_option_date', 'Posts older than:', __NAMESPACE__ . '\\plugin_options_date', 'label-old-posts', 'label-old-posts-plugin_main');
}

/**
 * Outputs the main date section
 */
function plugin_options_main_section_text()
{
    echo '<p>Any posts older than the date string below will be labeled as an old post.</p>';
    echo '<p>Please use phrases like <strong>-6 months</strong> or <strong>last year</strong>.  For more options, visit PHP ';
    echo '<a href="http://php.net/strtotime" target="_blank">strtotime</a> manual page.</p>';
}

/**
 * Outputs the date option input box
 */
function plugin_options_date()
{
    $options = get_option('label-old-posts-plugin_options');
    $pluginDate = isset($options['label-old-posts-plugin_option_date']) ? $options['label-old-posts-plugin_option_date'] : '';
    echo "<input id='plugin_text_string' name='label-old-posts-plugin_options[label-old-posts-plugin_option_date]' type='text' value='{$pluginDate}' />";
}

/**
 * setting validation function
 */
function plugin_options_validate($input)
{
    $clean = array();

    $dateString = trim($input['label-old-posts-plugin_option_date']);
    $parsed = strtotime($dateString); // will return false on parsing fail
    if ($parsed) {
        $clean['label-old-posts-plugin_option_date'] = $dateString;
    }

    return $clean;
}

/** register the installation hook **/
register_activation_hook(__FILE__, __NAMESPACE__ . '\\install');

/** register uninstall hook **/
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\\remove');

/** register the admin menu **/
add_action('admin_menu', __NAMESPACE__ . '\\admin_menu');

/** register admin settings function **/
add_action('admin_init', __NAMESPACE__ . '\\admin_init');
