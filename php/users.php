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

$userUrl = "https://app.paymoapp.com/api/users";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $userUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

$curlError = 'no';
if ($result === false) {
    $curlError = curl_error($ch);
}
curl_close($ch);

$_30daysMonths = array('February', 'April', 'June', 'September', 'November');
$workedHoursPerUserArray = array();
foreach (json_decode($result, true)['users'] as $users) {

    $userId = $users['id'];
    $workedDayHours = $users['workday_hours'];

    $currentDate = date('Y-m-d', strtotime('0 day')) . "T00:00:00Z";  

    $timeUrl = "https://app.paymoapp.com/api/entries?where=user_id=$userId and time_interval in ('$dateRange','$currentDate')";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $timeUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $resultTime = curl_exec($ch);

    $curlError = 'no';
    if ($resultTime === false) {
        $curlError = curl_error($ch);
    }
    curl_close($ch);


    $workedSecondsPerUser = 0;
    foreach (json_decode($resultTime, true)['entries'] as $entry) {
        $workedSecondsPerUser += $entry['duration'];
    }

    $workedHours = round($workedSecondsPerUser / 3600, 2);
    $productivityRate = round($workedHours / ($workedDayHours * 20), 3);
    $workedHoursPerUserArray[$userId] = array('name' => $users['name'], 'workedHours' => $workedHours, 'productivityRate' => $productivityRate);
}

$resultArray = array('users' => $workedHoursPerUserArray);

echo json_encode($resultArray);
