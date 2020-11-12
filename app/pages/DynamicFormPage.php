<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Security
SecurityService::validateLogin(false);

// Session
$user = SessionService::get(SessionEnum::USER_ID_KEY);

// Http
$id = HttpService::get("id");
$recordId = HttpService::get("recordId");

// Get form
if (!isset(DynamicFormConfig::configuration()[$id])) {
    ?>
    The form <?= $id ?> was not found!<br><br>
    <a href="javascript:history.back()">Back</a>
    <?php
    exit;
}
$form = DynamicFormConfig::configuration()[$id];
$table = $form["table"];

// Check is update and make sql to get data
$object = null;
$action = ActionEnum::INSERT;
if ($recordId != null) {
    $action = ActionEnum::UPDATE;
    $sql = "SELECT ";
    $comma = "";
    foreach ($form["fields"] as $key => $value) {
        $sql .= $comma . $key . " ";
        $comma = ",";
    }
    $sql .= "FROM " . $form["table"] . " ";
    $sql .= "WHERE id = $recordId";
    $objectRs = DatabaseService::executeQuery($sql);
    $object = DatabaseService::fetch($objectRs);
}
?>
<html>
    <head>
        <?php
        HtmlService::title("Dynamic Form");
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
                <form action="<?= UrlService::linkToAction("DynamicFormAction.php?id=$id&recordId=$recordId&action=$action&table=$table") ?>" method="POST">
                    <h5 class="light white-text">Actions</h5>
                    <div class="card">
                        <div class="card-content">
                            <button class="btn black">Submit</button>
                            <a href="<?= UrlService::linkToPage("DynamicListPage.php?id=$id") ?>" class="btn red">Cancel</a>
                        </div>
                    </div>

                    <h5 class="light white-text">Form</h5>
                    <div class="card">
                        <div class="card-content">
                            <?php
                            /* Form fields creation */
                            foreach ($form["fields"] as $key => $value) {
                                $name = $key;
                                $type = $value["type"] ?? "text";
                                $label = $value["label"] ?? $name;
                                $required = $value["required"] ?? false;
                                $placeholder = $value["placeholder"] ?? "";
                                $class = $value["class"] ?? "";
                                $config = $value["config"];
                                $value = "";
                                if ($object != null) {
                                    $value = $object[$key];
                                }

                                /* Print label */
                                ?><?= $label ?> <?= $required ? "<span class='required'>*</span>" : "" ?>:<?php
                                /* Create input */
                                if ($type == InputTypeEnum::TEXT) {
                                    ?>
                                    <input class="<?=$class?>" type="text" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::TEXTAREA) {
                                    ?>
                                    <textarea class="<?=$class?>" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> /><?= $value ?></textarea>
                                    <?php
                                } else if ($type == InputTypeEnum::NUMBER) {
                                    $min = $config["min"] ?? "0";
                                    $max = $config["max"] ?? "999999999";
                                    $step = $config["step"] ?? "1";
                                    ?>
                                    <input class="<?=$class?>" type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::SELECT) {
                                    $values = $config["values"] ?? [];
                                    ?>
                                    <select class="browser-default <?= $class ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?>>
                                        <?php foreach ($values as $valKey => $valValue) { ?>
                                            <option value="<?= $valKey ?>" <?= $value == $valValue ? "selected" : "" ?>><?= $valValue ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                } else if ($type == InputTypeEnum::SQL) {
                                    $sql = $config["sql"];
                                    $simulation = $config["simulation"] ?? false;
                                    $rs = [];
                                    if (!$simulation) {
                                        $rs = DatabaseService::executeQuery($sql);
                                    }
                                    ?>
                                    <select class="browser-default <?= $class ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?>>
                                        <?php while ($row = DatabaseService::fetch($rs)) { ?>
                                            <option value="<?= $row["value"] ?>" <?= $value == $row["value"] ? "selected" : "" ?>><?= $row["label"] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                } else if ($type == InputTypeEnum::DATE) {
                                    ?>
                                    <input class="<?=$class?>" type="date" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::DATETIME) {
                                    ?>
                                    <input class="<?=$class?>" type="datetime-local" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::EMAIL) {
                                    ?>
                                    <input class="<?=$class?>" type="email" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::PASSWORD) {
                                    ?>
                                    <input class="<?=$class?>" type="password" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::TIME) {
                                    ?>
                                    <input class="<?=$class?>" type="time" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                } else if ($type == InputTypeEnum::URL) {
                                    ?>
                                    <input class="<?=$class?>" type="url" placeholder="<?= $placeholder ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?> value="<?= $value ?>" />
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <!-- footer -->
        <footer> 
            <?php FooterStaticComponent::create() ?>
        </footer>
    </body>
    <?php
    Select2StaticComponent::create();
    ?>
    <script>
        $(document).ready(function () {
        });
    </script>
</html>