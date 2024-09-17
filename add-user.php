<?php
session_start();
function generatePassword($length = 9) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nums = '0123456789';
    $specialChars = '!@#$%^&*()-_+=~`[]{}|;:,.<>?';

    $password = '';

    // Choose at least one character from each category
    
    // Fill the rest of the password with random characters
    $remainingLength = $length - 3;
    for ($i = 0; $i < 3; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
        $password .= $nums[rand(0, strlen($nums) - 1)]  ;
        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];
    }
    // Shuffle the password to make it more random
    $password = str_shuffle($password);

    return $password;
}

$pass = generatePassword();

$connection = mysqli_connect("localhost", "root", "", "mysqli_fyp");

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $contactno = $_POST['contactno'];
    $regno = $_POST['regno'];
    $delegation = $_POST['delegation'];
    $role = $_POST['role'];

    if (!empty($name) && !empty($email) && !empty($cnic) && !empty($contactno) && !empty($role)) {
        $password = generatePassword(8);    

        $query = "INSERT INTO user (`name`, email, cnic, `password` , contactno, regno, delegation, `role`) VALUES ('$name', '$email', '$cnic', '$password' ,'$contactno', '$regno', '$delegation', '$role')";

        if(mysqli_query($connection, $query)) {
            $_SESSION['data-inserted'] = "User Added successfully!";
            if ($role === 'student') {
                header('Location: students.php');
                
            } elseif ($role === 'supervisor') {
                header('Location: supervisor.php');
            }
            elseif ($role === 'admin') {
                header('Location: admin-dashboard.php');
            }
        } else {
            $_SESSION['not_insert'] = "Data not inserted!";
        }
    } else {
        $_SESSION['required'] = "Please enter all the required fields";
    }
}
?>

