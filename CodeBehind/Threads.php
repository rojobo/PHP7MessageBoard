<?
namespace MessageBoard\Threads;

if (isset($_POST["ajax"])) {
	include '../Connection/cDatabase.php';
	HandleAjaxRequests();
}

function HandleAjaxRequests()
{
	if (isset($_POST["replyPost"])) {
		ReplyToThread($_POST);
	}
	elseif (isset($_POST["deleteThread"])) {
		DeleteThreadById($_POST["threadid"]);
	}
	elseif (isset($_POST["updatePost"])) {
		EditPostById($_POST);
	}
	elseif (isset($_POST["getPost"])) {
		GetPostById($_POST["postid"]);
	}
}

function GetPostById($pPostId)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT * FROM posts WHERE post_id = ?";
	$aryParams = array($pPostId);
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($aryRecords[0]);
}

function EditPostById($pParams)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "UPDATE posts SET post_content = :content, post_date = :datee WHERE post_id = :id";
	$aryParams = array(':content'=>$pParams["content"], ':datee'=>date("Y-m-d H:i:s"),
				 ':id'=>$pParams["postid"]);
	$intCount = $oDatabaseConnection->UpdateRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intCount);
}

function DeleteThreadById($pThreadId)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "DELETE FROM threads WHERE thread_id = ?";
	$aryParams = array($pThreadId);
	$intCount = $oDatabaseConnection->DeleteRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intCount);
}

function ReplyToThread($pParams)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "INSERT INTO posts(post_content, post_date, post_topic, post_by) 
				VALUES(:reply, :datee, :threadid, :userid)";
	$aryParams = array(':reply' => $pParams["reply"], 
				':datee' => date("Y-m-d H:i:s"), ':threadid' => $pParams["threadid"], 
				':userid' => $pParams["userid"]);
	$intId = $oDatabaseConnection->InsertRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intId);	
}

function GetThreadById($pThreadId): array
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT * FROM threads WHERE thread_id = ?";
	$aryParams = array($pThreadId);
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);
	return $aryRecords[0];
}

function GetPostsByThreadId($pThreadId): array
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT post_id, post_topic, post_content, post_date, post_by, 
		user_id, first_name, last_name FROM posts LEFT JOIN users ON posts.post_by = users.user_id 
		WHERE post_topic = ? ";
	$aryParams = array($pThreadId);
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);
	return $aryRecords;
}

?>