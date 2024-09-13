<?php
session_start();
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $role = $_POST['role'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $note = $_POST['note'];
    
    $query = "INSERT INTO meeting (`name`, `rollno`, `role`, `date`, `time`, `note`) VALUES('$name', '$rollno', '$role', '$date', '$time', '$note')";
    if(mysqli_query($connection, $query)){
        $_SESSION['success'] = "Meeting is scheduled";
        header('Location: meeting.php');
        exit();
    } else {
        $_SESSION['failed'] = "Something went wrong";
    }
}
   
?>