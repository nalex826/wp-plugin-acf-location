<?php

/*
Plugin Name: Advanced Custom Fields: Locations
Description: Custom ACF field to handle Locations
Version: 1.0.0
Author: Alex
License: GPLv2 or later
*/

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// check if class already exists
if (! class_exists('custom_acf_plugin_locations')) {
    class custom_acf_plugin_locations
    {
        // vars
        public $settings;

        /*
        *  __construct
        *
        *  This function will setup the class functionality
        *
        *  @type	function
        *  @date	17/02/2016
        *  @since	1.0.0
        *
        *  @param	void
        *  @return	void
        */

        public function __construct()
        {
            // settings
            // - these will be passed into the field class.
            $this->settings = [
                'version'	=> '1.0.0',
                'url'		   => plugin_dir_url(__FILE__),
                'path'		  => plugin_dir_path(__FILE__),
            ];

            // include field
            add_action('acf/include_field_types', [$this, 'include_field']); // v5
            add_action('acf/register_fields', [$this, 'include_field']); // v4
        }

        /*
        *  include_field
        *
        *  This function will include the field type class
        *
        *  @type	function
        *  @date	17/02/2016
        *  @since	1.0.0
        *
        *  @param	$version (int) major ACF version. Defaults to false
        *  @return	void
        */

        public function include_field($version = false)
        {
            // support empty $version
            if (! $version) {
                $version = 4;
            }

            // load textdomain
            load_plugin_textdomain('custom_acf', false, plugin_basename(dirname(__FILE__)) . '/lang');

            // include
            include_once 'fields/class-acf-field-locations-v' . $version . '.php';
        }
    }

    // initialize
    new custom_acf_plugin_locations();

    // class_exists check
}
