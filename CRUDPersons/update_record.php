<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
# This process updates a record. There is no display.
include_once "layout_header.php";
# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$id = $_GET['id'];

//sanatize data
$email = htmlspecialchars($email);
$fname = htmlspecialchars($fname);
$lname = htmlspecialchars($lname);
$phone = htmlspecialchars($phone);
$address = htmlspecialchars($address);
$address2 = htmlspecialchars($address2);
$city = htmlspecialchars($city);
$state = htmlspecialchars($state);
$zip_code = htmlspecialchars($zip_code);

$sql = 'SELECT `role` FROM persons '
. " WHERE email = ? "
. ' LIMIT 1';

$query =$pdo->prepare($sql);
$query->execute(Array($_SESSION['email']));
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result){
	$role =  $result['role'];
}
else{
	if (strpos($_SESSION['email'], "user", 0)===false){
			$role="admin";
	}
	else{
			$role="user";
	}
}

# 3. assign MySQL query code to a variable
$sql = "UPDATE persons SET email=?, role=?, fname=?, lname=?, phone=?, `address`=?, address2=?, city=?, `state`=?, zip_code=? WHERE id=?";
$query = $pdo->prepare($sql);
$query->execute(Array($email, $role, $fname, $lname, $phone, $address, $address2, $city, $state, $zip_code ,$id));

# 4. update the message in the database
//$pdo->query($sql); # execute the query
echo "<p>Your info has been updated</p><br>";
echo "<a href='display_list.php'>Back to list</a>";
include_once "layout_footer.php";