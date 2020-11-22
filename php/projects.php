 <?php
    $email = "sasmithadasanayaka96@gmail.com";
    $password = "HjA!!7P2Mtxhu5b";


    $currentDate = gmdate('y-m-');
    $startDate = $currentDate . "01T00:00:00Z";

    $_1monthBefore = date("y-m-d", strtotime("-1 Months"));
    $_2monthBefore = date("y-m-d", strtotime("-2 Months"));

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
        foreach ($client['projects'] as $project) {
            if ($project['created_on'] >= $startDate) {
                $newClientProjects += 1;
            }
        }
        $totalProjects += $newClientProjects;
        $projects[$client['id']] = array('name' => $client['name'], 'newProjects' => $newClientProjects);
    }

    $resultArray = array("newClientProjects" => $projects, 'totalProjects' => $totalProjects);
    echo json_encode($resultArray);
