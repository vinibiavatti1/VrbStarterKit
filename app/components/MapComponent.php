<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Map component. This component uses the leaflet plugin to render the map with
 * OpenStreetMap
 */
class MapComponent extends Component {

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
        ?>
        <div id="leaflet-map" style="width: <?= $this->width ?>; height: <?= $this->height ?>"></div>
        <?php
    }

    public function style() {
        ?>
        <style></style>    
        <?php
    }

    public function script() {
        ?>
        <script>
            $(document).ready(function () {
                let map = L.map('leaflet-map').setView([<?= $this->lat ?>, <?= $this->lng ?>], <?= $this->zoom ?>);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                <?php foreach ($this->markers as $marker) { ?>
                    L.marker([<?= $marker["lat"] ?>, <?= $marker["lng"] ?>]).addTo(map);
                <?php } ?>
            });
        </script>    
        <?php
    }

}
