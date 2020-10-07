<?php

/*

Plugin Name: Renew Ads Plugin

Plugin URI: https://osclass.pro

Description: Этот плагин позволяет пользователям бесплатно продлевать срок размещения объявлений и другое.

Version: 1.0.4

Author: cartagena68&Mnu


Short Name: renew_ads

Plugin update URI: renewads

*/

require_once('ModelRenewAds.php');



function renew_ads_install() {

    

    ModelRenewAds::newInstance()->import('renew_ads/struct.sql');

    

	osc_set_preference('renew_times', '3','renew_ads','INTEGER');

	osc_set_preference('time_between_renew', '86400','renew_ads','INTEGER');

	osc_set_preference('delete_spam_cron', 'off','renew_ads','STRING');

	osc_set_preference('delete_expired_cron', 'off','renew_ads','STRING');

	osc_set_preference('delete_expired_after_days', '0','renew_ads','INTEGER');

	osc_set_preference('send_admin_email', '','renew_ads','STRING');

	osc_set_preference('days_to_clear_deleted_table', '5','renew_ads','INTEGER');

	osc_set_preference('allow_to_expired', 'off','renew_ads','STRING');

	osc_set_preference('only_renew', '','renew_ads','STRING');

	

	$locales = osc_current_user_locale() ;

     $description[$locales]['s_title'] = '{WEB_TITLE} - A listing has been renewed';

     $description[$locales]['s_text'] = '<p>Dear {WEB_TITLE} admin,</p>

<p>You are receiving this email because a listing has been renewed at {WEB_LINK}.</p>

<p>Listing details:</p>

<p>Contact name: {USER_NAME}<br />Contact email: {USER_EMAIL}</p>

<p>Title: {ITEM_TITLE}</p>

<p>Url: {ITEM_URL}</p>

<p>Regards,</p>

<p>{WEB_LINK}</p>';

     Page::newInstance()->insert( array('s_internal_name' => 'email_admin_renew_item', 'b_indelible' => '1'), $description );

		

}

// Uninstall Plugin

function renew_ads_uninstall() {

	$conn = getConnection();

	 ModelRenewAds::newInstance()->uninstall();

	 

     osc_delete_preference('renew_times','renew_ads');

	 osc_delete_preference('time_between_renew','renew_ads');

	 osc_delete_preference('delete_spam_cron','renew_ads');

	 osc_delete_preference('delete_expired_cron','renew_ads');

	 osc_delete_preference('delete_expired_after_days','renew_ads');

	 osc_delete_preference('send_admin_email','renew_ads');

	 osc_delete_preference('days_to_clear_deleted_table','renew_ads');

	 osc_delete_preference('allow_to_expired','renew_ads');

	 osc_delete_preference('only_renew','renew_ads');

	 

	 $page_ids = $conn->osc_dbFetchResults("SELECT * FROM %st_pages WHERE s_internal_name = 'email_admin_renew_item'", DB_TABLE_PREFIX);

		foreach($page_ids as $page_id){

        $conn->osc_dbExec("DELETE FROM %st_pages_description WHERE fk_i_pages_id = %d", DB_TABLE_PREFIX, $page_id['pk_i_id']);

              

        $conn->osc_dbExec("DELETE FROM %st_pages WHERE s_internal_name = 'email_admin_renew_item'", DB_TABLE_PREFIX);      

		}

}



function renew_ads_send_email($id){

	

	$send_admin_email = osc_get_preference('send_admin_email','renew_ads');

	$siteUrl = osc_base_url(); 

	$siteLink = '<a target="_blank" href="'.$siteUrl.'">{WEB_TITLE}</a>';

	$mPages = new Page() ;

        $aPage = $mPages->findByInternalName('email_admin_renew_item') ;

        $locale = osc_current_user_locale() ;

        $content = array();

        if(isset($aPage['locale'][$locale]['s_title'])) {

            $content = $aPage['locale'][$locale];

        } else {

            $content = current($aPage['locale']);

        }        

        $item = Item::newInstance()->findByPrimaryKey($id);                     

	    $item_link_url = $siteUrl.'index.php?page=item&id='.$id ;

        $item_url    = '<a target="_blank" href="'.$item_link_url.'" >'.$item_link_url.'</a>';

        $words   = array();

        $words[] = array('{USER_NAME}', '{ITEM_TITLE}', '{WEB_TITLE}', '{ITEM_URL}', '{ITEM_ID}', '{USER_EMAIL}', '{WEB_LINK}');

        $words[] = array($item['s_contact_name'], $item['s_title'], osc_page_title(), $item_url, $item['pk_i_id'], $item['s_contact_email'], $siteLink) ;

        $title = osc_mailBeauty($content['s_title'], $words) ;

        $body  = osc_mailBeauty($content['s_text'], $words) ;

        $emailParams =  array('subject'  => $title

                             ,'to'       => osc_contact_email()

                             ,'to_name'  => 'Admin'

                             ,'body'     => $body

                             ,'alt_body' => $body);

        osc_sendMail($emailParams);

 }



