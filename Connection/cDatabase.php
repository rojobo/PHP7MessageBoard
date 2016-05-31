<?
namespace MessageBoardData;
require 'Globals.php';
require 'IDatabaseConnect.php';

class cDatabase implements IDatabaseConnect {

	private $_Host = DB_HOST;
	private $_User = DB_USER;
	private $_Pass = DB_PASS;
	private $_DBname = DB_NAME;
	private $_PDO;
	private $_Error;
	
	function __construct()
	{
		$strSourceName = 'mysql:host=' . $this->_Host . ';dbname=' . $this->_DBname .';charset=utf8';
		$aryOptions = array(
			\PDO::ATTR_PERSISTENT => true,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		);

		try {
		    $this->_PDO = new \PDO($strSourceName, $this->_User, $this->_Pass, $aryOptions);
		}
		catch (PDOException $ex) {
			$this->_Error = $ex->getMessage();
		}
	}

	public function SelectRecords($pSQL, $pArray = null): array
	{
		try {
			$oStatement = $this->_PDO->prepare($pSQL);
			$oStatement->execute($pArray);
			return $oStatement->fetchAll();
		}
		catch(PDOException $exception) {
			return $ex->getMessage();		
		}

	}
	public function UpdateRecords($pSQL, $pArray = null): int
	{
		try {
			$oStatement = $this->_PDO->prepare($pSQL);
			$oStatement->execute($pArray);
			return $oStatement->rowCount();
		}
		catch(PDOException $exception) {
			return $ex->getMessage();		
		}
	}
	public function DeleteRecords($pSQL, $pArray = null): int
	{
		try {
			$oStatement = $this->_PDO->prepare($pSQL);
			$oStatement->execute($pArray);
			return $oStatement->rowCount();
		}
		catch(PDOException $exception) {
			return $ex->getMessage();		
		}	
	}
	public function InsertRecords($pSQL, $pArray = null): string
	{
		try {
			$oStatement = $this->_PDO->prepare($pSQL);
			$oStatement->execute($pArray);
			return  $this->_PDO->lastInsertId();
		}
		catch(PDOException $exception) {
			return $ex->getMessage();		
		}
	}
}
?>