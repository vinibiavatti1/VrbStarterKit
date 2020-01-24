<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Basic chart component that uses Chartjs lib
 */
class BasicChartComponent extends Component {

    const BAR_TYPE = "bar";
    const LINE_TYPE = "line";

    private $chartType;
    private $data;
    private $width;
    private $height;
    private $id;

    public function __construct($id, $chartType, $data, $width = "50%", $height = "400px") {
        $this->chartType = $chartType;
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
        $this->id = $id;
    }

    public function html() {
        ?>
        <div style="width:<?= $this->width ?>; height:<?= $this->height ?>">
            <canvas id="<?= $this->id ?>"></canvas>
        </div>

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
                var ctx = document.getElementById('<?= $this->id ?>').getContext('2d');
                var chart = new Chart(ctx, {
                    type: '<?= $this->chartType ?>',
                    data: <?= json_encode($this->data) ?>,
                    options: {
                        "responsive": true,
                        "maintainAspectRatio": false
                    }
                });
            });
        </script>    
        <?php
    }

}
