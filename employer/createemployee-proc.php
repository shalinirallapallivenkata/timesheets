<?php
$username=$_POST['username'];
include_once __DIR__ . "/../app/config.php";
include_once __DIR__ . "/../app/constants.php";
global $firstname, $conn, $middlename, $lastname, $address, $company,
       $employeeusername, $employeepassword, $contactnumber, $startdate, $starttime;


$queryString = "insert into users (
`username`,
`password`,
`firstname`,
`middlename`,
`lastname`,
`address`,
`contactnumber`,
`employername`,
`startdate`,
`starttime`,                  
`user_role`) values (
                     '" . $employeeusername . "',
                     '" . $employeepassword . "',
                     '" . $firstname . "',
                     '" . $middlename . "',
                     '" . $lastname . "',
                     '" . $address . "',
                     '" . $contactnumber . "',
                     '" . $employername . "',
                     '" . $startdate . "',
                     '" . $starttime . "',
                     '" . ROLE_EMPLOYEE . "'
)";


$result = $conn->query($queryString);
if (mysqli_affected_rows($conn) > 0) {
    echo "Employee has been created successfully!";
} else {
    echo "Employee creation failed!";
}
?>
