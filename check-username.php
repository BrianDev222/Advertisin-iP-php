<?php

$username = "BrianDev222";

function platform($platformName, $username) {

    switch($platformName) {

        case "github":
            return "https://github.com/{$username}";
    }
}

function check($url) {

$ch = curl_init($url);

curl_setopt_array ($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_NOBODY  => true,
    CURLOPT_USERAGENT  => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:155.0) Gecko/20100101 Firefox/155.0",
]);

curl_exec($ch);

$result = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);


return $result == 200 ? "OK" : "NOT OK";

}


$url = platform("github", $username);
echo check($url);




?>