<?php
osc_add_hook('header','bender_follow_construct');

bender_add_body_class('home');


$buttonClass = '';
$listClass   = '';
if(bender_show_as() == 'gallery'){
  $listClass = 'listing-grid';
  $buttonClass = 'active';
}
?>
<?php osc_current_web_theme_path('header.php') ; ?>

<section class="main__banner" style="background-image: url(<?= osc_current_web_theme_url ('app/img/main-banner.jpg')?>);">
    <div class="container">
        <h1 class="main__banner-h1">Выгодная аренда и продажа недвижимости в г.&nbsp;<strong id="title_city"></strong></h1>
    </div>
</section>

<section class="main__search">
    <div class="container">
        <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf">
            <div class="hidden"><?php osc_categories_select('sCategory', null, __('Select a category', 'bender')) ; ?></div>
            <input type="hidden" name="page" value="search"/>
            <div class="type_realty hidden">
                <input type="radio" name="meta[4]" value="Квартира">
                <input type="radio" name="meta[4]" value="Дом">
								<input type="radio" name="meta[4]" value="Коттедж">
                <input type="radio" name="meta[4]" value="Комната">
            </div>
            <div class="radio_rooms_count hidden">
                <input type="radio" name="meta[3]" value="Студия">
                <input type="radio" name="meta[3]" value="1" >
                <input type="radio" name="meta[3]" value="2" >
                <input type="radio" name="meta[3]" value="3" >
                <input type="radio" name="meta[3]" value="4" >
                <input type="radio" name="meta[3]" value="5" >
            </div>
            <div class="main__search-filter">
                <div class="main__search-filter-tabs">
                    <div class="main__search-filter-tab " data-cat="96">Купить</div>
                    <div class="main__search-filter-tab" data-cat="97">Снять</div>
                    <div class="main__search-filter-tab" data-cat="116">Покупатели</div>
                    <div class="main__search-filter-tab" data-cat="122">Арендаторы</div>
                </div>
                <div class="main__search-filter-tab-content active">
                    <div class="main__search-filter-wrap">
										<div class="select-city">
										<input class="input-text" type="hidden" id="sRegion" name="sRegion">
										<input class="input-text" type="text" id="sCity" name="sCity" placeholder="Начните вводить город" autocomplete="off">
										<span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
										</div>
                        <div class="select">
                            <div class="select-wrap">
                                <span>Тип недвижимости</span>
                                <img src="<?= osc_current_web_theme_url ('app/img/icons/select-angle.svg')?>" alt="">
                            </div>
                            <div class="select-items">
                                <div class="select-item" data-cat-type="Квартира">Квартиру</div>
                                <div class="select-item" data-cat-type="Дом">Дом</div>
                                <div class="select-item" data-cat-type="Коттедж">Коттедж</div>
                                <div class="select-item" data-cat-type="Комната">Комнату</div>
                            </div>
                        </div>
                        <div class="select">
                            <div class="select-wrap">
                                <span>Кол-во. комнат</span>
                                <img src="<?= osc_current_web_theme_url ('app/img/icons/select-angle.svg')?>" alt="">
                            </div>
                            <div class="select-items">
                                <div class="select-item" data-val="Студия">Студия</div>
                                <div class="select-item" data-val="1">1-комнатная</div>
                                <div class="select-item" data-val="2">2-комнатная</div>
                                <div class="select-item" data-val="3">3-комнатная</div>
                                <div class="select-item" data-val="4">4-комнатная</div>
                                <div class="select-item" data-val="5">5-комнатная</div>
                            </div>
                        </div>
                        <div class="select">
                            <div class="select-wrap">
                                <span>Цена</span>
                                <img src="<?= osc_current_web_theme_url ('app/img/icons/select-angle.svg')?>" alt="">
                            </div>
                            <div class="select-items">
                                <div class="price-min-max">
                                    <input class="input-text" type="text" id="priceMin" name="sPriceMin" placeholder="Мин." value="" size="6" maxlength="6">
                                    <input class="input-text" type="text" id="priceMax" name="sPriceMax" placeholder="Макс." value="" size="6" maxlength="9">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main__search-filter-btn-wrap">
                        <button class="btn btn-yellow ui-button ui-button-big js-submit">Смотреть варианты</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="main__feat">
    <div class="container">
        <div class="main__feat-wrap wrap">
            <div class="main__feat-item">
                <div class="main__feat-icon"><img src="<?= osc_current_web_theme_url ('app/img/icons/main-feat-icon1.svg')?>" alt=""></div>
                <p>Только актуальные объявления в каталоге</p>
            </div>
            <div class="main__feat-item">
                <div class="main__feat-icon"><img src="<?= osc_current_web_theme_url ('app/img/icons/main-feat-icon2.svg')?>" alt=""></div>
                <p>Размещайте и находите объявления бесплатно</p>
            </div>
            <div class="main__feat-item">
                <div class="main__feat-icon"><img src="<?= osc_current_web_theme_url ('app/img/icons/main-feat-icon3.svg')?>" alt=""></div>
                <p>Испльзуйте фильтр для поиска нужных объявлений</p>
            </div>
            <div class="main__feat-item">
                <div class="main__feat-icon"><img src="<?= osc_current_web_theme_url ('app/img/icons/main-feat-icon4.svg')?>" alt=""></div>
                <p>Более 500 объявлений в вашем городе</p>
            </div>
        </div>
    </div>
