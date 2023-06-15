<?php
include '../connection.php';
?>
<?php

//echo $div_id;
$id=$_REQUEST['id'];
if(strlen($id)>=4)
{$str="SELECT * from teachers where id like '%$id'";
//echo $str;
$q=mysqli_query($conn,$str);
 $data=[];
while($row=mysqli_fetch_assoc($q))
{
    $obj=[];
    $obj['id']=$row['id'];
    $obj['fname']=$row['first_name'];
    $obj['email']=$row['email'];
    array_push($data,$obj);
}
}
header('Content-type: application/json');
echo json_encode($data);
?>