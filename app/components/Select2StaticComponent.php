<?php

require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

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
