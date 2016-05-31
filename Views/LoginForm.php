<br />
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-offset-1">
		  		<h1>Sign In! <small> Please enter your credentials.</small></h1>
		  	</div>
		</div>
  	</div>
</div>


<br />
<div class="alert alert-danger alert-dismissible" role="alert" id="divErrors" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning! Please correct the following entries:</strong> 
  <br />
    <ul id="ulErrorList">
    </ul>
</div>

<?
if (\MessageBoard\Signin\LoginFailed()) {
?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Oops! We couldn't locate your account.</strong> 
  <br />
    <ul>
    	<li>Please check your credentials and try again.</li>
    </ul>
</div>
<?}?>

<div class="container">
	<form class="form-horizontal" name="frmSignIn" id="frmSignIn" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off">
	  <div class="form-group">
	    <label for="txtEmail" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10 has-feedback" id="divEmail">
	      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="txtPassword" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10 has-feedback" id="divPassword">
	      <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <div class="checkbox">
	        <label>
	          <input type="checkbox"> Remember me
	        </label>
	      </div>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name="btnSignin" onclick="return ValidateSignIn();">Sign in</button>
	    </div>
	  </div>
	</form>	
</div>