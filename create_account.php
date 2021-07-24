<?php
include('class/DB.php');
require_once(__DIR__ . '/vendor/autoload.php');
include('class/Announce.php');


if (isset($_POST['createAccount'])){
	$id = \Ramsey\Uuid\Uuid::uuid4();
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (!DB::query('SELECT username FROM users WHERE username =:username; ', array(':username' => $username))){
		if (strlen($username) >= 3 && strlen($username) <= 32) {

            if (preg_match('/[a-zA-Z0-9_]+/', $username)) { // preg_match : dung de so sanh chuoi reular expression voi mot chuoi 

                if (strlen($password) >= 6 && strlen($password) <= 60) {

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (!DB::query('SELECT email FROM users WHERE email = :email', array(':email' => $email))){
							DB::query('INSERT INTO users VALUES (:id,:username,:email,:password) ', array(':id'=>$id,':username' => $username,':email' => $email,':password' => password_hash($password, PASSWORD_BCRYPT))); 
	                        Announce::alert('Create new account success! . Please login with your new account!!');
                        } else{
                            Announce::alert("Email in use");
                        }
                    } else {
                        Announce::alert( 'Invalid email!');

                    }
                } else {
                    Announce::alert( 'Invalid password!');

                }
            } else {
                Announce::alert( 'Invalid username');

            }
        } else {
            Announce::alert( 'Invalid username');

		}
	}else{
		Announce::alert('User already exits'); 
    }
    

}



?>


<h4><a href="http://andreatran.atwebpages.com/login.html">Click here to back to login form</a></h4>