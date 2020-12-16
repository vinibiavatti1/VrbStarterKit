<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Login");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
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
                    <form action="<?= UrlUtil::addBaseUrl("/app/actions/LoginAction.php") ?>" method="POST">
                        <h5 class="light white-text">Login</h5>
                        <div class="card">
                            <div class="card-content">
                                E-mail
                                <input type="email" class="form-control" id="email" placeholder="Put your e-mail" name="email" required="" value="admin@admin.com">
                                Password
                                <input type="password" class="form-control" id="password" placeholder="Put your password" name="password" required="" value="admin">
                                Idiom
                                <select name="idiom" class="browser-default" style="margin-bottom: 10px">
                                    <?php 
                                        $enum = new ReflectionClass(IdiomEnum);
                                        foreach($enum->getConstants() as $key => $value) {
                                            ?><option value="<?=$value["code"]?>"><?=$value["description"]?></option><?php
                                        } 
                                    ?>
                                </select>
                                <button type="submit" class="btn black">Login</button>
                                <a href="<?= UrlUtil::linkToPage("HomePage") ?>" class="btn red">Back</a>
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