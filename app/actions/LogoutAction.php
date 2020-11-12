<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Action event call
EventService::action();

// Detroy session
SessionService::destroy();
UrlService::redirectToPage("HomePage");