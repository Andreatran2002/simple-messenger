<?php 
    include('./class/DB.php');
    include('./class/Login.php'); 

    if (!Login::isLoggedIn()){
        die("Not logged in"); 
    }
    
    if (isset($_POST['confirm'])){
        if (isset($_POST['alldevices'] )){
            DB::query('DELETE FROM login_tokens WHERE user_id =:userid',array(':userid' => Login::isLoggedIn() )); 
        }
        else{
            if (isset($_COOKIE['SNID'])){
            DB::query('DELETE FROM login_tokens WHERE token= :token',array(':token' => sha1($_COOKIE['SNID']))); 
            }
    
            setcookie('SNID','1',time()-3600); 
            setcookie('SNID_','1',time()-3600); 
        }
    }
?>

<h1>Logout of your Account</h1>
<p>Are you sure you want to log out?</p>

<form action="logout.php" method="post">
    <input type="checkbox" name="alldevices" value="alldevices" id=""> Logout of all devices <br>
    <input type="submit" value="Confirm" name="confirm" />
</form>