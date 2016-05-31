function ValidateSignIn() {
	var txtEmail = document.forms["frmSignIn"]["txtEmail"];
	var txtPassword = document.forms["frmSignIn"]["txtPassword"];
	var divErrors = document.getElementById("divErrors");
	var ulErrorList = document.getElementById("ulErrorList");
	var strOutput = "";
	var aryErrors = [];


  	if (txtEmail != undefined && txtEmail != null) {
		if (txtEmail.value === "") {
			strOutput += "Email must be entered\n";
			aryErrors.push("Email cannot be blank.");
			document.getElementById("divEmail").className = document.getElementById("divEmail").className.replace(/(?:^|\s)has-success(?!\s)/g,'');
			document.getElementById("divEmail").className += " has-error";
	  	}
	  	else {
	  		document.getElementById("divEmail").className = document.getElementById("divEmail").className.replace(/(?:^|\s)has-error(?!\s)/g,'');
		  	document.getElementById("divEmail").className += " has-success";
	  	}
  	}

  	if (txtPassword != undefined && txtPassword != null) {
		if (txtPassword.value === "") {
			strOutput += "Password must be entered.\n";
			aryErrors.push("Password cannot be blank.");
	  		document.getElementById("divPassword").className = document.getElementById("divPassword").className.replace(/(?:^|\s)has-success(?!\s)/g,'');
			document.getElementById("divPassword").className += " has-error";
	  	}
	  	else {
	  		document.getElementById("divPassword").className = document.getElementById("divPassword").className.replace(/(?:^|\s)has-error(?!\s)/g,'');
		  	document.getElementById("divPassword").className += " has-success";
	  	}
	}

	if (aryErrors.length > 0) {
  		$("#ulErrorList").empty();
	    for (var i = 0; i < aryErrors.length; i++ ) {
	        var liError = document.createElement("li");
	        liError.innerHTML = aryErrors[i];
	        ulErrorList.appendChild(liError);
	    }
  		divErrors.style.display = "block";
  	}

  	if (strOutput !== "") {
  		// console.log(output);
  		window.location.href = "#divErrors";
  		return false;
  	}
  	else {
  		divErrors.style.display = "none";
  		return true;
  	}
}