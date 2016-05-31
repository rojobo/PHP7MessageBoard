<?
namespace MessageBoardData;

interface IDatabaseConnect {
	public function SelectRecords($strSQL, $paramArray = null): array;
	public function UpdateRecords($strSQL, $paramArray = null): int;
	public function DeleteRecords($strSQL, $paramArra = null): int;
	public function InsertRecords($strSQL, $paramArray = null): string; 
}
?>