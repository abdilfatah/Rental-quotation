<?php require_once "includes/sessions.php";?>
<?php require_once "includes/functions.php";?>
<?php confirm_employee_login();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo $_SESSION["employee_name"]; ?>
    </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/2f7569df82.js" crossorigin="anonymous"></script>

</head>

<body>


<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="employee_dashboard.php" class="navbar-brand">Shabelle Cars</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="employee_dashboard.php" class="nav-link">
              <i class="fa fa-user"></i>  <?php echo $_SESSION["employee_name"]; ?>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-gear"></i>Employee Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

    <?php
if (!isset($_GET['q'])) {
	require_once "employee/currentquots.php";
} 
elseif (!isset($_GET['addquote'])) {
	require_once "employee/addquote.php";
} 
?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/76a3098157.js"></script>
</body>

</html>
