<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 14.01.19
 * Time: 19:13
 */
?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2aeecb33-cd8c-4662-b7bf-9f211f9c4896" type="text/javascript"></script>

<div class="modal fade" id="map" role="dialog" style="z-index: 1060;">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <div id="yandex-map" style="width: 100%; height: 400px;">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        ymaps.ready(init);

        function init () {
            var myMap;

            $('body').on('click', '.showLocation', function (e){

                var lat = $(this).data('lat');
                var long = $(this).data('long');

                myMap = new ymaps.Map('yandex-map', {
                    center: [lat, long],
                    zoom : 15
                });

                var myGeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [lat, long]
                    }
                });

                myMap.geoObjects.add(myGeoObject);

                $('#map').modal({show:true});
            });

            $('#map .close').on('click', function(){
                myMap.destroy();
            });
        }
    });

</script>