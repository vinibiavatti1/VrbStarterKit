<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Login");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body>
        <?php 
        StatusComponent::create();
        ?>
        <div class="container">
            <div class="row">
                <div class="col col-sm-12 col-lg-4 offset-lg-4" style="margin-top: 100px">
                    <?php 
                        $loginComponent = new LoginComponent(UrlService::addBaseUrl("/app/actions/LoginAction.php"));
                        $loginComponent->render();
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>