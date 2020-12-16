<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Connection error");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
        ?>
    </head>
    <body>
        <div class="white-text">
            The application cannot connect to the database. Please, try again later.<br>
            <a href="<?= UrlUtil::addBaseUrl("app/pages/LoginPage.php") ?>">Try again</a>
        </div>
    </body>
</html>