$('#divUserModal').on('show.bs.modal', function (event) {
  var strFirst;
  var strLast;
  var intUserId;
  var btnButton = $(event.relatedTarget); // Button that triggered the modal
  intUserId = btnButton.data('userid'); // Extract info from data-* attributes
  var oModal = $(this);

	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Admin.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        userId: intUserId,
	        getUser: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		strFirst = data.first_name;
		strLast = data.last_name;
		oModal.find('.modal-title').text(strFirst + ' ' + strLast);
		oModal.find('#txtFirstName').val(strFirst);
		oModal.find('#txtLastName').val(strLast);
		oModal.find('#hidUserId').val(intUserId);
	});
});

function SaveUser(oModal) {
	var strFirst = document.getElementById("txtFirstName").value;
	var strLast = document.getElementById("txtLastName").value;
	var intUserId = document.getElementById("hidUserId").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Admin.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        userId: intUserId,
	        updateUser: "true",
	        ajax: "true",
	        first: strFirst,
	        last: strLast
	    }
	}).done(function(data){
		window.location.reload(false);
	});
}

function DeleteUser() {
	var intUserId = document.getElementById("hidUserId").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Admin.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        userId: intUserId,
	        deleteUser: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		window.location.reload(false);
	});	
}

function AddUser() {
	var strFirst = document.getElementById("txtAddFirstName").value;
	var strLast = document.getElementById("txtAddLastName").value;
	var strPassword = document.getElementById("txtAddPassword").value;
	var blnAdmin = document.getElementById("chkAdmin").checked;
	var blnReadOnly = document.getElementById("chkReadOnly").checked;
	blnAdmin = blnAdmin ? "Y" : "N";
	blnReadOnly = blnReadOnly ? "Y" : "N";
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Admin.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        readonly: blnReadOnly,
	        admin: blnAdmin,
	        password: strPassword,
	        addUser: "true",
	        ajax: "true",
	        first: strFirst,
	        last: strLast
	    }
	}).done(function(data){
		window.location.reload(false);
	});
}