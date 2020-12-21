<?php
require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event call
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Example Maps");
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
                        <?php
                        $map = new GMapComponent("100%", "600px", -26.9160017, -49.0792243);
                        $map->addMarker(-26.9160017, -49.0792243);
                        $map->render();
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <?php FooterStaticComponent::create() ?>
        </footer>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>