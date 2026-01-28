<?php
if (!isset($_SESSION['user_id'])) 
{
header("Location:phpincludes/logout.php");
}
$user_id=$_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_level = $_SESSION['user_level'];
?>