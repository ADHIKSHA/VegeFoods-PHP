<?php
session_start();
$email    = "";

$password = "";

$errors = array(); 
$db = mysqli_connect('localhost:3307', 'root', '', 'foodshala');

if(isset($_SESSION['type'])=="restaurant")
{
  echo("<script>alert('already logged in as a Restaurant owner!');
    window.location.replace('addmenu.php');
    </script>");
}

else if(isset($_SESSION['type'])=="user")
{
  echo("<script>alert('already logged in as a user! Log out first.');
    window.location.replace('index.php');
    </script>");
}

else
{
if (isset($_POST['login'])) {
  // receive all input values from the form
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM restaurants WHERE email='$email' AND password='$password' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $log=0;
  if ($user) { // if user exists
    if ($user['email'] === $email) {

    if ($user['password'] === $password) {
       $_SESSION['resid'] = $user['resid'];
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['type'] = "restaurant";
      $log=1;
      header('location: addmenu.php');
    }
  }
  }
  if($log==0){
    array_push($errors, "Wrong username/password combination");}
}

// REGISTER USER
if (isset($_POST['register'])) {
  $ownname = "";
$email    = "";
$resname = "";
$country    = "";
$add1 = "";
$add2    = "";
$phone = "";
$city    = "";
$password = "";
$location    = "";
$resid="";
$errors = array(); 
$dishids=array();
  // receive all input values from the form
  $resname = mysqli_real_escape_string($db, $_POST['resname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $ownname = mysqli_real_escape_string($db, $_POST['ownname']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
    $location = mysqli_real_escape_string($db, $_POST['location']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $add1 = mysqli_real_escape_string($db, $_POST['add1']);
  $add2 = mysqli_real_escape_string($db, $_POST['add2']);
 // $resid=
  $postcode = mysqli_real_escape_string($db, $_POST['postcode']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($resname)) { array_push($errors, "Username is required");  echo "Username required";}
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM restaurants WHERE res_name='$resname' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['res_name'] === $resname) {
      echo "Username exists";
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database

    $query = "INSERT INTO restaurants (res_name, owner_name, country,streetadd1,streetadd2,city,postcode,phone,email,location,password) 
              VALUES('$resname', '$ownname', '$country','$add1', '$add2', '$city','$postcode', '$phone', '$email','$location','$password')";
    mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['type'] = "restaurant";
    $user_check_query = "SELECT * FROM restaurants WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $log=0;
    if ($user) { // if user exists
       $_SESSION['resid'] = $user['resid'];
      }
}
} }

?>