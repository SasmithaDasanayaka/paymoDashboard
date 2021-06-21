<?php
set_time_limit(1000);
// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://app.paymoapp.com/api/entries?where=time_interval%20in%20(%222020-11-01T00:00:00Z%22,%222020-12-01T00:00:00Z%22)",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//         "Authorization: Basic MjRlOWU2OTk3YWFmNTA1MGVlMmJkMjcxNzAxOWQzMzY6dGVzdA=="
//     ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// $response = json_decode($response, true);
// var_dump(count($response['entries']));



// $target_url = "https://app.paymoapp.com/api/projects";
// $email = "sasmithanilupul.17@cse.mrt.ac.lk";
// $password = "Abcd@123";

// for ($i = 0; $i < 500; $i++) {

// 	$post = array(
// 		"name" => "New Project",
// 		"description" => "Project added from API"
// 	);

// 	$ch = curl_init();
// 	curl_setopt($ch, CURLOPT_URL, $target_url);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
// 	curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
// 	curl_setopt($ch, CURLOPT_POST, 1);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// 	$result = curl_exec($ch);
// 	if ($result === false) {
// 		echo "Curl error: " . curl_error($ch) . "\n";
// 	}
// 	curl_close($ch);

// 	echo "New project ID: " . json_decode($result, true)['projects'][0]['id'];
// }


$target_url = "https://app.paymoapp.com/api/users";
$email = "sasmithanilupul.17@cse.mrt.ac.lk";
$password = "Abcd@123";
$clientId = 899156;
$userId = 216860;

// for ($i = 71; $i <= 80; $i++) {

//     $post = array(
//         "name" => "project '$i'",
//         "description" => "Latest project we'll be working on",
//         "billable" => true,
//         "client_id" => $clientId,
//         "users" => [216860, 216861],
//     );

//     $clientId++;
//     $userId++;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$result = curl_exec($ch);
if ($result === false) {
    echo "Curl error: " . curl_error($ch) . "\n";
}
curl_close($ch);

// print_r(json_decode($result, true));

foreach (json_decode($result, true)['users'] as $client) {
    $id = $client['id'];
    $url = "https://app.paymoapp.com/api/users/$id";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    print_r(json_decode($result, true));
    curl_close($ch);
}
// }
// setlocale(LC_MONETARY, 'en_US');
// echo money_format('%i', $number) . "\n";
