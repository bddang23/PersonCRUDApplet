<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
# This process updates a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$m = $_POST['msg'];
$id = $_GET['id'];

# 3. assign MySQL query code to a variable
$sql = "UPDATE messages SET message=? WHERE id=?";
$query = $pdo->prepare($sql);
$query->execute(Array($m, $id));

# 4. update the message in the database
$pdo->query($sql); # execute the query
echo "<p>Your info has been added</p><br>";
echo "<a href='display_list.php'>Back to list</a>";