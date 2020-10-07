<?php



/*

 *      OSCLass – software for creating and publishing online classified

 *                           advertising platforms

 *

 *                        Copyright (C) 2010 OSCLASS

 *

 *       This program is free software: you can redistribute it and/or

 *     modify it under the terms of the GNU Affero General Public License

 *     as published by the Free Software Foundation, either version 3 of

 *            the License, or (at your option) any later version.

 *

 *     This program is distributed in the hope that it will be useful, but

 *         WITHOUT ANY WARRANTY; without even the implied warranty of

 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

 *             GNU Affero General Public License for more details.

 *

 *      You should have received a copy of the GNU Affero General Public

 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */



 if (Params::getParam('plugin_action') == 'renew_settings'){

	osc_set_preference('renew_times', Params::getParam('renew_times'),'renew_ads','INTEGER');

	osc_set_preference('time_between_renew', Params::getParam('time_between_renew'),'renew_ads','INTEGER');

	osc_set_preference('send_admin_email', Params::getParam('send_admin_email'),'renew_ads','STRING');

	osc_set_preference('allow_to_expired', Params::getParam('allow_to_expired'),'renew_ads','STRING');

	osc_set_preference('only_renew', Params::getParam('only_renew'),'renew_ads','STRING');

	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Renew ads settings are now saved.', 'renew_ads') . '<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'renew_ads') . '</a></p></div>';

	osc_reset_preferences();



} else if (Params::getParam('plugin_action') == 'spam_settings'){

	osc_set_preference('delete_spam_cron', Params::getParam('delete_spam_cron'),'renew_ads','STRING');

	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Spam ads cron settings are now saved.', 'renew_ads') . '<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'renew_ads') . '</a></p></div>';

	osc_reset_preferences();



} else if (Params::getParam('plugin_action') == 'expired_settings'){

	osc_set_preference('delete_expired_cron', Params::getParam('delete_expired_cron'),'renew_ads','STRING');

	osc_set_preference('delete_expired_after_days', Params::getParam('delete_expired_after_days'),'renew_ads','INTEGER');

	osc_set_preference('days_to_clear_deleted_table', Params::getParam('days_to_clear_deleted_table'),'renew_ads','INTEGER');

	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Expired ads cron settings are now saved.', 'renew_ads') . '<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'renew_ads') . '</a></p></div>';

	osc_reset_preferences();



} else if (Params::getParam('plugin_action') == 'delete_expired_ads'){

	delete_expired_ads();

	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Expired ads have been deleted.', 'renew_ads') . '<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'renew_ads') . '</a></p></div>';

} else if (Params::getParam('plugin_action') == 'delete_spam_ads'){

	delete_spam_ads();

	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Spam ads have been deleted.', 'renew_ads') . '<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'renew_ads') . '</a></p></div>';

}



$renew_times = osc_get_preference('renew_times','renew_ads');

$time_between_renew = osc_get_preference('time_between_renew','renew_ads');

$delete_expired_cron = osc_get_preference('delete_expired_cron','renew_ads');

$delete_expired_after_days = osc_get_preference('delete_expired_after_days','renew_ads');

$delete_spam_cron = osc_get_preference('delete_spam_cron','renew_ads'); 

$send_admin_email = osc_get_preference('send_admin_email','renew_ads');

$days_to_clear_deleted_table = osc_get_preference('days_to_clear_deleted_table','renew_ads');

$allow_to_expired = osc_get_preference('allow_to_expired','renew_ads');

$only_renew = osc_get_preference('only_renew','renew_ads');



?>



<div id="settings_form" style="border:1px solid #ccc; background:#eee;">

	<div style="padding:20px;">



<h2><?php _e('Renew Ads Settings', 'renew_ads');?></h2>

<form name="renew_ads_form" id="renew_ads_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">

	<input type="hidden" name="page" value="plugins"/>

	<input type="hidden" name="action" value="renderplugin"/>

	<input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>admin.php"/>

	<input type="hidden" name="plugin_action" value="renew_settings"/>



	<input style="width:40px;padding-left:3px;" type="number" name="renew_times" id="renew_times" value="<?php echo $renew_times; ?>"/>

	<?php _e('Set max. times an ad can be renewed (Enter 0 for no limitations).', 'renew_ads');?>

	<br/><br/>

	<?php _e('User has to wait', 'renew_ads');?>&nbsp;<input  style="width:100px;padding-left:3px;" type="number" name="time_between_renew" id="time_between_renew" value="<?php echo $time_between_renew ; ?>"/>&nbsp;<?php _e('seconds to republish the ad again (1 hour = 3600 sec. / 1 day = 86400 sec.)', 'renew_ads') . '.';?> <?php _e('If the value is set to zero, there is no wait period', 'renew_ads');?>

	<br/><br/>

	<input type="checkbox" name="send_admin_email" id="send_admin_email" value="yes" <?php if($send_admin_email=='yes'){echo 'checked';} ?>/>&nbsp;<?php _e('Notify admin when a listing has been renewed', 'renew_ads');?>

	<br/><br/>

	<input type="radio" name="allow_to_expired" id="allow_to_expired" value="on" <?php if($allow_to_expired == 'on'){ echo 'checked';} ?>/>&nbsp;<?php _e('Show only expired ads in user dashboard','renew_ads'); ?>

	<br/><br/>

	<input type="radio" name="allow_to_expired" id="allow_to_expired" value="off" <?php if($allow_to_expired == 'off'){ echo 'checked';} ?>/>&nbsp;<?php _e('Show all ads in user dasboard (disabled, inactive and spam ads are not shown)','renew_ads'); ?>

	<br/><br/>

	<input type="checkbox" name="only_renew" id="only_renew" value="on" <?php if($only_renew=='on'){echo 'checked';} ?>/>&nbsp;<?php _e('Allow users to only renew ads (it will not change publishing date, only renew expiration date and retain position)', 'renew_ads');?>

	<br/><br/>

	<button type="submit" class="btn btn-submit"><?php _e('Update', 'renew_ads');?></button>

	<br/><br/>

