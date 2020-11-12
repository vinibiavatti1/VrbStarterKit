<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Connection error");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body>
        <div class="white-text">
            The application cannot connect to the database. Please, try again later.<br>
            <a href="<?= UrlService::addBaseUrl("app/pages/LoginPage.php") ?>">Try again</a>
        </div>
    </body>
</html>