</section>

<section class="main__catalog">
    <div class="container">
        <div class="section-title">Только актуальные объявления </div>
        <div class="main__catalog-tabs">
            <div class="main__catalog-tab active">Купить </div>
            <div class="main__catalog-tab">Снять </div>
        </div>
        <div class="main__catalog-slider-wrap slider-wrap active">
            <div class="main__catalog-slider">
                <?php
            // View::newInstance()->_exportVariableToView("listType", 'latestItems');
            // View::newInstance()->_exportVariableToView("listClass",$listClass);
            // osc_current_web_theme_path('loop.php');
                osc_query_item(array(
                    "category_name" => "prodat",
                    "results_per_page" => "10"
                ));
                while ( osc_has_custom_items() ) {
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
                    </div>
                <? } ?>
            </div>
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
        <div class="main__catalog-slider-wrap slider-wrap">
            <div class="main__catalog-slider">
                <?php
                osc_query_item(array(
                    "category_name" => "sdat",
                    "results_per_page" => "10"
                ));
                while ( osc_has_custom_items() ) {
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
                            <?php if( osc_price_enabled_at_items() ) { ?><span class="main__catalog-item-price"><?php echo osc_item_formated_price(); ?> / мес.</span><?php } ?>
                            <span class="main__catalog-item-address">г. <?= osc_item_city (); ?>, ул. <?php echo osc_item_address(); ?></span>
                        </a>
                    </div>
                <? } ?>
            </div>
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
        <a href="<? osc_base_url(); ?>/search" class="btn">Посмотреть весь каталог</a>
    </div>
</section>

<section class="main__services">
    <div class="container">
        <div class="section-title">Всё, что пожелаете в один клик</div>
        <div class="main__services-wrap wrap">
            <div class="main__services-item">
                <img src="<?= osc_current_web_theme_url ('app/img/icons/main-services-icon1.svg')?>" alt="" class="main__services-item-icon">
                <h4 class="main__services-item-title">Снять квартиру</h4>
                <ul class="main__services-item-list">
                    <li><a href="#" class="main__services-item-link">Студию</a></li>
                    <li><a href="#" class="main__services-item-link">1-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">2-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">3-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">4-комнатную</a></li>
                </ul>
            </div>
            <div class="main__services-item">
                <img src="<?= osc_current_web_theme_url ('app/img/icons/main-services-icon2.svg')?>" alt="" class="main__services-item-icon">
                <h4 class="main__services-item-title">Купить квартиру</h4>
                <ul class="main__services-item-list">
                    <li><a href="#" class="main__services-item-link">Студию</a></li>
                    <li><a href="#" class="main__services-item-link">1-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">2-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">3-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">4-комнатную</a></li>
                </ul>
            </div>
            <div class="main__services-item">
                <img src="<?= osc_current_web_theme_url ('app/img/icons/main-services-icon3.svg')?>" alt="" class="main__services-item-icon">
                <h4 class="main__services-item-title">Продать квартиру</h4>
                <ul class="main__services-item-list">
                    <li><a href="#" class="main__services-item-link">Студию</a></li>
                    <li><a href="#" class="main__services-item-link">1-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">2-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">3-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">4-комнатную</a></li>
                </ul>
            </div>
            <div class="main__services-item">
                <img src="<?= osc_current_web_theme_url ('app/img/icons/main-services-icon4.svg')?>" alt="" class="main__services-item-icon">
                <h4 class="main__services-item-title">Сдать квартиру </h4>
                <ul class="main__services-item-list">
                    <li><a href="#" class="main__services-item-link">Студию</a></li>
                    <li><a href="#" class="main__services-item-link">1-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">2-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">3-комнатную</a></li>
                    <li><a href="#" class="main__services-item-link">4-комнатную</a></li>
                </ul>
            </div>
        </div>
        <div class="main__services-mob">
            <p class="main__services-mob-text">Сервис помогает с арендой и продажей недвижимости в вашем городе в минимальные сроки и по необходимой вам цене</p>
            <a href="<?php echo osc_user_dashboard_url(); ?>" class="btn">Подать объявление</a>
        </div>
    </div>
</section>
<? osc_add_hook('footer','autocompleteCity');
function autocompleteCity(){ ?>
    <script type="text/javascript">
        $(function() {
            function log( message ) {
                $( "<div/>" ).text( message ).prependTo( "#log" );
                $( "#log" ).attr( "scrollTop", 0 );
            }

            $( "#sCity" ).autocomplete({
                source: "<?php echo osc_base_url(true); ?>?page=ajax&action=location",
                minLength: 2,
                select: function( event, ui ) {
                    $("#sRegion").attr("value", ui.item.region);
                    log( ui.item ?
                        "<?php echo osc_esc_html( __('Selected', 'bender') ); ?>: " + ui.item.value + " aka " + ui.item.id :
                        "<?php echo osc_esc_html( __('Nothing selected, input was', 'bender') ); ?> " + this.value );
                }
            });
        });
    </script>
    <?php
}
?>
<?php osc_current_web_theme_path('footer.php') ; ?>