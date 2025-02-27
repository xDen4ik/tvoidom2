<?php if (!defined('OC_ADMIN')) exit('Direct access is not allowed.');
/*
 * Copyright 2014 Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

osc_enqueue_script('jquery-validate');
osc_enqueue_script('php-date');


// cateogry js
$categories = Category::newInstance()->toTree();

$new_item = __get('new_item');
function customText($return = 'title')
{
    $new_item = __get('new_item');
    $text = array();
    if ($new_item) {
        $text['title']    = __('Listing');
        $text['subtitle'] = __('Add listing');
        $text['button']   = __('Add listing');
    } else {
        $text['title']    = __('Listing');
        $text['subtitle'] = __('Edit listing');
        $text['button']   = __('Update listing');
    }
    return $text[$return];
}

if ($new_item) {
    $options = array(0, 1, 3, 5, 7, 10, 15, 30);
} else {
    $options = array(-1, 0, 1, 3, 5, 7, 10, 15, 30);
}

function customPageHeader()
{ ?>
    <h1><?php echo customText('title'); ?></h1>
<?php
}
osc_add_hook('admin_page_header', 'customPageHeader');

function customPageTitle($string)
{
    return sprintf('%s &raquo; %s', customText('subtitle'), $string);
}
osc_add_filter('admin_title', 'customPageTitle');

//customize Head
function customHead()
{
?>
    <script type="text/javascript">
        document.write('<style type="text/css"> .tabber{ display:none; } </style>');
        $(document).ready(function() {
            $('input[name="user"]').attr("autocomplete", "off");
            $('#user,#fUser').autocomplete({
                source: "<?php echo osc_admin_base_url(true); ?>?page=ajax&action=userajax",
                minLength: 0,
                select: function(event, ui) {
                    if (ui.item.id == '') {
                        $("#contact_info").show();
                        return false;
                    }
                    $('#userId').val(ui.item.id);
                    $('#fUserId').val(ui.item.id);
                    $("#contact_info").hide();
                }
            });

            $('.ui-autocomplete').css('zIndex', 10000);

            <?php if (osc_locale_thousands_sep() != '' || osc_locale_dec_point() != '') { ?>
                $("#price").on("blur", function(event) {
                    var price = $("#price").prop("value");
                    <?php if (osc_locale_thousands_sep() != '') { ?>
                        while (price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>') != -1) {
                            price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
                        }
                    <?php }; ?>
                    <?php if (osc_locale_dec_point() != '') { ?>
                        var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point()) ?>');
                        if (tmp.length > 2) {
                            price = tmp[0] + '<?php echo osc_esc_js(osc_locale_dec_point()) ?>' + tmp[1];
                        }
                    <?php }; ?>
                    $("#price").prop("value", price);

                });
            <?php } ?>

            $('#update_expiration').change(function() {
                if ($(this).attr("checked")) {
                    $('#dt_expiration').prop('value', '');
                    $('div.update_expiration').show();
                } else {
                    $('#dt_expiration').prop('value', '-1');
                    $('div.update_expiration').hide();
                }
            });

            $('body').on("created", '[name^="select_"]', function(evt) {
                selectUi($(this));
            });

        });
    </script>
    <?php ItemForm::location_javascript_new('admin'); ?>
    <?php if (osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
<?php
}
osc_add_hook('admin_header', 'customHead', 10);

$new_item   = __get('new_item');
$actions    = __get('actions');

osc_add_filter('render-wrapper', 'render_offset');
function render_offset()
{
    return 'row-offset';
}
osc_current_admin_theme_path('parts/header.php'); ?>
<div id="pretty-form">
    <div class="grid-row no-bottom-margin">
        <div class="row-wrapper">
            <h2 class="render-title"><?php echo customText('subtitle'); ?> <span style="font-size: small;"><a href="<?php echo osc_item_url(); ?>"><?php _e('View listing on front'); ?></a></span></h2>
        </div>
    </div>
    <div class="grid-row no-bottom-margin float-right">
        <div class="row-wrapper">
            <?php if (!$new_item) { ?>
                <ul id="item-action-list">
                    <?php foreach ($actions as $aux) { ?>
                        <li>
                            <?php echo $aux; ?>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <div class="grid-row grid-100">
        <div class="row-wrapper">
            <div id="item-form">
                <ul id="error_list"></ul>
                <?php printLocaleTabs(); ?>
                <form action="<?php echo osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data" name="item">
                    <input type="hidden" name="page" value="items" />
                    <?php if ($new_item) { ?>
                        <input type="hidden" name="action" value="post_item" />
                    <?php } else { ?>
                        <input type="hidden" name="action" value="item_edit_post" />
                        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                        <input type="hidden" name="secret" value="<?php echo osc_item_secret(); ?>" />
                    <?php } ?>
                    <div id="left-side">
                        <?php printLocaleTitle(osc_get_locales()); ?>
                        <div class="category">
                            <label><?php _e('Category'); ?></label>
                            <?php ItemForm::category_multiple_selects(); ?>
                        </div>
                        <div class="input-description-wide">
                            <?php printLocaleDescription(osc_get_locales()); ?>
                        </div>
                        <br>

                        <div id="map" class="map" style="height: 400px;">
                        </div>

                        <?php if (osc_price_enabled_at_items()) { ?>
                            <div>
                                <label><?php _e('Price'); ?></label>
                                <?php ItemForm::price_input_text(); ?>
                                <span class="input-currency"><?php ItemForm::currency_select(); ?></span>
                            </div>
                        <?php } ?>

                        <?php if (osc_images_enabled_at_items()) { ?>
                            <div class="photo_container">
                                <label><?php _e('Photos'); ?></label>
                                <?php ItemForm::photos(); ?>
                                <div id="photos">
                                    <?php if (osc_max_images_per_item() == 0 || (osc_max_images_per_item() != 0 && osc_count_item_resources() < osc_max_images_per_item())) { ?>
                                        <div>
                                            <input type="file" name="photos[]" /> (<?php _e('optional'); ?>)
                                        </div>
                                    <?php } ?>
                                </div>
                                <p><a href="#" onclick="addNewPhoto(); return false;"><?php _e('Add new photo'); ?></a></p>
                            </div>
                        <?php } ?>
                        <?php if ($new_item) {
                            ItemForm::plugin_post_item();
                        } else {
                            ItemForm::plugin_edit_item();
                        }
                        ?>
                    </div>
                    <div id="right-side">
                        <div class="well ui-rounded-corners">
                            <h3 class="label"><?php _e('User'); ?></h3>
                            <div id="contact_info">
                                <div class="input-has-placeholder input-separate-top">
                                    <label><?php _e('Name'); ?></label>
                                    <?php ItemForm::contact_name_text(); ?>
                                </div>
                                <div class="input-has-placeholder input-separate-top">
                                    <label><?php _e('E-mail'); ?></label>
                                    <?php ItemForm::contact_email_text(); ?>
                                </div>
                                <?php if (!$new_item) { ?>
                                    <div class="input-has-placeholder input-separate-top">
                                        <label><?php _e('Ip Address'); ?></label>
                                        <input id="ipAddress" type="text" name="ipAddress" value="<?php echo osc_item_ip(); ?>" class="valid" readonly="readonly">
                                    </div>
                                <?php } ?>
                                <div class="input-separate-top">
                                    <label><?php ItemForm::show_email_checkbox(); ?><?php _e('Show e-mail'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="well ui-rounded-corners input-separate-top">
                            <h3 class="label"><?php _e('Location'); ?></h3>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Country'); ?></label>
                                <?php ItemForm::country_select(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Region'); ?></label>
                                <?php ItemForm::region_text(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('City'); ?></label>
                                <?php ItemForm::city_text(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('City area'); ?></label>
                                <?php ItemForm::city_area_text(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Zip code'); ?></label>
                                <?php ItemForm::zip_text(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Address'); ?></label>
                                <?php ItemForm::address_text(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Координаты'); ?></label>
                                <?php ItemForm::d_coord_long(); ?>
                            </div>
                            <div class="input-has-placeholder input-separate-top">
                                <label><?php _e('Координаты'); ?></label>
                                <?php ItemForm::d_coord_lat(); ?>
                            </div>
                        </div>

                        <div class="well ui-rounded-corners input-separate-top">
                            <h3 class="label"><?php _e('Expiration'); ?></h3>
                            <?php if ($new_item) { ?>
                                <div class="input-has-placeholder input-separate-top">
                                    <?php ItemForm::expiration_input('add'); ?>
                                </div>
                                <label><?php _e('It could be an integer (days from original publishing date it will be expired, 0 to never expire) or a date in the format "yyyy-mm-dd hh:mm:ss"'); ?></label>
                            <?php } else if (!$new_item) { ?>
                                <div class="input-separate-top">
                                    <label><input type="checkbox" id="update_expiration" name="update_expiration" style="width: inherit!important;" /> <?php _e('Update expiration?'); ?></label>
                                    <div class="hide update_expiration">
                                        <div class="input-has-placeholder input-separate-top">
                                            <?php ItemForm::expiration_input('edit'); ?>
                                        </div>
                                        <label><?php _e('It could be an integer (days from original publishing date it will be expired, 0 to never expire) or a date in the format "yyyy-mm-dd hh:mm:ss"'); ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="clear"></div>
                    <div class="form-actions">
                        <?php if (!$new_item) { ?>
                            <a href="javascript:history.go(-1)" class="btn"><?php _e('Cancel'); ?></a>
                        <?php } ?>
                        <input type="submit" value="<?php echo osc_esc_html(customText('button')); ?>" class="btn btn-submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://api-maps.yandex.ru/2.1/?apikey=fcec40dd-9eaf-41db-bda3-9b3f4023eadd&lang=ru-RU" type="text/javascript"></script>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        x1 = document.getElementById('d_coord_lat').value;
        x2 = document.getElementById('d_coord_long').value;
        ymaps.ready(init);
        //�������� �����
        function init() {
            var myPlacemark;
            var geolocation = ymaps.geolocation,
                myMap = new ymaps.Map('map', {
                    zoom: 10,
                    center: [x2, x1],
                    controls: [],
                }, {
                    searchControlProvider: 'yandex#search',
                    yandexMapDisablePoiInteractivity: true,
                    suppressMapOpenBlock: true,
                });

            var searchControl = new ymaps.control.SearchControl({
                options: {
                    provider: 'yandex#map',
                    noPlacemark: true,
                    placeholderContent: 'Поиск',
                },

            });
            searchControl.events.add('load', function(event) {
                if (!event.get('skip') && searchControl.getResultsCount()) {
                    searchControl.showResult(0);
                }
            });

            geolocation.get({
                provider: 'yandex',
                mapStateAutoApply: true
            }).then(function(result) {
                userCoodinates = result.geoObjects.get(0).geometry.getCoordinates();
                result.geoObjects.options.set('preset', 'islands#redCircleIcon');
                result.geoObjects.get(0).properties.set({
                    balloonContentBody: 'Мое местоположение',
                });
                myMap.geoObjects.add(result.geoObjects);
            });


            myMap.controls.add('zoomControl');
            myMap.controls.add('geolocationControl');
            myMap.controls.add(searchControl);

            searchControl.events.add('submit', function() {
                document.getElementById('address').value = searchControl.getRequestString();
                // document.getElementById('address_text').innerHTML = searchControl.getRequestString();
            }, this);
            /*    $("div.input-has-placeholder.input-separate-top").find("label").css({
                   "display": "none"
               }); */

            searchControl.events.add('resultselect', function(e) {
                var index = e.get('index');
                searchControl.getResult(index).then(function(res) {
                    var coords = res.geometry.getCoordinates();
                    const x = coords.split(",");
                    document.getElementById('d_coord_lat').value = x[1];
                    document.getElementById('d_coord_long').value = x[0];

                    document.getElementById('city').value = res.geometry.getLocalities();

                    if (myPlacemark) {
                        myPlacemark.geometry.setCoordinates(coords);
                    } else {
                        myPlacemark = createPlacemark(coords);
                        myMap.geoObjects.add(myPlacemark);
                        myPlacemark.events.add('dragend', function() {
                            getAddress(coords);
                        });
                        document.getElementById('d_coord_lat').value = x[1];
                        document.getElementById('d_coord_long').value = x[0];

                        $("div.input-has-placeholder.input-separate-top").find("label").css({
                            "display": "none"
                        });
                        getAddress(coords);
                    }
                });
            })


            myMap.events.add('click', function(e) {
                var coords = e.get('coords');
                document.getElementById('d_coord_lat').value = coords[1];
                document.getElementById('d_coord_long').value = coords[0];
                ymaps.geocode('��� ��������������').then(function(res) {
                    ymaps.geocode('���������� �����').then(function(res) {});
                });
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);

                }
                searchControl.hideResult();
                getAddress(coords);
            });


            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'Поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            function getAddress(coords) {
                myPlacemark.properties.set('iconCaption', 'Поиск...');
                ymaps.geocode(coords).then(function(res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    var region = firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.AddressDetails.Country.AdministrativeArea.AdministrativeAreaName');
                    var cityArea = firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.Address.Components');
                    $.each(cityArea, function(index, value) {
                        if (value.kind == "area") {
                            cityArea = value.name;
                        } else if (value.kind == "province") {
                            cityArea = value.name;
                        } else {}
                    });
                    myPlacemark.properties
                        .set({
                            iconCaption: [
                                firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                            ].filter(Boolean).join(', '),
                        });
                    document.getElementById('address').value = firstGeoObject.getAddressLine();
                    document.getElementById('d_coord_lat').value = coords[1];
                    document.getElementById('d_coord_long').value = coords[0];
                    city = firstGeoObject.getLocalities()[0];
                    if (city != undefined) {
                        document.getElementById('city').value = city;
                        $('#cityId').val('');
                    }
                    document.getElementById('region').value = region;
                    if (cityArea != undefined) {
                        document.getElementById('cityArea').value = cityArea;
                    }
                    $("div.input-has-placeholder.input-separate-top").find("label").css({
                        "display": "none"
                    });
                });
            }


             if (x1.length > 2 && x2.length > 2) {
                 var myPlacemark = new ymaps.Placemark(
                     [x2, x1]
                 );
                 myMap.geoObjects.add(myPlacemark);

                 function sayHi() {
                     myMap.setCenter([x2, x1], 10, {
                         checkZoomRange: true
                     });
                 }
                 setTimeout(sayHi, 1000);
             }
        }
    });
</script>
<?php osc_current_admin_theme_path('parts/footer.php'); ?>