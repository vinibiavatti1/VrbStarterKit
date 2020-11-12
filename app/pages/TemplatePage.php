<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Security
SecurityService::validateLogin(false);

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Template");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body>
        <!-- Header -->
        <header>
            <?php NavbarComponent::create(); ?>
        </header>
        
        <!-- Main -->
        <main>
            <div class="container">
                <h5 class="light white-text">Template</h5>
                <div class="card">
                    <div class="card-content">
                        Hello World!
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
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