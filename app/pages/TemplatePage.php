<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Basic Template");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
        ?>
    </head>
    <body>
        <!-- Header -->
        <header></header>
        
        <!-- Main -->
        <main></main>
        
        <!-- Footer -->
        <footer></footer>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>