<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

class NavbarComponent extends Component {
    
    private $user;
    
    public function __construct() {
        $this->user = "Default";
    }
    
    public function html() {
        ?>
        <!-- Navbar -->
        <nav class="navbar translucent z-depth-0">
            <div class="container">
                <a class="brand-logo light"><?= Config::TITLE ?></a>
            </div>
            <a href="#" data-target="sidenav" class="sidenav-trigger" style="display: inline-block"><i class="material-icons">menu</i></a>
        </nav>  

        <!-- Sidenav -->
        <ul class="sidenav" id="sidenav">
            <li class="sidenav-header black white-text light">
                <span style="font-size: 20px;">Backoffice</span><br><br>
                User: <?= $this->user; ?>
            </li>
            <li class="sidenav-title">Main</li>
            <li><a href="<?= UrlUtil::linkToPage("backoffice/BOHomePage") ?>">Home Page</a></li>
            <li><a href="<?= UrlUtil::linkToPage("backoffice/BOTemplatePage") ?>">Template Page</a></li>
            <li class="sidenav-title">Examples</li>
            <li><a href="<?= UrlUtil::linkToPage("backoffice/BOChartExamplePage") ?>">Chart (Chartjs)</a></li>
            <li><a href="<?= UrlUtil::linkToPage("backoffice/BOMapExamplePage") ?>">Map (Leaflet OSM)</a></li>
            <li><a href="<?= UrlUtil::linkToPage("backoffice/BOPdfExamplePage") ?>">Pdf (Dompdf)</a></li>
            <li class="sidenav-title">VrbSimpleForms</li>
            <li><a href="<?= UrlUtil::linkToPage("simpleforms/DynamicListPage.php?id=example") ?>">Dynamic List Page</a></li>
            <li><a href="<?= UrlUtil::linkToPage("simpleforms/DynamicFormPage.php?id=example") ?>">Dynamic Form Page</a></li>
            <li class="sidenav-title">Others</li>
            <li><a href="<?= UrlUtil::linkToAction("LogoutAction") ?>">Logout</a></li>
        </ul>
        <?php
    }

    public function script() {
        ?>
        <script>
            $(document).ready(function () {
                $('.sidenav').sidenav();
            });
        </script>
        <?php
    }

    public function style() {
    }
    
    public static function create() {
        $component = new NavbarComponent();
        $component->render();
    }
}
