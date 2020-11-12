<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

//Debug
const DEBUG = false;

// Security
SecurityService::validateLogin(false);

// Action event call
EventService::action();

// Get HTTP params
$id = HttpService::get("id");
$recordId = HttpService::get("recordId");
$action = HttpService::get("action");
$table = HttpService::get("table");
$data = $_POST;

// Check is update
if ($action == ActionEnum::UPDATE) {
    $sql = "UPDATE $table SET %s WHERE id = $recordId";
    $sets = "";
    $comma = "";
    foreach ($data as $key => $value) {
        $value = addslashes($value);
        $sets .= "$comma $key = '$value'";
        $comma = ",";
    }
    $sql = sprintf($sql, $sets);
} else if($action == ActionEnum::INSERT) {
    $sql = "INSERT INTO $table (%s) VALUES (%s)";
    $fields = "";
    $values = "";
    $comma = "";
    foreach ($data as $key => $value) {
        $value = addslashes($value);
        $fields .= "$comma $key";
        $values .= "$comma '$value'";
        $comma = ",";
    }
    $sql = sprintf($sql, $fields, $values);
} else if($action == ActionEnum::DELETE) {
    $sql = "UPDATE $table SET active = 0 WHERE id = $recordId";
}
if (DEBUG) {
    echo $sql;
} else {
    DatabaseService::executeUpdate($sql);
    UrlService::redirectToPage("DynamicListPage.php?id=$id&status=SUCCESS");
}