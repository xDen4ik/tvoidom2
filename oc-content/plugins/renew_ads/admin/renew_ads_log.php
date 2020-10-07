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
 ?>
 
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
<div style="padding:20px;">
<h2><?php _e('Renewed ads log', 'renew_ads');?></h2>
<strong><?php _e('Ads been renewed by users', 'renew_ads');?></strong><br /><br />
<?php show_renew_ads_log(); ?>
<br/><br/><hr/>
<h2><?php _e('Expiring ads log', 'renew_ads');?></h2>
<strong><?php _e('Ads that will expire in the next 3 days', 'renew_ads');?></strong><br /><br />
<?php expiring_ads_log(); ?>
<br/><br/><hr/>
<h2><?php _e('Deleted expired ads log', 'renew_ads');?></h2>
<strong><?php _e('Expired ads that are been deleted', 'renew_ads');?></strong><br /><br />
<?php deleted_expired_items_log(); ?>
</div></div>