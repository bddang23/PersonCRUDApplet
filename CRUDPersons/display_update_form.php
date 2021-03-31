<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
# connect
require '../database/database.php';
$pdo = Database::connect();
include_once "layout_header.php";

//find role
$sql = 'SELECT * FROM persons '
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



# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "SELECT * FROM persons WHERE id= ?";
$query=$pdo->prepare($sql);
$query->execute(Array($id));
$result = $query->fetch();

if($_SESSION['email']!='admin@admin.com' || $role!='admin'){
    if ($_SESSION['email'] != $result['email']){
            echo "<p><b>Cannot update other's account!</b></p>";
            echo "<a href='display_list.php'>Back to list</a>";
            exit();
    }
}

?>

<h1>Update existing person</h1>

<form method='post' action='update_record.php?id=<?php echo $id ?>'>
    Email:      <input name='email' type='text' value='<?php echo $result['email'];?>'> </br>
    Role:       <?php 
                        $userSelected="";
                        $adminSelected="";
                        
                    if($role == 'admin' && $result['email'] != $_SESSION['email']){
                            if ($result['role'] =='user')
                                $userSelected = "selected";
                            else if ($result['role']=='admin')
                                $adminSelected = "selected";
                           
                        echo "<select name='role'> \n
                        <option value='user' " . $userSelected ." >User</option> \n
                        <option value='admin' ". $adminSelected .">Admin</option> \n
                        </select> </br>";
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
    <input class="btn btn-info" type="submit" value="Submit">
</form>
<?php
include_once "layout_footer.php";
?>