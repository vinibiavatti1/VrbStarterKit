<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Action event call
EventService::action();

// Get HTTP params
$email = HttpService::post("email");
$password = HttpService::post("password");

// Do login (Example)
if($email == 'admin@admin.com' && $password == 'admin') {
    SessionService::setActiveSession();
    SessionService::set(SessionTypes::USER_ID_KEY, $email);
    UrlService::redirectWithStatus("app/pages/LoginPage.php", "LOGIN_SUCCESS");            
} else {
    UrlService::redirectWithStatus("app/pages/LoginPage.php", "LOGIN_FAILED");
}