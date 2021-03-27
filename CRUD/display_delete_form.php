<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "SELECT * FROM persons WHERE id= ?";
$query=$pdo->prepare($sql);
$query->execute(Array($id));
$result = $query->fetch();
?>
<h1>Delete <?php echo $result['fname'] . " " . $result['lname'] ;?></h1>
<h2>Are you sure?</h2>
<form method='post' action='delete_record.php?id=<?php echo $id ?>'>
    <input type="submit" value="Yes">
</form>

<form method='post' action='display_list.php'>
    <input type="submit" value="No">
</form>

