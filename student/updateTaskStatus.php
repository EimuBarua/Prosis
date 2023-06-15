<?php include '../connection.php'; ?>
<?php
    $taskId=$_REQUEST['taskId'];
    $studentId=$_REQUEST['studentId'];
    $status=$_REQUEST['status'];
    // echo $grpId;
    // echo $date;
    // $str="SELECT * FROM task WHERE date='".$date."'AND group_id=".$grpId.";";
    $str="    UPDATE task
    SET status = $status, student_id = $studentId
    WHERE id=$taskId";
    // echo $str;
    $q=mysqli_query($conn,$str);
    
    $str2="SELECT * FROM task WHERE id=$taskId";
    // echo $str;
    $q2=mysqli_query($conn,$str2);
    $row2=mysqli_fetch_array($q2);
    // print_r($row);


    $str3="SELECT * FROM students WHERE id=".$row2['student_id'].";";
    $q3=mysqli_query($conn,$str3);
    $row3=mysqli_fetch_array($q3);
    

    $obj=[];

    $obj['id']=$row2['id'];
    $obj['group_id']=$row2['group_id'];
    $obj['date']=$row2['date'];
    $obj['task_details']=$row2['task_details'];
    $obj['task_description']=$row2['task_description'];
    $obj['status']=$row2['status'];
    $obj['students_name']=$row3['first_name'];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($obj);
?>