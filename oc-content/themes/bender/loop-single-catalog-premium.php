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

    <div class="catalog__ads-item <?php osc_run_hook("highlight_class"); ?><?php echo $class; if(osc_item_is_premium()){ echo ' vip'; } ?>">
        <div class="catalog__ads-item-slider">
            <div class="catalog__ads-item-slider-big">
                <div class="catalog__ads-item-slider-big-img-slide">
                        <?php if(osc_count_item_resources()) { ?>
                            <a data-fancybox="gallery" href="<?php echo osc_resource_thumbnail_url(); ?>" class="catalog__ads-item-slider-big-img">
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                            </a>
                        <?php } else { ?>
                            <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                        <?php } ?>
                </div>
                <?php watchlist(); ?>
                <div class="catalog__ads-item-slide-count"><div class="catalog__ads-item-slide-count-current">1</div>/<div class="catalog__ads-item-slide-count-all">12</div></div>
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
            <div class="catalog__ads-item-slider-img-nav">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if(osc_count_item_resources()) { ?>
                        <a data-fancybox="gallery" href="<?php echo osc_resource_thumbnail_url(); ?>" class="catalog__ads-item-slider-img">
                            <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                        </a>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="catalog__ads-item-info">
            <div class="catalog__ads-item-info-mob">
                <div class="catalog__ads-item-price"><?php if( osc_price_enabled_at_items() ) { ?><?php echo osc_item_formated_price(); ?><?php } ?></div>
                <ul class="catalog__ads-item-list">
                    <li>Район: Центр</li>
                    <li>Этаж: 12/16</li>
                    <li>Площадь: 78 м2</li>
                </ul>
            </div>
            <h4 class="catalog__ads-item-title">г. <?= osc_item_city (); ?>, ул. <?= osc_item_address(); ?></h4>
            <div class="catalog__ads-item-text">
                <img src="<?= osc_current_web_theme_url ('app/img/icons/human.svg')?>" alt="">
                4 минуты до центра пешком
            </div>
            <ul class="catalog__ads-item-list">
                <li>Район: Центр</li>
                <li>Этаж: 12/16</li>
                <li>Площадь: 78 м2</li>
                <li>Закрытый двор</li>
            </ul>
            <a href="<?php echo osc_item_url() ; ?>" class="btn btn-pc">Посмотреть контакты</a>
            <a href="<?php echo osc_item_url() ; ?>" class="btn btn-mob">Подробнее</a>
        </div>
        <div class="catalog__ads-item-info">
            <div class="catalog__ads-item-price"><?php if( osc_price_enabled_at_items() ) { ?><?php echo osc_item_formated_price(); ?><?php } ?></div>
            <div class="catalog__ads-item-date-published">Опубликовано: 1 июня</div>
            <div class="catalog__ads-item-profile">
                <div class="catalog__ads-item-profile-img"><img src="<?= osc_current_web_theme_url ('app/img/profile-img.png')?>" alt=""></div>
                <div class="catalog__ads-item-profile-info">
                    <img src="<?= osc_current_web_theme_url ('app/img/icons/small-check.svg')?>" alt="">
                    Проверенный аккаунт
                </div>
            </div>
        </div>
    </div>