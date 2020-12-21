<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

class GMapComponent extends Component {
    
    private $markers = [];
    private $lat;
    private $lng;
    private $width;
    private $height;
    private $zoom;

    public function __construct($width, $height, $lat, $lng, $zoom = 15) {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->width = $width;
        $this->height = $height;
        $this->zoom = $zoom;
    }

    public function addMarker($lat, $lng) {
        array_push($this->markers, ["lat" => $lat, "lng" => $lng]);
    }

    public function html() {
        if(!empty(Config::GMAP_API_KEY)) {
            ?>
            <div id="google-map" style="width: <?= $this->width ?>; height: <?= $this->height ?>"></div>
            <?php
        }
    }

    public function style() {
        ?>
        <style></style>    
        <?php
    }

    public function script() {
        if(empty(Config::GMAP_API_KEY)) {
            echo("You must configure the Google Maps API Key in config.php to use the GMapComponent");
        } else {
            ?>
            <script defer src="https://maps.googleapis.com/maps/api/js?key=<?=Config::GMAP_API_KEY?>&callback=initMap"></script>
            <script>
                function initMap() {
                    map = new google.maps.Map(document.getElementById('google-map'), {
                        center: {lat: <?=$this->lat?>, lng: <?=$this->lng?>},
                        zoom: <?= $this->zoom?>
                    });
                    <?php foreach ($this->markers as $marker) { ?>
                        new google.maps.Marker({
                            position: {lat: <?=$marker["lat"]?>, lng: <?=$marker["lng"]?>},
                            map
                        });
                    <?php } ?>
                }
            </script>    
            <?php
        }
    }

}
