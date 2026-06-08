<?php
include('config/db.php');

$username = "doctor1";
$password = password_hash("doctor123", PASSWORD_DEFAULT);

$sql = "INSERT INTO doctors (username, password, role)
        VALUES ('$username', '$password', 'doctor')";

$conn->query($sql);
echo "User created!";
?>