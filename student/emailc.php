<?php
include '../connection.php';
?>
<?php

//echo $div_id;
$id=$_REQUEST['id'];
echo $id;
if(strlen($id)>=4)
{$str="SELECT * from students where email like '$id'";
//echo $str;
$q=mysqli_query($conn,$str);
 $data=[];
while($row=mysqli_fetch_assoc($q))
{
    $obj=[];
    $obj['email']=$row['email'];
    array_push($data,$obj);
}
print_r($data);
}
header('Content-type: application/json');
echo json_encode($data);
?>