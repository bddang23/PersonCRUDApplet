<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
# This process inserts a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

$email = $_POST['email'];
$role = $_POST['role'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];

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

//check to make sure email is not there
$sql = "SELECT id FROM persons WHERE email = ?";
$query = $pdo->prepare($sql);
$query->execute(Array(
    $email
));
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result) {
    echo("Email <b>".$email."</b> already existed. Try Again!</br>");
    echo "<a href='display_create_form.php'>Back create form!</a>";
} else {
# 3. assign MySQL query code to a variable
$sql = "INSERT INTO persons (`role`, email, fname, lname, phone, `address`, address2, city, `state`, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute(Array(
    $role,
    $email,
    $fname,
    $lname,
    $phone,
    $address,
    $address2,
    $city,
    $state,
    $zip_code
));

# 4. insert the message into the database
//$pdo->query($sql); # execute the query
echo "<p>Your info has been added</p><br>";
echo "<a href='display_list.php'>Back to list</a>";
}