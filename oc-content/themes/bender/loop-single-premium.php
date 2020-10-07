<?php 
$size = explode('x', osc_thumbnail_dimensions()); 
$detail = osc_get_premium_meta ();
$rooms = '';
if ($detail[3]['s_value'] !== 'Студия') {
    $rooms = $detail[3]['s_value'] . '-к квартира';
} else {
    $rooms = 'Студия';
}
$title = $rooms . ', ' . $detail[5]['s_value'] . ' м², ' . $detail[6]['s_value'] . '/' . $detail[7]['s_value'] . ' эт.';
?>
<div class="main__catalog-item premium">
    <?php watchlist(); ?>
    <span class="main__catalog-item-img">
        <?php if( osc_images_enabled_at_items() ) { ?>
            <?php if(osc_count_premium_resources()) { ?>
                <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
            <?php } else { ?>
                <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
            <?php } ?>
        <?php } ?>
    </span>
    <a href="<?php echo osc_premium_url() ; ?>" class="main__catalog-item-wrap">
        <span class="main__catalog-item-hover">Смотреть объявление</span>
        <h3 class="main__catalog-item-h3"><?= $title ?></h3>
        <?php if( osc_price_enabled_at_items() ) { ?><span class="main__catalog-item-price"><?php echo osc_premium_formated_price(); ?></span><?php } ?>
        <span class="main__catalog-item-address">г. <?= osc_premium_city (); ?>, ул. <?php echo osc_premium_address(); ?></span>
    </a>
</div>
