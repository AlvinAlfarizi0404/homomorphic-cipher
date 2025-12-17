<?php
function encrypt($text, $key = 5) {
    $result = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $result .= chr(ord($text[$i]) + $key);
    }
    return $result;
}

function decrypt($text, $key = 5) {
    $result = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $result .= chr(ord($text[$i]) - $key);
    }
    return $result;
}
