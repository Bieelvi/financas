<?php 

declare(strict_types=1);

function lang() {
    return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

function translate(string $optionText) {    
    $lang = lang();
    if ((is_file(__DIR__ . "/../public/lang/{$lang}.json"))) {
        $langDir = "lang/{$lang}.json";
    } else {
        $langDir = "lang/en.json";
    }

    $textJson = file_get_contents(__DIR__ . "/../public/{$langDir}");
    $textArray = json_decode($textJson, true);

    if (isset($textArray[$optionText])) {
        return $textArray[$optionText];
    } 

    return $optionText;   
}