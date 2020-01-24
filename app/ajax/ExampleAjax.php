<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Ajax event call
EventService::ajax();

// Validate params and access rights
SecurityService::validateGetParams(["value"]);
SecurityService::validateModule(Const_Modulo::CADASTROS);
SecurityService::validatePermission([Const_Permissao::CADASTRAR]);
SecurityService::validateLicense([Const_Licenca::STANDARD, Const_Licenca::ENTERPRISE]);

// Get HTTP params
$valor_1 = HttpService::get("value");
$valor_2 = HttpService::post("value_2", -1);

// Response
$response = new JsonResponseErrorComponent(200, 'Success');
$response->render();
HeaderService::setJsonContentType();
http_response_code(200);