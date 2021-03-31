<?php include_once "layout_header.php";?>
<h1>Register New User</h1>
<?php
error_reporting(0);
if($_GET['err']=='empty')
    echo "<p style='color:red'>All fields REQUIRED. Try Again!</p></br>";
else if($_GET['err']=='invalidEmail')
    echo "<p style='color:red'>Invalid email. Try Again!</p></br>";
else if($_GET['err']=='passRequ')
    echo "<p style='color:red'>Try Again! Password should be at least 16 characters in length and should include at least one upper case letter, one number, and one special character.</p></br>";
else if($_GET['err']=='passVal')
    echo "<p style='color:red'>Try Again! Wrong Password Confirmation.</p></br>";
else if($_GET['err']=='existEmail')
    echo "<p style='color:red'>Email <b> {$_GET['email']} </b> already exist. Try Again!</p></br>";
?>

<p>ALL FIELDS ARE REQUIRED!</p>
<form method='post' action='register_new_user.php'>
    Email: <input name='email' type='text' placeholder=<?php echo $_GET['email'] ?>> </br>
    Password: <input name='password' type='password'> </br>
    Confirm Password: <input name='valPassword' type='password'> </br>
    Role: <select name="role">
                <option value="user" <?php if($_GET['role']=='user')  echo 'selected'; ?>>User</option>
                <option value="admin"<?php if($_GET['role']=='admin')  echo 'selected' ?>>Admin</option>
          </select> </br>
    First name: <input name='fname' type='text'placeholder=<?php echo $_GET['fname'] ?>> </br>
    Last name: <input name='lname' type='text' placeholder=<?php echo $_GET['lname'] ?>> </br>
    Phone: <input name='phone' type='tel'placeholder=<?php echo $_GET['phone'] ?>> </br>
    Address: <input name='address' type='text' placeholder=<?php echo $_GET['address'] ?>> </br>
    Address 2: <input name='address2' type='text' placeholder=<?php echo $_GET['address2'] ?>> </br>
    City: <input name='city' type='text' placeholder=<?php echo $_GET['city'] ?>> </br>
    State: <input name='state' type='text' placeholder=<?php echo $_GET['state'] ?>> </br>
    Zip Code: <input name='zip_code' type='text' placeholder=<?php echo $_GET['zip_code'] ?>> </br></br> 
    <input class="btn btn-info" type="submit" value="Submit">
</form>
<button class="btn btn-default" onClick="window.location.href='login.php';" value="Return to Login">Return to Login</button>
<?php include_once "layout_footer.php";?>
