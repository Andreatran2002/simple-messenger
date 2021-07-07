<?php
include('class/DB.php');
require_once(__DIR__ . '/vendor/autoload.php');

if (isset($_POST['login'])) {
        $id = \Ramsey\Uuid\Uuid::uuid4();
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (DB::query('SELECT username FROM user WHERE username=:username', array(':username'=>$username))) {

                if (password_verify($password, DB::query('SELECT password FROM user WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                        echo 'Logged in!';
                        $cstrong = True; 
                        $token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong)); 
                        $user_id = DB::query('SELECT id FROM user WHERE username=:username',array(':username'=>$username))[0]['id']; 
                        DB::query('INSERT INTO login_tokens VALUES(:id, :token , :user_id)'  ,array(':id'=>$id,':token'=>sha1($token),':user_id'=>$user_id)); 
                        //Hàm sha1() trong php có tác dụng chuyển một chuỗi sang một chuỗi mới đã được mã hóa theo tiêu chuẩn sha1

                        setcookie("SNID",$token,time()+ 60*60*24*7, '/',NULL,NULL,TRUE); 
                        setcookie("SNID_",'1',time()+ 60*60*24*3, '/',NULL,NULL,TRUE); 
                } else {
                        echo 'Incorrect Password!';
                }

        } else {
                echo 'User not registered!';
        }

}

?>
<h1>Login to your account</h1>
<form action="login.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="submit" name="login" value="Login">
</form>