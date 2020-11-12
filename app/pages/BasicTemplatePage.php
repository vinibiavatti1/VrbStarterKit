<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Basic Template");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
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