<?php
include('class/DB.php');
require_once(__DIR__ . '/vendor/autoload.php');

$id = \Ramsey\Uuid\Uuid::uuid4();
echo $id;
$username = htmlspecialchars($_GET['username']);
$message = htmlspecialchars($_GET['message']);

$result = DB::query("SELECT * FROM messages WHERE username=:username", array(':username' => $username)); 

foreach($result as $r){
	echo $r['username'];
	echo "\\";
	echo $r['message'];
	echo "\n";		
}

