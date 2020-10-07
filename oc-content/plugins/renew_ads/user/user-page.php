<?php

if(!osc_is_web_user_logged_in()){$session_user_id = false;}

else if (osc_is_web_user_logged_in()){$session_user_id = $_SESSION['userId'];}

if(!$session_user_id){ header('location:'.osc_user_login_url());}

if(osc_get_preference('only_renew','renew_ads')	== ''){	$onlyRenew = false ; $republish = __('Republish','renew_ads') ; $republished = __('Republished','renew_ads'); $torepublish = __('republish','renew_ads');

} else if(osc_get_preference('only_renew','renew_ads')	== 'on'){ $onlyRenew = true ; $republish = __('Renew','renew_ads'); $republished = __('Renewed','renew_ads'); $torepublish = __('renew','renew_ads'); }

$itemsPerPage = (Params::getParam('itemsPerPage') != '') ? Params::getParam('itemsPerPage') : 5;

$page         = (Params::getParam('iPage') != '') ? Params::getParam('iPage') : 0;

if(osc_get_preference('allow_to_expired','renew_ads') == 'on') {

	$total_items  = ModelRenewAds::newInstance()->countExpiredItemsByUserID($session_user_id);

	$total_pages  = ceil($total_items/$itemsPerPage);

	$items = ModelRenewAds::newInstance()->getUserExpiredItem($session_user_id, $page * $itemsPerPage, $itemsPerPage);

	$noListings = __("You don't have any expired ad yet", 'renew_ads');

} else if(osc_get_preference('allow_to_expired','renew_ads') == 'off') {

	$total_items  = Item::newInstance()->countByUserIDEnabled($session_user_id);

	$total_pages  = ceil($total_items/$itemsPerPage);

	$items = Item::newInstance()->findByUserIDEnabled($session_user_id, $page * $itemsPerPage, $itemsPerPage);

	$noListings = __("You don't have any published ad yet", 'renew_ads');

}

View::newInstance()->_exportVariableToView('items', $items);

View::newInstance()->_exportVariableToView('list_total_pages', $total_pages);

View::newInstance()->_exportVariableToView('list_total_items', $total_items);

View::newInstance()->_exportVariableToView('items_per_page', $itemsPerPage);

View::newInstance()->_exportVariableToView('list_page', $page);



if(Params::getParam('plugin_action')=='renew') {

	renew_ads(Params::getParam('item_id'),Params::getParam('category_id'));

	$send_admin_email = osc_get_preference('send_admin_email','renew_ads'); 

	if($send_admin_email=='yes'){

		renew_ads_send_email(Params::getParam('item_id'));

	}

	header('location:'.osc_route_url('renew-ads-user-menu'));	

	osc_add_flash_ok_message( sprintf(__('Congratulations. Your ad has been %s!', 'renew_ads'),$republished) ) ;			

}

