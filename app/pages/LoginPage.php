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
                    <form action="<?= UrlService::addBaseUrl("/app/actions/LoginAction.php") ?>" method="POST">
                        <div class="login-panel shadow-sm card">
                            <div class="card-content">
                                <h5 class="light" style="margin-top: 0px">Login</h5>
                                <hr>
                                E-mail
                                <input type="email" class="form-control" id="email" placeholder="Insira seu e-mail" name="email" required="">
                                Senha
                                <input type="password" class="form-control" id="password" placeholder="Insira sua senha" name="password" required="">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>