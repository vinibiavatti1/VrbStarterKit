<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class to allow internationalization. To configure the translation per session,
 * the index <b>IDIOM</b> needs to be defined in <code>$_SESSION</code> array 
 * with some language key. The translation key can be defined in the page's 
 * query url too, like <code>page.php?idiom=en_US</code>. This key will be 
 * used to find the properties of this idiom in <code>app/enums/IdiomEnum</code>,
 * and to load the file in <code>app/translations</code> to define the dictionary 
 * idiom of the application
 */
class TranslationUtil {
    
    const TRANSLATION_QUERY_PARAM = "idiom";
    
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
        $idiom = null;
        if(HttpUtil::get(self::TRANSLATION_QUERY_PARAM) != null) {
            $idiom = HttpUtil::get(self::TRANSLATION_QUERY_PARAM);
        } else if(SessionUtil::get(SessionEnum::IDIOM) != null) {
            $idiom = SessionUtil::get(SessionEnum::IDIOM);
        }
        if($idiom != null) {
            @include_once(__DIR__ . "/../translations/" . ((isset($idiom) && $idiom != null) ? $idiom : Config::IDIOM) . ".php");
        }
    }
    
}

/**
 * Global access to <code>TranslationUtil::translate</code>
 * @param string $text
 * @return string
 */
function __($text) {
    return TranslationUtil::translate($text);
}

/*
 * Load dictionary
 */
TranslationUtil::loadDictionary();