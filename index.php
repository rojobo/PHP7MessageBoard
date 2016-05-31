<?
$_PageJS = 'Javascript/validate.js';
$_PageTitle = 'Sign In';
include 'Connection/cDatabase.php';
include 'CodeBehind/Signin.php';
include 'header.php';

if (!\MessageBoard\Session\IsLoggedIn()) {
	include 'Views/LoginForm.php';
}
else {
	include 'Views/Home.php';
}

include 'footer.php';
?>