<?php
session_start();
$connection = mysqli_connect("localhost" , "root" , "" , "mysqli_fyp");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $supervisor = $_POST['supervisor'];
    $note = $_POST['note'];

    $query = "INSERT INTO chat (`name`, `supervisor`, `note`) 
              VALUES ('$name', '$supervisor', '$note')";

    if(mysqli_query($connection, $query)){
        $_SESSION['submit'] = "Proposal submitted successfully";
        header('Location: chat.php');
    } else {
        echo "proposal not Submitted: " . mysqli_error($connection);
    }
}
?>