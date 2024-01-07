<?php 

declare(strict_types=1);

function translate(string $optionText) {
    $textArray = [
        "Bieelvi Finance" => "Bieelvi Finance",
        "Finance" => "Finance",
        "Page Logo Alt" => "Logo on the page: it's a little pig with a coin on top with black outlines.",
        "Reports" => "Reports",
        "Farmer" => "Farmer",
        "Products" => "Products",
        "Sign In" => "Sign In",
        "Sign Up" => "Sign Up",
        "Profile" => "Profile",
        "Logout" => "Logout",
        "Close" => "Close",
        "Confirm" => "Confirm",
        "Product" => "Product",
        "Select a product" => "Select a product",
        "Type" => "Type",
        "Select a type" => "Select a type",
        "Initial value" => "Valor inicial",
        "Final value" => "Final value",
        "Initial date" => "Initial date",
        "Final date" => "Final date",
        "Search" => "Search",
        "Exemple 100" => "Exemple US$ 100.00",
        "Exemple 200" => "Exemple US$ 200.00",
        "Value" => "Value",
        "Date" => "Date",
        "Observation" => "Observation",
        "Observations" => "Observations",
        "Back" => "Back",
        "Edit" => "Edit",
        "Register" => "Register",
        "Gain" => "Gain",
        "Spent" => "Spent",
        "Farmer list" => "Farmer list",
        "Clean filter" => "Clean filter",
        "Filter" => "Filter",
        "Actions" => "Actions",
        "No comments" => "No comments",
        "Delete product" => "Delete product",
        "Are you sure you want to delete this farm?" => "Are you sure you want to delete this farm?"
    ];
    
    if (isset($textArray[$optionText])) {
        return $textArray[$optionText];
    } 

    return $optionText;   
}