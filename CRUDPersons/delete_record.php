<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}

# This process inserts a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();
include_once "layout_header.php";
# 3. assign MySQL query code to a variable
$id = $_GET['id'];
$sql = "DELETE FROM persons WHERE id = ?";
$query =$pdo->prepare($sql);
$query->execute(Array($id));

# 4. insert the message into the database
//$pdo->query($sql); # execute the query
echo "<p>Your person has been deleted</p><br>";
echo "<a href='display_list.php'>Back to list</a>";
include_once "layout_footer.php";