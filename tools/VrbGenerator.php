<?php
/* VrbGenerator feature */

require_once(__DIR__ . "/../app/utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Constants
const IDENTATION = "   ";
const BREAK_LINE = "\n";

// Http
$table = HttpUtil::getNotEmpty("table");
$tableDataRs = null;
if($table != null) {
    $sql = "DESC `$table`";
    $tableDataRs = DatabaseUtil::executeSql($sql);
    $tableData = [];
    while($row = DatabaseUtil::fetchData($tableDataRs)) {
        array_push($tableData, [
            "field" => $row["Field"],
            "primary" => $row["Key"] == "PRI"
        ]);
        $repository = generateRepository($table, $tableData);
        $action = generateAction($table, $tableData);
        $validator = generateValidator($table, $tableData);
        $formPage = generateFormPage($table, $tableData);
        $listPage = generateListPage($table, $tableData);
    }
}

$sql = "SHOW TABLES";
$showTablesRs = DatabaseUtil::executeSql($sql);
?>
<html>
    <head>
        <?php
        HtmlUtil::title("VrbGenerator");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
        ?>
        <style>
            .code {
                font-family: monospace;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header>
            <nav class="navbar translucent z-depth-0">
                <div class="container">
                    <a class="brand-logo light">VrbGenerator</a>
                </div>
            </nav>  
        </header>
        
        <!-- Main -->
        <main>
            
            <!-- CRUD -->
            <div class="container">
                <h5 class="light white-text">Database Table</h5>
                <div class="card">
                    <div class="card-content">
                        <form action="" method="GET">
                        Select the table
                        <select name="table" class="browser-default">
                            <?php while($row = DatabaseUtil::fetchDataAsArray($showTablesRs)) { ?>
                            <option value="<?=$row[0]?>"><?=$row[0]?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <button class="btn black">Generate!</button>
                        </form>
                    </div>
                </div>
                
                <?php if($tableDataRs != null) { ?>
                    <h5 class="light white-text"><?=camelCase($table, true)?>Repository.php</h5>
                    <div class="card">
                        <div class="card-content">
                            <textarea id="repositoryTextarea" class="code browser-default" style="height: 300px!important;"><?=$repository?></textarea>
                        </div>
                    </div>
                    
                    <h5 class="light white-text"><?=camelCase($table, true)?>Action.php</h5>
                    <div class="card">
                        <div class="card-content">
                            <textarea id="actionTextarea" class="code browser-default" style="height: 300px!important;"><?=$action?></textarea>
                        </div>
                    </div>
                    
                    <h5 class="light white-text"><?=camelCase($table, true)?>Validator.php</h5>
                    <div class="card">
                        <div class="card-content">
                            <textarea id="validatorTextarea" class="code browser-default" style="height: 300px!important;"><?=$validator?></textarea>
                        </div>
                    </div>
                    
                    <h5 class="light white-text"><?=camelCase($table, true)?>ListPage.php</h5>
                    <div class="card">
                        <div class="card-content">
                            <textarea id="listTextarea" class="code browser-default" style="height: 300px!important;"><?=$listPage?></textarea>
                        </div>
                    </div>
                    
                    <h5 class="light white-text"><?=camelCase($table, true)?>FormPage.php</h5>
                    <div class="card">
                        <div class="card-content">
                            <textarea id="formTextarea" class="code browser-default" style="height: 300px!important;"><?=$formPage?></textarea>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
            <!-- Component -->
        </main>
        
        <!-- Footer -->
        <footer></footer>
    </body>
    <?php 
    CodeMirrorStaticComponent::create("repositoryTextarea", "php", "dracula");
    CodeMirrorStaticComponent::create("actionTextarea", "php", "dracula");
    CodeMirrorStaticComponent::create("validatorTextarea", "php", "dracula");
    CodeMirrorStaticComponent::create("listTextarea", "php", "dracula");
    CodeMirrorStaticComponent::create("formTextarea", "php", "dracula");
    ?>
    <script>
        $(document).ready(function () {
            
        });
    </script>
</html>
<?php
/**
 * Generates repository
 * @param type $table
 * @param type $tableData
 */
function generateRepository($table, $tableData) {
    $repository  = append("<?php");
    $repository .= getImportCode();
    $repository .= append();
    $repository .= append("class " . camelCase($table, true) . "Repository {");
    $repository .= append();
    
    // Find all
    $repository .= append("public static function findAll() {", 1);
    $repository .= append("\$sql = \"SELECT " . listFields($tableData, ", ", "", false, false, "`") . " FROM `$table`\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2); 
    $repository .= append("}", 1);
    
    // Find all active
    $repository .= append();
    $repository .= append("public static function findAllActive() {", 1);
    $repository .= append("\$sql = \"SELECT " . listFields($tableData, ", ", "", false, false, "`") . " FROM `$table` WHERE `active` = '1'\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2); 
    $repository .= append("}", 1);
    
    // Find by id
    $repository .= append();
    $repository .= append("public static function findById(\$" . camelCase(getPrimaryKey($tableData)) . ") {", 1);
    $repository .= append("\$sql = \"SELECT " . listFields($tableData, ", ", "", false, false, "`") . " FROM `$table` WHERE `" . getPrimaryKey($tableData) . "` = '\$". camelCase(getPrimaryKey($tableData)) ."'\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("}", 1);
    
    // Insert
    $repository .= append();
    $repository .= append("public static function insert(" .listFields($tableData, ", ", "\$", true, false, "") . ") {", 1);
    $repository .= append("\$sql = \"INSERT INTO `$table` (" . listFields($tableData, ", ", "", false, false, "`") . ") VALUES (" . listFields($tableData, ", ", "\$", true, false, "`") . ")\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("}", 1);
    
    // Update
    $repository .= append();
    $repository .= append("public static function update(" .listFields($tableData, ", ", "\$", true, false, "") . ") {", 1);
    $repository .= append("\$sql = \"UPDATE `$table` SET ", 2, false);
    $comma = "";
    foreach ($tableData as $value) {
        if($value["primary"]) {
            continue;
        }
        $repository .= $comma . "`" . $value["field"] . "` = '\$" . camelCase($value["field"]) . "'";
        $comma = ", ";
    }
    $repository .= append(" WHERE `" . getPrimaryKey($tableData) . "` = '\$" . camelCase(getPrimaryKey($tableData)) . "'\";");
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("}", 1);
    
    // Delete
    $repository .= append();
    $repository .= append("public static function delete(\$" . camelCase(getPrimaryKey($tableData)) . ") {", 1);
    $repository .= append("\$sql = \"DELETE FROM `$table` WHERE `" . getPrimaryKey($tableData) . "` = '\$" . camelCase(getPrimaryKey($tableData)) . "'\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("}", 1);
    
    // Inactivate
    $repository .= append();
    $repository .= append("public static function inactivate(\$" . camelCase(getPrimaryKey($tableData)) . ") {", 1);
    $repository .= append("\$sql = \"UPDATE `$table` SET `active` = 0 WHERE `" . getPrimaryKey($tableData) . "` = '\$" . camelCase(getPrimaryKey($tableData)) . "'\";", 2);
    $repository .= append("return DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("}", 1);
    
    // Is record owned by user
    $repository .= append();
    $repository .= append("public static function isRecordOwnedByUser(\$" . camelCase(getPrimaryKey($tableData)) . ", \$idUser) {", 1);
    $repository .= append("\$sql = \"SELECT `" . getPrimaryKey($tableData) . "` FROM `$table` WHERE `" . getPrimaryKey($tableData) . "` = '\$" . camelCase(getPrimaryKey($tableData)) . "' AND `id_user` = '\$idUser'\";", 2);
    $repository .= append("\$rs = DatabaseUtil::executeSql(\$sql);", 2);
    $repository .= append("return DatabaseUtil::getNumRows(\$rs) > 0;", 2);
    $repository .= append("}", 1);
    
    
    $repository .= append();
    $repository .= append("}");
    return $repository;
}

/**
 * Generate action
 * @param type $table
 * @param type $tableData
 */
function generateAction($table, $tableData) {
    $resourceName = camelCase($table, true);
    $repositoryName = $resourceName . "Repository";
    $pageName = $resourceName . "Page";
    $validatorName = $resourceName . "Validator";
    
    $action  = append("<?php");
    $action .= getImportCode(); 
    $action .= append();
    $action .= append("// Event");
    $action .= append("EventUtil::action();");
    $action .= append();
    $action .= append("// Security");
    $action .= append("SecurityUtil::validateLogin();");
    $action .= append();
    $action .= append("// Http");
    foreach ($tableData as $data) {
        $varName = "\$" . camelCase($data["field"]);
        $action .= append($varName . " = HttpUtil::post(\"" . camelCase($data["field"]) . "\");");
        if($data["primary"]) {
            $action .= append("if($varName == null) {");
            $action .= append("$varName = HttpUtil::get(\"" . camelCase($data["field"]) . "\");", 1);
            $action .= append("}");
        }
    }
    $action .= append("\$action = HttpUtil::get(\"action\");");
    $action .= append();
    $action .= append("// Owner validation");
    $idField = "\$" . camelCase(getPrimaryKey($tableData));
    $action .= append("\$idUser = SessionUtil::get(SessionEnum::USER_ID);");
    $action .= append("if($idField != null && !$repositoryName::isRecordOwnedByUser($idField, \$idUser)) {");
    $action .= append("SecurityUtil::unauthorized();", 1);
    $action .= append("}");
    $action .= append();
    $action .= append("// Data validation");
    $action .= append("if(in_array(\$action, [ActionEnum::INSERT, ActionEnum::UPDATE])) {");
    $action .= append("$validatorName::validate(" . listFields($tableData, ", ") . ");", 1);
    $action .= append("}");
    $action .= append();
    $action .= append("// Action");
    $action .= append("if(\$action == ActionEnum::INSERT) {");
    $action .= append("$repositoryName::insert(" . listFields($tableData, ", ") . ");", 1);
    $action .= append("} else if(\$action == ActionEnum::UPDATE) {");
    $action .= append("$repositoryName::update(" . listFields($tableData, ", ") . ");", 1);
    $action .= append("} else if(\$action == ActionEnum::DELETE) {");
    $action .= append("$repositoryName::delete(\$" . camelCase(getPrimaryKey($tableData)) . ");", 1);
    $action .= append("} else if(\$action == ActionEnum::INACTIVATE) {");
    $action .= append("$repositoryName::inactivate(\$" . camelCase(getPrimaryKey($tableData)) . ");", 1);
    $action .= append("}");
    $action .= append();
    $action .= append("// Redirect");
    $action .= append("UrlUtil::redirectToPage(\"$pageName.php\", StatusEnum::SUCCESS);");
    return $action;
}

/**
 * Generate validator
 * @param type $table
 * @param type $tableData
 */
function generateValidator($table, $tableData) {
    $validator = append("<?php");
    $validator .= getImportCode();
    $validator .= append();
    $validator .= append("class " . camelCase($table, true) . "Validator {");
    $validator .= append();
    
    // Insert validator
    $validator .= append("public static function validate(" . listFields($tableData, ", ") . ") {", 1);
    foreach($tableData as $data) {
        $validator .= append("if(\$" . camelCase($data["field"]) . " == null) {", 2);
        $validator .= append("self::invalidate(\"The field " . camelCase($data["field"]) . " must be set!\")", 3);
        $validator .= append("}", 2);
    }
    $validator .= append("}", 1);
    
    return $validator;
}

/**
 * Generate form Page
 * @param type $table
 * @param type $tableData
 */
function generateFormPage($table, $tableData) {
    $resourceName = camelCase($table, true);
    $actionName = $resourceName . "Action";
    $repositoryName = $resourceName . "Repository";
    $formName = $resourceName . "FormPage";
    $formPage = "";
    
    foreach($tableData as $data) {
        $formPage .= append(camelCase($data["field"], true) . ":", 9);
        $formPage .= append("<input type=\"text\" name=\"" . camelCase($data["field"]) . "\" placeholder=\"" . camelCase($data["field"]) . "\" value=\"<?=\$data[\"" . $data["field"] . "\"] ?? \"\"?>\" />", 9);
    }
    
    $template = file_get_contents(__DIR__ . "/resources/FormTemplate.txt");
    $template = str_replace("[CONTENT]", $formPage, $template);
    $template = str_replace("[ACTION_NAME]", $actionName, $template);
    $template = str_replace("[REPOSITORY_NAME]", $repositoryName, $template);
    $template = str_replace("[PAGE_TITLE]", $formName, $template);
    
    return $template;
}

/**
 * Generate list Page
 * @param type $table
 * @param type $tableData
 */
function generateListPage($table, $tableData) {
    $resourceName = camelCase($table, true);
    $actionName = $resourceName . "Action";
    $repositoryName = $resourceName . "Repository";
    $listName = $resourceName . "ListPage";
    $formName = $resourceName . "FormPage";
    
    // Header
    $header = "";
    foreach($tableData as $data) {
        $header .= append("<th>" . camelCase($data["field"], true) . "</th>", 12);
    }
    $header .= append("<th>Actions</th>", 12);
    
    // Body
    $body = "";
    foreach($tableData as $data) {
        $body .= append("<td><?=\$row[\"" . $data["field"] . "\"]?></td>", 13);
    }
    $body .= append("<td>", 13);
    $body .= append("<a href=\"<?=UrlUtil::linkToPage(\"" . $formName . "\")?>?id=<?=\$row[\"" . getPrimaryKey($tableData) . "\"]?>\">Update</a>", 14);
    $body .= append("/ <a href=\"<?=HtmlUtil::voidHref()?>\" onclick=\"inactivate(<?=\$row[\"" . getPrimaryKey($tableData) . "\"]?>)\">Inactivate</a>", 14);
    $body .= append("</td>", 13);
    
    $template = file_get_contents(__DIR__ . "/resources/ListTemplate.txt");
    $template = str_replace("[HEADER]", $header, $template);
    $template = str_replace("[BODY]", $body, $template);
    $template = str_replace("[REPOSITORY_NAME]", $repositoryName, $template);
    $template = str_replace("[PAGE_TITLE]", $listName, $template);
    $template = str_replace("[FORM_PAGE]", $formName, $template);
    $template = str_replace("[ACTION_NAME]", $actionName, $template);
    
    return $template;
}

/**
 * Return text with break line and identation
 * @param type $text
 * @param type $identationSize
 */
function append($text = "", $identationSize = 0, $breakLine = true) {
    $result = "";
    for($i = 0; $i < $identationSize; $i++) {
        $result .= IDENTATION; 
    }
    $result .= $text;
    if($breakLine) {
        $result .= BREAK_LINE;
    }
    return $result;
}

/**
 * List all fields in a string
 * @param type $tableData
 * @param type $separator
 * @param type $camelCase
 * @param type $capitalize
 * @return type
 */
function listFields($tableData, $separator, $prefix = "\$", $camelCase = true, $capitalize = false, $surround = "", $withoutPrimarykey = false) {
    $fields = "";
    $sep = "";
    foreach ($tableData as $value) {
        if($withoutPrimarykey && $value["primary"]) {
            continue;
        }
        $fields .= $sep;
        $fieldName = $value["field"];
        if($camelCase) {
            $fieldName = camelCase($fieldName, $capitalize);
        }
        $fields .= $surround . $prefix . $fieldName . $surround;
        $sep = $separator;
    }
    return $fields;
}

/**
 * Get primary key field
 * @param type $tableData
 * @return type
 */
function getPrimaryKey($tableData) {
    foreach ($tableData as $value) {
        if($value["primary"]) {
            $field = $value["field"];
            return $field;
        }
    }
    return null;
}

/**
 * Camel case
 * @param type $text
 * @param type $capitalize
 * @return type
 */
function camelCase($text, $capitalize = false) {
    $result = str_replace(' ', '', ucwords(str_replace('_', ' ', $text)));
    if(!$capitalize) {
        $result[0] = strtolower($result[0]);
    }
    return $result;
}

/**
 * Get import code
 * @return type
 */
function getImportCode() {
    return "require_once(__DIR__ . \"/../utils/ImportUtil.php\");" . BREAK_LINE . "ImportUtil::importPhpModules();" . BREAK_LINE;
}