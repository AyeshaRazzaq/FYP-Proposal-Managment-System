<?php
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');

session_start();

if(isset($_POST['delete']) && isset($_POST['id'])){
    $id = $_POST['id'];
    $query = mysqli_query($connection,"DELETE FROM user WHERE id = $id");
    if($query){
        header('Location: students.php');
        $_SESSION['delstudent'] = "Delete user Successfully!!";
        exit();
    }
    else{
        $_SESSION['notdel'] = "user Not Deleted!!";    }
}
else{
    echo "Invalid request";
}
?>
