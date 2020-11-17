<?php
$projectsUrl = "https://app.paymoapp.com/api/clients";
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

$workedHoursPerClientArray = array();
$totalWorkedSeconds = 0;

foreach (json_decode($result, true)['clients'] as $client) {
    $clientId =  $client['id'];

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
        exit();
    }
    curl_close($ch);

    $workedSecondsPerClient = 0;
    foreach (json_decode($result, true)['entries'] as $entry) {
        $workedSecondsPerClient += $entry['duration'];
    }

    $workedHoursPerClientArray[$clientId] = $workedSecondsPerClient / 3600;
    $totalWorkedSeconds += $workedSecondsPerClient;
}
$totalWorkedHours = $totalWorkedSeconds / 3600;

$targetSales = $totalWorkedHours * 90;

$resultArray = array('totalWorkedHours' => $totalWorkedHours, 'targetSales' => $targetSales, 'workedHoursPerClientArray' => $workedHoursPerClientArray);

echo json_encode($resultArray);
