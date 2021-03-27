<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
# connect
require '../database/database.php';
$pdo = Database::connect();
include_once "layout_header.php";
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
    <button class="btn btn-info" type="submit" value="Yes">Yes</button>
</form>

<form method='post' action='display_list.php'>
    <button class="btn btn-danger"type="submit" value="No">No</button>
</form>

<?php
include_once "layout_footer.php";
?>