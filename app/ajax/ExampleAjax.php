<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Ajax event call
EventService::ajax();

// Validate params and access rights
SecurityService::validateInputParams(INPUT_GET, ["value"]);
SecurityService::validateSessionValue(SessionEnum::PERMISSION_KEY, PermissionEnum::ADMINISTRATOR);
SecurityService::validateSessionValue(SessionEnum::LICENSE_KEY, LicenseEnum::ENTERPRISE);

// Get HTTP params
$valor_1 = HttpService::input(INPUT_POST, "value");
$valor_2 = HttpService::input(INPUT_POST, "value2", -1);

// Response
$response = new JsonResponseErrorComponent(200, 'Success');
$response->render();
HeaderService::setJsonContentType();
http_response_code(200);