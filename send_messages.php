<?php
include('./class/DB.php');
include('./class/Login.php');
require_once(__DIR__ . '/vendor/autoload.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');
$id = \Ramsey\Uuid\Uuid::uuid4();
$message = htmlspecialchars($_GET['message']);
$timestamp = (date("Y/m/d h:i:s"));
session_start();
$cstrong = True;
$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

$_SESSION['token'] = $token; 
if (!isset($_SESSION['token'])){

}

if (Login::isLoggedIn()) {
    $userid = Login::isLoggedIn();
} else {
    die('Not logged in');
}
$nocsrf = $_SESSION['token'];
    if (!isset($nocsrf)){
        die("INVALID TOKEN"); 
    }
    if ($nocsrf != $_SESSION['token']){
        die('INVALID TOKEN'); 
    }
    if (DB::query("SELECT id FROM users WHERE id = :receiver ", array(':receiver' => $_GET['receiver_id']))) {
        DB::query("INSERT INTO messages VALUES (:id,:sender,:receiver,:message,:time)", array(':id'=>$id,':message' => $_GET['message'], ':sender' => $userid, ':receiver' => htmlspecialchars($_GET['receiver_id']),':time' =>$timestamp));
        echo "Messengers sent";
    } else {
        die("Invalid ID!");
    }
    session_destroy();


?>