</form>



<br/>

<hr/>

<br/>



<!-- EXPIRED SETTINGS -->

<h2><?php _e('Expired Ads Settings', 'renew_ads');?></h2>

<strong><?php _e('NOTE: both Cron and Manual button will delete maximum of 50 expired ads at a time', 'renew_ads');?></strong>



<br/>

<br/>



<!-- EXPIRED DELETE SETTINGS -->

<form name="expired_ads_form" id="expired_ads_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">

	<input type="hidden" name="page" value="plugins"/>

	<input type="hidden" name="action" value="renderplugin"/>

	<input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>admin.php"/>

	<input type="hidden" name="plugin_action" value="expired_settings"/>



	<label for="delete_expired_cron"><?php _e('Set Cron to delete expired ads', 'renew_ads');?></label>

	<br/>

	<input name="delete_expired_cron" id="delete_expired_cron" type="radio" value="off" <?php if($delete_expired_cron=='off'){echo 'checked';} ?>/>&nbsp;<?php _e('Off', 'renew_ads'); ?>

	<br/>

	<input name="delete_expired_cron" id="delete_expired_cron" type="radio" value="hourly" <?php if($delete_expired_cron=='hourly'){echo 'checked';} ?>/>&nbsp;<?php _e('Hourly', 'renew_ads'); ?>

	<br/>

	<input name="delete_expired_cron" id="delete_expired_cron" type="radio" value="daily" <?php if($delete_expired_cron=='daily'){echo 'checked';} ?>/>&nbsp;<?php _e('Daily', 'renew_ads'); ?>

	<br/>

	<input name="delete_expired_cron" id="delete_expired_cron" type="radio" value="weekly" <?php if($delete_expired_cron=='weekly'){echo 'checked';} ?>/>&nbsp;<?php _e('Weekly', 'renew_ads'); ?>

	<br/>

	<input style="width:40px;padding-left:3px;" type="number" name="delete_expired_after_days" id="delete_expired_after_days" value="<?php echo $delete_expired_after_days; ?>"/> <?php _e('Set how many days after expiration the ad will be deleted (Enter 0 to delete the ad the day is expired).', 'renew_ads');?>

	<br/>

	<input style="width:40px;padding-left:3px;" type="number" name="days_to_clear_deleted_table" id="days_to_clear_deleted_table" value="<?php echo $days_to_clear_deleted_table; ?>"/> <?php _e('Set how many days keep the log after the ad has been deleted.', 'renew_ads');?>

	<br/><br/>

	<button type="submit" class="btn btn-submit"><?php _e('Update', 'renew_ads');?></button>

</form>



<br/>

<hr/>

<br/>



<!-- EXPIRED MANUAL DELETE -->

<form name="delete_expired_ads_form" id="delete_expired_ads_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">

	<input type="hidden" name="page" value="plugins"/>

	<input type="hidden" name="action" value="renderplugin"/>

	<input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>admin.php"/>

	<input type="hidden" name="plugin_action" value="delete_expired_ads"/>

	<button type="submit" class="btn btn-submit" style="background-color:#D6003C;"><?php _e('MANUALLY DELETE EXPIRED ADS', 'renew_ads');?></button>

</form>



<br/>

<hr/>

<br/>



<!-- SPAM SETTINGS -->

<h2><?php _e('Spam Ads Settings', 'renew_ads');?></h2>

<strong><?php _e('NOTE: both Cron and Manual button will delete maximum of 50 SPAM ads at a time', 'renew_ads');?></strong>



<br/>

<br/>



<!-- SPAM DELETE SETTINGS -->

