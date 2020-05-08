<?php

include_once __DIR__ . "/../app/config.php";
$username = $_GET['eeusername'];
$erusername=$_GET['erusername'];
$timecodesArray = [];
$query_res = $conn->query("select id,timecode_desc from timecodes");
while ($timecodeRow = $query_res->fetch_assoc()) {
    $timecodesArray[] = $timecodeRow;
}
foreach ($timecodesArray as $time) {
    $time_allocation[$time['id']] = $time['timecode_desc'];
}

$query_res = $conn->query("select id from users where username = '" . $username . "'");
$user = $query_res->fetch_assoc();
$employee_id = $user['id'];

$query_res = $conn->query("select * from timeentry where employee_id = " . $employee_id);
while ($row = $query_res->fetch_assoc()) {
    $timeentries[] = $row;
}
date_default_timezone_set('America/Los_Angeles');
$type = CAL_GREGORIAN;
$workdays = array();
$workdays_all = array();
$month = date('n');
$year = date('Y');
$day_count = cal_days_in_month($type, $month, $year);

$dates = [];
for ($i = 1; $i <= $day_count; $i++) {
    $date = date("Y-m-d", strtotime($year . '-' . $month . '-' . $i));
    $get_name = date('l', strtotime($date));
    $day_name = substr($get_name, 0, 3);
    $dates[$i] = $date;
//    if ($day_name != 'Sun' && $day_name != 'Sat') {
//        $workdays[] = $date;
//    }
//    if ($day_name == 'Mon') {
//        $thisweekstart[] = $date;
//    }
//    if ($day_name == 'Sun') {
//        $thisweekend[] = $date;
//    }
}


//for ($i = 0; $i < 5; $i++) {
//    $toDay = time() + ($i * 24 * 60 * 60);
//    $tommDate = date('Y-m-d', $toDay);
//    $Days[] = $tommDate;
//}
//$todaysDate = $Days[0];
$tablerows = "";
$timeEntriesForDay = [];
foreach ($dates as $date) {
    foreach ($timeentries as $timeentry) {
        if ($timeentry['timeentry_date'] == $date) {
            $timeEntriesForDay[$date][] = $timeentry;
        }
    }
}

$totalHours = 0.00;
$recordNum = 0;
foreach ($dates as $date) {
    $recordNum++;
    $timeentries = [];
        if (isset($timeEntriesForDay[$date])) {
            $timeentries = $timeEntriesForDay[$date];
        } else {
            $timeentries = [
                [
                    'timeentry_date' => $date,
                ],
            ];
        }

        $timeentryCounter = 0;
        foreach ($timeentries as $timeentry) {
            $paycode_id = $timeentry['timecode_id'];
            $hours = $timeentry['hours'];
            $hours = number_format($hours, 2);
            $totalHours = $hours + $totalHours;
            $comments = $timeentry['comments'];
            $totalHours = number_format($totalHours, 2);

            $deleteIcon = "";
            $deleteIcons="";
            $notesIcon = "";
            if (count($timeentry) > 1) {
//        if(true) {
                $deleteIcon = <<<HTML
<a href="#" title="remove" id="deleterecord" class="deleterecord" data-id="{$timeentry['id']}">
                        <span class="glyphicon glyphicon-trash"></span></a>
HTML;
            if(!isset($erusername)){
                $deleteIcons=$deleteIcon;
            }
            else if(isset($username) && isset($erusername)){
                $deleteIcons = "";
            }
                $notesIcon = <<<HTML
<span class="glyphicon glyphicon-comment"></span> 
HTML;
            }
            $timeentry_date = "";
            $recordID = "";
            if ($timeentryCounter == 0) {
                $recordID = $recordNum;
                $timeentry_date = $date;
                $timeentryCounter++;
                //$recordID++;
            }
            $tablerows .= <<<HTML
        <tr>
            <td>{$recordID}</td>
            <td>
            <span>{$timeentry_date}</span>
            </td>
            <td>
                
                    <span class="paycodemain">{$time_allocation[$paycode_id]}</span>
                
            </td>
            <div class="row">
            <td>
               <span class="starttimemain" >{$timeentry['starttime']}<span>
            </td>
            <td>
               <span class="endtimemain">{$timeentry['endtime']}<span>
            <td>
               <span class="hoursmain">{$hours}<span>
            </td>

            <td>
                <div class="col-sm-3" >
                    <span class="totalhours">{$totalHours}</span>
                </div></td>
            </td>
            <td>
            {$notesIcon}{$comments}
            </td>
            <td>         
                <div class="col-sm-3">
                    {$deleteIcons}
                </div>
            </td>
        </tr>
HTML;

    }
}


