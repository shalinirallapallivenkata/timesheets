<?php

include_once __DIR__ . "/../app/config.php";
?>
<html>
<head>
    <script src="js/createemployee.js" type="text/javascript"></script>
    <style>


        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 20%;
            opacity: 0.9;
            float: left;
        }

        input[value=Cancel] {
            background-color: #f44336;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 20%;
            opacity: 0.9;
        }
        label{
            margin-right:70px;
            display: inline-block;
            padding-bottom: 30px;
            alignment: right;
        }
        input[type=button]{
            margin-right: 70px;
        }
        .requiredastrix {
            color: red;
        }

    </style>
</head>
<body>
<?php
$erusername=$_GET['username'];
?>
?>
<h1> Create Employee by <?= strtoupper($erusername)?></h1>
<div class="container" style="display: inline">
<form method="post" action="createemployee-proc.php" autocomplete="off">
    <input type="hidden" name="username" value="<?=$erusername?>">
    <div class="row-md-12">
        <div class="col-md-6">
            <label><span class="requiredastrix">*</span> First Name:</label>
            <input type="text" name="firstname" required>
            <br>
            <label>Middle Name:</label>
            <input type="text" name="middlename">
            <br>
            <label><span class="requiredastrix">*</span>Last Name:</label>
            <input type="text" name="lastname" required>
            <br>
            <label>Start Date:</label>
            <input type="date" name="startdate" style="font-size:15px">
            <br>
            <label>Employer Name:</label>
            <input type="text" name="employername" value="<?=$erusername?>">
            <br>
            <input type="submit" value="Submit">



        </div>
        <div class="col-md-6">

            <label>Address:</label>
            <input type="text" name="address">
            <br>
            <label><span class="requiredastrix">*</span>Contact Number</label>
            <input type="phone" name="contactnumber" required>
            <br>
            <label><span class="requiredastrix">*</span>Email</label>
            <input type="email" name="employeremail" required>
            <br>
            <label>Start Time:</label>
            <input type="time" name="starttime" style="font-size: 15px" ><br>
            <input type="button" class="cancelbtn" value="Cancel">

        </div>


    </div>
</form>
</div>
</body>
</html>