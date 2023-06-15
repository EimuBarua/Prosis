<?php
include '../connection.php';
?>
<?php

  $id=$_REQUEST['id'];
  $name=$_REQUEST['name'];
  $no=$_REQUEST['members'];
  $supervisor=$_REQUEST['supervisor'];
  $x='';
  for($i=1;$i<=$no;$i++)
  {
    if($i>1)
    $x=$x.'-';
    $x=$x.$name[$i];
    
  }
  //echo $x;
  $str="insert into groups (name,supervisor_id) value('$x',$supervisor)";
  //echo $str;
  mysqli_query($conn,$str);
  $str="SELECT * from groups where name='$x' ";
  $q=mysqli_query($conn,$str);
  $row=mysqli_fetch_assoc($q);
  $gid=$row['id'];
  
for($i=1;$i<=$no;$i++)
{
 // $idd=$id[$i];
  $str="insert into group_members  value($gid,$id[$i])";
  //echo $str;
 mysqli_query($conn,$str);
}

// // if(mysqli_query($conn,$str))
// // {
    header('Content-type: application/json; charset=utf-8');
    $data = ['succ'=>true];
echo json_encode($data);
// // }
?>