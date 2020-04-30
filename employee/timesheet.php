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
    <style>
        th {
            background-color: steelblue;
            color: #f1f1f1;
            font-family: "Calibri Light";
            font-size: large;
            text-align: center;
        }
        input[type=text]{
            max-width: 40px;
            border: #666666 1px solid;
            display: inline;
        }
        input[name=h8]{
            background-color: #4CAF50;
            color: #f1f1f1;
        }
    </style>
</head>
<body>
<h1 align="center"> Time Sheet of <?php
    echo $username ?></h1>
<div class="container">
    <table class="table table-hover" style="display: inline">
        <tr>
            <th>Project</th>
            <th>Task</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thurs</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
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
                    <button class="dropdown-toggle.btn-primary:hover" type="button" data-toggle="dropdown">Project
                        Selection
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="1">Project 1</a></li>
                        <li><a href="2">Project 2</a></li>
                        <li><a href="3">Project 3</a></li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="dropdown">
                    <button class="dropdown-toggle.btn-primary:hover" type="button" data-toggle="dropdown">Time
                        allocation
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($time_allocation

                        as $time){ ?>
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
                    <input type="text" placeholder="8.00" name="h" required>
                </div>
            </td>
            <td><div class="col-sm-3">
                    <input type="text" placeholder="8.00" name="h" required>
                </div></td>
            <td><div class="col-sm-3">
                    <input type="text" placeholder="8.00" name="h" required>
                </div></td>
            <td><div class="col-sm-3">
                    <input type="text" placeholder="8.00" name="h" required>
                </div></td>
            <td><div class="col-sm-3">
                    <input type="text" placeholder="8.00" name="h" required>
                </div></td>
            <td><div class="col-sm-3">
                    <input type="text"  placeholder="8.00" name="h" required>
                </div></td>
            <td>
                <div class="col-sm-3">
                    <input type="text" placeholder="8.00"  name="h" required>
                </div></td>
            </td>


            <td>
                <div class="col-sm-3" >
                    <input type="text" name="total">
                </div></td>
            </td>
            <td>
                <div class="col-sm-3">
                    <input type="text" name="maint" onclick=add()>
                </div></td>
            </td>
            </div>
        </tr>
</div>
</table>
</body>
</html>