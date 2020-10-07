<?php if (osc_get_preference('api_key', 'yandex_maps_pro') != '') { ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=<?php echo osc_get_preference('api_key', 'yandex_maps_pro'); ?>" type="text/javascript"></script>
<?php } else { ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<?php } ?>
<?php
$addr = array();
if (($item['d_coord_lat'] != '') && ($item['d_coord_lat'] != null)) {
    $addr[] = $item['d_coord_lat'];
}
if (($item['d_coord_long'] != '') && ($item['d_coord_long'] != null)) {
    $addr[] = $item['d_coord_long'];
}


?>
<script type="text/javascript">
    ymaps.ready(function() {
        ymaps.geocode('<?php echo $addr[1] . ',' . $addr[0]; ?>').then(
            function(res) {

                var myMap = new ymaps.Map("map", {
                    center: res.geoObjects.get(0).geometry.getCoordinates(),
                    zoom: 16,
                    controls: ['smallMapDefaultSet']
                });

                myPlacemark = new ymaps.Placemark(res.geoObjects.get(0).geometry.getCoordinates(), {
                    hintContent: '<?php echo $address; ?>',
                });

                myMap.geoObjects.add(myPlacemark);
            }
        );
    });
</script>
<div id="map" style="width: 100%; height:240px"></div>