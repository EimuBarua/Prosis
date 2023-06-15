<?php
include '../connection.php';
?>
<?php

  $id=$_REQUEST['id'];
  $fname=$_REQUEST['fname'];
  $lname=$_REQUEST['lname'];
  $email=$_REQUEST['email'];
  $phone=$_REQUEST['phone'];
  $dob=$_REQUEST['dob'];
  $gender=$_REQUEST['gender'];
  $address=$_REQUEST['address'];
  $pass = $_REQUEST['pass'];
  $str="insert into teachers value($id,'$fname','$lname','$email','$phone','$dob','$gender','$address','$pass')";
  
   if(mysqli_query($conn,$str))
{
    header('Content-type: application/json; charset=utf-8');
    $data = ['succ'=>true];
echo json_encode($data);
}
?>