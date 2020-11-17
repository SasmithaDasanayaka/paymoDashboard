<?php
$projectsUrl = "https://app.paymoapp.com/api/projectstatuses?include=projects";
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

$currentDate = gmdate('y-m-');
$startDate = strtotime($currentDate . "01");
$endDate = strtotime($currentDate . "30");

$countNewProjectsCurrent = 0;
$countNewProjectsPrevious = 0;

foreach (json_decode($result, true)['projectstatuses'] as $project) {
    $date   = new DateTime($project['created_on']);
    $createdDate = $date->format('Y-m-d');
    $createdDate = strtotime($createdDate);

    if (($createdDate >= $startDate) && ($createdDate <= $endDate)) {
        $countNewProjectsCurrent += 1;
    }
}

$currentDate = gmdate('y-m-d');
$startDate = date_create(gmdate('y-m-d'));
date_sub($startDate, date_interval_create_from_date_string("31 days"));
$newStartDate = date_format($startDate, "Y-m-");
$newStartDate = $newStartDate . "01";
$newEndDate = $newStartDate . "30";


foreach (json_decode($result, true)['projectstatuses'] as $project) {
    $date   = new DateTime($project['created_on']);
    $createdDate = $date->format('Y-m-d');
    $createdDate = strtotime($createdDate);

    if (($createdDate >= $newStartDate) && ($createdDate <= $newEndDate)) {
        $countNewProjectsPrevious += 1;
    }
}

echo $countNewProjectsCurrent;
echo $countNewProjectsPrevious;
$percentageGrowth = ($countNewProjectsCurrent - $countNewProjectsPrevious) * 100 / $countNewProjectsPrevious;

$resultArray = array("countNewProjectsCurrent" => $countNewProjectsCurrent, "percentageGrowth" => $percentageGrowth);
