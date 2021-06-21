<?php
include 'config.php';

$currentDate = gmdate('y-m-');
$startDate = $currentDate . "01T00:00:00Z";


$_2monthPreviousStartDate = date('Y-m-', strtotime('-3 month')) . "01T00:00:00Z";

$projectsUrl = "https://app.paymoapp.com/api/clients?include=projects.id,projects.created_on";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $projectsUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
curl_close($ch);

$totalProjects = 0;
$projects = array();
foreach (json_decode($result, true)['clients'] as $client) {
    $newClientProjects = 0;
    if ($client['projects'] !== 0) {
        foreach ($client['projects'] as $project) {
            if ($project['created_on'] >= $_2monthPreviousStartDate) {
                $newClientProjects += 1;
            }
        }
    }
    $totalProjects += $newClientProjects;
    $projects[$client['id']] = array('name' => $client['name'], 'newProjects' => $newClientProjects);
}


$resultArray = array("newClientProjects" => $projects, 'totalProjects' => $totalProjects);
echo json_encode($resultArray);
