<?php
session_start();

$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
$stu_id = $_POST['id'];
$stu_name = $_POST['name'];
$stu_email = $_POST['email'];
$stu_regno = $_POST['regno'];
$stu_contactno = $_POST['contactno'];
$stu_cnic = $_POST['cnic'];
$stu_password = $_POST['password'];

$sql = "UPDATE user SET name = '{$stu_name}', email = '{$stu_email}', regno = '{$stu_regno}', contactno = '{$stu_contactno}', cnic = '{$stu_cnic}', `password` = '{$stu_password}' WHERE id = '{$stu_id}'";
$result = mysqli_query($connection,$sql);
if(isset($sql))
{
    header('Location:students.php');
    $_SESSION["alert_update"] = "Data Updated Successfully";
}
else{
   $_SESSION["alert_not_update"] ="Data not updated"; 
}
?>