function get_cat_expiration_days($ItemCategoryId){

	 $days = ModelRenewAds::newInstance()->get_expiration_days($ItemCategoryId);

	 return $days['i_expiration_days'] ;

	}



if( !function_exists( 'renew_ads' ) ) {

        function renew_ads($ItemId,$ItemCategoryId)  {

			$Item = Item::newInstance()->findByPrimaryKey($ItemId);	

			$pub_date = $Item['dt_pub_date'];

			$available_times = osc_get_preference('renew_times','renew_ads');

			$item_is_renewed = ModelRenewAds::newInstance()->item_is_renewed($ItemId);

			$time_between_renew = osc_get_preference('time_between_renew','renew_ads');

			$renew_date = strtotime($item_is_renewed['last_renewed']);

			$now = strtotime("now");

			if($now - $renew_date <= $time_between_renew){

				return false; }

			if($available_times !='0' && $item_is_renewed['d_renewed'] >= $available_times) {

				return false ; 

				}else{	

			$renew = new dao;

			$date = date('Y-m-d H:i:s');

			$expirationDays = get_cat_expiration_days($ItemCategoryId)	;

			if($expirationDays != 0){

			$newExpirationDate = date('Y-m-d H:i:s', strtotime('+'.$expirationDays.' days'));

			} else {

			$newExpirationDate = '9999-12-31 23:59:59'; 

			}

			if(osc_get_preference('only_renew','renew_ads')	== ''){	

			$sql = sprintf("INSERT INTO %st_item_renew_ads (fk_i_item_id ,d_renewed,published,last_renewed) VALUES (%d, %d, '$pub_date','$date') ON DUPLICATE KEY UPDATE d_renewed = d_renewed + 1, last_renewed = '$date' ", DB_TABLE_PREFIX, $ItemId, 1);					

			$sql2 = sprintf("UPDATE %st_item SET dt_mod_date = '%s' WHERE pk_i_id = '%s'", DB_TABLE_PREFIX, $date, $ItemId);

			$sql3 = sprintf("UPDATE %st_item SET dt_expiration = '%s' WHERE pk_i_id = '%s'", DB_TABLE_PREFIX, $newExpirationDate, $ItemId);

			$sql4 = sprintf("UPDATE %st_item SET dt_pub_date = '%s' WHERE pk_i_id = '%s'", DB_TABLE_PREFIX, $date, $ItemId);	

			$result = $renew->dao->query($sql);

			if($result){

			$result2 = $renew->dao->query($sql2);

			$result3 = $renew->dao->query($sql3);

			$result4 = $renew->dao->query($sql4);

			}

			if($result2 && $result3 && $result4){

				return true;

					} 

				} else if(osc_get_preference('only_renew','renew_ads')	== 'on'){	

				$sql = sprintf("INSERT INTO %st_item_renew_ads (fk_i_item_id ,d_renewed,published,last_renewed) VALUES (%d, %d, '$pub_date','$date') ON DUPLICATE KEY UPDATE d_renewed = d_renewed + 1, last_renewed = '$date' ", DB_TABLE_PREFIX, $ItemId, 1);		

			$sql3 = sprintf("UPDATE %st_item SET dt_expiration = '%s' WHERE pk_i_id = '%s'", DB_TABLE_PREFIX, $newExpirationDate, $ItemId);

			$result = $renew->dao->query($sql);

			if($result){

			$result3 = $renew->dao->query($sql3);

			}

			if($result3){

				return true;

					}

			}

		}

    } 

}



