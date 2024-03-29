<?php

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// check if class already exists
if (! class_exists('custom_loc_acf_field_locations')) {
    class custom_loc_acf_field_locations extends acf_field
    {
        // vars
        public $settings;
        // will hold info such as dir / path
        public $defaults; // will hold default field options

        /*
        *  __construct
        *
        *  Set name / label needed for actions / filters
        *
        *  @since	3.6
        *  @date	23/01/13
        */

        public function __construct($settings)
        {
            // vars
            $this->name     = 'locations';
            $this->label    = __('Locations');
            $this->category = __('Basic', 'custom_acf'); // Basic, Content, Choice, etc
            $this->defaults = [
                // add default here to merge into your field.
                // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
                // 'preview_size' => 'thumbnail'
            ];

            // do not delete!
            parent::__construct();

            // settings
            $this->settings = $settings;
        }

        /*
        *  create_options()
        *
        *  Create extra options for your field. This is rendered when editing a field.
        *  The value of $field['name'] can be used (like below) to save extra data to the $field
        *
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$field	- an array holding all the field's data
        */

        public function create_options($field)
        {
            // defaults?
            /*
            $field = array_merge($this->defaults, $field);
            */

            // key is needed in the field names to correctly save the data
            $key = $field['name'];

            // Create Field Options HTML
            ?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Preview Size', 'custom_acf'); ?></label>
		<p class="description"><?php _e('Thumbnail is advised', 'custom_acf'); ?></p>
	</td>
	<td>
		<?php

            do_action('acf/create_field', [
                'type'		  => 'radio',
                'name'		  => 'fields[' . $key . '][preview_size]',
                'value'		 => $field['preview_size'],
                'layout'	 => 'horizontal',
                'choices'	=> [
                    'thumbnail'      => __('Thumbnail', 'custom_acf'),
                    'something_else' => __('Something Else', 'custom_acf'),
                ],
            ]);

            ?>
	</td>
</tr>
<?php

        }

        /*
        *  create_field()
        *
        *  Create the HTML interface for your field
        *
        *  @param	$field - an array holding all the field's data
        *
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        public function create_field($field)
        {
            // defaults?
            /*
            $field = array_merge($this->defaults, $field);
            */

            // perhaps use $field['preview_size'] to alter the markup?

            // create Field HTML
            ?>
<div>

</div>
<?php
        }

        /*
        *  input_admin_enqueue_scripts()
        *
        *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
        *  Use this action to add CSS + JavaScript to assist your create_field() action.
        *
        *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        public function input_admin_enqueue_scripts()
        {
            // Note: This function can be removed if not used

            // vars
            $url     = $this->settings['url'];
            $version = $this->settings['version'];

            // register & include JS
            wp_register_script('custom_acf', "{$url}assets/js/input.js", ['acf-input'], $version);
            wp_enqueue_script('custom_acf');

            // register & include CSS
            wp_register_style('custom_acf', "{$url}assets/css/input.css", ['acf-input'], $version);
            wp_enqueue_style('custom_acf');
        }

        /*
        *  input_admin_head()
        *
        *  This action is called in the admin_head action on the edit screen where your field is created.
        *  Use this action to add CSS and JavaScript to assist your create_field() action.
        *
        *  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        public function input_admin_head()
        {
            // Note: This function can be removed if not used
        }

        /*
        *  field_group_admin_enqueue_scripts()
        *
        *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
        *  Use this action to add CSS + JavaScript to assist your create_field_options() action.
        *
        *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        public function field_group_admin_enqueue_scripts()
        {
            // Note: This function can be removed if not used
        }

        /*
        *  field_group_admin_head()
        *
        *  This action is called in the admin_head action on the edit screen where your field is edited.
        *  Use this action to add CSS and JavaScript to assist your create_field_options() action.
        *
        *  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        public function field_group_admin_head()
        {
            // Note: This function can be removed if not used
        }

        /*
        *  load_value()
        *
            *  This filter is applied to the $value after it is loaded from the db
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$value - the value found in the database
        *  @param	$post_id - the $post_id from which the value was loaded
        *  @param	$field - the field array holding all the field options
        *
        *  @return	$value - the value to be saved in the database
        */

        public function load_value($value, $post_id, $field)
        {
            // Note: This function can be removed if not used
            return $value;
        }

        /*
        *  update_value()
        *
        *  This filter is applied to the $value before it is updated in the db
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$value - the value which will be saved in the database
        *  @param	$post_id - the $post_id of which the value will be saved
        *  @param	$field - the field array holding all the field options
        *
        *  @return	$value - the modified value
        */

        public function update_value($value, $post_id, $field)
        {
            // Note: This function can be removed if not used
            return $value;
        }

        /*
        *  format_value()
        *
        *  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$value	- the value which was loaded from the database
        *  @param	$post_id - the $post_id from which the value was loaded
        *  @param	$field	- the field array holding all the field options
        *
        *  @return	$value	- the modified value
        */

        public function format_value($value, $post_id, $field)
        {
            // defaults?
            /*
            $field = array_merge($this->defaults, $field);
            */

            // perhaps use $field['preview_size'] to alter the $value?

            // Note: This function can be removed if not used
            return $value;
        }

        /*
        *  format_value_for_api()
        *
        *  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$value	- the value which was loaded from the database
        *  @param	$post_id - the $post_id from which the value was loaded
        *  @param	$field	- the field array holding all the field options
        *
        *  @return	$value	- the modified value
        */

        public function format_value_for_api($value, $post_id, $field)
        {
            // defaults?
            /*
            $field = array_merge($this->defaults, $field);
            */

            // perhaps use $field['preview_size'] to alter the $value?

            // Note: This function can be removed if not used
            return $value;
        }

        /*
        *  load_field()
        *
        *  This filter is applied to the $field after it is loaded from the database
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$field - the field array holding all the field options
        *
        *  @return	$field - the field array holding all the field options
        */

        public function load_field($field)
        {
            // Note: This function can be removed if not used
            return $field;
        }

        /*
        *  update_field()
        *
        *  This filter is applied to the $field before it is saved to the database
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$field - the field array holding all the field options
        *  @param	$post_id - the field group ID (post_type = acf)
        *
        *  @return	$field - the modified field
        */

        public function update_field($field, $post_id)
        {
            // Note: This function can be removed if not used
            return $field;
        }
    }

    // initialize
    new custom_loc_acf_field_locations($this->settings);

    // class_exists check
}

?>