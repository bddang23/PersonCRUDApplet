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
<h1>Read/view existing message</h1>
<form method='post' action='display_list.php'>
    Email:      <input name='email' type='text' value='<?php echo $result['email'];?>' disabled > </br>
    Role:       <input name='role' type='text' value='<?php echo $result['role'];?>' disabled > </br>
    First name: <input name='fname' type='text' value='<?php echo $result['fname'];?>' disabled > </br>
    Last name:  <input name='lname' type='text' value='<?php echo $result['lname'];?>' disabled > </br>
    Phone:      <input name='phone' type='text' value='<?php echo $result['phone'];?>' disabled > </br>
    Address:    <input name='address' type='text' value='<?php echo $result['address'];?>' disabled > </br>
    Address 2:  <input name='address2' type='text' value='<?php echo $result['address2'];?>' disabled > </br>
    City:       <input name='city' type='text' value='<?php echo $result['city'];?>' disabled > </br>
    State:      <input name='state' type='text' value='<?php echo $result['state'];?>' disabled > </br>
    Zip Code:   <input name='zip_code' type='text' value='<?php echo $result['zip_code'];?>' disabled > </br>
    <input type="submit" value="Return to Display List">
</form>