if( !function_exists( 'renew_ads_menu' ) ) {

function renew_ads_menu() {

    echo '<h3><a href="#">Renew Ads</a></h3>

    <ul>

        <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) .'admin/admin.php').'">&raquo; ' . __('Admin', 'renew_ads') . '</a></li>   

		<li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) .'admin/renew_ads_log.php').'">&raquo; ' . __('Log', 'renew_ads') . '</a></li>            

    </ul>';

	}

}



function renew_ads_settings() {

        osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/admin/admin.php') ;

    }

	

function renew_ads_user_menu(){

	if(osc_get_preference('only_renew','renew_ads')	== ''){	

		 echo '<li class="renew_ads" ><a href="' . osc_route_url('renew-ads-user-menu') .'" >'.__('Republish your ads', 'renew_ads').'</a></li>'; 

	} else if(osc_get_preference('only_renew','renew_ads')	== 'on'){	

		 echo '<li class="renew_ads" ><a href="' . osc_route_url('renew-ads-user-menu') .'" >'.__('Renew your ads', 'renew_ads').'</a></li>'; 

	}

	}

	

function delete_spam_ads(){

	$items = ModelRenewAds::newInstance()->getSpamItem();
	
	if(!$items) { 
		return false;
	 } else {

	View::newInstance()->_exportVariableToView('items', $items);

	while(osc_has_items())

		{

			$item = Item::newInstance()->findByPrimaryKey(osc_item_id());

			$email = $item['s_contact_email'];

			$id = $item['pk_i_id'];

			$title = $item['s_title'];

			if($item['fk_i_user_id'] != ''){

			$user = $item['fk_i_user_id'];
			} else { $user = 0 ; $result = TRUE ;}

			if(!osc_item_is_premium()){

			$delete = new dao;

			$sql = sprintf("DELETE FROM %st_item_renew_ads WHERE fk_i_item_id = '%s'", DB_TABLE_PREFIX, $id);

			$result = $delete->dao->query($sql);

			if($result){

			$status = $delete->dao->insert(ModelRenewAds::newInstance()->getTable_DeletedExpiredAds(),

			array(

			'fk_i_item_id' => $id,

			'status' => 'SPAM',

			'user_id' => $user,

			'item_title' => $title,

			'deleted' => $email,

			'deleted_date' => date('Y-m-d H:i:s')));

			if($status){

				

			$mItems = new ItemActions(true);



			$success = $mItems->delete($item['s_secret'], $item['pk_i_id']);
					}
				}

			}

		} 

	}

}

	

function R_A_deleted_items($id){

	$delete = new dao;

			$sql = sprintf("DELETE FROM %st_item_renew_ads WHERE fk_i_item_id = '%s'", DB_TABLE_PREFIX, $id);

			$result = $delete->dao->query($sql);	

	}



function delete_expired_ads(){

			$items = ModelRenewAds::newInstance()->getExpiredItem();
			if(!$items) { 
				return false;
	 		} else {

			View::newInstance()->_exportVariableToView('items', $items);

			while(osc_has_items()) { 

			$item = Item::newInstance()->findByPrimaryKey(osc_item_id());

			$email = $item['s_contact_email'];

			$id = $item['pk_i_id'];

			$title = $item['s_title'];
			
			if($item['fk_i_user_id'] != ''){

			$user = $item['fk_i_user_id'];
			} else { $user = 0 ; $result = TRUE ;}

			if(!osc_item_is_premium()){

			$delete = new dao;

			$sql = sprintf("DELETE FROM %st_item_renew_ads WHERE fk_i_item_id = '%s'", DB_TABLE_PREFIX, $id);

			$result = $delete->dao->query($sql);

			if($result){

			$status = $delete->dao->insert(ModelRenewAds::newInstance()->getTable_DeletedExpiredAds(),

			array(

			'fk_i_item_id' => $id,

			'status' => 'EXPIRED',

			'user_id' => $user,

			'item_title' => $title,

			'deleted' => $email,

			'deleted_date' => date('Y-m-d H:i:s')));

			if($status){

				

			$mItems = new ItemActions(true);



			$success = $mItems->delete($item['s_secret'], $item['pk_i_id']);
					}
				}

			}

		} 

	}

}



function clean_deleted_ads_table(){

	$days = osc_get_preference('days_to_clear_deleted_table','renew_ads');

	$today=date('Y-m-d H:i:s');

	$date = date('Y-m-d H:i:s', strtotime($today. ' - '.$days.' days'));

	$delete = new dao;

			$sql = sprintf("DELETE FROM %st_item_deleted_expired_ads WHERE deleted_date < '%s'", DB_TABLE_PREFIX, $date);

			$result = $delete->dao->query($sql);

			if($result){

				return true;

			}

	}



