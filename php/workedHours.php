<?php
include 'config.php';

$temDateRange = $_GET['dateRange'];
if ($temDateRange === '3_months') {
    $dateRange = date('Y-m-d', strtotime('-90 day')) . "T00:00:00Z";
} else if ($temDateRange === '2_months') {
    $dateRange = date('Y-m-d', strtotime('-60 day')) . "T00:00:00Z";
} else if ($temDateRange === '1_months') {
    $dateRange = date('Y-m-d', strtotime('-30 day')) . "T00:00:00Z";
} else {
    $dateRange = date('Y-m-d', strtotime('-14 day')) . "T00:00:00Z";
}

$clientUrl = "https://app.paymoapp.com/api/clients?include=projects.id,projects.budget_hours,projects.created_on";
$employeeUrl = "https://app.paymoapp.com/api/users?where=type=Employee";
$projectUrl = "https://app.paymoapp.com/api/projects";

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
$totalWorkedSeconds3Months = 0;

$_30daysMonths = array('February', 'April', 'June', 'September', 'November');

foreach (json_decode($result, true)['clients'] as $client) {
    $clientId =  $client['id'];
    $numOfProjects = 0;

    $_2monthPreviousStartDateClient = date('Y-m-d', strtotime('-90 day')) . "T00:00:00Z";
    $_currentMonthStartDateClient =  date('Y-m-d', strtotime('0 day')) . "T23:59:00Z";


    $budgetHours = 0;
    foreach ($client['projects'] as $project) {
        $budgetHours += $project['budget_hours'];

        if ($project['created_on'] >= $_2monthPreviousStartDateClient && $project['created_on'] <= $_currentMonthStartDateClient) {
            $numOfProjects += 1;
        }
    }


    $currentDate = date('Y-m-d', strtotime('0 day')) . "T23:59:00Z";

    $timeUrl = "https://app.paymoapp.com/api/entries?where=client_id=$clientId and time_interval in ('$dateRange','$currentDate')";

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


    $_2monthPreviousStartDateClient =  date('Y-m-d', strtotime('-90 day')) . "T00:00:00Z";
    $currentMonthStartDateClient =  date('Y-m-d', strtotime('0 day')) . "T23:59:00Z";

    $time3MonthsUrl = "https://app.paymoapp.com/api/entries?where=client_id=$clientId and time_interval in ('$_2monthPreviousStartDateClient','$currentMonthStartDateClient')";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $time3MonthsUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result3Months = curl_exec($ch);
    if ($result3Months === false) {
        echo "Curl error: " . curl_error($ch) . "\n";
    }
    curl_close($ch);

    $workedSeconds3MonthsPerClient = 0;
    foreach (json_decode($result3Months, true)['entries'] as $entry) {
        $workedSeconds3MonthsPerClient += $entry['duration'];
    }
    $totalWorkedSeconds3Months += $workedSeconds3MonthsPerClient;

    $numOfProjects > 0 &&    $clientArray[$clientId] = array('name' => $client['name'], 'workedHours3Months' => round($workedSeconds3MonthsPerClient / 3600, 2), 'numOfProjects' => $numOfProjects, 'budgetHours' => $project['budget_hours']);
    $totalWorkedSeconds += $workedSecondsPerClient;
}

$totalWorkedHours = round($totalWorkedSeconds / 3600, 2);
$totalWorkedHours3Months = round($totalWorkedSeconds3Months / 3600, 2);


$targetSales = number_format(round($totalWorkedHours * 90, 2), 2);


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

$_0monthPreviousStartDate = date('Y-m-d', strtotime('-30 day')) . "T00:00:00Z";
$_1monthPreviousStartDate = date('Y-m-d', strtotime('-60 day')) . "T00:00:00Z";
$_2monthPreviousStartDate = date('Y-m-d', strtotime('-90 day')) . "T00:00:00Z";
$_currentMonthStartDate = date('Y-m-', strtotime('0 month')) . "01T00:00:00Z";

$lastThreeMonthsProjectBudgetHours = 0;

foreach (json_decode($project, true)['projects'] as $project) {
    ($project['budget_hours']) && $budgetHours += $project['budget_hours'];
    $id = $project['id'];

    $timeUrl = $timeUrl . "$id,";

    if ($project['created_on'] >= $_0monthPreviousStartDate) {
        $_0monthPreviousProjectCount += 1;
    } else if ($project['created_on'] >= $_1monthPreviousStartDate && $project['created_on'] <= $_0monthPreviousStartDate) {
        $_1monthPreiviousProjectCount += 1;
    } else if ($project['created_on'] >= $_2monthPreviousStartDate && $project['created_on'] <= $_1monthPreviousStartDate) {
        $_2monthPreviousProjectCount += 1;
    }

    if ($project['created_on'] >= $_2monthPreviousStartDate) {
        $lastThreeMonthsProjectBudgetHours += $project['budget_hours'];
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


foreach (json_decode($time, true)['entries'] as $entry) {
    $workedSeconds += $entry['duration'];
}

$lastThreeMonthsProjectBudgetHours !== 0 ? $jobHours = round((($lastThreeMonthsProjectBudgetHours / 90) * $forecast), 2) : $jobHours = 0;
$fullyOccupiedEmployees = round(($jobHours / 160), 2);
$workedHours = round($workedSeconds / 3600, 2);
if ($budgetHours - $workedHours >= 0) {
    $remainHours = $budgetHours - $workedHours;
    $profitSurplus = number_format(round($remainHours * 90, 2), 2);
    $loss = number_format(0, 2);
} else {
    $remainHours = $workedHours - $budgetHours;
    $loss = number_format(round($remainHours * 90, 2), 2);
    $profitSurplus = number_format(0, 2);
}

foreach ($clientArray as $key => $client) {
    if ($budgetHours != 0) {
        $clientArray[$key]['budgetHours'] = round(($client['budgetHours'] / $budgetHours), 2);
    } else {
        $clientArray[$key]['budgetHours'] = 0;
    }
}

foreach ($clientArray as $key => $client) {
    if ($totalWorkedHours3Months != 0) {
        $clientArray[$key]['timeShare'] = round(($client['workedHours3Months'] / $totalWorkedHours3Months), 2);
    } else {
        $clientArray[$key]['timeShare'] = 0;
    }
}


$salesTotal = ($budgetHours !== 0) ? number_format($budgetHours * 90, 2) : 'unlimited';


//sort clients according to no.of projects
$sortClientArray = array();
foreach ($clientArray as $key => $client) {
    $sortClientArray[$key] = $client['numOfProjects'];
}
array_multisort($sortClientArray, SORT_DESC, $clientArray);


$resultArray = array('totalWorkedHours' => $totalWorkedHours, 'targetSales' => $targetSales, 'client' => $clientArray, 'productivityRate' => $productivityRate, 'profit' => $profitSurplus, 'loss' => $loss, 'salesTotal' => $salesTotal, 'forecast' => $forecast, 'jobHours' => $jobHours, 'fullyOccupiedEmployees' => $fullyOccupiedEmployees);

echo json_encode($resultArray);
