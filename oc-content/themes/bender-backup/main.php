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
<!-- <div class="clear"></div>
<div class="latest_ads">
<h1><strong><?php _e('Latest Listings', 'bender') ; ?></strong></h1>
 <?php if( osc_count_latest_items() == 0) { ?>
    <div class="clear"></div>
    <p class="empty"><?php _e("There aren't listings available at this moment", 'bender'); ?></p>
<?php } else { ?>
    <div class="actions">
      <span class="doublebutton <?php echo $buttonClass; ?>">
           <a href="<?php echo osc_base_url(true); ?>?sShowAs=list" class="list-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span><?php _e('List', 'bender'); ?></span></a>
           <a href="<?php echo osc_base_url(true); ?>?sShowAs=gallery" class="grid-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span><?php _e('Grid', 'bender'); ?></span></a>
      </span>
    </div>
    
    <div class="clear"></div>
    <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
        <p class="see_more_link"><a href="<?php echo osc_search_show_all_url() ; ?>">
            <strong><?php _e('See all listings', 'bender') ; ?> &raquo;</strong></a>
        </p>
    <?php } ?>
<?php } ?>
</div>
</div> -->

<section class="main__banner" style="background-image: url(img/main-banner.jpg);">
        <div class="container">
            <h1 class="main__banner-h1">Выгодная аренда и продажа недвижимости в Екатеринбурге</h1>
        </div>
    </section>

    <section class="main__search">
        <div class="container">
            <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf">
        <input type="hidden" name="page" value="search"/>
            <div class="main__search-filter">
                <div class="main__search-filter-tabs">
                    <div class="main__search-filter-tab active">Купить</div>
                    <div class="main__search-filter-tab">Снять</div>
                    <div class="main__search-filter-tab">Продать</div>
                    <div class="main__search-filter-tab">Сдать</div>
                </div>
                <div class="main__search-filter-tab-content active">
                    <div class="main__search-filter-wrap">
                        <div class="select">
                            <div class="select-wrap">
                                <span>Квартира</span>
                                <img src="img/icons/select-angle.svg" alt="">
                            </div>
                            <div class="select-items">
                                <div class="select-item">Студия</div>
                                <div class="select-item">1-комнатная</div>
                                <div class="select-item">2-комнатная</div>
                            </div>
                        </div>
                        <div class="select">
                            <div class="select-wrap">
                                <span>Кол-во. комнат</span>
                                <img src="img/icons/select-angle.svg" alt="">
                            </div>
                            <div class="select-items">
                                <div class="select-item">Студия</div>
                                <div class="select-item">1-комнатная</div>
                                <div class="select-item">2-комнатная</div>
                            </div>
                        </div>
                        <div class="select">
                            <div class="select-wrap">
                                <span>Цена</span>
                                <img src="img/icons/select-angle.svg" alt="">
                            </div>
                            <div class="select-items">
                                <div class="select-item">Студия</div>
                                <div class="select-item">1-комнатная</div>
                                <div class="select-item">2-комнатная</div>
                            </div>
                        </div>
                        <input type="text" placeholder="Город, адрес, метро, район, шоссе или ЖК">
                    </div>
                    <div class="main__search-filter-btn-wrap">
                        <button class="btn btn-yellow">Открыть на карте</button>
                        <button class="btn btn-yellow">Смотреть варианты</button>
                    </div>
                </div>
            </div>
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
                <div class="main__catalog-tab">Купить </div>
                <div class="main__catalog-tab active">Снять </div>
            </div>
            <div class="main__catalog-slider-wrap slider-wrap">
                <?php
                View::newInstance()->_exportVariableToView("listType", 'latestItems');
                View::newInstance()->_exportVariableToView("listClass",$listClass);
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
            <a href="#" class="btn">Посмотреть весь каталог</a>
        </div>
    </section>

    <section class="main__services">
        <div class="container">
            <div class="section-title">Всё, что пожелаете в один клик</div>
            <div class="main__services-wrap wrap">
                <div class="main__services-item">
                    <img src="img/icons/main-services-icon1.svg" alt="" class="main__services-item-icon">
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
                    <img src="img/icons/main-services-icon2.svg" alt="" class="main__services-item-icon">
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
                    <img src="img/icons/main-services-icon3.svg" alt="" class="main__services-item-icon">
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
                    <img src="img/icons/main-services-icon4.svg" alt="" class="main__services-item-icon">
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
                <a href="#" class="btn">Подать объявление</a>
            </div>
        </div>
    </section>
<?php osc_current_web_theme_path('footer.php') ; ?>