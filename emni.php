<?php
include 'connection1.php';
session_start();
?>
<?php
 echo $_SESSION['id'].' '.$_SESSION['role'];

?>