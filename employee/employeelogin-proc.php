<?php
$data = $_POST;
$employeelogin=data['employeeusername'];
$employeepassword=data['employeepassword'];


$conn_employee= mysqli_connect("127.0.0.1", "root", "root", "timesheets","3306");
$query_result = $conn->query("select *from employee");
$employees = [];
while($row = $query_result->fetch_assoc()){
    $users[] = $row;
}
foreach ($employees as $employee) {
    if ($username == $employee['employeeusername'] && $password == $employee['password']) {
        header('Location: home.php?username='.$employee['employeeusername']);
        exit();
    }
}
echo "Invalid Login. Please click back and try again";

