$('#divEditPost').on('show.bs.modal', function (event) {
  var strContent;
  var intUserId;
  var intPostId;
  var btnButton = $(event.relatedTarget);
  intPostId = btnButton.data('postid');
  var oModal = $(this);

	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Threads.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        postid: intPostId,
	        getPost: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		intUserId = data.post_by;
		strContent = data.post_content;
		oModal.find('#txtEditContent').val(strContent);
		oModal.find('#hidPostId').val(intPostId);
		oModal.find('#hidPostUserId').val(intUserId);
	});
});

function DeleteThread() {
	var intThreadId = document.getElementById("hidCategoryId").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Threads.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        threadid: intThreadId,
	        deleteThread: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		window.location = "categories.php";
	});	
}

function Reply() {
	var intThreadId = document.getElementById("hidCategoryId").value;
	var intUserId = document.getElementById("hidUserId").value;
	var strReply = document.getElementById("txtReply").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Threads.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        threadid: intThreadId,
	        userid: intUserId,
	        reply: strReply,
	        replyPost: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		window.location.reload(false);
	});	
}

function EditPost(oModal) {
	var strContent = document.getElementById("txtEditContent").value;
	var intPostId = document.getElementById("hidPostId").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Threads.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        postid: intPostId,
	        content: strContent,
	        updatePost: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		window.location.reload(false);
	});
}