<?
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <!-- Header -->
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" charset="UTF-8">
    <!-- Title -->
    <title><?echo 'Message Board | ' . $_PageTitle; ?></title>
        <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="Stylesheets/bootstrap.css" rel="stylesheet" media="screen">
      </head>

  <!-- Body-->
  <body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
          <img alt="Brand" src="http://ih0.redbubble.net/image.66837130.1798/sticker,220x200-pad,220x200,ffffff.jpg">
        </a>
      </div>

      <div class="navbar-right">
        <p class="navbar-text bg-success"><?echo isset($_SESSION['user_name']) ? "Signed in as " . $_SESSION['user_name'] : "Please sign in."?></p>
        <?if (\MessageBoard\Session\IsLoggedIn()) {?>
        <ul class="nav navbar-nav">
          <li><a href="categories.php">&nbsp;&nbsp;<b>Posts</b>&nbsp;&nbsp;</a></li>
          <li><a href="admin.php">&nbsp;&nbsp;<b>Admin</b>&nbsp;&nbsp;</a></li>
          <li><a href="logout.php">&nbsp;&nbsp;<b>Log Out</b>&nbsp;&nbsp;</a></li>
        </ul>
        <?}?>
      </div>
    </div>
  </nav>