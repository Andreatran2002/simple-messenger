<?php
include('class/DB.php');
include('class/Announce.php');
require_once(__DIR__ . '/vendor/autoload.php');

if (isset($_POST['login'])) {
        $id = \Ramsey\Uuid\Uuid::uuid4();
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                        
                        $cstrong = True; 
                        $token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong)); 
                        $user_id = DB::query('SELECT id FROM users WHERE username=:username',array(':username'=>$username))[0]['id']; 
                        DB::query('INSERT INTO login_tokens VALUES(:id, :token , :user_id)'  ,array(':id'=>$id,':token'=>sha1($token),':user_id'=>$user_id)); 
                        //Hàm sha1() trong php có tác dụng chuyển một chuỗi sang một chuỗi mới đã được mã hóa theo tiêu chuẩn sha1
                        setcookie("SNID",$token,time()+ 60*60*24*7, '/',NULL,NULL,TRUE); 
                        setcookie("SNID_",'1',time()+ 60*60*24*3, '/',NULL,NULL,TRUE); 
                        header("Location: http://andreatran.atwebpages.com/chat_box.php");
                } else {
                        Announce::alert("Incorrect Password!");
                }

        } else {
                Announce::alert('User not registered!');
        }

}

?>
<h4><a href="http://andreatran.atwebpages.com/login.html">Click here to back to login form</a></h4>