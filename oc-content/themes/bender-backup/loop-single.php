  <!--  
  <?php $size = explode('x', osc_thumbnail_dimensions()); ?>
     <li class="<?php osc_run_hook("highlight_class"); ?>listing-card <?php echo $class; if(osc_item_is_premium()){ echo ' premium'; } ?>">
        <?php if( osc_images_enabled_at_items() ) { ?>
            <?php if(osc_count_item_resources()) { ?>
                <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_esc_html(osc_item_title()) ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
            <?php } else { ?>
                <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_esc_html(osc_item_title()) ; ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
            <?php } ?>
        <?php } ?>
        <div class="listing-detail">
            <div class="listing-cell">
                <div class="listing-data">
                    <div class="listing-basicinfo">
                        <a href="<?php echo osc_item_url() ; ?>" class="title" title="<?php echo osc_esc_html(osc_item_title()) ; ?>"><?php echo osc_item_title() ; ?></a>
                        <div class="listing-attributes">
                            <span class="category"><?php echo osc_item_category() ; ?></span> -
                            <span class="location"><?php echo osc_item_city(); ?> <?php if( osc_item_region()!='' ) { ?> (<?php echo osc_item_region(); ?>)<?php } ?></span> <span class="g-hide">-</span> <?php echo osc_format_date(osc_item_pub_date()); ?>
                            <?php if( osc_price_enabled_at_items() ) { ?><span class="currency-value"><?php echo osc_format_price(osc_item_price()); ?></span><?php } ?>
                        </div>
                        <p><?php echo osc_highlight( osc_item_description() ,250) ; ?></p>
                    </div>
                    <?php if($admin){ ?>
                        <span class="admin-options">
                            <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'bender'); ?></a>
                            <span>|</span>
                            <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bender')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'bender'); ?></a>
                            <?php if(osc_item_is_inactive()) {?>
                                <span>|</span>
                                <a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'bender'); ?></a>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </li> 
-->
    <?php $size = explode('x', osc_thumbnail_dimensions()); ?>
    <a href="<?php echo osc_item_url() ; ?>" class="main__catalog-item <?php osc_run_hook("highlight_class"); ?><?php echo $class; if(osc_item_is_premium()){ echo ' premium'; } ?>">
        <span class="main__catalog-item-favorite">
            <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" stroke-width="1.5" stroke-linejoin="round"/>
            </svg>
        </span>
        <span class="main__catalog-item-img">
            <?php if( osc_images_enabled_at_items() ) { ?>
                <?php if(osc_count_item_resources()) { ?>
                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                <?php } else { ?>
                    <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                <?php } ?>
            <?php } ?>
        </span>
        <span class="main__catalog-item-wrap">
            <span class="main__catalog-item-hover">Смотреть объявление</span>
            <h3 class="main__catalog-item-h3"><?php echo osc_item_title() ; ?></h3>
            <?php if( osc_price_enabled_at_items() ) { ?><span class="main__catalog-item-price"><?php echo osc_item_formated_price(); ?></span><?php } ?>
            <span class="main__catalog-item-address">ул. <?php echo osc_item_address(); ?></span>
        </span>
    </a>