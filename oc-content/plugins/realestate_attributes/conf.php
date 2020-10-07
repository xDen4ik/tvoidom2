<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');
/*
 *      OSCLass – software for creating and publishing online classified
 *                           advertising platforms
 *
 *                        Copyright (C) 2015 OSCLASS
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

<?php
if(Params::getParam('plugin_action')!='') {
    if(Params::getParam('plugin_action')=="type_delete") {
        if(Params::getParam('id')!="") {
            ModelRealEstate::newInstance()->deletePropertyType( Params::getParam('id') ) ;
        }
    } else if(Params::getParam('plugin_action')=="type_add") {
        $dataItem = array();
        $request = Params::getParamsAsArray();
        foreach ($request as $k => $v) {
            if (preg_match('|(.+?)#(.+)|', $k, $m)) {
                $dataItem[$m[1]][$m[2]] = $v;
            }
        }
        // insert locales
        $lastId = ModelRealEstate::newInstance()->getLastPropertyTypeId();
		if($lastId == null) {
			$lastId = 1 ;
		} else{
        $lastId++;
		}
        foreach ($dataItem as $k => $_data) {
            ModelRealEstate::newInstance()->insertPropertyType($lastId, $k, $_data['property_type']);
        }
    } else if(Params::getParam('plugin_action')=="type_edit") {
        $property_type = Params::getParam('property_type');
        foreach($property_type as $k => $v) {
            foreach($v as $kj => $vj) {
                ModelRealEstate::newInstance()->replacePropertyType($k, $kj, $vj);
            }
        }
    }
}
?>

<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
    <div style="padding: 20px;">
        <div style="float: left; width: 50%;">
            <fieldset>
                <legend><?php _e('Property types', 'realestate_attributes'); ?></legend>
                    <form name="propertys_form" id="propertys_form" action="<?php echo osc_admin_base_url(true);?>" method="GET" enctype="multipart/form-data" >
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="realestate_attributes/conf.php" />
                    <input type="hidden" name="section" value="types" />
                    <input type="hidden" name="plugin_action" value="type_edit" />
                <div class="tabber">
                <?php $locales = osc_get_locales();
                    $property_type = ModelRealEstate::newInstance()->getPropertyTypes(false) ;
                    $data = array();
                    foreach ($property_type as $c) {
                        $data[$c['fk_c_locale_code']][] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name']);
                    }
                    $default = current($data);
                    if(is_array($default)) {
                    foreach($default as $d) {
                        $data['new'][] = array('pk_i_id' => $d['pk_i_id'], 's_name' => '');
                    }}
                ?>
                    <?php foreach($locales as $locale) {?>
                        <div class="tabbertab">
                            <h2><?php echo $locale['s_name']; ?></h2>
                                <ul>
                                <?php
                                    if(count($data)>0) {
                                        foreach(isset($data[$locale['pk_c_code']])?$data[$locale['pk_c_code']]:$data['new'] as $property_type) { ?>
                                            <li><input name="property_type[<?php echo  $property_type['pk_i_id'];?>][<?php echo  $locale['pk_c_code'];?>]" id="<?php echo $property_type['pk_i_id'];?>" type="text" value="<?php echo  $property_type['s_name'];?>" /> <a href="<?php echo osc_admin_base_url(true);?>?page=plugins&action=renderplugin&file=realestate_attributes/conf.php?plugin_action=type_delete&id=<?php echo  $property_type['pk_i_id'];?>" ><button type="button"><?php _e('Delete', 'realestate_attributes'); ?></button></a> </li>
                                        <?php };
                                    }; ?>
                                </ul>
                        </div>
                        <?php }; ?>
                        <button type="submit"><?php _e('Edit', 'realestate_attributes'); ?></button>
                    </form>
                </div>
            </fieldset>
        </div>
        <div style="float: left; width: 50%;">
            <fieldset>
                <legend><?php _e('Add new property types', 'realestate_attributes'); ?></legend>
                <form name="propertys_form" id="propertys_form" action="<?php echo osc_admin_base_url(true); ?>" method="GET" enctype="multipart/form-data" >
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="realestate_attributes/conf.php" />
                    <input type="hidden" name="plugin_action" value="type_add" />

                    <div class="tabber">
                    <?php $locales = osc_get_locales();
                        $data = [];
                        if(!isset($c) && !empty($property_type))
                        $data[$locale['pk_c_code']] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name']);
                    ?>
                    <?php foreach($locales as $locale) {?>
                        <div class="tabbertab">
                            <h2><?php echo $locale['s_name']; ?></h2>
                            <input name="<?php echo  $locale['pk_c_code'];?>#property_type" id="property_type" type="text" value="" />
                        </div>
                    <?php }; ?>
                    </div>
                    <button type="submit" ><?php _e('Add new', 'realestate_attributes'); ?></button>
                </form>
            </fieldset>
        </div>
        <div style="clear: both;"></div>										
    </div>
</div>
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
    <div style="padding: 20px;">
        <div style="float: left; width: 100%;">
            <fieldset style="border: 1px solid #ff0000;">
                <legend><?php _e('Warning', 'realestate_attributes'); ?></legend>
                <p>
                    <?php _e('Deleting property types may end in errors. Some of those property types could be attached to some actual items', 'realestate_attributes') ; ?>.
                </p>
            </fieldset>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
