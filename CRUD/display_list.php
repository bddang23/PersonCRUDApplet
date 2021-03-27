<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}

echo "<h1>Messages List</h1>";
# connect
require '../database/database.php';
$pdo = Database::connect();


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



//show what session
echo 'Login as <b>'. $role . '</b> with email <b>' .  $_SESSION['email'] . '</b> </br></br>'; 

# display link to "create" form
if($role=='admin'){
	echo "<a href='display_create_form.php'>Create</a><br><br>";
}

//logout link
echo "<a style='color: green' href='logout.php'>LOGOUT</a> <br> <br>";


# display all records
$sql = 'SELECT * FROM persons';
foreach ($pdo->query($sql) as $row) {
	$str = "";
	$str .= "<a href='display_read_form.php?id=" . $row['id'] . "'>Read</a> ";
	
	if($role=='admin' || $_SESSION['email'] == $row['email']){
		$str .= "<a href='display_update_form.php?id=" . $row['id'] . "'>Update</a> ";
		$str .= "<a href='display_delete_form.php?id=" . $row['id'] . "'>Delete</a> ";
	}

    $str .= ' (' . $row['id'] . ') ' . $row['fname'] . " " . $row['lname'] . " - " . $row['email'];
	$str .=  '<br>';
	echo $str;
}

echo '<br />';