function deleted_expired_items_log(){

	$DeletedExpiredAds = ModelRenewAds::newInstance()->DeletedExpiredItems();

		echo "

	<table id='table' class='sortable' border='1'>

	<thead> 

	<tr>

	<th><span>&nbsp;".__('Item Id','renew_ads')."&nbsp;</span></th>

	<th><span>&nbsp;".__('Deleted for','renew_ads')."&nbsp;</span></th>

	<th><span>&nbsp;".__('User Id','renew_ads')."&nbsp;</span></th>

	<th><span>&nbsp;".__('Item Title','renew_ads')."&nbsp;</span></th>

	<th><span>".__('Contact Email','renew_ads')."</span></th>

	<th><span>".__('Deleted date','renew_ads')."</span></th>

	</tr>

	</thead><tbody>";

	

	if(is_array($DeletedExpiredAds)){

	foreach($DeletedExpiredAds as $DeletedExpiredAd){

	$id = $DeletedExpiredAd['fk_i_item_id'];

	$status = $DeletedExpiredAd['status'];

	$deleted = $DeletedExpiredAd['deleted'];

	$title = $DeletedExpiredAd['item_title'];
	
	if($DeletedExpiredAd['user_id'] == 0){
		$user = 'Anonymous';
	} else { $user = $DeletedExpiredAd['user_id']; }

	$user_link_url = osc_base_url().'oc-admin/index.php?page=items&userId='.$user ;

	$deleted_date = osc_format_date($DeletedExpiredAd['deleted_date']);

	echo "<tr style='font-weight:700;'>";	

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$id. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$status. "</td>";
	
	if($user == 'Anonymous'){		
		echo "<td align='center' style='padding:8px;font-size:13px;'>" .$user. "</td>";
	} else {
	echo "<td align='center' style='padding:8px;font-size:13px;'><a target='_new' href='".$user_link_url."'>" .$user. " <span class='icon-new-window'></span></a></td>";
	}

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$title. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$deleted. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$deleted_date. "</td>";

	echo "</tr>";

		}

	}

	echo "</tbody></table>";

	}

	

function secondsToTime($inputSeconds) {
    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $days = floor($inputSeconds / $secondsInADay);
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}



function get_cron_time_Hourly(){

	$allHourlyTimes = ModelRenewAds::newInstance()->GetCronTimeHourly();

	foreach($allHourlyTimes as $allHourlyTime){

		$Hourlytime = $allHourlyTime['d_next_exec'];

	}

	$cronTime = strtotime($Hourlytime);

	$now = strtotime("now");

	if($cronTime > $now){

	$time_to_wait1 = $cronTime-$now;

	$time_to_wait = secondsToTime($time_to_wait1);

	if($time_to_wait['d']>=1){$days = sprintf(__('%s days ','renew_ads'),$time_to_wait['d']);}else{$days = '';}

	if($time_to_wait['h']>=1){$hours = sprintf(__('%s hours ','renew_ads'),$time_to_wait['h']);}else{$hours = '';}

	if($time_to_wait['m']>=1){$minutes = sprintf(__('%s minutes ','renew_ads'),$time_to_wait['m']);}else{$minutes = '';}

	if($time_to_wait['s']>=1){$seconds = sprintf(__('%s seconds ','renew_ads'),$time_to_wait['s']);}else{$seconds = '';}

	$nextHourlyCron = $days.$hours.$minutes.$seconds;

	} else if($cronTime <= $now){

		$nextHourlyCron = 'Cron Job Running'; }

	return $nextHourlyCron ;

}



function get_cron_time_Daily(){

	$allDailyTimes = ModelRenewAds::newInstance()->GetCronTimeDaily();

	foreach($allDailyTimes as $allDailyTime){

		$Dailytime = $allDailyTime['d_next_exec'];

	}

	$cronTime = strtotime($Dailytime);

	$now = strtotime("now");

	if($cronTime > $now){

	$time_to_wait1 = $cronTime-$now;

	$time_to_wait = secondsToTime($time_to_wait1);

	if($time_to_wait['d']>=1){$days = sprintf(__('%s days ','renew_ads'),$time_to_wait['d']);}else{$days = '';}

	if($time_to_wait['h']>=1){$hours = sprintf(__('%s hours ','renew_ads'),$time_to_wait['h']);}else{$hours = '';}

	if($time_to_wait['m']>=1){$minutes = sprintf(__('%s minutes ','renew_ads'),$time_to_wait['m']);}else{$minutes = '';}

	if($time_to_wait['s']>=1){$seconds = sprintf(__('%s seconds ','renew_ads'),$time_to_wait['s']);}else{$seconds = '';}

	$nextDailyCron = $days.$hours.$minutes.$seconds;

	} else if($cronTime <= $now){

		$nextDailyCron = 'Cron Job Running'; }

	return $nextDailyCron ;

}



