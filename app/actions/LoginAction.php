<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Action event call
EventUtil::action();

// Security
SecurityUtil::validatePostParams(["email", "password", "idiom"]);

// Get HTTP params
$email = HttpUtil::post("email");
$password = HttpUtil::post("password");
$idiom = HttpUtil::post("idiom");

// Do login (Example)
if($email == 'admin@admin.com' && $password == 'admin') {
    SessionUtil::set(SessionEnum::USER_ID, $email);
    SessionUtil::set(SessionEnum::IDIOM, $idiom);
    UrlUtil::redirectToPage("backoffice/BOHomePage", "LOGIN_SUCCESS");
} else {
    UrlUtil::redirectToPage("LoginPage", "LOGIN_FAILED");
}