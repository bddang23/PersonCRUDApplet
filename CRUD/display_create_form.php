<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
?>
<h1>Create/add new person</h1>
<form method='post' action='insert_record.php'>
    Email: <input name='email' type='text' > </br>
    Role: <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
          </select> </br>
    First name: <input name='fname' type='text'> </br>
    Last name: <input name='lname' type='text'> </br>
    Phone: <input name='phone' type='tel'> </br>
    Address: <input name='address' type='text'> </br>
    Address 2: <input name='address2' type='text'> </br>
    City: <input name='city' type='text'> </br>
    State: <input name='state' type='text'> </br>
    Zip Code: <input name='zip_code' type='text'> </br></br> 
    <input type="submit" value="Submit">
</form>