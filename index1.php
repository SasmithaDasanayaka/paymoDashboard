<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://app.paymoapp.com/api/entries?where=time_interval%20in%20(%222020-11-01T00:00:00Z%22,%222020-12-01T00:00:00Z%22)",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Basic MjRlOWU2OTk3YWFmNTA1MGVlMmJkMjcxNzAxOWQzMzY6dGVzdA=="
    ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response, true);
var_dump(count($response['entries']));