function get_cron_time_Weekly(){

	$allWeeklyTimes = ModelRenewAds::newInstance()->GetCronTimeWeekly();

	foreach($allWeeklyTimes as $allWeeklyTime){

		$Weeklytime = $allWeeklyTime['d_next_exec'];

	}

	$cronTime = strtotime($Weeklytime);

	$now = strtotime("now");

	if($cronTime > $now){

	$time_to_wait1 = $cronTime-$now;

	$time_to_wait = secondsToTime($time_to_wait1);

	if($time_to_wait['d']>=1){$days = sprintf(__('%s days ','renew_ads'),$time_to_wait['d']);}else{$days = '';}

	if($time_to_wait['h']>=1){$hours = sprintf(__('%s hours ','renew_ads'),$time_to_wait['h']);}else{$hours = '';}

	if($time_to_wait['m']>=1){$minutes = sprintf(__('%s minutes ','renew_ads'),$time_to_wait['m']);}else{$minutes = '';}

	if($time_to_wait['s']>=1){$seconds = sprintf(__('%s seconds ','renew_ads'),$time_to_wait['s']);}else{$seconds = '';}

	$nextWeeklyCron = $days.$hours.$minutes.$seconds;

	} else if($cronTime <= $now){

		$nextWeeklyCron = 'Cron Job Running'; }

	return $nextWeeklyCron ;

}



function show_renew_ads_log(){

	$renewedItems = ModelRenewAds::newInstance()->renewed_items();

	echo "

	<table id='table' class='sortable' border='1'>

	<thead> 

	<tr>

	<th><span>&nbsp;".__('Item Id','renew_ads')."&nbsp;</span></th>

	<th><span>&nbsp;".__('User Id','renew_ads')."&nbsp;</span></th>

	<th><span>".__('Item Title','renew_ads')."&nbsp;</span></th>

	<th><span>".__('Category','renew_ads')."</span></th>

	<th><span>".__('First publication date','renew_ads')."</span></th>

	<th><span>".__('Times renewed','renew_ads')."</span></th>

	<th><span>".__('Last renewed','renew_ads')."</span></th>

	<th><span>".__('Will Expire In','renew_ads')."</span></th>

	<th><span>".__('Contact Email','renew_ads')."</span></th>

	</tr>

	</thead><tbody>";

	

	if(is_array($renewedItems)){

	foreach($renewedItems as $renewedItem){

	$id= $renewedItem["fk_i_item_id"];

	$timesRenewed = $renewedItem["d_renewed"];

	$lastRenewed= osc_format_date($renewedItem["last_renewed"]);

	$item = Item::newInstance()->findByPrimaryKey($id);

	$contact_email = $item['s_contact_email'];

	$categoryID = $item['fk_i_category_id'];

	$userId = $item['fk_i_user_id'];

	if($item['b_spam'] == 1 ){

	$is_spam = true ;

	} else { $is_spam = ''; }

	if($item['b_premium'] == 1 ){

	$is_premium = true ;

	} else { $is_premium = ''; }

	$pubbDate = osc_format_date($renewedItem["published"]);

	$title = mb_substr($item['s_title'], 0, 30, 'utf-8');

                    if($title != $item['s_title']) {

                        $title .= '...';

                    }

	$category = Category::newInstance()->findByPrimaryKey($categoryID);

	$category_name = $category['s_name'];

	$item_link_url = osc_base_url().'index.php?page=item&id='.$id ;

	$user_link_url = osc_base_url().'oc-admin/index.php?page=items&userId='.$userId ;

	$now = strtotime("now");

	if($item['dt_expiration']!='9999-12-31 23:59:59'){

		$exp_date = strtotime($item['dt_expiration']);

		if($now < $exp_date){

			$time_to_expiration = $exp_date-$now;

			$days_more = secondsToTime($time_to_expiration);

			if($days_more['d']>=1){$daysToExp = sprintf(__('%s days ','renew_ads'),$days_more['d']);}else{$daysToExp = '';}

			if($days_more['h']>=1){$hoursToExp = sprintf(__('%s hours ','renew_ads'),$days_more['h']);}else{$hoursToExp = '';}

			if($days_more['m']>=1){$minutesToExp = sprintf(__('%s minutes ','renew_ads'),$days_more['m']);}else{$minutesToExp = '';}

			$daysToExpire = $daysToExp.$hoursToExp.$minutesToExp;

			} else if ($now >= $exp_date){ 

			$daysToExpire = __('Expired','renew_ads'); $exp_date = ''; }

		} else {$daysToExpire = ''; $exp_date = '';}

	

	echo "<tr style='font-weight:700;'>";

	if($is_spam){

		echo "<td align='center' style='padding:8px;font-size:13px;background-color:#7a8288;color:white;'><a target='_new' href='".$item_link_url."'style='color:white;'>" .$id. " <span class='icon-new-window'></span></a><br />Spam</td>";

		} else if($is_premium) {

			echo "<td align='center' style='padding:8px;font-size:13px;background-color:#f0db7f;'><a target='_new' href='".$item_link_url."'>" .$id. " <span class='icon-new-window'></span></a><br />Premium</td>";

		} else {

 	echo "<td align='center' style='padding:8px;font-size:13px;'><a target='_new' href='".$item_link_url."'>" .$id. " <span class='icon-new-window'></span></a></td>"; 

	}

	echo "<td align='center' style='padding:8px;font-size:13px;'><a target='_new' href='".$user_link_url."'>" .$userId. " <span class='icon-new-window'></span></a></td>";

	echo "<td style='padding:8px;font-size:13px;'>" .$title. "</td>";

 	echo "<td style='padding:8px;font-size:13px;'>" .$category_name. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$pubbDate. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$timesRenewed. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$lastRenewed. "</td>";

 	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$daysToExpire. "</td>";

	echo "<td style='padding:8px;font-size:13px;font-size:12px;'>" .$contact_email. "</td>";

	echo "</tr>";

		}

	}

	echo "</tbody></table>";

	

}



