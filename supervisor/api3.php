<?php
include '../connection.php';
?>
<?php

//echo $div_id;

$sid=$_REQUEST['id'];
$data=[];
if(strlen($sid)>=4)
{
$str="SELECT * from group_members where student_id like '%$sid'";
//echo $str;
$q=mysqli_query($conn,$str);
while($row=mysqli_fetch_assoc($q))
{
    $obj=[];
    $obj['id']=$row['student_id'];
    array_push($data,$obj);
}
}
///echp strlen($data);

header('Content-type: application/json');
echo json_encode($data);
?>