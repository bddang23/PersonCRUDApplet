<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "SELECT * FROM messages WHERE id= ?";
$query=$pdo->prepare($sql);
$query->execute(Array($id));
$result = $query->fetch();
?>
<h1>Delete Message "<?php echo $result['message'];?>"</h1>
<h2>Are you sure?</h2>
<form method='post' action='delete_record.php?id=<?php echo $id ?>'>
    <input type="submit" value="Yes">
</form>

<form method='post' action='display_list.php'>
    <input type="submit" value="No">
</form>

