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

<h1>Update existing message</h1>
<form method='post' action='update_record.php?id=<?php echo $id ?>'>
    Email:      <input name='email' type='text' value='<?php echo $result['email'];?>'> </br>
    Role:       <?php if( $result['role'] == 'admin'){
                        echo '<select name="role"> \n
                        <option value="user">User</option> \n
                        <option value="admin">Admin</option> \n
                        </select> </br>';
                    }
                    else {
                        echo "<input name='role' type='text' value='" . $result['role'] ."'; disabled > </br>";
                    } 
                ?>

    First name: <input name='fname' type='text' value='<?php echo $result['fname'];?>'  > </br>
    Last name:  <input name='lname' type='text' value='<?php echo $result['lname'];?>'  > </br>
    Phone:      <input name='phone' type='text' value='<?php echo $result['phone'];?>'  > </br>
    Address:    <input name='address' type='text' value='<?php echo $result['address'];?>'  > </br>
    Address 2:  <input name='address2' type='text' value='<?php echo $result['address2'];?>'  > </br>
    City:       <input name='city' type='text' value='<?php echo $result['city'];?>'  > </br>
    State:      <input name='state' type='text' value='<?php echo $result['state'];?>'  > </br>
    Zip Code:   <input name='zip_code' type='text' value='<?php echo $result['zip_code'];?>'  > </br>
    <input type="submit" value="Submit">
</form>