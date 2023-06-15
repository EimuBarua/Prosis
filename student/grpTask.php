<?php include '../connection.php'; ?>
<?php
    $date=$_REQUEST['date'];
    $grpId=$_REQUEST['gId'];
    // echo $grpId;
    // echo $date;
    $str="SELECT * FROM task WHERE date='".$date."'AND group_id=".$grpId.";";
    // echo $str;
    $q=mysqli_query($conn,$str);
    $data=[];
    while($row=mysqli_fetch_array($q)){
        // print_r($row);
        // echo $row['id'].' '.$row['name'].'<br>';
        $obj=[];
        $id=$row['id'];
        $group_id=$row['group_id'];
        $date=$row['date'];
        $task_details=$row['task_details'];
        $task_description=$row['task_description'];
        $student_id=$row['student_id'];
        $status=$row['status'];

        if($student_id != null){
            $str2="SELECT * FROM students WHERE id=".$student_id.";";
            $q2=mysqli_query($conn,$str2);
            $row2=mysqli_fetch_array($q2);
            $students_name=$row2['first_name'];
            $obj['student_name']=$students_name;
        }
        // print_r($row2);

        $obj['id']=$id;
        $obj['group_id']=$group_id;
        $obj['date']=$date;
        $obj['task_details']=$task_details;
        $obj['task_description']=$task_description;
        
        $obj['status']=$status;

        array_push($data,$obj);

        // echo $row['id'];
    }
    // print_r($data);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
?>