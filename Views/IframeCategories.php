<?
$_PageJS = "/PHP7MessageBoard/Javascript/Categories.js";
include 'IframeHeader.php';
include '../CodeBehind/Categories.php';
?>

<div class="container">
	<ul class="nav nav-tabs">
		<?
		$aryCategories = \MessageBoard\Categories\GetAllCategories();
		foreach ($aryCategories as $key => $value) {
			$intCategoryId = $key + 1;
			if ($_GET["id"] == $intCategoryId) {
				echo '<li role="presentation" class="active">
						<a href="IframeCategories.php?id='. $intCategoryId . '">'. $value["cat_name"] .'</a>
					 </li>';
			}
			else {
				echo '<li role="presentation">
						<a href="IframeCategories.php?id='. $intCategoryId . '">'. $value["cat_name"] .'</a>
					 </li>';
			}
		}
		$intCategoryKey = $_GET["id"] - 1;
		?>
	</ul>
	<hr />
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
			  		<h2><?=$aryCategories[$intCategoryKey]["cat_description"];?></h2>
			  	</div>
			</div>
	  	</div>
	</div>
	<table class="table table-hover">
		<tr>
		  <td class="success">Thread</td>
		  <td class="info">Created on</td>
		</tr>
		<?
		$aryThreads = \MessageBoard\Categories\GetThreadsByCategory($_GET["id"]);
		if (count($aryThreads) === 0) {
			echo "<tr>
					<td class='active'>There are no topics in this category yet.</td>
					<td class='active'>&nbsp;</td>
				 </tr>";
		}
		else {
			foreach ($aryThreads as $key => $value) {
				echo "<tr>
						<td><a target='_parent' href='../threads.php?id=" . $value['thread_id'] ."'>" . $value['thread_subject'] . "</a>
						</td>
						<td>" 
							. date('d-m-Y', strtotime($value['thread_date'])) . "
						</td>
					 </tr>";
			}	
		}
		?>
	</table>
	<?
	if(!\MessageBoard\Session\IsReadOnly()){
	?>
	<table class="table table-hover" role="button" data-toggle='modal' data-target='#divAddThread'>
		<tr colspan="3">
		  <td class="warning lead text-center">Start New Thread</td>
		</tr>
	</table>
	<?
	}
	?>
</div>

<div class="modal fade" id="divAddThread" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Thread</h4>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="hidCategoryId" value="<?=$_GET['id'];?>"></input>
          <input type="hidden" id="hidUserId" value="<?=$_SESSION['user_id'];?>"></input>
          <div class="form-group">
            <label for="txtThreadSubject" class="control-label">Subject:</label>
            <input type="text" class="form-control" id="txtThreadSubject">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="AddThread();">Start Thread</button>
      </div>
    </div>
  </div>
</div>

<?
include 'IframeFooter.php';
?>