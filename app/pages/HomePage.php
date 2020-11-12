<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Home");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body class="background-image">
        <!-- Header -->
        <header>
            <nav class="translucent z-depth-0">
                <div class="container">
                    <span class="brand-logo light"><?= Config::TITLE ?></span>
                    <div class="right">
                        <ul>
                            <li><a href="<?= UrlService::linkToPage("LoginPage") ?>">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main -->
        <main>
            <div class="container">
                <div style="margin-top: 200px">
                    <h3 class="light center white-text">VrbStarterKit</h3>
                    <hr>
                    <h6 class="light center white-text">Starter kit for PHP projects</h6>
                </div>
            </div>
        </main>
        
        <!-- footer -->
        <footer> 
            <?php FooterStaticComponent::create() ?>
        </footer>
    </body>
    <?php
    DataTableComponent::create();
    Select2StaticComponent::create();
    StatusComponent::create();
    ?>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>