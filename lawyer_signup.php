<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LCMS legal case Management</title>
    <link href="public/css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/parsley.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>

    <?php
        if(isset($_POST["lawyer-signup"])){
            $firstname=($_POST["lawyer-firstname"]);
            $lastname=($_POST["lawyer-lastname"]);
            $email=($_POST["lawyer-email"]);
            $password=($_POST["lawyer-password"]);
            $phone=($_POST["lawyer-phone"]);
            $gender=($_POST["lawyer-gender"]);
            $address=($_POST["lawyer-address"]);
            $specialization=($_POST["lawyer_special"]);
            $image=($_POST["lawyer-image"]);
            
            require_once("includes/db.php");
            $con;
            if ($con) {
                $stmt = $con->prepare("SELECT * FROM lawyer_login WHERE lawyer_email = ?");
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->num_rows;
                if ($numRows > 0) {
                    echo "Email already used.";
                }
                else{
                    $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $con->prepare("INSERT INTO lawyer_login(lawyer_first_name, lawyer_last_name, lawyer_email, lawyer_password, lawyer_phone_no, lawyer_gender, lawyer_address, specialization, lawyer_image)
                    VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param('sssssssss', $firstname, $lastname, $email, $hashedpwd, $phone, $gender, $address, $specialization, $image);
                    $stmt->execute();
                    if ($stmt->affected_rows === -1) {
                        echo "Error";
                        exit();
                    } else {
                        $stmt->close();
                        echo "signuped lawyer";
                        Header("Location: lawyer_login.php");
                        exit();
                    }
                }
            }
        }

    ?>

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://images.pexels.com/photos/5669602/pexels-photo-5669602.jpeg?cs=srgb&dl=pexels-sora-shimazaki-5669602.jpg&fm=jpg" alt=""/>
                        <h3>Welcome to LCMS</h3>
                        <p>We are provide a platform for Lawyers and Clients for easier communication!</p>
                        
                    </div>
                    <div class="col-md-9 register-right">
                        <div>
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register as a Lawyer...</h3>
                                
                            </div>
                            <div class="tab-pane fade show" id="profile" >
                                <form id="signup-form" data-parsley-validate="" data-parsley-validate="" action="lawyer_signup.php" method="post" class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="lawyer-firstname" required="" type="text" class="form-control" placeholder="First Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input name="lawyer-lastname" required="" type="text" class="form-control" placeholder="Last Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input name="lawyer-password" id="pass" data-parsley-minlength="6" type="password" class="form-control" placeholder="Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input name="lawyer-confirm-password" id="pass" data-parsley-minlength="6" type="password" class="form-control"  placeholder="Confirm Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <div  class="maxl">
                                                <label class="radio inline"> 
                                                    <input name="lawyer-gender" type="radio" name="gender" value="male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input name="lawyer-gender"type="radio" name="gender" value="female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input data-parsley-type="email" data-parsley-trigger="change" name="lawyer-email" type="email" class="form-control" placeholder="Your Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="10" maxlength="14" name="lawyer-phone" class="form-control" placeholder="Your Phone *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <select name="lawyer_special" class="form-control">
                                                <option class="hidden"  selected disabled>Specialization</option>
                                                <option  value="Civil">Civil</option>
                                                <option value="Criminal">Criminal</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input name="lawyer-address" required="" type="text" class="form-control"  placeholder="Enter Your Address *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input name="lawyer-image" type="file" name="image" />
                                         </div>
                                        <input type="submit" name="lawyer-signup" class="btnRegister"  value="Register"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





      <script>
        function showPass() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        <script type="text/javascript">
                    $(function () {
                    $('#signup-form').parsley().on('field:validated', function() {
                        var ok = $('.parsley-error').length === 0;
                        $('.bs-callout-info').toggleClass('hidden', !ok);
                        $('.bs-callout-warning').toggleClass('hidden', ok);
                        Parsley.options.minlength = 6;
                    })
                    .on('form:submit', function() {
                        return false; // Don't submit form for this demo
                    });
                    });
        </script>
      </script>
      <script src="public/js/jquery.min.js"> </script>
      <script src="public/js/parsley.js"> </script>

</body>
</html>
