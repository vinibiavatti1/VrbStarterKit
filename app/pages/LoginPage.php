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
        <div>
            <div class="row">
                <div class="col s12 m8 l6 offset-l3 offset-m2">
                    <br>
                    <form action="<?= UrlService::addBaseUrl("/app/actions/LoginAction.php") ?>" method="POST">
                        <h5 class="light white-text">Login</h5>
                        <div class="card">
                            <div class="card-content">
                                E-mail
                                <input type="email" class="form-control" id="email" placeholder="Put your e-mail" name="email" required="" value="admin@admin.com">
                                Senha
                                <input type="password" class="form-control" id="password" placeholder="Put your password" name="password" required="" value="admin">
                                <button type="submit" class="btn black">Login</button>
                                <a href="<?= UrlService::linkToPage("HomePage") ?>" class="btn red">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
</html>