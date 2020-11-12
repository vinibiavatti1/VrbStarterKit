<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

class FooterStaticComponent extends StaticComponent {

    public static function create() {
        ?>
        <div class="footer translucent">
            <div class="container">
                Made with ♥ using VrbStarterKit!
                <a class="right" href="https://github.com/vinibiavatti1/VrbStarterKit">Github repository</a>
            </div>
        </div>
        <?php
    }

}
