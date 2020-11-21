<?php

$clientUrl = "https://app.paymoapp.com/api/clients?include=projects.id";
$employeeUrl = "https://app.paymoapp.com/api/users?where=type=Employee";
$projectUrl = "https://app.paymoapp.com/api/projects";

$email = "sasmithadasanayaka96@gmail.com";
$password = "HjA!!7P2Mtxhu5b";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $clientUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if ($result === false) {
    echo "Curl error: " . curl_error($ch) . "\n";
}
curl_close($ch);

$workedHoursPerClientArray = array();
$totalWorkedSeconds = 0;

$_31daysMonths = array(1, 3, 5, 7, 8, 10, 12);
$_30daysMonths = array(2, 4, 6, 9, 11);


foreach (json_decode($result, true)['clients'] as $client) {
    $clientId =  $client['id'];
    $numOfProjects = count($client['projects']);
    // $currentDate = gmdate('y-m-d');
    // $previousDate = date_create(gmdate('y-m-d'));
    // date_sub($previousDate, date_interval_create_from_date_string("30 days"));
    // $newPreviousDate = date_format($previousDate, "Y-m-d");

    $currentDate = gmdate('y-m-');
    $startDate = $currentDate . "01";
    $endDate = $currentDate . "30";
    $timeUrl = "https://app.paymoapp.com/api/entries?where=client_id=$clientId and time_interval in ('$startDate','$endDate')";

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

    $workedSecondsPerClient = 0;
    foreach (json_decode($result, true)['entries'] as $entry) {
        $workedSecondsPerClient += $entry['duration'];
    }

    $workedHoursPerClientArray[$clientId] = $workedSecondsPerClient / 3600;
    $totalWorkedSeconds += $workedSecondsPerClient;
}

$totalWorkedHours = round($totalWorkedSeconds / 3600, 2);

$targetSales = $totalWorkedHours * 90;





$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $employeeUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$employee = curl_exec($ch);

$employee = json_decode($employee, true);
$numOfEmployee = count($employee['users']);

curl_close($ch);

$productivityRate = ($numOfEmployee  != 0) ? $totalWorkedHours / 160 / $numOfEmployee : 0;
$productivityRate = round($productivityRate, 3);





$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $projectUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$project = curl_exec($ch);
curl_close($ch);

$budgetHours = 0;
$workedSeconds = 0;
foreach (json_decode($project, true)['projects'] as $project) {
    ($project['budget_hours']) && $budgetHours += $project['budget_hours'];
    $id = $project['id'];
    $timeUrl = "https://app.paymoapp.com/api/entries?where=project_id=$id";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $timeUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $time = curl_exec($ch);

    foreach (json_decode($time, true)['entries'] as $entry) {
        $workedSeconds += $entry['duration'];
    }
}

$workedHours = round($workedSeconds / 3600, 2);
if ($budgetHours - $workedHours >= 0) {
    $remainHours = $budgetHours - $workedHours;
    $profitSurplus = round($remainHours * 90, 2);
    $loss = 0;
} else {
    $remainHours = $workedHours - $budgetHours;
    $loss = round($remainHours * 90, 2);
    $profitSurplus = 0;
}

$salesTotal = ($budgetHours !== 0) ? $budgetHours * 90 : 'unlimited';

$resultArray = array('totalWorkedHours' => $totalWorkedHours, 'targetSales' => $targetSales, 'workedHoursPerClientArray' => $workedHoursPerClientArray, 'productivityRate' => $productivityRate, 'profit' => $profitSurplus, 'loss' => $loss, 'salesTotal' => $salesTotal);

echo json_encode($resultArray);
