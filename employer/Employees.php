<?php
$data = $_POST;
$employername = $_GET['username'];
$conn_employee = mysqli_connect("127.0.0.1", "root", "root", "timesheets", "3306");
$query_result = $conn_employee->query("select * from employee where employername = '" . $employername . "'");
$values = [];
while ($row = $query_result->fetch_assoc()) {
    $values[] = $row;
}
?>
<html lang="en">

<head><title>Employee List</title>

</head>

<body>
<h3> Welcome to Employees!</h3>
<h2> Select an employee to work with their timesheets!</h2>
<ol>
    <?php
    foreach ($values as $value) {
        echo "<li> <a href=\"employeetimesheet.php?username=" . $employername
            . "&employeecode=" . $value['employeecode'] . "> " . $value['employeename'] . "</a></li> ";
    }
    ?>
</ol>
</body>
</html>
