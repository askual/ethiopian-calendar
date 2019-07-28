<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       askual.com
 * @since      1.0.0
 *
 * @package    Ameshash
 * @subpackage Ameshash/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="cleanup_options" action="options.php">
    	<?php
	        //Grab all options
	        $options = get_option($this->plugin_name);
	        // Cleanup
          var_dump($options);
            $abnormal = $options['abnormal'];
	        $normal = $options['normal'];
	    ?>
	    <?php
	        settings_fields($this->plugin_name);
	        do_settings_sections($this->plugin_name);
	    ?>
    <fieldset id="g1">
        <legend style="font-size: large; background-color: white;">
            <b><span>Date type</span></b>
        </legend>
        <label>
            <input type="radio" id="<?php echo $this->plugin_name; ?>-normal" name="<?php echo $this->plugin_name; ?>[normal]" value="1" <?php checked(1, $normal, true); ?> />
            <span><?php esc_attr_e('Ethiopian Orthodox date', $this->plugin_name); ?></span>
            <input type="radio" id="<?php echo $this->plugin_name; ?>-normal" name="<?php echo $this->plugin_name; ?>[normal]" value="2" <?php checked(2, $normal, true); ?> >
            <span><?php esc_attr_e('Secular Ethiopian date', $this->plugin_name); ?></span>
        </label>
    </fieldset>
    <fieldset>
        <legend style="font-size: large; background-color: white;">
            <b><span>Name</span></b>
        </legend>
        <label>
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-abnormal" name="<?php echo $this->plugin_name; ?>[abnormal]" value="1" <?php checked(1, $abnormal, true); ?> />
            <span><?php esc_attr_e('Something something', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <fieldset>
        <legend style="font-size: large; background-color: red;">
            <b><span>Uninstall</span></b>
        </legend>
        <label>
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-abnormal" name="<?php echo $this->plugin_name; ?>[abnormal]" value="1" <?php checked(1, $abnormal, true); ?> />
            <span><?php esc_attr_e('Something something', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>


</div>
