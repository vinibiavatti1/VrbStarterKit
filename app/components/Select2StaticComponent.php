<?php

require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

class Select2StaticComponent extends StaticComponent {

    const SELECTOR = ".select2";

    public static function create() {
        ?>
        <script>
            $("<?= self::SELECTOR ?>").select2();
        </script>    
        <?php
    }
}
