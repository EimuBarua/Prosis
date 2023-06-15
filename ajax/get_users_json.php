<?php
/* get all users list in json for autocomplete */
include 'connection.php';

// $users = $conn->query("select * from user");
$str="SELECT * FROM students";

$users=mysqli_query($conn,$str);
// $e=mysqli_fetch_assoc($user);
$user_data = array();
foreach($users as $key => $val)
{
	$user_data[$key]['id'] = $val['id'];
	$user_data[$key]['name'] = $val['first_name'].' '.$val['last_name'];
	$user_data[$key]['avatar'] = $val['user_profile_url'];
	$user_data[$key]['type'] = 'user';
}

header('Content-Type: application/json');
echo json_encode($user_data);
?>