?>
<section class="user-items-page">
	<div class="container">
		<h2><?php printf(__('%s your ads', 'renew_ads'),$republish); ?></h2>

		<?php if(osc_count_items() == 0) { ?>

			<h3><?php echo $noListings; ?></h3>

		<?php } else { ?>

			<?php while(osc_has_items()) { 

				$now = strtotime("now");

				$item = Item::newInstance()->findByPrimaryKey(osc_item_id());

				if($item['dt_expiration']!='9999-12-31 23:59:59'){

					$exp_date = strtotime($item['dt_expiration']);

					if($now < $exp_date){

						$willExpire = __('Will expire in: ','renew_ads');

						$time_to_expiration = $exp_date-$now;

						$days_more = secondsToTime($time_to_expiration);

						if($days_more['d']>=1){$daysToExp = sprintf(__('%s days ','renew_ads'),$days_more['d']);}else{$daysToExp = '';}

						if($days_more['h']>=1){$hoursToExp = sprintf(__('%s hours ','renew_ads'),$days_more['h']);}else{$hoursToExp = '';}

						if($days_more['m']>=1){$minutesToExp = sprintf(__('%s minutes ','renew_ads'),$days_more['m']);}else{$minutesToExp = '';}

						$daysToExpire = $daysToExp.$hoursToExp.$minutesToExp;

					} else if ($now >= $exp_date){ 

						$daysToExpire = __('Expired','renew_ads'); $willExpire = ''; }

					} else {$daysToExpire = ''; $willExpire = '';}

					$item_is_renewed = ModelRenewAds::newInstance()->item_is_renewed(osc_item_id());

					$available_times = osc_get_preference('renew_times','renew_ads');

					$times_remaining = $available_times-$item_is_renewed['d_renewed'];

					$time_between_renew = osc_get_preference('time_between_renew','renew_ads');

					$renew_date = strtotime($item_is_renewed['last_renewed']);	

					$total_time_to_wait =  gmdate("H:i:s", $time_between_renew);

					$time_to_wait1 =  ($renew_date+$time_between_renew)-$now ; 

					$time_to_wait = secondsToTime($time_to_wait1);

					if($time_to_wait['d']>=1){$days = sprintf(__('%s days ','renew_ads'),$time_to_wait['d']);}else{$days = '';}

					if($time_to_wait['h']>=1){$hours = sprintf(__('%s hours ','renew_ads'),$time_to_wait['h']);}else{$hours = '';}

					if($time_to_wait['m']>=1){$minutes = sprintf(__('%s minutes ','renew_ads'),$time_to_wait['m']);}else{$minutes = '';}

					if($time_to_wait['s']>=1){$seconds = sprintf(__('%s seconds ','renew_ads'),$time_to_wait['s']);}else{$seconds = '';}

					?>

					<?php if( osc_item_is_enabled () ) { ?>

						<?php if( osc_item_is_active () ) { ?>

							<?php if( !osc_item_is_spam () ) { ?>  

								<div class="item" >
									<? $detail = osc_get_item_meta ();
									$rooms = '';
									if ($detail[3]['s_value'] !== 'Студия') {
										$rooms = $detail[3]['s_value'] . '-к квартира';
									} else {
										$rooms = 'студия';
									}
									$title = osc_item_address() . ', ' . $rooms . ', ' . $detail[5]['s_value'] . ' м²';
									?>

									<h3>

										<a href="<?php echo osc_item_url(); ?>"><?= $title ?></a>

									</h3>

									<!-- <strong><?php _e('Ad ID: ','renew_ads');?></strong><?php echo osc_item_id() ; ?>&nbsp;&nbsp;<strong><?php _e('Category: ','renew_ads'); ?></strong><a href="<?php echo osc_base_url().osc_item_category(); ?>"><?php echo osc_item_category(); ?></a> -->

									<strong><?php echo $willExpire.$daysToExpire ; ?></strong>



									<p class="options">

										<?php if($available_times !='0' && $item_is_renewed['d_renewed'] >= $available_times) {

											printf(__('You have %s your ad %s times. You cannot %s this ad!', 'renew_ads'),$republished, $available_times, $torepublish); 

										} else if($time_between_renew !='0' && $now - $renew_date <= $time_between_renew){ 

											printf(__('To %s this ad again, you need to wait:', 'renew_ads'), $torepublish); echo '<br/>'.$days.$hours.$minutes.$seconds ;

										} else {

											if($available_times !='0') { printf(__('You can %s this ad %s more times!', 'renew_ads'), $torepublish, $times_remaining); }

											?>

											<form  action="<?php echo osc_route_url('renew-ads-user-menu'); ?>" method="POST" >

												<input type="hidden" name="plugin_action" value="renew" />

												<input type="hidden" name="item_id" value="<?php echo osc_item_id() ; ?>" />

												<input type="hidden" name="category_id" value="<?php echo osc_item_category_id() ; ?>" />

												<button id="renew_ads_form" class="btn" type="submit" ><?php printf(__('%s this ad', 'renew_ads'), $republish); ?></button>

											</form> 

										<?php  } ?>		 

									</p>

                   <!-- <p>

                    <?php _e('Publication date', 'renew_ads') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?>

                  </p>-->

                  <br />

                </div>



              <?php } ?>

            <?php } ?>

          <?php } ?>

        <?php } ?>

        <br />

        <div class="paginate">
        	<ul>

        	<?php for($i = 0 ; $i < $total_pages ; $i++) {

        		if($i == $page) {

        			printf('<li><a class="searchPaginationSelected" href="%s">%d</a></li>', osc_route_url('renew-ads-user-menu', array('iPage' => $i)), ($i + 1));

        		} else {

        			printf('<li><a class="searchPaginationNonSelected" href="%s">%d</a></li>', osc_route_url('renew-ads-user-menu', array('iPage' => $i)), ($i + 1));

        		}

        	} ?>
        	</ul>
        </div>

      <?php } ?>
    </div>
  </section>