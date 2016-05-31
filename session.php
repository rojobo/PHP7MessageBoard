<?
namespace MessageBoard\Session;
session_start();


function IsLoggedIn() :bool 
{
	return (isset($_SESSION) && !empty($_SESSION));
}

function IsAdmin(): bool
{
	return (isset($_SESSION) && $_SESSION['admin'] === 'Y');
}

function IsReadOnly(): bool
{
	return (isset($_SESSION) && $_SESSION['readonly'] === 'Y');
}

function IsOwnAuthor($pAuthorId): bool
{
	return ($pAuthorId == $_SESSION['user_id']);
}
?>