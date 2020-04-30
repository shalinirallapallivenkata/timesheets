<?php
include_once __DIR__ . "/config.php";
//$data = $_GET;
$data = $_POST;

$username = $data['username'];
$password = $data['password'];
global $conn;
/** @var mysqli_result $query_result */
$query_result = $conn->query("select * from users");
$users = [];
while($row = $query_result->fetch_assoc()){
    $users[] = $row;
}
foreach ($users as $user) {
    if ($username == $user['username'] && $password == $user['password']) {
        header('Location: home.php?username='.$user['username']);
        exit();
    }
}
echo "Invalid Login. Please click back and try again";