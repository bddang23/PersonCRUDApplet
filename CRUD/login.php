<?php
    session_start();//create $_SESSION supergloabal array
   
    $errMsg='';
    
    //check login credential
    //if this login.php is called using the submit button, check user's imput
    if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])){
        
        //prevent HTML/CSS/JS injection
        $_POST['email']=htmlspecialchars($_POST['email']);
        $_POST['password']=htmlspecialchars($_POST['password']);
        
        if($_POST['email']=='admin@admin.com' && $_POST['password']=='admin'){
        $_SESSION['email'] = 'admin@admin.com';
        echo 'sucessful!';
        header("Location:display_list.php");
        }
        else if($_POST['email']=='user@user.com' && $_POST['password']=='user'){
            $_SESSION['email'] = 'user@user.com';
            
            header("Location:display_list.php");
            }
        else{
            //check database for legit'email/pass
            require '../database/database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM persons '
                . ' WHERE email = ? '
                . ' LIMIT 1';
                
            $query =$pdo->prepare($sql);
            $query->execute(Array($_POST['email']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            //if user typed legit'email combo, set $_SESSION
            if ($result){
               $password = $_POST['password'];
               $password_hash_db = $result['password_hash'];
               $password_salt_db = $result['password_salt'];
               $password_hash = MD5($password . $password_salt_db);
               echo strcmp( $password_hash_db,$password_hash );

               if(!strcmp($password_hash, $password_hash_db)){
                   $_SESSION['email'] = $result['email'];
                   header("Location:display_list.php");
               }
               else {
                   $errMsg = "Login Failed: Wrong email or password";
               }
               
               
            }
            else{
            $errMsg = "Login Failed: Wrong email or password";
            }
        }
    }
?>

<DOCTYPE html>
<html lang="en-US">
    <head>
        <title> Crud Applet with Login</title>
        <meta charset="hutf-8" />
    </head>
    
    <body>
       
        <div class = "container">
             <h1>Crud Applet with Login</h1>
        <h2>Login</h2>
             <form action="" method="post">
            
            <p style="color: red;"><?php echo $errMsg; ?></p>
            
            <input type="text" class="form-control" name='email' placeholder="Email" required autofocus /> <br />
            
            <input type="password" class="form-control" name="password" placeholder="Password" required  /> <br />
            
            <button class="btn btn-lg btn-primary btn-block" type ="submit" name="login" >Login</button> 
            <button class="btn btn-lg btn-secondary btn-block" onClick="window.location.href='register.php';" type ="button" name="join" >Join</button>
        </form>
        </div>
       
    </body>