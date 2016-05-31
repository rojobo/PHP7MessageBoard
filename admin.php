<?
$_PageJS = 'Javascript/validate.js';
$_PageTitle = 'Admin Control';
include 'header.php';

if (!\MessageBoard\Session\IsLoggedIn()) {
	include 'Views/NoAccess.php';
}
else {
	include 'Views/Admin.php';
}

include 'footer.php';
?>