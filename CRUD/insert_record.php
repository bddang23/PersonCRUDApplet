<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
# This process inserts a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$m = $_POST['msg'];
$m = htmlspecialchars($m);


# 3. assign MySQL query code to a variable
$sql = "INSERT INTO messages (message) VALUES (?)";
$query = $pdo->prepare($sql);
$query->execute(Array($m));

# 4. insert the message into the database
$pdo->query($sql); # execute the query
echo "<p>Your info has been added</p><br>";
echo "<a href='display_list.php'>Back to list</a>";