<?php
require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event call
EventUtil::page();

// Chart data
$data1 = [
    "labels" => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    "datasets" => [[
    "label" => 'Data',
    "backgroundColor" => ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
    "borderColor" => ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
    "borderWidth" => 1,
    "data" => [rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10)]
        ]]
];
$data2 = [
    "labels" => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    "datasets" => [[
    "label" => 'Data',
    "backgroundColor" => ["rgba(0, 0, 0, 0.0)"],
    "borderColor" => ["rgb(255, 99, 132)"],
    "borderWidth" => 2,
    "data" => [rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10)]
        ]]
];
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Example Charts");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
        ?>
    </head>
    <body>
        <!-- Header -->
        <header>
            <?php NavbarComponent::create(); ?>
        </header>

        <!-- Main -->
        <main>
            <div class="container">
                <h5 class="light white-text">Template</h5>
                <div class="card">
                    <div class="card-content">
                        <?php
                        $chart1 = new BasicChartComponent("grafico_1", BasicChartComponent::BAR_TYPE, $data1);
                        $chart1->render();
                        $chart2 = new BasicChartComponent("grafico_2", BasicChartComponent::LINE_TYPE, $data2);
                        $chart2->render();
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <?php FooterStaticComponent::create() ?>
        </footer>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>