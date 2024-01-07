<?php 

declare(strict_types=1);

function lang() {
    return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

function translate(string $optionText) {    
    $lang = lang();
    if ((is_file(__DIR__ . "/../public/lang/{$lang}.php"))) {
        $langDir = "lang/{$lang}.php";
    } else {
        $langDir = "lang/en.php";
    }

    $textArray = require __DIR__ . "/../public/{$langDir}";

    if (isset($textArray[$optionText])) {
        return $textArray[$optionText];
    } 

    return $optionText;   
}