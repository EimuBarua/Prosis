<?php
include '../connection.php';
?>
<?php 

if ( $_FILES['policy_image']['error'] > 0 ){
    echo 'Error: ' . $_FILES['policy_image']['error'] . '<br>';
}
else {
// if(move_uploaded_file($_FILES['policy_image']['tmp_name'], 'uploads/' . $_FILES['policy_image']['name']))
// {
    // 
    $id=$_REQUEST['id'];
  $fname=$_REQUEST['fname'];
  $lname=$_REQUEST['lname'];
  $email=$_REQUEST['email'];
  $phone=$_REQUEST['phone'];
  $dob=$_REQUEST['dob'];
  $gender=$_REQUEST['gender'];
  $address=$_REQUEST['address'];
  $pass = $_REQUEST['pass'];


    $filename=$_FILES['policy_image']['name'];
        
        
    $fileerror=$_FILES['policy_image']['error'];
    
    $filetmp=$_FILES['policy_image']['tmp_name'];
    

    $fileext=explode('.',$filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored=array('png', 'jpg', 'jpeg');
    if(in_array($filecheck,$fileextstored)){
        $destinationfile='uploads/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);
    

        echo $fname;
        $batch =substr($id,2,3);
        $session='';

        $str="insert into students value($id,'$fname','$lname','$email','$phone','$session','$batch','$dob','$gender','$address','$pass','$destinationfile')";
         echo $str;
        if(mysqli_query($conn,$str))
        {
            header('Content-type: application/json; charset=utf-8');
            $data = ['succ'=>true];
            echo json_encode($data);
        }
}
}


?>


 
  
  