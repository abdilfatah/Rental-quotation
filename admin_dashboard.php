<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_admin_login(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
    <?php echo $_SESSION["admin_name"]; ?>, Welcome again
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/style.css">
 
    <link rel="icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/2f7569df82.js" crossorigin="anonymous"></script>
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="admin_dashboard.php" class="navbar-brand">Shabelle Cars</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="admin_dashboard.php" class="nav-link">
              <i class="fa fa-user"></i> Welcome <?php echo $_SESSION["admin_name"]; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-gear"></i>Admin Dashboard</h1>
        </div>
      </div>
    </div>
  </header>


    <?php
        if(!isset($_GET['q']))
        
            require_once("admin/currentquots.php");
        elseif($_GET['q'] == "manageemployees")
          require_once("admin/manageemployees.php");
        elseif($_GET['q'] == "removeemployee")
            require_once("admin/removeemployee.php");
        elseif($_GET['q'] == "addquotation")
            require_once("admin/addquotation.php");
            elseif($_GET['q'] == "createemployee")
            require_once("admin/createemployee.php");

    ?>


<script src="https://kit.fontawesome.com/76a3098157.js"></script>
</body>
</html>
