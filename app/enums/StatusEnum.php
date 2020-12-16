<?php
require_once(__DIR__ . "./ToastrEnum.php");

class StatusEnum {
    const LOGIN_SUCCESS =   [ "type" => ToastrEnum::SUCCESS, "message" => "Login successfull" ];
    const SUCCESS =         [ "type" => ToastrEnum::SUCCESS, "message" => "Action successfull" ];
    const LOGIN_FAILED =    [ "type" => ToastrEnum::ERROR, "message" => "Invalid user and/or password" ];
    const FAILED =          [ "type" => ToastrEnum::ERROR, "message" => "Action failed" ];
    const DATA_NOT_FOUND =  [ "type" => ToastrEnum::ERROR, "message" => "Data not found" ];
    const NO_DATA =         [ "type" => ToastrEnum::ERROR, "message" => "No data available for this action" ];
    const NO_FORM_FOUND =   [ "type" => ToastrEnum::ERROR, "message" => "The form for this action was not found" ];
    const NO_LIST_FOUND =   [ "type" => ToastrEnum::ERROR, "message" => "The list for this action was not found" ];
    /* add more here */
}

