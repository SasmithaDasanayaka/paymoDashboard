<?php

$clientUrl = "https://app.paymoapp.com/api/clients?include=projects.id,projects.budget_hours";
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

$clientArray = array();
$totalWorkedSeconds = 0;

$_30daysMonths = array('February', 'April', 'June', 'September', 'November');

foreach (json_decode($result, true)['clients'] as $client) {
    $clientId =  $client['id'];
    $numOfProjects = count($client['projects']);

    $budgetHours = 0;
    foreach ($client['projects'] as $project) {
        $budgetHours += $project['budget_hours'];
    }


    $currentDate = gmdate('y-m-');
    $startDate = $currentDate . "01T00:00:00Z";

    if (in_array(date('F'), $_30daysMonths)) {
        if (date('F') === 'February') {
            $endDate = $currentDate . "29T00:00:00Z";
        } else {
            $endDate = $currentDate . "30T00:00:00Z";
        }
    } else {
        $endDate = $currentDate . "31T00:00:00Z";
    }

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

    $clientArray[$clientId] = array('name' => $client['name'], 'workedHours' => round($workedSecondsPerClient / 3600, 2), 'numOfProjects' => $numOfProjects, 'budgetHours' => $budgetHours);
    $totalWorkedSeconds += $workedSecondsPerClient;
}

$totalWorkedHours = round($totalWorkedSeconds / 3600, 2);

$targetSales = round($totalWorkedHours * 90, 2);


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


$timeUrl = "https://app.paymoapp.com/api/entries?where=project_id in (";

$_1monthPreiviousProjectCount = 0;
$_2monthPreviousProjectCount = 0;
$_0monthPreviousProjectCount = 0;
$currentMonthProjectCount = 0;

$_1monthPreviousStartDate = date('Y-m-', strtotime('-2 month')) . "01T00:00:00Z";
$_2monthPreviousStartDate = date('Y-m-', strtotime('-3 month')) . "01T00:00:00Z";
$_0monthPreviousStartDate = date('Y-m-', strtotime('-1 month')) . "01T00:00:00Z";
$_currentMonthStartDate = date('Y-m-', strtotime('0 month')) . "01T00:00:00Z";


foreach (json_decode($project, true)['projects'] as $project) {
    ($project['budget_hours']) && $budgetHours += $project['budget_hours'];
    $id = $project['id'];

    $timeUrl = $timeUrl . "$id,";

    if ($project['created_on'] >= $_currentMonthStartDate) {
        $currentMonthProjectCount += 1;
    } else if ($project['created_on'] >= $_0monthPreviousStartDate) {
        $_0monthPreviousProjectCount += 1;
    } else if ($project['created_on'] >= $_1monthPreviousStartDate) {
        $_1monthPreiviousProjectCount += 1;
    } else if ($project['created_on'] >= $_2monthPreviousStartDate) {
        $_2monthPreviousProjectCount += 1;
    }
}

$avg = ($_0monthPreviousProjectCount + $_1monthPreiviousProjectCount + $_2monthPreviousProjectCount) / 3;
$weightedTot = (($_0monthPreviousProjectCount * 3) + ($_1monthPreiviousProjectCount * 2) + $_2monthPreviousProjectCount);
$diff = $weightedTot - ($avg * 6);
$ratio = 2;
$val1 = $diff / $ratio;
$val2 = $avg - $diff;
$forecast = round(((4 * $val1) + $val2), 0);

$totalLastThreeMonthsProjects = ($_0monthPreviousProjectCount + $_1monthPreiviousProjectCount + $_2monthPreviousProjectCount);

$timeUrl = rtrim($timeUrl, ", ");
$timeUrl = $timeUrl . ")";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $timeUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$time = curl_exec($ch);

$lastThreeMonthsProjectSeconds = 0;

foreach (json_decode($time, true)['entries'] as $entry) {
    $workedSeconds += $entry['duration'];
    if ($entry['created_on'] >= $_2monthPreviousStartDate && $entry['updated_on'] <= $_currentMonthStartDate) {
        $lastThreeMonthsProjectSeconds += $entry['duration'];
    }
}

$lastThreeMonthsProjectSeconds !== 0 ? $jobHours = round(($currentMonthProjectCount * ($totalLastThreeMonthsProjects / $lastThreeMonthsProjectSeconds / 3600)), 2) : $jobHours = 0;
$fullyOccupiedEmployees = round(($jobHours / 160), 2);
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

foreach ($clientArray as $key => $client) {
    $budgetHours !== 0 && $clientArray[$key]['budgetHours'] = round(($client['budgetHours'] / $budgetHours), 4);
    $totalWorkedHours !== 0 && $clientArray[$key]['timeShare'] = round(($client['workedHours'] / $totalWorkedHours), 4);
}

$salesTotal = ($budgetHours !== 0) ? $budgetHours * 90 : 'unlimited';

$resultArray = array('totalWorkedHours' => $totalWorkedHours, 'targetSales' => $targetSales, 'client' => $clientArray, 'productivityRate' => $productivityRate, 'profit' => $profitSurplus, 'loss' => $loss, 'salesTotal' => $salesTotal, 'forecast' => $forecast, 'jobHours' => $jobHours, 'fullyOccupiedEmployees' => $fullyOccupiedEmployees);

echo json_encode($resultArray);
