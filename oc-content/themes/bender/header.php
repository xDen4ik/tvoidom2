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
<li class="main__header-li"><a href="<? osc_base_url(); ?>/prodat" class="main__header-link">Продажа</a></li>
<li class="main__header-li"><a href="<? osc_base_url(); ?>/sdat" class="main__header-link">Аренда</a></li>
<li class="main__header-li"><a href="#" class="main__header-link">Новостройки</a></li>
<li class="main__header-li"><a href="#" class="main__header-link">Ещё</a></li>
</ul>
</nav>
<div class="main__header-lk">
<!--                     <a href="#">
<svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M26.5075 1H4.39007C2.46164 1 0.898438 3.04642 0.898438 5.57009V17.0877C0.898438 19.6114 2.46164 21.6578 4.39007 21.6578H5.73535V27L13.0799 21.6578H26.5075C28.4373 21.6578 30.0005 19.6114 30.0005 17.0877V5.57009C30.0005 3.04642 28.4373 1 26.5075 1Z" stroke="#131F35" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a> -->
<? if (osc_is_web_user_logged_in() || osc_is_login_form () || $_SERVER['REQUEST_URI'] == '/user/recover' || $_SERVER['REQUEST_URI'] == '/user/register'): ?>
	<a href="<? osc_base_url(); ?>/index.php?page=custom&file=watchlist/watchlist.php" class="<?= $_SERVER['QUERY_STRING'] == 'page=custom&file=watchlist/watchlist.php' ? 'active' : '';?>">
	<svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
	</svg>
	</a>
	<? $pos = strpos($_SERVER['REQUEST_URI'], '/user/'); ?>
	<a href="<?php echo osc_user_dashboard_url(); ?>" class="<?= $pos !== false ? 'active' : ''; ?>">
	<svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M17.8701 11.0894C18.3768 10.3408 18.666 7.02978 18.666 6.10413C18.666 3.28527 15.9792 1 12.6657 1C9.35285 1 6.66602 3.28527 6.66602 6.10413C6.66602 7.0569 6.97267 10.3911 7.50656 11.154C8.55289 12.6492 10.4722 14 12.6651 14C14.8917 14 16.8342 12.6202 17.8701 11.0894Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
	<path d="M16.9189 16.5054C14.5142 17.645 13.3839 17.9226 12.8713 17.9721C12.3582 17.9226 11.229 17.645 8.82323 16.5054C4.97428 14.6839 0.793945 21.9732 0.793945 26.9998C2.46158 26.9998 10.6484 26.9998 12.8055 26.9998C12.8511 26.9998 12.8984 26.9998 12.9383 26.9998C15.0954 26.9998 23.2828 26.9998 24.9499 26.9998C24.9488 21.9732 20.7678 14.6839 16.9189 16.5054Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
	</svg>
	</a>
	<? else: ?>
		<a data-fancybox href="#login">
		<svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
		</svg>
		</a>
		<a data-fancybox href="#login">
		<svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M17.8701 11.0894C18.3768 10.3408 18.666 7.02978 18.666 6.10413C18.666 3.28527 15.9792 1 12.6657 1C9.35285 1 6.66602 3.28527 6.66602 6.10413C6.66602 7.0569 6.97267 10.3911 7.50656 11.154C8.55289 12.6492 10.4722 14 12.6651 14C14.8917 14 16.8342 12.6202 17.8701 11.0894Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
		<path d="M16.9189 16.5054C14.5142 17.645 13.3839 17.9226 12.8713 17.9721C12.3582 17.9226 11.229 17.645 8.82323 16.5054C4.97428 14.6839 0.793945 21.9732 0.793945 26.9998C2.46158 26.9998 10.6484 26.9998 12.8055 26.9998C12.8511 26.9998 12.8984 26.9998 12.9383 26.9998C15.0954 26.9998 23.2828 26.9998 24.9499 26.9998C24.9488 21.9732 20.7678 14.6839 16.9189 16.5054Z" stroke="#131F35" stroke-width="1.5" stroke-linejoin="round"/>
		</svg>
		</a>
		<? endif; ?>
		</div>
		<? if (osc_is_web_user_logged_in() || osc_is_login_form () || $_SERVER['REQUEST_URI'] == '/user/recover' || $_SERVER['REQUEST_URI'] == '/user/register'): ?>
			<a href="<?php echo osc_item_post_url_in_category() ; ?>" class="main__header-btn btn">Подать объявление</a>
			<? else: ?>
				<a data-fancybox href="#login" class="main__header-btn btn">Подать объявление</a>
				<? endif; ?>
				<a href="#" class="hamburger hamburger--emphatic" id="hamburger">
				<span class="hamburger-box">
				<span class="hamburger-inner"></span>
				</span>
				</a>
				<nav class="main__header-mob-menu">
				<a href="<? osc_base_url(); ?>/index.php?page=custom&file=watchlist/watchlist.php">Избранное</a>
				<!-- <a href="#" data-message="1" class="link-message">Мои сообщения</a> -->
				<a href="<? osc_base_url(); ?>/search">Найти недвижимость</a>
				<a href="<?php echo osc_item_post_url_in_category() ; ?>">Подать объявление</a>
				<a href="#">Новостройки</a>
				<a href="#">Контакты</a>
				</nav>
				</div>
				</div>
				</header>
				
				<section class="flash-message">
				<div class="container">
				<?php osc_show_widgets('header'); ?>
				<?php osc_show_flash_message(); ?>
				</div>
				</section>
				
				<section class="user-dashboard">
				<div class="container">
				<?php 
				osc_run_hook('before-content'); 
				osc_run_hook('before-main'); 
				// osc_run_hook('inside-main'); 
				?>
				</div>
				</section>
				
				<?
				if (osc_is_search_page ()) { ?>
					<section class="catalog__filter">
					<div class="container">
					<?php osc_run_hook('before-main'); ?>
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
					<div class="catalog__search-filter">
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
					<input class="input-text" type="text" id="priceMin" name="sPriceMin" placeholder="Мин." value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6">
					<input class="input-text" type="text" id="priceMax" name="sPriceMax" placeholder="Макс." value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="9">
					</div>
					</div>
					</div>
					</div>
					<div class="catalog__filter-select-wrap">
					<!-- <a href="#" class="catalog__filter-more-filters">Показать больше фильтров</a> -->
					<button class="btn btn-yellow ui-button ui-button-big js-submit">Применить фильтр</button>
					</div>
					</div>
					</div>
					</form>
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
				}
				?>