<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Security
SecurityUtil::validateLogin(false);

// Session
$user = SessionUtil::get(SessionEnum::USER_ID);

// Http
$id = HttpUtil::get("id");
$recordId = HttpUtil::get("recordId");

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
    $objectRs = DatabaseUtil::executeSql($sql);
    $object = DatabaseUtil::fetchData($objectRs);
}
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Dynamic Form");
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
                <form action="<?= UrlUtil::linkToAction("DynamicFormAction.php?id=$id&recordId=$recordId&action=$action&table=$table") ?>" method="POST">
                    <h5 class="light white-text">Actions</h5>
                    <div class="card">
                        <div class="card-content">
                            <button class="btn black">Submit</button>
                            <a href="<?= UrlUtil::linkToPage("simpleforms/DynamicListPage.php?id=$id") ?>" class="btn red">Cancel</a>
                        </div>
                    </div>

                    <h5 class="light white-text">Form</h5>
                    <div class="card">
                        <div class="card-content">
                            <?php
                            /* Form fields creation */
                            foreach ($form["fields"] as $fieldKey => $fieldValue) {
                                $name = $fieldKey;
                                $type = $fieldValue["type"] ?? "text";
                                $label = $fieldValue["label"] ?? $name;
                                $required = $fieldValue["required"] ?? false;
                                $placeholder = $fieldValue["placeholder"] ?? "";
                                $class = $fieldValue["class"] ?? "";
                                $config = $fieldValue["config"];
                                $value = $fieldValue["default"] ?? "";
                                if ($object != null) {
                                    $value = $object[$fieldKey];
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
                                            <option value="<?= $valKey ?>" <?= $value == $valKey ? "selected" : "" ?>><?= $valValue ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                } else if ($type == InputTypeEnum::SQL) {
                                    $sql = $config["sql"];
                                    $simulation = $config["simulation"] ?? false;
                                    $rs = [];
                                    if (!$simulation) {
                                        $rs = DatabaseUtil::executeSql($sql);
                                    }
                                    ?>
                                    <select class="browser-default <?= $class ?>" name="<?= $name ?>" <?= $required ? "required" : "" ?>>
                                        <?php while ($row = DatabaseUtil::fetchData($rs)) { ?>
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