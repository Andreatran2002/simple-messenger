
<?php
include('class/DB.php');
require_once(__DIR__ . '/vendor/autoload.php');

$id = \Ramsey\Uuid\Uuid::uuid4();
$username = htmlspecialchars($_GET['username']);
$message = htmlspecialchars($_GET['message']);

if ($message == "" || $username == "") {
	die("message");
}
else{
 DB::query('INSERT INTO messages VALUES (:id,:username,:message)', array(':id'=>$id,':username' => $username, ':message' =>$message));
 }

?>
