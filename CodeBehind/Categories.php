<?
namespace MessageBoard\Categories;

if (isset($_POST["ajax"])) {
	include '../Connection/cDatabase.php';
	HandleAjaxRequests();
}

function HandleAjaxRequests()
{
	if (isset($_POST["addThread"])) {
		AddNewThread($_POST);
	}
}

function AddNewThread($pParams)
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "INSERT INTO threads(thread_subject, thread_date, thread_cat, thread_by) 
				VALUES(:subject, :datee, :category, :userid)";
	$aryParams = array(':subject' => $pParams["subject"], 
				':datee' => date("Y-m-d H:i:s"), ':category' => $pParams["category"], 
				':userid' => $pParams["userid"]);
	$intId = $oDatabaseConnection->InsertRecords($strSQL, $aryParams);	
	header('Content-Type: application/json');
	echo json_encode($intId);
}	

function GetAllCategories(): array
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT cat_id, cat_name, cat_description FROM categories";
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL);
	return $aryRecords;
}

function GetThreadsByCategory($pCategoryId): array
{
	$oDatabaseConnection = new \MessageBoardData\cDatabase();
	$strSQL = "SELECT thread_id, thread_subject, thread_date, thread_cat FROM threads WHERE thread_cat = ?";
	$aryParams = array($pCategoryId);
	$aryRecords = $oDatabaseConnection->SelectRecords($strSQL, $aryParams);
	return $aryRecords;
}

?>