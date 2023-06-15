<?php include '../connection.php'; ?>


<?php 

 $date=$_REQUEST['date'];
 $name=$_REQUEST['name'];
 $grpId=$_REQUEST['grpId'];
 $description=$_REQUEST['description'];
//  echo $date;
//  print_r($name);

 for($i=0;$i<count($name);$i++){
        $str="INSERT INTO task (group_id,date,task_details,task_description,status)
        VALUES($grpId,'".$date."','".$name[$i]."','".$description[$i]."',0);";
       //  echo $str;
        $members=mysqli_query($conn,$str);
 }
 

$data=['success'=>'ok'];
header('Content-Type: application/json; charset=utf-8');

echo json_encode($data);


?>