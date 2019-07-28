<h2>
    <img src="<?php echo WP_PLUGIN_URL."/".$this->plugin_name."/public/img/icon4.png"; ?>" alt=""> 
    Ethiopian Calendar : <?=$ameshash_title?>
</h2>




<h2 class="nav-tab-wrapper">
    <a href="<?=admin_url( 'admin.php?page=' . $this->plugin_name )?>"
        class="nav-tab <?=$ameshash_active == 'home'? 'nav-tab-active' : 's'?>">
        <?php _e( 'General' ); ?>
    </a><a href="<?=admin_url( 'admin.php?page=' . $this->plugin_name."_setting" )?>"
        class="nav-tab <?=$ameshash_active == 'setting'? 'nav-tab-active' : ''?>">
        <?php _e( 'Setting' ); ?> </a>
</h2>