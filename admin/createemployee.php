    <?php
        if(isset($_POST["employee-signup"])){
            $firstname=($_POST["employee-firstname"]);
            $lastname=($_POST["employee-lastname"]);
            $email=($_POST["employee-email"]);
            $password=($_POST["employee-password"]);
            
            require_once("../includes/db.php");
            $con;
            if ($con) {
                $stmt = $con->prepare("SELECT * FROM employee_login WHERE employee_email = ?");
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->num_rows;
                if ($numRows > 0) {
                    echo "Email already used.";
                }
                else{
                    $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $con->prepare("INSERT INTO employee_login(employee_first_name, employee_last_name, employee_email, password)
                    VALUES (?,?,?,?)");
                    $stmt->bind_param('ssss', $firstname, $lastname, $email, $hashedpwd);
                    $stmt->execute();
                    if ($stmt->affected_rows === -1) {
                        echo "Error";
                        exit();
                    } else {
                        $stmt->close();
                        echo "Employee Created Successfully";
                        Header("Location: ../admin_dashboard.php?q=manageemployees");
                        exit();
                    }
                }
            }
        }

    ?>
<br><br><br>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Welcome Admin</h3>
                        <p>To Register New Employee</p>
                        
                    </div>
                    <div class="col-md-9 register-right">
                        <div>
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">New Employee Details...</h3>
                                
                            </div>
                            <div class="tab-pane fade show" id="profile" >
                                <form id="signup-form" data-parsley-validate="" data-parsley-validate="" action="admin/createemployee.php" method="post" class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="employee-firstname" required="" type="text" class="form-control" placeholder="First Name *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="employee-lastname" required="" type="text" class="form-control" placeholder="Last Name *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input data-parsley-type="email" data-parsley-trigger="change" name="employee-email" type="email" class="form-control" placeholder="Your Email *" value="" />
                                        </div>
                                        
                                        <br>
                                        <div class="form-group">
                                            <div  class="maxl">
                                                
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       
                                        <div class="form-group">
                                            <input name="employee-password" id="pass" data-parsley-minlength="6" type="password" class="form-control" placeholder="Password *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="employee-confirm-password" id="pass" data-parsley-minlength="6" type="password" class="form-control"  placeholder="Confirm Password *" value="" />
                                        </div>
                                        <br>
                                        
                                        <input type="submit" name="employee-signup" class="btn btn-primary"  value="Register"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
