<?
namespace MessageBoard\Signin;

if (WasFormSubmitted()) {
	AuthenticateUser();
}


function WasFormSubmitted(): bool
{
	return isset($_POST["btnSignin"]);
}

function LoginFailed(): bool
{
	return isset($_GET["loginFailed"]); 
}

function AuthenticateUser() 
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT * FROM users WHERE user_name = ? AND user_pass = ?";
	$aryParams = [$_POST["txtEmail"], md5($_POST["txtPassword"])];
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);
	$intRecordCount = count($aryRecords);
	if ($intRecordCount > 0) {
		session_start();
		$aryRecords = $aryRecords[0];
		$_SESSION['user_id'] = $aryRecords['user_id'];
		$_SESSION['user_name'] = $aryRecords['user_name'];
		$_SESSION['first_name'] = $aryRecords['first_name'];
		$_SESSION['last_name'] = $aryRecords['last_name'];
		$_SESSION['admin'] = $aryRecords['admin'];
		$_SESSION['readonly'] = $aryRecords['readonly'];
	}
	else {
		header("Location: index.php?loginFailed=True");
	}
}

?>