<?php
require_once(__DIR__ . "/app/utils/UrlUtil.php");
require_once(__DIR__ . "/config.php");
UrlUtil::redirect("app/pages/" . Config::INITIAL_PAGE);