<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

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
                <span style="font-size: 20px;"><?= Config::TITLE ?></span><br><br>
                User: <?= $this->user; ?>
            </li>
            <li class="sidenav-title">Main</li>
            <li><a href="<?= UrlService::linkToPage("AdminPage") ?>">Admin Page</a></li>
            <li><a href="<?= UrlService::linkToPage("DynamicListPage.php?id=example") ?>">Dynamic List Page</a></li>
            <li><a href="<?= UrlService::linkToPage("TemplatePage") ?>">Template Page</a></li>
            <li class="sidenav-title">Others</li>
            <li><a href="<?= UrlService::linkToAction("LogoutAction") ?>">Logout</a></li>
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
