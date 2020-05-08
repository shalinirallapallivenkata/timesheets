<?php

include_once __DIR__ . "/../app/config.php";
$data = $_GET;
$username = $data['erusername'];
global $conn;
$employees = [];
$query_result = $conn->query("select username from users where employername=" . "'$username'");
while ($row = $query_result->fetch_assoc()) {
    $employees[] = $row;
}
?>

<html>
<head>
<body>
<H1 style="padding-bottom: 30px">Employees of <?= $username ?></H1>
<table>
    <thead></thead>
    <tbody>
    <div>
        <span name="approvetimesheet">
        <?php
        foreach ($employees as $employee) { ?>
            <tr><td style="font-size: 20px">
                    <a href="/../timesheets/employee/timesheet.php?eeusername=<?= $employee['username'] ?>&erusername=<?=$username?>">
                    <?= $employee['username'] ?></a></td><tr>
            <?php
            } ?>
            </span>
    </div>
    </tbody>
</table>
</body>
</head>

</html>
