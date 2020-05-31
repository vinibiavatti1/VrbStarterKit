<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Ajax event call
EventService::ajax();

// Validate params and access rights
SecurityService::validateInputParams(INPUT_GET, ["value"]);
SecurityService::validateModule(Const_Modulo::CADASTROS);
SecurityService::validatePermission([Const_Permissao::CADASTRAR]);
SecurityService::validateLicense([Const_Licenca::STANDARD, Const_Licenca::ENTERPRISE]);

// Get HTTP params
$valor_1 = HttpService::input(INPUT_POST, "value");
$valor_2 = HttpService::input(INPUT_POST, "value_2", -1);

// Response
$response = new JsonResponseErrorComponent(200, 'Success');
$response->render();
HeaderService::setJsonContentType();
http_response_code(200);