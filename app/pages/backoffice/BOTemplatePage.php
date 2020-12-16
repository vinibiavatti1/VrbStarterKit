<?php
require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Security
SecurityUtil::validateLogin(false);

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Template");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
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