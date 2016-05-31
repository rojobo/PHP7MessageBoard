<?
$_PageJS = '/PHP7MessageBoard/Javascript/Threads.js';
include 'IframeHeader.php';
include '../CodeBehind/Threads.php';

$aryThreads = \MessageBoard\Threads\GetThreadById($_GET["id"]);
$aryPosts = \MessageBoard\Threads\GetPostsByThreadId($_GET["id"]);
$intThreadAuthor = $aryPosts[0]["post_by"] ?? $aryThreads["thread_by"];
?>
<div class="container">
	<table class="table table-hover">
		<tr colspan="2">
		  <td class="success lead text-center"><?=$aryThreads["thread_subject"]?></td>
		</tr>
	</table>
	<table class="table table-hover table-bordered">
	<?
	foreach ($aryPosts as $key => $value) {
		if(\MessageBoard\Session\IsAdmin() ||
			(\MessageBoard\Session\IsOwnAuthor($intThreadAuthor) && !\MessageBoard\Session\IsReadOnly())){
			echo "<tr>
					<td width='15%'><strong>". $value["first_name"] . " " . $value["last_name"] . " " . "<br />" . date('d-m-Y', strtotime($value['post_date'])) . "</strong></td>
					<td class='text-left'><strong>&nbsp;&nbsp;&nbsp;" . $value["post_content"] . "</strong></td>
					<td class='text-center'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#divEditPost' data-postid='". $value["post_id"] ."'>
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'>
						</span></button>
					</td>
				 </tr>";
		}
		else{
			echo "<tr>
					<td width='15%'><strong>". $value["first_name"] . " " . $value["last_name"] . " " . "<br />" . date('d-m-Y', strtotime($value['post_date'])) . "</strong></td>
					<td class='text-left'><strong>&nbsp;&nbsp;&nbsp;" . $value["post_content"] . "</strong></td>
				 </tr>";
		}
	}
	?>
	</table>
	<?
	if(!\MessageBoard\Session\IsReadOnly()){
	?>
	<button type="button" class="btn btn-primary btn-lg btn-block" role="button" data-toggle='modal' 
	data-target='#divReply'>Reply</button>
	<?
	}
	if(\MessageBoard\Session\IsAdmin() ||
			(\MessageBoard\Session\IsOwnAuthor($intThreadAuthor) && !\MessageBoard\Session\IsReadOnly())){
	?>
	<button type="button" class="btn btn-danger btn-lg btn-block" role="button" data-toggle='modal' 
	data-target='#divDelete'>Delete</button>
	<?}?>
</div>

<div class="modal fade" id="divReply" tabindex="-1" role="dialog" aria-labelledby="modal">
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
            <label for="txtReply" class="control-label">Reply:</label>
            <textarea class="form-control" rows="3" id="txtReply"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Reply();">Post</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" id="divDelete" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Delete Thread?</h4>
      </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-danger" onclick="DeleteThread();">Delete</button>
	    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="divEditPost" tabindex="-1" role="dialog" aria-labelledby="modal3">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Thread</h4>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="hidPostId"></input>
          <input type="hidden" id="hidPostUserId"></input>
          <div class="form-group">
            <label for="txtEditContent" class="control-label">Reply:</label>
            <textarea class="form-control" rows="3" id="txtEditContent"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="EditPost();">Post</button>
      </div>
    </div>
  </div>
</div>
<?
include 'IframeFooter.php';
?>