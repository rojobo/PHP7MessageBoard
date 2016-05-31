<?
$_PageJS = "/PHP7MessageBoard/Javascript/Admin.js";
include 'IframeHeader.php';
include '../CodeBehind/Admin.php';
$aryUsers = \MessageBoard\Admin\GetAllUsers();
?>
<div class="container">
	<table class="table table-hover">
		<tr colspan="3">
		  <td class="success lead text-center">Users</td>
		</tr>
	</table>
	<table class="table table-hover table-bordered">
	<tr class="info lead text-center">
		<td><strong>First</strong></td>
		<td><strong>Last</strong></td>
		<td class="text-center"><strong>Edit</strong></td>
	</tr>
	<?
	foreach ($aryUsers as $key => $value) {
    if (\MessageBoard\Session\IsAdmin()) {
		  echo "<tr class='text-center'>
				  <td><strong>". $value["first_name"] . "</strong></td>
				  <td><strong>" . $value["last_name"] . "</strong></td>
				  <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#divUserModal' data-userid='". $value["user_id"] ."'>
					<span class='glyphicon glyphicon-pencil' aria-hidden='true'>
					</span></button></td>";
    }
    else{
      if($_SESSION["user_id"] == $value["user_id"]) {
          echo "<tr class='text-center'>
              <td><strong>". $value["first_name"] . "</strong></td>
              <td><strong>" . $value["last_name"] . "</strong></td>
              <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#divUserModal' data-userid='". $value["user_id"] ."'>
              <span class='glyphicon glyphicon-pencil' aria-hidden='true'>
              </span></button></td>";        
      }
    }
	}
	?>
	</table>
  <?if (\MessageBoard\Session\IsAdmin()) {?>
	<table class="table table-hover" role="button" data-toggle='modal' data-target='#divUserModal2'>
		<tr colspan="3">
		  <td class="danger lead text-center">Add User</td>
		</tr>
	</table>
  <?}?>
</div>

<div class="modal fade" id="divUserModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
      <input type="hidden" id="hidUserId"></input>
        <form>
          <div class="form-group">
            <label for="txtFirstName" class="control-label">First:</label>
            <input type="text" class="form-control" id="txtFirstName">
          </div>
          <div class="form-group">
            <label for="txtLastName" class="control-label">Last:</label>
            <input type="text" class="form-control" id="txtLastName">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="SaveUser();">Save</button>
        <button type="button" class="btn btn-danger" onclick="DeleteUser();">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="divUserModal2" tabindex="-1" role="dialog" aria-labelledby="userModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-txtAddFirstName">
            <label for="txtFirstName" class="control-label">First:</label>
            <input type="text" class="form-control" id="txtAddFirstName">
          </div>
          <div class="form-group">
            <label for="txtAddLastName" class="control-label">Last:</label>
            <input type="text" class="form-control" id="txtAddLastName">
          </div>
          <div class="form-group">
            <label for="txtAddPassword" class="control-label">Password:</label>
            <input type="password" class="form-control" id="txtAddPassword">
          </div>
		  <div class="checkbox">
		  	<label>
		  		<input id="chkAdmin" type="checkbox"> Admin
		  	</label>
		  </div>
		  <div class="checkbox">
		  	<label>
		  		<input id="chkReadOnly" type="checkbox"> Readonly
		  	</label>
		  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="AddUser();">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?
include 'IframeFooter.php';
?>