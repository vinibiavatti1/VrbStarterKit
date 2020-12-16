<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Action event call
EventUtil::action();

// Detroy session
SessionUtil::destroy();
UrlUtil::redirectToPage("HomePage");