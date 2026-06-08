
<link rel="stylesheet" href="login.css">

<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM doctors WHERE username='$username'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            header("Location: dashboard.php");
        } else {
            echo "Wrong password";
        }
    } else {
        echo "User not found";
    }
}
?>

<div class="login-container">
    <h2>🔐 Doctor Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <a href="#">Forgot Password?</a>
</div>
