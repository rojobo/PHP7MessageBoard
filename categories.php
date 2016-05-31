<?
$_PageJS = 'Javascript/validate.js';
$_PageTitle = 'Categories';
include 'header.php';

if (!\MessageBoard\Session\IsLoggedIn()) {
	include 'Views/NoAccess.php';
}
else {
	include 'Views/Categories.php';
}

include 'footer.php';
?>