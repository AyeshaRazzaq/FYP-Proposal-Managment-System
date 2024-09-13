<?php
session_start();

$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
$sup_id = $_POST['id'];
$sup_name = $_POST['name'];
$sup_email = $_POST['email'];
$sup_delegation = $_POST['delegation'];
$sup_contactno = $_POST['contactno'];
$sup_cnic = $_POST['cnic'];
$sup_password = $_POST['password'];

$sql = "UPDATE user SET name = '{$sup_name}', email = '{$sup_email}', delegation = '{$sup_delegation}', contactno = '{$sup_contactno}', cnic = '{$sup_cnic}', `password` = '{$sup_password}' WHERE id = '{$sup_id}'";
$result = mysqli_query($connection,$sql);
if(isset($sql))
{
    header('Location:supervisor.php');
    $_SESSION["alert_update"] = "Data Updated Successfully";
}
else{
   $_SESSION["alert_not_update"] ="Data not updated"; 
}
?>