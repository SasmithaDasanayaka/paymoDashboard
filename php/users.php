<?php

$userUrl = "https://app.paymoapp.com/api/users";

$email = "sasmithadasanayaka96@gmail.com";
$password = "HjA!!7P2Mtxhu5b";

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

    $currentDate = gmdate('y-m-');
    $startDate = $currentDate . "01";

    if (in_array(date('F'), $_30daysMonths)) {
        if (date('F') === 'February') {
            $endDate = $currentDate . "29";
        } else {
            $endDate = $currentDate . "30";
        }
    } else {
        $endDate = $currentDate . "31";
    }
    $timeUrl = "https://app.paymoapp.com/api/entries?where=user_id=$userId and time_interval in ('$startDate','$endDate')";


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

    $workedHoursPerUserArray[$userId] = array('name' => $users['name'], 'workedHours' => round($workedSecondsPerUser / 3600, 2));
}

$resultArray = array('users' => $workedHoursPerUserArray);

echo json_encode($resultArray);
