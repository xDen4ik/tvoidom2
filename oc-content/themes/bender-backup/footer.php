<footer class="main__footer">
    <div class="container">
        <div class="main__footer-wrap wrap">
            <div class="col">
                <a href="/" class="main__footer-logo"><img src="<?= osc_current_web_theme_url ('app/img/logo.svg')?>" alt=""></a>
                <p class="main__footer-text">Сервис помогает с арендой и продажей недвижимости в вашем городе в минимальные сроки и по необходимой вам цене</p>
                <div class="main__footer-soc-links">
                    <a href="#"><img src="<?= osc_current_web_theme_url('img/icons/soc.png')?>" alt=""></a>
                    <a href="#"><img src="<?= osc_current_web_theme_url('img/icons/soc.png')?>" alt=""></a>
                    <a href="#"><img src="<?= osc_current_web_theme_url('img/icons/soc.png')?>" alt=""></a>
                </div>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Заголовок: <img src="<?= osc_current_web_theme_url('img/icons/select-angle.svg')?>" alt=""></h4>
                <ul>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                </ul>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Дополнительно: <img src="<?= osc_current_web_theme_url('img/icons/select-angle.svg')?>" alt=""></h4>
                <ul>
                    <li><a href="#">О проете</a></li>
                    <li><a href="#">Сотрудничество</a></li>
                    <li><a href="#">Реклама</a></li>
                </ul>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Контакты:</h4>
                <ul>
                    <li>Телефон: 8 (812) 457-75-85</li>
                    <li>Почта: your.house@mail.ru</li>
                    <li>Адрес: г. Екатеринбург, ул Малышева 76 </li>
                </ul>
            </div>
        </div>
        <div class="main__footer-bottom-wrap wrap">
            <div class="copy">© ООО «ТВОЙ ДОМ»</div>
            <div class="main__footer-pol">
                <a data-fancybox href="#">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>
<!-- </div> -->
<!-- <?php osc_run_hook('after-main'); ?>
</div>
<div id="responsive-trigger"></div> -->
<!-- footer -->
<!-- <div class="clear"></div>
<?php osc_show_widgets('footer');?>
<div id="footer">
    <div class="wrapper">
        <ul class="resp-toggle">
            <?php if( osc_users_enabled() ) { ?>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li>
                    <?php echo sprintf(__('Hi %s', 'bender'), osc_logged_user_name() . '!'); ?>  &middot;
                    <strong><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'bender'); ?></a></strong> &middot;
                    <a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'bender'); ?></a>
                </li>
            <?php } else { ?>
                <li><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'bender'); ?></a></li>
                <?php if(osc_user_registration_enabled()) { ?>
                    <li>
                        <a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'bender'); ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <li class="publish">
                <a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'bender');?></a>
            </li>
            <?php } ?>
        </ul>
        <ul>
        <?php
        osc_reset_static_pages();
        while( osc_has_static_pages() ) { ?>
            <li>
                <a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
            </li>
        <?php
        }
        ?>
            <li>
                <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'bender'); ?></a>
            </li>
        </ul>
        
        <?php if ( osc_count_web_enabled_locales() > 1) { ?>
            <?php osc_goto_first_locale(); ?>
            <strong><?php _e('Language:', 'bender'); ?></strong>
            <?php $i = 0;  ?>
            <?php while ( osc_has_web_enabled_locales() ) { ?>
            <span><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><?php echo osc_locale_name(); ?></a></span><?php if( $i == 0 ) { echo " &middot; "; } ?>
                <?php $i++; ?>
            <?php } ?>
        <?php } ?>
    </div>
</div> -->
<?php osc_run_hook('footer'); ?>
</body>
</html>
