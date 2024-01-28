<?php 

declare(strict_types=1);

use Financas\Enum\Language;

function lang() {
    if (isset($_SESSION['logged']) && $_SESSION['logged']->getConfigs()) {
        return $_SESSION['logged']->getConfigs()->getLanguage();
    } else {
        return Language::EN->value;
    }
}

function translate(string $optionText) {    
    $lang = lang();
    $langDir = is_file(__DIR__ . "/../public/lang/{$lang}.json") ? "lang/{$lang}.json" : "lang/en.json";

    $textJson = file_get_contents(__DIR__ . "/../public/{$langDir}");
    $textArray = json_decode($textJson, true); 

    return $textArray[$optionText] ?? $optionText;   
}