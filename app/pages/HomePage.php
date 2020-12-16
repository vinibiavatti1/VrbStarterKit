<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Home");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
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
                            <li><a href="<?= UrlUtil::linkToPage("HomePage") ?>">English</a></li>
                            <li><a href="<?= UrlUtil::linkToPage("HomePage") ?>?idiom=pt_BR">Portuguese</a></li>
                            <li><a href="<?= UrlUtil::linkToPage("LoginPage") ?>">Login</a></li>
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
                    <h6 class="light center white-text"><?=__("Starter kit for PHP projects")?></h6>
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