?>

<html lang="en">
<head>
    <title>Timesheets</title>
    <script type="text/javascript" src="js/timesheets.js"></script>
    <link rel="stylesheet" href="css/timesheets.css">
</head>
<body>
<div class="container">
    <h1 align="center"> Time Sheet of <?= strtoupper($username) ?></h1>


    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h4 id="addhrs">Add Hours</h4>
            <form id="mymodalform" method="post" action="timesheet-entry.php" autocomplete="off">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="username" value="<?= $username ?>">
                <div class="header">
                    <p class="days">Day(s)</p>
                    <span class="checkbox">
                        <label>
                            <input type="checkbox" id="excludechekbox" name="excludechekbox"> Exclude Weekends
                        </label>
                    </span>
                </div>
                <div id="fromtodates" class="ui-widget">
                    <label for="datepicker1">From: </label>
                    <input id="datepicker1" size="8" name="fromdate"/><span id="inlineDate1"></span>
                    <label for="datepicker2">To: </label>
                    <input id="datepicker2" size="8" name="todate"/><span id="inlineDate2"></span>
                </div>
                <div class="inout">
                    <label for="intime">IN</label>
                    <input type="time" id="intime" name="in" value="08:00">
                    <label for="outtime">OUT</label>
                    <input type="time" id="outtime" name="out" value="17:00">
                </div>
                <br>
                <div class="paycode">
                    <label for="paycode-select">Paycode: </label>
                    <select name="paycode" id="paycode-select">
                        <?php
                        foreach ($time_allocation as $id => $timecodeDesc) {
                            echo "<option value='" . $id . "'>" . $timecodeDesc . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="hrs">Hours: </label>
                <input id="hrs" value="9.00" name="hourslogged" placeholder="0.00" required size="3" type="text"/>
                <div class="comments">
                    <label for="cmts">Comments: </label>
                    <input id="cmts" name="comments" size="20"/>
                </div>
                <div class="submission">
                    <input type="submit" value="Submit" id="sub">
                    <input type="button" class="close-modal" value="Cancel" id="cncl">
                </div>
            </form>
        </div>
    </div>
    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close-modal2">&times;</span>
            <h4 id="aprrovetimesheet">Approve Timesheet</h4>
            <form name="myModalform2" method="post" action="approval-proc.php">

            </form>
        </div>
    </div>

    <h3>Time Sheet of week
    </h3><br>
    <?php if(isset($username)&&isset($erusername)) {?>
        <div class="hours">
            <button id="approve">APPROVE TIMESHEET</button>
        </div><?php }?>
    <?php if(isset($username)&&isset($erusername)) {?>
        <div class="hours">
            <button style="display: none" id="myBtn">ADD HOURS</button>
        </div><?php }?>
    <?php if(!isset($erusername)){?>
    <div class="hours">
        <button id="myBtn">ADD HOURS</button>
    </div><?php }?>
    <table class="table table-hover" style="display: inline">
        <thead>
        <tr>
            <th>Record ID</th>
            <th>Date</th>
            <th>Pay Code</th>
            <th>In</th>
            <th>Out</th>
            <th>Hours</th>
            <th>Total</th>
            <th>Notes</th>
            <th>
                <div class="col-md-1 col-lg-1">
                    <span class="glyphicon glyphicon-wrench more-toolbar" aria-hidden="true"></span>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        <?= $tablerows ?>
        <?php
        $totaloftimesheet = 0 ?>
        <tr>
            <td>
                <h4 style="font-family: 'Footlight MT Light'">Total</h4>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="padding-left: 25px">
                <?= number_format($totaloftimesheet + $totalHours, 2) ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