function expiring_ads_log(){

	$expiringItems = ModelRenewAds::newInstance()->ExpiringItem();

	echo "

	<table id='table' class='sortable' border='1'>

	<thead> 

	<tr>

	<th><span>&nbsp;".__('Item Id','renew_ads')."&nbsp;</span></th>

	<th><span>&nbsp;".__('User Id','renew_ads')."&nbsp;</span></th>

	<th><span>".__('Item Title','renew_ads')."&nbsp;</span></th>

	<th><span>".__('Category','renew_ads')."</span></th>

	<th><span>".__('Last publication date','renew_ads')."</span></th>

	<th><span>".__('Expiring date','renew_ads')."</span></th>

	<th><span>".__('Will Expire In','renew_ads')."</span></th>

	<th><span>".__('Contact Email','renew_ads')."</span></th>

	</tr>

	</thead><tbody>";

	

	if(is_array($expiringItems)){

	foreach($expiringItems as $expiringItem){

	$item = Item::newInstance()->findByPrimaryKey($expiringItem['pk_i_id']);

	$id = $item['pk_i_id'];

	$contact_email = $item['s_contact_email'];

	$categoryID = $item['fk_i_category_id'];
	
	if($item['fk_i_user_id'] != '') {

	$userId = $item['fk_i_user_id'];
	
	} else { $userId = 'Anonymous' ; }

	if($item['b_spam'] == 1 ){

	$is_spam = true ;

	} else { $is_spam = ''; }

	if($item['b_premium'] == 1 ){

	$is_premium = true ;

	} else { $is_premium = ''; }

	$pubbDate = osc_format_date($item['dt_pub_date']);

	$expiringDate = osc_format_date($item['dt_expiration']);

	$title = mb_substr($item['s_title'], 0, 30, 'utf-8');

                    if($title != $item['s_title']) {

                        $title .= '...';

                    }

	$category = Category::newInstance()->findByPrimaryKey($categoryID);

	$category_name = $category['s_name'];

	$item_link_url = osc_base_url().'index.php?page=item&id='.$id ;

	$user_link_url = osc_base_url().'oc-admin/index.php?page=items&userId='.$userId ;

	$now = strtotime("now");

	if($item['dt_expiration']!='9999-12-31 23:59:59'){

		$exp_date = strtotime($item['dt_expiration']);

		if($now < $exp_date){

			$time_to_expiration = $exp_date-$now;

			$days_more = secondsToTime($time_to_expiration);

			if($days_more['d']>=1){$daysToExp = sprintf(__('%s days ','renew_ads'),$days_more['d']);}else{$daysToExp = '';}

			if($days_more['h']>=1){$hoursToExp = sprintf(__('%s hours ','renew_ads'),$days_more['h']);}else{$hoursToExp = '';}

			if($days_more['m']>=1){$minutesToExp = sprintf(__('%s minutes ','renew_ads'),$days_more['m']);}else{$minutesToExp = '';}

			$daysToExpire = $daysToExp.$hoursToExp.$minutesToExp;

			} else if ($now >= $exp_date){ 

			$daysToExpire = __('Expired','renew_ads'); $exp_date = ''; }

		} else {$daysToExpire = ''; $exp_date = '';}

	

	echo "<tr style='font-weight:700;'>";

	if($is_spam){

		echo "<td align='center' style='padding:8px;font-size:13px;background-color:#7a8288;color:white;'><a target='_new' href='".$item_link_url."'style='color:white;'>" .$id. " <span class='icon-new-window'></span></a><br />Spam</td>";

		} else if($is_premium) {

			echo "<td align='center' style='padding:8px;font-size:13px;background-color:#f0db7f;'><a target='_new' href='".$item_link_url."'>" .$id. " <span class='icon-new-window'></span></a><br />Premium</td>";

		} else {

 	echo "<td align='center' style='padding:8px;font-size:13px;'><a target='_new' href='".$item_link_url."'>" .$id. " <span class='icon-new-window'></span></a></td>";

		}
		
		if($userId == 'Anonymous'){
			echo "<td align='center' style='padding:8px;font-size:13px;'>" .$userId. " </td>";
		} else {
	echo "<td align='center' style='padding:8px;font-size:13px;'><a target='_new' href='".$user_link_url."'>" .$userId. " <span class='icon-new-window'></span></a></td>";
		}

	echo "<td style='padding:8px;font-size:13px;'>" .$title. "</td>";

 	echo "<td style='padding:8px;font-size:13px;'>" .$category_name. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$pubbDate. "</td>";

	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$expiringDate. "</td>";

 	echo "<td align='center' style='padding:8px;font-size:13px;'>" .$daysToExpire. "</td>";

	echo "<td style='padding:8px;font-size:13px;font-size:12px;'>" .$contact_email. "</td>";

	echo "</tr>";

		}

	}

	echo "</tbody></table>";

	

	}

	

