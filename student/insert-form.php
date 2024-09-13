<?php
session_start();
$connection = mysqli_connect("localhost" , "root" , "" , "mysqli_fyp");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $class = $_POST['class'];
    $role = $_POST['role'];
    $regno = $_POST['regno'];
    $rollno = $_POST['rollno'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $module1 = $_POST['module1'];
    $module2 = $_POST['module2'];
    $module3 = $_POST['module3'];
    $ftools = $_POST['f-tools'];
    $btools = $_POST['b-tools'];
    $status = "pending";

    $query = "UPDATE proposals SET status = 'pending' WHERE status IS NULL OR status = ''";
    $query = "INSERT INTO proposals (`name`, `class`, `role`, `regno`, `rollno`,  `email`, `title`, `abstract`, `module1`, `module2`, `module3`, `f-tools`, `b-tools`, `status`) 
              VALUES ('$name', '$class', '$role', '$regno', '$rollno', '$email', '$title', '$abstract', '$module1', '$module2', '$module3', '$ftools', '$btools', '$status')";

    if(mysqli_query($connection, $query)){
        $_SESSION['submit'] = "Proposal submitted successfully";
        header('Location: proposal-submission.php');
    } else {
        echo "proposal not Submitted: " . mysqli_error($connection);
    }
}
?>

