<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

class CodeMirrorStaticComponent extends StaticComponent {

    public static function create($idTextarea, $mode, $theme) {
        ?>
        <script>
            textarea = document.getElementById("<?=$idTextarea?>");
            editor = CodeMirror.fromTextArea(textarea, {
                lineNumbers: true,
                mode:  "<?=$mode?>",
                theme: "<?=$theme?>"
            });
        </script>    
        <?php
    }
}
