<?php
$data = $_POST;
$employerusername=$data['username'];
$employerpassword=$data['password'];


$conn_employer= mysqli_connect("127.0.0.1", "root", "root", "timesheets","3306");
$query_result = $conn_employer->query("select * from employer");
$employers = [];
while($row = $query_result->fetch_assoc()){
    $employers[] = $row;
}
foreach ($employers as $employer) {
    if ($employerusername == $employer['employerusername'] && $employerpassword == $employer['employerpassword']) {
        header('Location: employerhome.php?username='.$employer['employerusername']);
        exit();
    }
}
echo "Invalid Login. Please click back and try again";

