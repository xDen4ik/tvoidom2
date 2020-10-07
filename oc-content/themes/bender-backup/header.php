<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('common/head.php') ; ?>
    </head>
<body <?php bender_body_class(); ?>>
    <header class="main__header">
        <div class="container">
            <div class="main__header-wrap wrap">
                <a href="/" class="main__header-logo"><img src="<?= osc_current_web_theme_url ('app/img/logo.svg')?>" alt=""></a>
                <nav class="main__header-menu">
                    <ul class="main__header-list">
                        <li class="main__header-li"><a href="#" class="main__header-link">Продажа</a></li>
                        <li class="main__header-li"><a href="#" class="main__header-link">Аренда</a></li>
                        <li class="main__header-li"><a href="#" class="main__header-link">Новостройки</a></li>
                        <li class="main__header-li"><a href="#" class="main__header-link">Ещё</a></li>
                    </ul>
                </nav>
                <div class="main__header-lk">
                    <a href="#">
                        <svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.5075 1H4.39007C2.46164 1 0.898438 3.04642 0.898438 5.57009V17.0877C0.898438 19.6114 2.46164 21.6578 4.39007 21.6578H5.73535V27L13.0799 21.6578H26.5075C28.4373 21.6578 30.0005 19.6114 30.0005 17.0877V5.57009C30.0005 3.04642 28.4373 1 26.5075 1Z" stroke="#131F35" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="<?php echo osc_user_dashboard_url(); ?>">
                    <!-- <a data-fancybox data-touch="false" href="#reg"> -->
                        <svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.8701 11.0894C18.3768 10.3408 18.666 7.02978 18.666 6.10413C18.666 3.28527 15.9792 1 12.6657 1C9.35285 1 6.66602 3.28527 6.66602 6.10413C6.66602 7.0569 6.97267 10.3911 7.50656 11.154C8.55289 12.6492 10.4722 14 12.6651 14C14.8917 14 16.8342 12.6202 17.8701 11.0894Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M16.9189 16.5054C14.5142 17.645 13.3839 17.9226 12.8713 17.9721C12.3582 17.9226 11.229 17.645 8.82323 16.5054C4.97428 14.6839 0.793945 21.9732 0.793945 26.9998C2.46158 26.9998 10.6484 26.9998 12.8055 26.9998C12.8511 26.9998 12.8984 26.9998 12.9383 26.9998C15.0954 26.9998 23.2828 26.9998 24.9499 26.9998C24.9488 21.9732 20.7678 14.6839 16.9189 16.5054Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <a href="<?php echo osc_item_post_url_in_category() ; ?>" class="main__header-btn btn">Подать объявление</a>
                <!-- <a data-fancybox href="#sign-in" class="main__header-btn btn">Подать объявление</a> -->
                <a href="#" class="hamburger hamburger--emphatic" id="hamburger">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </a>
                <nav class="main__header-mob-menu">
                    <a data-fancybox data-touch="false" href="#reg">Избранное</a>
                    <a href="#" data-message="1" class="link-message">Мои сообщения</a>
                    <a href="#">Найти недвижимость</a>
                    <a href="<?php echo osc_item_post_url_in_category() ; ?>">Подать объявление</a>
                    <!-- <a data-fancybox data-touch="false" href="#sign-in">Подать объявление</a> -->
                    <a href="#">Новостройки</a>
                    <a href="#">Контакты</a>
                </nav>
            </div>
        </div>
    </header>
 <!-- <div id="header" style="margin-top: 90px;">
    <div class="wrapper">
        <ul class="nav">
            <?php if( osc_is_static_page() || osc_is_contact_page() ){ ?>
                <li class="search"><a class="ico-search icons" data-bclass-toggle="display-search"></a></li>
                <li class="cat"><a class="ico-menu icons" data-bclass-toggle="display-cat"></a></li>
            <?php } ?>
            <?php if( osc_users_enabled() ) { ?>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li class="first logged">
                    <span><?php echo sprintf(__('Hi %s', 'bender'), osc_logged_user_name() . '!'); ?>  &middot;</span>
                    <strong><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'bender'); ?></a></strong> &middot;
                    <a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'bender'); ?></a>
                </li>
            <?php } else { ?>
                <li><a id="login_open" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'bender') ; ?></a></li>
                <?php if(osc_user_registration_enabled()) { ?>
                    <li><a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register for a free account', 'bender'); ?></a></li>
                <?php }; ?>
            <?php } ?>
            <?php } ?>
            <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <li class="publish"><a href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish your ad for free", 'bender');?></a></li>
            <?php } ?>
        </ul>

    </div>
    <?php if( osc_is_home_page() || osc_is_static_page() || osc_is_contact_page() ) { ?>
    <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
        <input type="hidden" name="page" value="search"/>
        <div class="main-search">
            <div class="cell">
                <input type="text" name="sPattern" id="query" class="input-text" value="" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'bender'), 'bender')); ?>" />
            </div>
            <?php  if ( osc_count_categories() ) { ?>
                <div class="cell selector">
                    <?php osc_categories_select('sCategory', null, __('Select a category', 'bender')) ; ?>
                </div>
                <div class="cell reset-padding">
            <?php  } else { ?>
                <div class="cell">
            <?php  } ?>
                <button class="ui-button ui-button-big js-submit"><?php _e("Search", 'bender');?></button>
            </div>
        </div>
        <div id="message-search"></div>
    </form>
    <?php } ?>
</div>
<?php osc_show_widgets('header'); ?>
<div class="wrapper wrapper-flash">
    <?php
        $breadcrumb = osc_breadcrumb('&raquo;', false, get_breadcrumb_lang());
        if( $breadcrumb !== '') { ?>
        <div class="breadcrumb">
            <?php echo $breadcrumb; ?>
            <div class="clear"></div>
        </div>
    <?php
        }
    ?>
    <?php osc_show_flash_message(); ?>
</div>
<?php osc_run_hook('before-content'); ?>
<div class="wrapper" id="content">
    <?php osc_run_hook('before-main'); ?>
    <div id="main">
        <?php osc_run_hook('inside-main'); ?> -->