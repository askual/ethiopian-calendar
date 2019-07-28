<div class="wrap">
  <?php 
  $ameshash_active = 'setting';
  $ameshash_title = "Setting";
  include 'ameshash-admin-header.php';
  ?>

  <?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { echo '<div id="message" class="updated"><p>'. __('Settings saved.') .'</p></div>'.PHP_EOL; } ?>
  <div style="width: 65%; float: left;">
    <form method="post" action="options.php">
      <?php
    settings_fields( $this->plugin_name );

    $options = get_option($this->plugin_name);

    $language = $options['language'];
    $format = $options['format'];
    // var_dump($options);

    ?>
      <br />

      <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
        <h3 class="hndle" style="padding:5px;"><span>Date format</span></h3>
        <div class="inside">
          <p align="justify">Choose Ethiopian date output format.</p>
          <table class="form-table">

            <tr valign="top">
              <th scope="row">
                <input type="radio" name="<?php echo $this->plugin_name; ?>[format]" value="1"
                  <?php checked('1', $format, true); ?>>
              </th>
              <?php if ($language=="en"): ?>
              <td>29th Hidar, 1989 A.D</td>
              <?php else: ?>
              <td>ህዳር 29 ቀን 1989 አ.ም</td>
              <?php endif; ?>
            </tr>

            <tr valign="top">
              <th scope="row">
                <input type="radio" name="<?php echo $this->plugin_name; ?>[format]" value="2"
                  <?php checked('2', $format, true); ?>>
              </th>
              <?php if ($language=="en"): ?>
              <td>29th Hidar, 1989</td>
              <?php else: ?>
              <td>ህዳር 29 ቀን 1989</td>
              <?php endif; ?>
            </tr>

            <tr valign="top">
              <th scope="row">
                <input type="radio" name="<?php echo $this->plugin_name; ?>[format]" value="3"
                  <?php checked('3', $format, true); ?>>
              </th>
              <?php if ($language=="en"): ?>
              <td>29/03/1989 A.D</td>
              <?php else: ?>
              <td>29/03/1989 አ.ም</td>
              <?php endif; ?>
            </tr>

            <tr valign="top">
              <th scope="row">
                <input type="radio" name="<?php echo $this->plugin_name; ?>[format]" value="4"
                  <?php checked('4', $format, true); ?>>
              </th>
              <td>29/03/1989</td>
            </tr>

          </table>
          <?php submit_button(); ?>
        </div>
      </div>

      <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
        <h3 class="hndle" style="padding:5px;"><span>Date Language</span></h3>
        <div class="inside">
          <p align="justify">Choose Ethiopian date output language. You can use default (english) language or አማርኛ.</p>
          <table class="form-table">
            <tr>
              <td><input type="radio" name="<?php echo $this->plugin_name; ?>[language]" value="en"
                  <?php checked('en', $language, true); ?>></td>
              <td>English</td>
            </tr>
            <tr>
              <td><input type="radio" name="<?php echo $this->plugin_name; ?>[language]" value="am"
                  <?php checked('am', $language, true); ?>></td>
              <td>አማርኛ</td>
            </tr>
          </table>
          <?php submit_button(); ?>
        </div>

      </div>


    </form>
  </div>




  <?php

include __DIR__.'/ameshash-admin-sidebar.php';
?>


</div>