<form name="spam_ads_form" id="spam_ads_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">

	<input type="hidden" name="page" value="plugins"/>

	<input type="hidden" name="action" value="renderplugin"/>

	<input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>admin.php"/>

	<input type="hidden" name="plugin_action" value="spam_settings"/>



	<label for="delete_spam_cron"><?php _e('Set Cron job to delete spam ads', 'renew_ads');?></label>

	<br/>

	<input name="delete_spam_cron" id="delete_spam_cron" type="radio" value="off" <?php if($delete_spam_cron=='off'){echo 'checked';} ?>/>&nbsp;<?php _e('Off', 'renew_ads'); ?>

	<br/>

	<input name="delete_spam_cron" id="delete_spam_cron" type="radio" value="hourly" <?php if($delete_spam_cron=='hourly'){echo 'checked';} ?>/>&nbsp;<?php _e('Hourly', 'renew_ads'); ?>

	<br/>

	<input name="delete_spam_cron" id="delete_spam_cron" type="radio" value="daily" <?php if($delete_spam_cron=='daily'){echo 'checked';} ?>/>&nbsp;<?php _e('Daily', 'renew_ads'); ?>

	<br/>

	<input name="delete_spam_cron" id="delete_spam_cron" type="radio" value="weekly" <?php if($delete_spam_cron=='weekly'){echo 'checked';} ?>/>&nbsp;<?php _e('Weekly', 'renew_ads'); ?>

	<br/><br/>

	<button type="submit" class="btn btn-submit"><?php _e('Update', 'renew_ads');?></button>

</form>



<br/>

<hr/>

<br/>



<!-- SPAM MANUAL DELETE -->

<form name="delete_spam_ads_form" id="delete_spam_ads_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">

	<input type="hidden" name="page" value="plugins"/>

	<input type="hidden" name="action" value="renderplugin"/>

	<input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>admin.php"/>

	<input type="hidden" name="plugin_action" value="delete_spam_ads"/>

	<button type="submit" class="btn btn-submit" style="background-color:#D6003C;"><?php _e('MANUALLY DELETE SPAM ADS', 'renew_ads');?></button>

</form>



<br/>

<hr/>

<br/>



<table style="font-size:16px" border="0">

	<tr>

		<td align="left">

		<strong><?php _e('Next hourly cron:','renew_ads'); ?></strong>

		</td>

		<td align="left">

		&nbsp;&nbsp;<?php echo get_cron_time_Hourly(); ?>

		</td>

	</tr>

	<tr>

		<td align="left">

		<strong><?php _e('Next daily cron:','renew_ads'); ?> </strong>

		</td>

		<td align="left">

		&nbsp;&nbsp;<?php echo get_cron_time_Daily(); ?>

		</td>

	</tr>

	<tr>

		<td align="left">

		<strong><?php _e('Next weekly cron:','renew_ads'); ?> </strong>

		</td>

		<td align="left">

		&nbsp;&nbsp;<?php echo get_cron_time_weekly(); ?>

		</td>

	</tr>

</table>

<hr />
<div class="donationpaypal">
<p>Support cartagena68 by donating with PayPal</p><form action="https://www.paypal.com/cgi-bin/webscr" method="post"> <input type="hidden" name="business" value="cartagena68@plugins-zone.com" data-original-title="" title=""> <input type="hidden" name="return" value="http://plugins-zone.com/" data-original-title="" title=""> <input type="hidden" name="rm" value="2" data-original-title="" title=""> <input type="hidden" name="cancel_return" value="http://plugins-zone.com/" data-original-title="" title=""> <input type="hidden" name="charset" value="UTF-8" data-original-title="" title=""> <input type="hidden" name="cmd" value="_donations" data-original-title="" title=""> <input type="hidden" name="bn" value="_Donate_WPS_en" data-original-title="" title=""> <input type="hidden" name="currency_code" value="USD" data-original-title="" title=""> <input type="hidden" name="lc" value="en-us" data-original-title="" title=""><div class="form-group lbab-amount"> <input type="text" name="amount" maxlength="16" data-original-title="" title=""><span>$</span></div><input type="hidden" name="item_name" value="Support Plugins Zone" data-original-title="" title=""> <input type="hidden" name="page_style" value="paypal" data-original-title="" title=""> <input type="hidden" name="cbt" value="Return to Plugins Zone" data-original-title="" title=""><div class="form-group lbab-donation-btn"><br /> <input type="submit" name="submit" value="Donate Now" data-original-title="" title=""></div></form></div>
<br /><br />
<style>.donationpaypal .form-group.lbab-amount span{color:#908f8f;padding:5px 0;font-size:25px;position:absolute;right:18px;top:4px;width:35px;height:30px;background:#cecece;z-index:100;text-shadow:1px 1px 1px #FFF;text-align:center;border-radius:0 3px 3px 0}.donationpaypal .lbab-donation-btn input{cursor:pointer;font:600 18px/22px "Open Sans",sans-serif;background:#cecece;border-radius:3px;text-transform:uppercase;padding:6px;border:0;width:150px;font-size:18px;color:#908f8f;text-shadow:1px 1px 1px #FFF}.donationpaypal .form-group.lbab-amount,.donationpaypal .lbab-donation-btn{position:relative;width:170px}.donationpaypal .form-group.lbab-amount input{margin-top:4px;padding:10px 37px 10px 10px;border:1px solid #b2b2b2;-webkit-appearance:textfield;box-sizing:content-box;border-radius:3px;box-shadow:0 1px 4px 0 rgba(168,168,168,.6) inset;transition:all .2s linear;width:102px;position:relative}</style>

	</div>

</div>
