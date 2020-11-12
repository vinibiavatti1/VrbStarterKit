<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Dynamic form configuration class to set the configuration for each 
 * form that will be make in DynamicFormPage.php
 */
class DynamicFormConfig {

    /**
     * Configuration for dynamic form
     * @return type
     */
    public static function configuration() {
        return [
            "example" => self::exampleForm(),
            /* Put more here */
        ];
    }

    /**
     * Example form configuration
     * @return type
     */
    private static function exampleForm() {
        return [
            "table" => "example",
            "fields" => [
                "name" => [
                    "type" => InputTypeEnum::TEXT,
                    "label" => "Name",
                    "required" => true,
                    "class" => "blue-text",
                    "placeholder" => "Put the name here"
                ],
                "age" => [
                    "type" => InputTypeEnum::NUMBER,
                    "label" => "Age",
                    "required" => false,
                    "placeholder" => "Put the age here",
                    "config" => [
                        "min" => "0",
                        "max" => "150",
                        "step" => "1"
                    ]
                ],
                "description" => [
                    "type" => InputTypeEnum::TEXTAREA,
                    "label" => "Description",
                    "required" => false,
                    "placeholder" => "Put the description here"
                ],
                "id_school" => [
                    "type" => InputTypeEnum::SQL,
                    "label" => "School",
                    "required" => false,
                    "config" => [
                        "sql" => "SELECT id as value, name as label FROM school WHERE active = 1",
                        "simulation" => true
                    ]
                ],
                "birth_date" => [
                    "type" => InputTypeEnum::DATE,
                    "label" => "Birth Date",
                    "required" => false
                ],
                "insert_date_time" => [
                    "type" => InputTypeEnum::DATETIME,
                    "label" => "Insert date time",
                    "required" => false
                ],
                "active" => [
                    "type" => InputTypeEnum::SELECT,
                    "label" => "Active",
                    "required" => true,
                    "config" => [
                        "values" => [
                            "1" => "Yes",
                            "2" => "No"
                        ]
                    ]
                ]
            ]
        ];
    }

}
