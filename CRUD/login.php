<?php
    session_start();//create $_SESSION supergloabal array
    error_reporting(0);
    $errMsg='';
    
    //check login credential
    //if this login.php is called using the submit button, check user's imput
    if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])){
        
        //prevent HTML/CSS/JS injection
        $_POST['username']=htmlspecialchars($_POST['username']);
        $_POST['password']=htmlspecialchars($_POST['password']);
        
        if($_POST['username']=='admin@admin.com' && $_POST['password']=='admin'){
        $_SESSION['username'] = 'admin@admin.com';
        
        header("Location:display_list.php");
        }
        else{
            //check database for legit username/pass
            require '../database/database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM mes_person '
                . ' WHERE username=? '
                . " LIMIT 1";
                
            $query =$pdo->prepare($sql);
            $query->execute(Array($_POST['username']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            //if user typed legit username combo, set $_SESSION
            if ($result){
               
               $password_hash_db = $result['password_hash'];
               $password_salt_db = $result['salt'];
               $password_hash = MD5($password+ $password_salt_db);

               if(!strcmp($password_hash, $password_hash_db)){
                   $_SESSION['username'] = $result['username'];
                   header("Location:display_list.php");
               }
               else {
                   $errMsg = "Login Failed: Wrong username or password";
               }
               
               
            }
            else{
            $errMsg = "Login Failed: Wrong username or password";
            }
        }
    }
    //print_r($_SESSION);
    //else just display the input form
?>
<DOCTYPE html>
<html lang="en-US">
    <head>
        <title> Crud Applet with Login</title>
        <meta charset="hutf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></link>
    </head>
    
    <body>
       
        <div class = "container">
             <h1>Crud Applet with Login</h1>
        <h2>Login</h2>
             <form action="" method="post">
            
            <p style="color: red;"><?php echo $errMsg; ?></p>
            
            <input type="text" class="form-control" name="username" placeholder="admin@admin.com"
            required autofocus /> <br />
            
            <input type="password" class="form-control" name="password" placeholder="admin" required  /> <br />
            
            <button class="btn btn-lg btn-primary btn-block" type ="submit" name="login" >Login</button> 
            <button class="btn btn-lg btn-secondary btn-block" onClick="window.location.href='register.php';" type ="button" name="join" >Join</button>
        </form>
        </div>
       
    </body>