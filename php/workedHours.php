<?php
$projectsUrl = "https://app.paymoapp.com/api/projects";
$email = "sasmithadasanayaka96@gmail.com";
$password = "HjA!!7P2Mtxhu5b";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $projectsUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if ($result === false) {
    echo "Curl error: " . curl_error($ch) . "\n";
}
curl_close($ch);

$projectsArr = array();
$totalTime = 0;
// echo $result;
foreach (json_decode($result, true)['projects'] as $project) {
    array_push($projectsArr, $project['name']);
    $projectId =  $project['id'];

    $timeUrl = "https://app.paymoapp.com/api/entries?where=project_id=$projectId";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $timeUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    if ($result === false) {
        echo "Curl error: " . curl_error($ch) . "\n";
    }
    curl_close($ch);
    print_r(json_decode($result, true));
    foreach (json_decode($result, true)['entries'] as $entry) {
        $totalTime += $entry['duration'];
    }
}

print_r($totalTime / 3600);
