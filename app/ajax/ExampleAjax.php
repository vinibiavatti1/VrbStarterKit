<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Ajax event call
EventUtil::ajax();

// Validate params and access rights
SecurityUtil::validateInputParams(INPUT_GET, ["value"]);
SecurityUtil::validateSessionValue(SessionEnum::PERMISSION, PermissionEnum::ADMINISTRATOR);
SecurityUtil::validateSessionValue(SessionEnum::LICENSE, LicenseEnum::ENTERPRISE);

// Get HTTP params
$valor_1 = HttpUtil::input(INPUT_POST, "value");
$valor_2 = HttpUtil::input(INPUT_POST, "value2", -1);

// Response
$response = new JsonResponseErrorComponent(200, 'Success');
$response->render();
HeaderUtil::setJsonContentType();
http_response_code(200);