<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/class.user.php");
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('index.php');
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	$user->redirect('index.php');
}
?>