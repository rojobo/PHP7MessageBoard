<?
$_PageTitle = 'Threads';
?>
<br />
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-offset-1">
		  		<h1>Threads <small> The hottest discussions on the web!</small></h1>
		  	</div>
		</div>
  	</div>
</div>

<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="Views/IframeThreads.php?id=<?=$_GET['id']?>"></iframe>
</div>


<br />