<?php
include('class/DB.php');
require_once(__DIR__ . '/vendor/autoload.php');



if (isset($_POST['createAccount'])){
	$id = \Ramsey\Uuid\Uuid::uuid4();
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (!DB::query('SELECT username FROM user WHERE username =:username; ', array(':username' => $username))){
		if (strlen($username) >= 3 && strlen($username) <= 32) {

            if (preg_match('/[a-zA-Z0-9_]+/', $username)) { // preg_match : dung de so sanh chuoi reular expression voi mot chuoi 

                if (strlen($password) >= 6 && strlen($password) <= 60) {

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (!DB::query('SELECT email FROM user WHERE email = :email', array(':email' => $email))){
							DB::query('INSERT INTO user VALUES (:id,:username,:email,:password) ', array(':id'=>$id,':username' => $username,':email' => $email,':password' => password_hash($password, PASSWORD_BCRYPT))); 
	                        echo "Success!";

                        } else{
                            echo "Email in use"; 
                        }
                    } else {
                        echo 'Invalid email!';
                    }
                } else {
                    echo 'Invalid password!';
                }
            } else {
                echo "Invalid username";
            }
        } else {
            echo "Invalid username";
		}
	}else{
		echo "User already exits"; }
    

}



?>


<html>
<h1>Create new Account</h1>
<form action="create_account.php" method="post">
    <input name="username" type="text" value="" placeholder="Enter your username!"><br>
    <input name="email" type="email" value="" placeholder="Enter your email address"><br>
    <input name="password" type="password" value=""><br>
    <input name="createAccount" type="submit" value="Submit">
</form>

</html>