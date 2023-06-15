<?php
    session_start();
    $role=1;
    if($_SESSION['role']=='supervisor')
    $role=2;
    session_destroy();
    if($role==2)
    header('Location: supervisor/auth-supervisor.php');
    else
    header('Location: student/auth-student.php');
?>