<?php
session_start();
error_reporting(0);
if(isset($_SESSION['email']))
{
	$email    = $_SESSION['email'];
	$id=$_GET['id'];
$errors = array(); 
$db = mysqli_connect('localhost:3307', 'root', '', 'foodshala');
$query="INSERT INTO cart(email, dishid) VALUES('$email','$id')";
mysqli_query($db, $query);
echo "done";
 echo "<script>";
 echo "alert('Added to the cart Successfully!');";
echo "location='shop.php';";
echo "</script>";
}
else{
	header('location: userlogin.php');
}

?>
