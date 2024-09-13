<?php
session_start();
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
if (isset($_POST['submit'])) {
    $_email = $_POST['email'];
    $_password = $_POST['password'];
    
    $query = "SELECT * FROM user WHERE email = '$_email' AND password = '$_password'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['role'] === 'student') {
            $_SESSION['user_data'] = $user;
            header('Location:student/Student-dashboard.php');
            exit(); 
        } else if ($user['role'] === 'supervisor') {
            $_SESSION['user_data'] = $user;
            header  ('Location:Supervisor/supervisor-dashboard.php');
            exit(); 
        }
        else if ($user['role'] === 'admin') {

            $_SESSION['user_data'] = $user;
            header('Location:admin-dashboard.php');
            exit(); 
        }
         else {
            echo "Unknown role";
        }
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid request";
}
?>