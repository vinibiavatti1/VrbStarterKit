<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/*
 * Load dictionary
 */
TranslateService::loadDictionary();

/**
 * Serviço de Tradução de aplicação. Para que a tradução seja configurada
 * dinâmicamente, o índice <b>idioma</b> deve estar inserido na sessão com o
 * valor referente ao idioma utilizado: "pt-br, en-us...".
 */
class TranslateService {
    
    /**
     * Translate text using the configured idiom
     * @param string $text
     */
    public static function translate($text) {
        if(!defined("DICTIONARY")) {
            return $text;
        }
        if(!array_key_exists($text, DICTIONARY)) {
            return $text;
        }
        return DICTIONARY[$text];
    }
    
    /**
     * Load dictionary
     */
    public static function loadDictionary() {
        $idiom = SessionService::get(SessionTypes::IDIOM_KEY);
        @include_once(__DIR__ . "/../translates/" . ((isset($idiom) && $idiom != null) ? $idiom : Config::IDIOM) . ".php");
    }
    
}

/**
 * Global access to <code>Translate_Service::translate</code>
 * @param string $text
 * @return string
 */
function __($text) {
    return TranslateService::translate($text);
}