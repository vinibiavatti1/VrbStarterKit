<?php
require_once(__DIR__ . "/app/services/UrlService.php");
require_once(__DIR__ . "/config.php");
UrlService::redirect("app/pages/" . Config::INITIAL_PAGE);