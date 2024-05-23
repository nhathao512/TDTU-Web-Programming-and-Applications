<?php

$countries = array("Vietnam", "Lao", "Cambodia", "Singapore");

$input = $_POST["query"];

$suggestions = array_filter($countries, function($country) use ($input) {
    return stripos($country, $input) !== false;
});

echo json_encode(array_values($suggestions)); 
