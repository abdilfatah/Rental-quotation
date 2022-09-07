<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>


<body>

    <?php
if (isset($_POST["employee-login"])) {
    $email = ($_POST["employee-email"]);
    $password = ($_POST["employee-password"]);
    require_once "includes/db.php";
    $con;
    if ($con) {
        $stmt = $con->prepare("SELECT employee_id, password, employee_first_name FROM employee_login WHERE employee_email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($employee_id, $db_pwd, $employee_name);
        while ($stmt->fetch()) {
            $employee_pw = $db_pwd;
        }
        $numRows = $stmt->num_rows;
        if ($numRows === 0) {
           echo "<div class='alert alert-danger text-center'>email not found </div>"; 
        } else {
            if (password_verify($password, $employee_pw) == false) {
               echo "<div class='alert alert-danger text-center'>incorrect password </div>"; 
            } else {
                require_once "includes/sessions.php";
                $_SESSION["employee_id"] = $employee_id;
                $_SESSION["employee_name"] = $employee_name;
                header("Location: employee_dashboard.php?id=" . $employee_id);

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
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 ">
                <form class="form-container col-sm-12" action="index.php" method="post">
                    <div class="text-center">
                        
                        <br>
                        <br>
                        <label for="uname">
                            <h4>Login for Employee</h4>
                        </label>
                    </div>

                    <div class="container">
                        <label for="email"><b>Email</b></label>
                        <input class="form-control-lg" type="email" placeholder="Enter Email" name="employee-email" required>

                        <label for="psw"><b>Password</b></label>
                        <input class="form-control-lg" type="password" placeholder="Enter Password" name="employee-password" id="pass" required>

                        <button class="mt-3 btn-lg btn-primary" type="submit" name="employee-login">Login</button>
                    </div>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>