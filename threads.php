<?
$_PageJS = 'Javascript/validate.js';
$_PageTitle = 'Threads';
include 'header.php';

if (!\MessageBoard\Session\IsLoggedIn()) {
	include 'Views/NoAccess.php';
}
else {
	include 'Views/Threads.php';
}

include 'footer.php';
?>