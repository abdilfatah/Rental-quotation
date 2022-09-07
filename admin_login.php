<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>

    <?php
if (isset($_POST["admin-login"])) {
    $email = ($_POST["admin-email"]);
    $password = ($_POST["admin-password"]);
    require_once "includes/db.php";
    $con;
    if ($con) {
        $stmt = $con->prepare("SELECT admin_id, admin_first_name, password FROM admin_login WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($admin_id, $admin_first_name, $db_pwd);
        while ($stmt->fetch()) {
            $admin_pw = $db_pwd;
            $admin_name = $admin_first_name;
        }
        $numRows = $stmt->num_rows;
        if ($numRows === 0) {
           echo "<div class='alert alert-danger text-center'>email not found </div>"; 
        } else {
            if (password_verify($password, $admin_pw) == false) {
                echo "<div class='alert alert-danger text-center'>incorrect password </div>"; 
            } else {
                require_once "includes/sessions.php";
                $_SESSION["admin_id"] = $admin_id;
                $_SESSION["admin_name"] = $admin_name;
                header("Location: admin_dashboard.php?id=" . $admin_id);
            }
        }
    } else {
        echo "server prob";
    }
}
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Shabelle Cars</a>
    </nav>
    <br> <br>
    <div class="container">
        
         <div class="row justify-content-center">
         
            <div class="col-md-5 ">
        <form  class="form-container col-sm-12" action="admin_login.php" method="post">
            <div class="container">
            <div class="text-center">
           <br>
            <br>
           <label for="uname">
              <h4>Login for Admin</h4>
            </label>
        </div>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="admin-email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="admin-password" id="pass" required>
                <br><br>
                <button class="btn btn-primary" type="submit" name="admin-login">Login</button>
                <br> <br>
                
            </div>
        </form>
      </div>
    </div>
    </div>

    <script>


</body>

</html>