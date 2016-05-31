<?
namespace MessageBoard\Admin;
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

if (isset($_POST["ajax"])) {
	include '../Connection/cDatabase.php';
	HandleAjaxRequests();
}


function HandleAjaxRequests()
{
	if (isset($_POST["getUser"])) {
		GetUserById($_POST["userId"]);
	}
	elseif (isset($_POST["updateUser"])) {
		UpdateUserById($_POST);
	}
	elseif (isset($_POST["deleteUser"])) {
		DeleteUserById($_POST["userId"]);
	}
	elseif (isset($_POST["addUser"])) {
		AddUser($_POST);
	}
}

function AddUser($pParams)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "INSERT INTO users(user_name, user_pass, user_date, first_name, last_name, readonly, admin) 
				VALUES(:email,:password,:datee, :first,
				:last, :readonly, :admin)";
	$aryParams = array(':email' => $pParams["first"]."@board.com", ':password' => md5($pParams["password"]), 
				':datee' => date("Y-m-d H:i:s"), ':first' => $pParams["first"], 
				':last' => $pParams["last"], ':readonly' => $pParams["readonly"],
				':admin' => $pParams["admin"]);
	$intId = $oDatabaseConnection->InsertRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intId);
}

function DeleteUserById($pUserId)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "DELETE FROM users WHERE user_id = ?";
	$aryParams = array($pUserId);
	$intCount = $oDatabaseConnection->DeleteRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intCount);
}

function UpdateUserById($pParams)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "UPDATE users SET first_name = :first, last_name = :last WHERE user_id = :id";
	$aryParams = array(':first'=>$pParams["first"], ':last'=>$pParams["last"], ':id'=>$pParams["userId"]);
	$intCount = $oDatabaseConnection->UpdateRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intCount);
}

function GetUserById($pUserId)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT * FROM users WHERE user_id = ?";
	$aryParams = array($pUserId);
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($aryRecords[0]);
}

function GetAllUsers(): array
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT * FROM users";
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL);
	return $aryRecords;
}

?>