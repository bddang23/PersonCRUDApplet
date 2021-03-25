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
<h1>Update existing message</h1>
<form method='post' action='update_record.php?id=<?php echo $id ?>'>
    message: <input name='msg' type='text' value='<?php echo $result['message']; ?>' ><br />
    <input type="submit" value="Submit">
</form>