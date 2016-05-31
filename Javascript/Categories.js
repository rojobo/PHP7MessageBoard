function AddThread() {
	var strSubject = document.getElementById("txtThreadSubject").value;
	var intCategoryId = document.getElementById("hidCategoryId").value;
	var intUserId = document.getElementById("hidUserId").value;
	$.ajax({
	    url: '/PHP7MessageBoard/CodeBehind/Categories.php',
	    type: 'POST',
	    dataType: "json",
	    data: {
	        subject: strSubject,
	        category: intCategoryId,
	        userid: intUserId,
	        addThread: "true",
	        ajax: "true"
	    }
	}).done(function(data){
		window.location.reload(false);
	});
}