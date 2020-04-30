<?php
include_once __DIR__ . "/config.php";
include_once __DIR__ . "/constants.php";
$username = $_GET['username'];

$query_result = $conn->query("select * from users where username =\"" . $username . "\"");
$user = $query_result->fetch_assoc();

$ROLE_MAP = [
    1 => "Admin",
    2 => "Employer",
    3 => "Employee",
];

?>

<html>

<head>
    <style type="text/css">
        ul.contents {
            list-style-type: square;
        }
    </style>
</head>
<body>

<div align="center">
    <h1> <?=$ROLE_MAP[$user['user_role']]?> Home</h1>
    <br>
    <h2>Welcome <?php echo $username, "!" ?></h2>
    <br>
</div>
<ul class="contents">
    <?php

    ?>
    <?php if ($user['user_role'] == ROLE_ADMIN): ?>
        <li>
            <a href="../admin/createemployer.php?username=<?= $_GET['username'] ?>">Create Employer</a>
            <!--        <a href="createemployer.php">Create Employer</a>-->
        </li>
    <?php endif; ?>
    <?php if ($user['user_role'] == ROLE_EMPLOYER): ?>
        <li>
            <a href="../employer/createemployee.php?username=<?= $_GET['username'] ?>">Create Employee</a>
            <!--        <a href="createemployee.php">Create Employer</a>-->
        </li>
    <?php endif; ?>
    <?php if ($user['user_role'] == ROLE_EMPLOYER || $user['user_role'] == ROLE_EMPLOYEE): ?>
        <li>
            <a href="../employee/timesheet.php?username=<?= $_GET['username'] ?>">Timesheet</a>
            <!--        <a href="createemployee.php">Create Employer</a>-->
        </li>
    <?php endif; ?>
</ul>
</body>

</html>

