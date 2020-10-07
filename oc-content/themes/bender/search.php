<?php 
if( osc_count_items() == 0 || stripos($_SERVER['REQUEST_URI'], 'search') ) {
  osc_add_hook('header','bender_nofollow_construct');
} else {
  osc_add_hook('header','bender_follow_construct');
}

bender_add_body_class('search');
$listClass = '';
$buttonClass = '';
if(osc_search_show_as() == 'gallery'){
  $listClass = 'listing-grid';
  $buttonClass = 'active';
}
osc_add_hook('before-main','sidebar');
function sidebar(){
  osc_current_web_theme_path('search-sidebar.php');
}
osc_current_web_theme_path('header.php') ; ?>


<section class="catalog__ads">
  <div class="container">
    <div class="catalog__ads-breadcrumbs">
      <?
      $h1 = '';
      $link = '';
      if (osc_search_category()) {
        switch (osc_search_category()[0]) {
          case '96': case 'prodat':
          $h1 = 'Купить недвижимость';
          $cat = 'Купить недвижимость';
          $link = 'prodat';
          break;
          case '97': case 'sdat':
          $h1 = 'Аренда недвижимости';
          $cat = 'Аренда недвижимости';
          $link = 'sdat';
          break;
          case '116': case 'kypit':
          $h1 = 'Покупатели';
          $cat = 'Покупатели';
          $link = 'kypit';
          break;
          case '122': case 'snyat':
          $h1 = 'Арендаторы';
          $cat = 'Арендаторы';
          $link = 'snyat';
          break;
        }
        if (osc_search_city()) {
          $h1 .= ' в г. ' . osc_search_city();
        }
      } else {
        if (osc_search_city()) {
          $h1 .= 'Недвижимость в г. ' . osc_search_city();
        }
      }
      ?>
      <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="<? osc_base_url(); ?>/search">Каталог</a></li>
            <? if (osc_search_category()) { ?>
              <li><?= $cat ?></li>
            <? } ?>
        </ul>
    </div>
    <?php osc_run_hook('search_ads_listing_top'); ?>
    <h1 class="catalog__ads-title"><?= $h1 ?></h1>

    <?php if(osc_count_items() == 0) { ?>
      <p class="empty" ><?php printf(__('There are no results matching "%s"', 'bender'), osc_search_pattern()) ; ?></p>
    <?php } else { ?>
      <div class="catalog__ads-filters">
        <div class="catalog__ads-filters-text">
          Найдено <?php
          $search_number = bender_search_number();
          echo num_decline($search_number['of'], 'объявление, объявления, объявлений' );
          ?>

        </div>
        <div class="select">
          <div class="select-wrap">
            <?
            $orders = osc_list_orders();
            $current = '';
            foreach($orders as $label => $params) {
              $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1';
              if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) {
                $current = $label;
              }
            }
            $i = 0; 
            ?>
            <span><?php echo $current; ?></span>
            <img src="<?= osc_current_web_theme_url ('app/img/icons/select-angle.svg')?>" alt="">
          </div>
          <div class="select-items">
            <? foreach($orders as $label => $params) { 
              $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
              <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                <a class="select-item current" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a>
              <?php } else { ?>
                <a class="current select-item" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a>
              <?php } ?>
              <?php $i++; ?>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php
    $i = 0;
    // osc_get_premiums();
    // if(osc_count_premiums() > 0) {
    //   echo '<h5>'.__('Premium listings','bender').'</h5>';
    //   View::newInstance()->_exportVariableToView("listType", 'premiums');
    //   View::newInstance()->_exportVariableToView("listClass",$listClass.' premium-list');
    //   osc_current_web_theme_path('loop-catalog-premium.php');
    // }
    ?>
    <?php if(osc_count_items() > 0) {
      View::newInstance()->_exportVariableToView("listType", 'catalog_items');
      View::newInstance()->_exportVariableToView("listClass",$listClass);
      osc_current_web_theme_path('loop-catalog.php');
      ?>
<!--       <?php
      if(osc_rewrite_enabled()){
        $footerLinks = osc_search_footer_links();
        if(count($footerLinks)>0) {
          ?>
          <div id="related-searches">
            <h5><?php _e('Other searches that may interest you','bender'); ?></h5>
            <ul class="footer-links">
              <?php foreach($footerLinks as $f) { View::newInstance()->_exportVariableToView('footer_link', $f); ?>
              <?php if($f['total'] < 3) continue; ?>
              <li><a href="<?php echo osc_footer_link_url(); ?>"><?php echo osc_footer_link_title(); ?></a></li>
            <?php } ?>
          </ul>
        </div>
      <?php }
    } ?> -->
    <div class="paginate" >
      <?php echo osc_search_pagination(); ?>
    </div>
  <?php } ?>
</div>
</section>
<?php osc_current_web_theme_path('footer.php') ; ?>