function renew_ads_load_scripts() {

       osc_register_script('sorttable', osc_base_url() . 'oc-content/plugins/renew_ads/js/sorttable.js', 'jquery');

       osc_enqueue_script('sorttable');

   }

   

function item_is_expired($itemId){

	$expiredItems = ModelRenewAds::newInstance()->GetItemRow($itemId);

	$date = date('Y-m-d H:i:s');

	foreach($expiredItems as $expiredItem){

	if($expiredItem['dt_expiration'] < $date){

		return true  ;

		}

	}

}

	

// This is needed in order to be able to activate the plugin

osc_register_plugin(osc_plugin_path(__FILE__), 'renew_ads_install');



// This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)

osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'renew_ads_uninstall');



osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'renew_ads_settings');



osc_add_hook('init_admin', 'renew_ads_load_scripts');



osc_add_hook('admin_menu', 'renew_ads_menu');



osc_add_hook('user_menu', 'renew_ads_user_menu');



osc_add_route('renew-ads-user-menu', 'renew-option', 'renew-option', osc_plugin_folder(__FILE__).'user/user-page.php', true);



osc_add_hook('cron_hourly', 'clean_deleted_ads_table');



osc_add_hook('delete_item', 'R_A_deleted_items');



$span_cron = osc_get_preference('delete_spam_cron','renew_ads');

osc_add_hook('cron_'.$span_cron, 'delete_spam_ads');



$expired_cron = osc_get_preference('delete_expired_cron','renew_ads');

osc_add_hook('cron_'.$expired_cron, 'delete_expired_ads');

	

?>