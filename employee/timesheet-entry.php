<?php

include_once __DIR__ . "/../app/config.php";
include_once __DIR__ . "/../app/constants.php";
$data = $_POST;
$username = $data['username'];

//Validate data
function valid_date($date)
{
    $explodedDate = explode("/", $date);
    $month = $explodedDate[0];
    $day = $explodedDate[1];
    $year = $explodedDate[2];
    return checkdate($month, $day, $year);
}
$errors = [];
if (!valid_date($data['fromdate'])) {
    $errors[] = "Invalid From Date";
}
if (!valid_date($data['todate'])) {
    $errors[] = "Invalid To Date";
}

if (count($errors) > 0) {
    $result = [
        'status' => false,
        'errors' => $errors,
    ];
    ob_clean();
    echo json_encode($result);
    exit();
}


//Insert data to db

$query_res = $conn->query("select id from users where username = '".$username."'");
$user = $query_res->fetch_assoc();
$employee_id = $user['id'];

$fromDate = new DateTime($data['fromdate']);
$toDate = new DateTime($data['todate']);
$dateInterval = $toDate->diff($fromDate);
$days = $dateInterval->days;
$excludeWeekends = $data['excludechekbox'] == "on";
for ($i = 0; $i <= $days; $i++) {
    $isweekend=false;
    $timeentry_date = $fromDate->format(Mysql_DateFormat);
   // $isweekend = //is fromdate a weekend in this iteration
    $get_namedate=date('l', strtotime($timeentry_date));
    $get_dayname=substr($get_namedate,0,3);
    if($get_dayname=='Sat' || $get_dayname=='Sun'){
        $isweekend=true;
    }
    if ($excludeWeekends && $isweekend) {
        $timeentry_date= " ";
    }
    $startTimeArray = explode(":", $data['in']);
    $endTimeArray = explode(":", $data['out']);
    $startTime = $fromDate->setTime($startTimeArray[0], $startTimeArray[1])->format(Mysql_DateTimeFormat);
    $endTime = $fromDate->setTime($endTimeArray[0], $endTimeArray[1])->format(Mysql_DateTimeFormat);
    $hours = $data['hourslogged'];//Todo: out time minus in time
    $timecodeId = $data['paycode'];
    $comments= $data['comments'];
    $insertQuery = <<<SQL
insert into timeentry (    
`timeentry_date`,
`hours`,
`starttime`,
`endtime`,
`employee_id`,
`timecode_id`,
`comments`                
)
values (
        "{$timeentry_date}",
        {$hours},
        "{$startTime}",
        "{$endTime}",
        {$employee_id},
        {$timecodeId},
        "{$comments}"
);
SQL;


    $query_res = $conn->query($insertQuery);
    $fromDate->add(new DateInterval("P1D"));

}

//Redirect to timesheet page
$result = [
    'status' => true,
];
ob_clean();
echo json_encode($result);
exit();