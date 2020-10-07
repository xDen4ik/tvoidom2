<?php

    // meta tag robots
if( osc_item_is_spam() || osc_premium_is_spam() ) {
    osc_add_hook('header','bender_nofollow_construct');
} else {
    osc_add_hook('header','bender_follow_construct');
}

osc_enqueue_script('jquery-validate');

bender_add_body_class('item');
osc_add_hook('after-main','sidebar');
function sidebar(){
    osc_current_web_theme_path('item-sidebar.php');
}

$location = array();
if( osc_item_address() !== '' ) {
    $location[] = osc_item_address();
}
if( osc_item_city_area() !== '' ) {
    $location[] = osc_item_city_area();
}
if( osc_item_city() !== '' ) {
    $location[] = osc_item_city();
}
if( osc_item_region() !== '' ) {
    $location[] = osc_item_region();
}
if( osc_item_country() !== '' ) {
    $location[] = osc_item_country();
}

osc_current_web_theme_path('header.php');
?>

<div class="catalog__mob">
    <a href="#" onclick="history.back();">Вернуться в каталог</a>
</div>

<section class="ad__header">
    <div class="container">
        <div class="catalog__ads-breadcrumbs">
            <?
            $cat = '';
            $link = '';
            switch (osc_item()['fk_i_category_id']) {
              case '96': case 'prodat':
              $cat = 'Купить недвижимость';
              $link = 'prodat';
              break;
              case '97': case 'sdat':
              $cat = 'Аренда недвижимости';
              $link = 'sdat';
              break;
              case '116': case 'kypit':
              $cat = 'Покупатели';
              $link = 'kypit';
              break;
              case '122': case 'snyat':
              $cat = 'Арендаторы';
              $link = 'snyat';
              break;
          }
          $detail = osc_get_item_meta ();
          $rooms = '';
          if ($detail[3]['s_value'] !== 'Студия') {
            $rooms = $detail[3]['s_value'] . '-к квартира';
        } else {
            $rooms = 'студия';
        }
        $title = osc_item_address() . ', ' . $rooms . ', ' . $detail[5]['s_value'] . ' м²';
        ?>
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="<? osc_base_url(); ?>/search">Каталог</a></li>
            <li><a href="<?= osc_base_url() . $link?>"><?= $cat ?></a></li>
            <li><?= osc_item_city() . ', ' . osc_item_address() . ', ' . $detail[5]['s_value'] . ' м²' ?></li>
        </ul>
    </div>
    <h1 class="ad__header-title">
     <?= $title ?>
     <?php watchlist(); ?>
 </h1>
 <div class="ad__header-published ad__header-published-mob">Опубликовано: <?= date('d.m.Y', strtotime(osc_item_pub_date ())) ?></div>
 <div class="ad__header-wrap wrap">
    <div class="ad__header-info-wrap">
        <div class="ad__header-slider">
            <div class="ad__header-slider-big-wrap">
                <div class="ad__header-slider-big">
                    <?php if( osc_images_enabled_at_items() ) { ?>
                        <?php if(osc_count_item_resources()) { ?>
                            <? foreach (osc_get_item_resources () as $img) { ?>
                                <a data-fancybox="gallery<?= osc_item_id () ?>" href="<?= '/' . $img['s_path'] . $img['pk_i_id'] . '_thumbnail.' . $img['s_extension'] ?>" class="ad__header-slider-big-img">
                                    <img src="<?= '/' . $img['s_path'] . $img['pk_i_id'] . '_thumbnail.' . $img['s_extension'] ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>">
                                </a>
                            <? } ?>
                        <?php } else { ?>
                            <div class="ad__header-slider-big-img"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>"></div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <?php if(osc_count_item_resources()) { ?>
                    <div class="slider-controls">
                        <div class="arr prev">
                            <svg width="17" height="32" viewBox="0 0 17 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.59286 31C1.44089 31 1.28892 30.9422 1.17296 30.8262C0.941044 30.5947 0.941044 30.2187 1.17296 29.9868L14.4537 16.7049C14.6413 16.5178 14.7441 16.2672 14.7441 15.9997C14.7441 15.7322 14.6409 15.4816 14.4537 15.2944L1.17296 2.01336C0.941044 1.78184 0.941044 1.40546 1.17296 1.17394C1.40488 0.94202 1.78045 0.94202 2.01237 1.17394L15.2931 14.455C15.7047 14.8662 15.9314 15.4148 15.9314 15.9997C15.9314 16.5846 15.7047 17.1332 15.2931 17.5448L2.01237 30.8266C1.89681 30.9418 1.74483 31 1.59286 31Z" />
                            </svg>
                        </div>
                        <div class="arr next">
                            <svg width="17" height="32" viewBox="0 0 17 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.59286 31C1.44089 31 1.28892 30.9422 1.17296 30.8262C0.941044 30.5947 0.941044 30.2187 1.17296 29.9868L14.4537 16.7049C14.6413 16.5178 14.7441 16.2672 14.7441 15.9997C14.7441 15.7322 14.6409 15.4816 14.4537 15.2944L1.17296 2.01336C0.941044 1.78184 0.941044 1.40546 1.17296 1.17394C1.40488 0.94202 1.78045 0.94202 2.01237 1.17394L15.2931 14.455C15.7047 14.8662 15.9314 15.4148 15.9314 15.9997C15.9314 16.5846 15.7047 17.1332 15.2931 17.5448L2.01237 30.8266C1.89681 30.9418 1.74483 31 1.59286 31Z" />
                            </svg>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="ad__header-slider-nav">
                <? foreach (osc_get_item_resources () as $img) { ?>
                    <a data-fancybox="gallery<?= osc_item_id () ?>" href="<?= '/' . $img['s_path'] . $img['pk_i_id'] . '_thumbnail.' . $img['s_extension'] ?>" class="ad__header-slider-nav-img">
                        <img src="<?= '/' . $img['s_path'] . $img['pk_i_id'] . '_thumbnail.' . $img['s_extension'] ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>">
                    </a>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="ad__header-profile">
        <div class="ad__header-price">
            <?php if( osc_price_enabled_at_items() ) { ?><?php echo osc_item_formated_price(); ?><?php } ?>
            <? switch (osc_item_category_id ()) {
                case 97: case 110: case 110: case 111: case 112: case 113: case 114: case 115:
                echo '/ мес.';
                break;
            }?>
        </div>
        <? if (osc_item()['fk_i_category_id'] == 97): ?>
            <div class="ad__header-com"><?= $detail[11]['s_value'] == 'Да' ? 'Коммунальные включены' : '+ коммунальные платежи'; ?></div>
        <? endif; ?>
        <div class="ad__header-profile-wrap">
            <div class="ad__header-profile-info">
                <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
                    <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow" class="btn btn-yellow"><?php _e('Edit item', 'bender'); ?></a>
                <?php } ?>
                <div class="ad__header-profile-name"><?= osc_item ()['s_contact_name'] ?></div>
                <div class="ad__header-profile-type"><?= $detail[12]['s_value'] ?></div>
                <!-- <div class="ad__header-profile-ads">2 объявления</div> -->
                <div class="catalog__ads-item-profile-info">
                    <img src="<?= osc_current_web_theme_url ('app/img/icons/small-check.svg')?>" alt="">
                    Проверенный аккаунт
                </div>
                <? if(osc_item_is_premium()){ ?>
                    <div class="catalog__ads-item-profile-info">
                        <img src="<?= osc_current_web_theme_url ('app/img/icons/crown.svg')?>" alt="">
                        VIP аккаунт
                    </div>
                <? } ?>
            </div>
            <div class="ad__header-profile-img">
                <img src="<?= profilepic_user_url(osc_item_user_id()) ?>" alt="">
            </div>
        </div>
            <div class="hidden show-phone"><?= $detail[17]['s_value'] ?></div>
            <a href="#" class="btn btn-show-phone">Показать номер </a>
        <a data-fancybox href="#call_author" class="btn">Связаться с автором</a>
        <div class="ad__header-published">Опубликовано: <?= date('d.m.Y', strtotime(osc_item_pub_date ())) ?></div>
    </div>
</div>
<div class="ad__header-lists">
    <ul class="ad__header-list">
        <?php if( osc_count_item_meta() >= 1 ) { 
            $k = 0; ?>
            <?php while ( osc_has_item_meta() ) { 
                $k++; ?>
                <?php if(osc_item_meta_value()!='' && osc_item_meta_name() != 'Телефон для связи') { ?>
                    <li><?= osc_item_meta_name(); ?>:<strong><?= osc_item_meta_value(); ?></strong></li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<div class="ad__header-desc">
    <p><?= osc_item_description(); ?></p>
</div>
<div class="ad__header-desc-more-btn">
    <span data-swap="Свернуть" data-text="Читать полностью">Читать полностью</span>
</div>
</div>
</section>

<section class="ad__map">
    <div class="container">
        <div class="section-title">Расположение на карте</div>
        <div class="ad__map-desc-mob-title"><?= 'г. ' . osc_item_city() . ', ' . osc_item_address() ?></div>
        <div class="wrap">
            <div class="ad__map-iframe">
                <?php osc_run_hook('location'); ?>
            </div>
        </div>
    </div>
</section>

<section class="ad__related">
    <div class="container">
        <div class="section-title"><?php _e('Related listings', 'bender'); ?></div>
        <?php related_listings(); ?>
        <?php if( osc_count_items() > 0 ) { ?>
            <div class="main__catalog-slider-wrap">
                <?php
                View::newInstance()->_exportVariableToView("listType", 'items');
                osc_current_web_theme_path('loop.php');
                ?>
                <div class="slider-controls">
                    <div class="arr prev">
                        <svg width="17" height="32" viewBox="0 0 17 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.59286 31C1.44089 31 1.28892 30.9422 1.17296 30.8262C0.941044 30.5947 0.941044 30.2187 1.17296 29.9868L14.4537 16.7049C14.6413 16.5178 14.7441 16.2672 14.7441 15.9997C14.7441 15.7322 14.6409 15.4816 14.4537 15.2944L1.17296 2.01336C0.941044 1.78184 0.941044 1.40546 1.17296 1.17394C1.40488 0.94202 1.78045 0.94202 2.01237 1.17394L15.2931 14.455C15.7047 14.8662 15.9314 15.4148 15.9314 15.9997C15.9314 16.5846 15.7047 17.1332 15.2931 17.5448L2.01237 30.8266C1.89681 30.9418 1.74483 31 1.59286 31Z" />
                        </svg>
                    </div>
                    <div class="arr next">
                        <svg width="17" height="32" viewBox="0 0 17 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.59286 31C1.44089 31 1.28892 30.9422 1.17296 30.8262C0.941044 30.5947 0.941044 30.2187 1.17296 29.9868L14.4537 16.7049C14.6413 16.5178 14.7441 16.2672 14.7441 15.9997C14.7441 15.7322 14.6409 15.4816 14.4537 15.2944L1.17296 2.01336C0.941044 1.78184 0.941044 1.40546 1.17296 1.17394C1.40488 0.94202 1.78045 0.94202 2.01237 1.17394L15.2931 14.455C15.7047 14.8662 15.9314 15.4148 15.9314 15.9997C15.9314 16.5846 15.7047 17.1332 15.2931 17.5448L2.01237 30.8266C1.89681 30.9418 1.74483 31 1.59286 31Z" />
                        </svg>
                    </div>
                </div>
            </div>
        <?php } ?>
        <a href="<? osc_base_url(); ?>/search" class="btn">Посмотреть весь каталог</a>
    </div>
</section>
<!-- <div id="item-content">
    
        <h1><?php if( osc_price_enabled_at_items() ) { ?><span class="price"><?php echo osc_item_formated_price(); ?></span> <?php } ?><strong><?php echo osc_item_title() . ' ' . osc_item_city(); ?></strong></h1>
        <div class="item-header">
            <div>
                <?php if ( osc_item_pub_date() !== '' ) { printf( __('<strong class="publish">Published date</strong>: %1$s', 'bender'), osc_format_date( osc_item_pub_date() ) ); } ?>
            </div>
            <div>
                <?php if ( osc_item_mod_date() !== '' ) { printf( __('<strong class="update">Modified date:</strong> %1$s', 'bender'), osc_format_date( osc_item_mod_date() ) ); } ?>
            </div>
            <?php if (count($location)>0) { ?>
                <ul id="item_location">
                    <li><strong><?php _e("Location", 'bender'); ?></strong>: <?php echo implode(', ', $location); ?></li>
                </ul>
            <?php }; ?>
        </div>
        <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
            <p id="edit_item_view">
                <strong>
                    <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'bender'); ?></a>
                </strong>
            </p>
        <?php } ?>


    <?php if( osc_images_enabled_at_items() ) { ?>
        <?php
        if( osc_count_item_resources() > 0 ) {
            $i = 0;
        ?>
        <div class="item-photos">
            <a href="<?php echo osc_resource_url(); ?>" class="main-photo" title="<?php _e('Image', 'bender'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
            </a>
            <div class="thumbs">
                <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php _e('Image', 'bender'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                </a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
    <div id="description">
        <p><?php echo osc_item_description(); ?></p>
        <div id="custom_fields">
            <?php if( osc_count_item_meta() >= 1 ) { ?>
                <br />
                <div class="meta_list">
                    <?php while ( osc_has_item_meta() ) { ?>
                        <?php if(osc_item_meta_value()!='') { ?>
                            <div class="meta">
                                <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php osc_run_hook('item_detail', osc_item() ); ?>
        <p class="contact_button">
            <?php if( !osc_item_is_expired () ) { ?>
            <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                    <a href="#contact" class="ui-button ui-button-middle ui-button-main resp-toggle"><?php _e('Contact seller', 'bender'); ?></a>
                <?php     } ?>
            <?php     } ?>
            <?php } ?>
           <a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow" class="ui-button ui-button-middle"><?php _e('Share', 'bender'); ?></a>
        </p>
    </div>
    <div id="useful_info" class="bordered-box">
        <h2><?php _e('Useful information', 'bender'); ?></h2>
        <ul>
            <li><?php _e('Avoid scams by acting locally or paying with PayPal', 'bender'); ?></li>
            <li><?php _e('Never pay with Western Union, Moneygram or other anonymous payment services', 'bender'); ?></li>
            <li><?php _e('Don\'t buy or sell outside of your country. Don\'t accept cashier cheques from outside your country', 'bender'); ?></li>
            <li><?php _e('This site is never involved in any transaction, and does not handle payments, shipping, guarantee transactions, provide escrow services, or offer "buyer protection" or "seller certification"', 'bender'); ?></li>
        </ul>
    </div>

        <?php related_listings(); ?>
        <?php if( osc_count_items() > 0 ) { ?>
        <div class="similar_ads">
            <h2><?php _e('Related listings', 'bender'); ?></h2>
            <?php
            View::newInstance()->_exportVariableToView("listType", 'items');
            osc_current_web_theme_path('loop.php');
            ?>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <?php if( osc_comments_enabled() ) { ?>
        <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
        <div id="comments">
            <h2><?php _e('Comments', 'bender'); ?></h2>
            <ul id="comment_error_list"></ul>
            <?php CommentForm::js_validation(); ?>
            <?php if( osc_count_item_comments() >= 1 ) { ?>
                <div class="comments_list">
                    <?php while ( osc_has_item_comments() ) { ?>
                        <div class="comment">
                            <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'bender'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
                            <p><?php echo nl2br( osc_comment_body() ); ?> </p>
                            <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                            <p>
                                <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'bender'); ?>"><?php _e('Delete', 'bender'); ?></a>
                            </p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="paginate" style="text-align: right;">
                        <?php echo osc_comments_pagination(); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="form-container form-horizontal">
                <div class="header">
                    <h3><?php _e('Leave your comment (spam and offensive messages will be removed)', 'bender'); ?></h3>
                </div>
                <div class="resp-wrapper">
                    <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                        <fieldset>

                            <input type="hidden" name="action" value="add_comment" />
                            <input type="hidden" name="page" value="item" />
                            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                            <?php if(osc_is_web_user_logged_in()) { ?>
                                <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                            <?php } else { ?>
                                <div class="control-group">
                                    <label class="control-label" for="authorName"><?php _e('Your name', 'bender'); ?></label>
                                    <div class="controls">
                                        <?php CommentForm::author_input_text(); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="authorEmail"><?php _e('Your e-mail', 'bender'); ?></label>
                                    <div class="controls">
                                        <?php CommentForm::email_input_text(); ?>
                                    </div>
                                </div>
                            <?php }; ?>
                            <div class="control-group">
                                <label class="control-label" for="title"><?php _e('Title', 'bender'); ?></label>
                                <div class="controls">
                                    <?php CommentForm::title_input_text(); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="body"><?php _e('Comment', 'bender'); ?></label>
                                <div class="controls textarea">
                                    <?php CommentForm::body_input_textarea(); ?>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="submit"><?php _e('Send', 'bender'); ?></button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
</div>
-->
<?php osc_current_web_theme_path('footer.php') ; ?>
