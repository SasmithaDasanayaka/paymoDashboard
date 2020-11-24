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



$target_url = "https://app.paymoapp.com/api/projects";
$email = "sasmithadasanayaka96@gmail.com";
$password = "HjA!!7P2Mtxhu5b";

for ($i = 0; $i < 500; $i++) {

	$post = array(
		"name" => "New Project",
		"description" => "Project added from API"
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $target_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);
	if ($result === false) {
		echo "Curl error: " . curl_error($ch) . "\n";
	}
	curl_close($ch);

	echo "New project ID: " . json_decode($result, true)['projects'][0]['id'];
}


// $target_url = "https://app.paymoapp.com/api/entries";
// $email = "sasmithadasanayaka96@gmail.com";
// $password = "HjA!!7P2Mtxhu5b";

// for ($i = 0; $i < 500; $i++) {

// 	$post = array(
// 		"task_id" => 19776038,
// 		"date" => "2014-12-10",
// 		"duration" => 3600,
// 		"description" => "Talked to Susan on the phone.",

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

// 	print_r(json_decode($result, true));
// }
