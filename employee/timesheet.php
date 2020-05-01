<?php

include_once __DIR__ . "/../app/config.php";
$username = $_GET['username'];
$timecode_desc = [];
$query_res = $conn->query("select timecode_desc from timecodes");
while ($t = $query_res->fetch_assoc()) {
    $timecode_desc[] = $t;
}
foreach ($timecode_desc as $time) {
    $time_allocation[] = $time['timecode_desc'];
}
?>
<html>
<head>

    <script type="text/javascript" src="js/timesheets.js"></script>
    <link rel="stylesheet" href="css/timesheets.css">

</head>
<body>
<h1 align="center"> Time Sheet of <?php
    echo $username ?></h1>
<div class="container">
    <div class="hours">
    <button id="myBtn">ADD HOURS</button></div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4 id="addhrs">Add Hours</h4>
            <div class="header">
            <p class="days">Day(s)</p>
            <span class="checkbox">
                <label>
                    <input type="checkbox" required> Exclude Weekends
                </label>
            </span>
            </div>
            <br>
            <div id="container" class="ui-widget">
                <label for="datepicker1">From: </label>
                <input id="datepicker1" size="8"/><span id="inlineDate1"></span>
                <label for="datepicker2">To: </label>
                <input id="datepicker2" size="8"/><span id="inlineDate2"></span>
            </div>
            <div class="paycode">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Pay Code
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($time_allocation as $time){ ?>
                    <li><a href="">
                            <?php
                            echo $time;
                            } ?>
                        </a></li>
                </ul>
            </div>
            <label for="hrs">Hours: </label>
            <input id="hrs" type="text" placeholder="8.00" size="3"/>
            <div class="comments">
                <label for="cmts">Comments: </label>
                <input id="cmts" size="20"/>
            </div>
        </div>
    </div>

    <table class="table table-hover" style="display: inline">
        <tr>
            <th>Pay Code</th>
            <th>In</th>
            <th>Out</th>
            <th>Hours</th>
            <th>Total</th>
            <th>
                <div class="col-md-1 col-lg-1">
                    <span class="glyphicon glyphicon-wrench more-toolbar" aria-hidden="true"></span>
                </div>
            </th>
        </tr>
        <tr>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Time
                        allocation
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($time_allocation as $time){ ?>
                        <li><a href="">
                                <?php
                                echo $time;
                                } ?>
                            </a></li>
                    </ul>
                </div>
            </td>
            <div class="row">
            <td>
                <div class="col">
                    <input type="text" placeholder="8.00" class="hoursentry" name="h" required>
                </div>
            </td>
            <td><div class="col-sm-3">
                    <input type="text" placeholder="8.00" class="hoursentry" name="h" required>
                </div>
            <td>
                <div class="col-sm-3">
                    <input type="text" placeholder="8.00" class="hoursentry" name="h" required>
                </div></td>
            </td>


            <td>
                <div class="col-sm-3" >
                    <input type="text" class="totalhours" name="total">
                </div></td>
            </td>
            <td>
                <div class="col-sm-3">
                    <a href="#" id="deleterecord">
                        <span class="glyphicon glyphicon-trash"></span></a>
                </div></td>
            </td>
            </div>
        </tr>
</div>
</table>
</body>
</html>