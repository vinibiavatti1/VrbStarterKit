<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Dynamic list configuration class to set the configuration for each 
 * list that will be make in DynamicListPage.php
 */
class DynamicListConfig {

    /**
     * Configuration for dynamic list
     * @return type
     */
    public static function configuration() {
        return [
            "example" => self::exampleList(),
            /* Put more here */
        ];
    }

    /**
     * Example list configuration
     * @return type
     */
    private static function exampleList() {
        return [
            "table" => "example",
            "sql" => "SELECT id, name, active FROM example WHERE active = 1",
            "columns" => [
                "id" => [
                    "label" => "ID",
                    "function" => function($value) {
                        return $value;
                    }
                ],
                "name" => [
                    "label" => "Name",
                    "function" => function($value) {
                        return $value;
                    }
                ],
                "active" => [
                    "label" => "Active",
                    "function" => function($value) {
                        if ($value == 0) {
                            return "False";
                        } else {
                            return "True";
                        }
                    }
                ]
            ],
            "actionsColumn" => true,
            "actions" => [
                "update" => true,
                "delete" => true
            ]
        ];
    }

}
