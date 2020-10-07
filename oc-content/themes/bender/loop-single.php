    <?php 
    $size = explode('x', osc_thumbnail_dimensions()); 
    $detail = osc_get_item_meta ();
    $rooms = '';
    if ($detail[3]['s_value'] !== 'Студия') {
        $rooms = $detail[3]['s_value'] . '-к квартира';
    } else {
        $rooms = 'Студия';
    }
    $title = $rooms . ', ' . $detail[5]['s_value'] . ' м², ' . $detail[6]['s_value'] . '/' . $detail[7]['s_value'] . ' эт.';
    ?>
    <div class="main__catalog-item <?php osc_run_hook("highlight_class"); ?><?php echo $class; if(osc_item_is_premium()){ echo ' premium'; } ?>">
        <?php watchlist(); ?>
        <span class="main__catalog-item-img">
            <?php if( osc_images_enabled_at_items() ) { ?>
                <?php if(osc_count_item_resources()) { ?>
                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                <?php } else { ?>
                    <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                <?php } ?>
            <?php } ?>
        </span>
        <a href="<?php echo osc_item_url() ; ?>" class="main__catalog-item-wrap">
            <span class="main__catalog-item-hover">Смотреть объявление</span>
            <h3 class="main__catalog-item-h3"><?= $title ?></h3>
            <?php if( osc_price_enabled_at_items() ) { ?><span class="main__catalog-item-price"><?php echo osc_item_formated_price(); ?></span><?php } ?>
            <span class="main__catalog-item-address">г. <?= osc_item_city (); ?>, ул. <?php echo osc_item_address(); ?></span>
        </a>
				<?php if($admin){ ?>
				<div class="admin-options">
				<a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow" class="btn"><?php _e('Edit item', 'bender'); ?></a>
				<a class="delete btn btn-yellow" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bender')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'bender'); ?></a></div>
				<? } ?>
    </div>