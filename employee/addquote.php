<?php
    if(isset($_POST["addquote"])){
        $company=($_POST["company"]);
        $debitor=($_POST["debitor"]);
        $idtype=($_POST["id-type"]);
        $branch=($_POST["branch"]);
        $cusName=($_POST["cus-name"]);
        $country=($_POST["country"]);
        $cusType=($_POST["customer-type"]);
        $idNo=($_POST["idno"]);
        $cusPhone=($_POST["customer-phone"]);
        $quotCategy=($_POST["quotation-categoty"]);
        $nationality=($_POST["nationality"]);
        $issueDate=($_POST["issue-date"]);
        $quotation_status="not yet accepted";

        require_once("../includes/db.php");
        $con;
        if ($con) {
            $employeeid = $_SESSION['employee_id'];
            $employeeid = $_GET['id'];

            $stmt = $con->prepare("INSERT INTO quotation(
                company, debitor, id_type, branch, customer_name, cust_category, id_no, quotation_category, nationality, issue_date, quotation_status)
                VALUES(?, ?, ?,?, ?, ?,?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssssssss', $company, $debitor, $idtype, $branch,$cusName, $cusType, $idNo, $quotCategy, $nationality, $issueDate, $quotation_status);
            $stmt->execute();
            if ($stmt->affected_rows === -1) {
                echo "Error";
            } else {
                $stmt->close();
                echo "quotation Added";
                Header("Location: ../employee_dashboard.php");
            }

        }
    }

?>
<br><br>
<div class="container register">
                <div class="row">
                  
                    <div class="col-md-3 register-left">
                        <h3>Welcome Back</h3>
                        <p>you can create quotaions here</p>
                        
                    </div>
                    <div class="col-md-9 register-right">
                        <div>
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Add Quotation Details...</h3>
                                <br>
                            </div>
                            <div class="tab-pane fade show" id="profile" >
                                <form id="addquote" data-parsley-validate="" data-parsley-validate="" action="employee/addquote.php" method="post" class="row register-form">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <select name="company" class="form-control">
                                                <option class="hidden"  selected disabled>Company</option>
                                                <option  value="mercedes">Mercedes</option>
                                                <option value="toyota">Toyota</option>
                                                <option value="tesla">Tesla</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input data-parsley-type="email" data-parsley-trigger="change" name="quotation-email" type="email" class="form-control" placeholder="Customer Email *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select name="debitor" class="form-control">
                                                <option class="hidden"  selected disabled>Debitor</option>
                                                <option  value="corporate">Corporate</option>
                                                <option value="private">Private</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select name="id-type" class="form-control">
                                                <option class="hidden"  selected disabled>ID-Type</option>
                                                <option  value="passport">Passport</option>
                                                <option value="mustabaqe">Mustabe</option>
                                                <option value="idcard">IDcard</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="expire-date" id="expireDate" type="date" class="form-control"  placeholder="Expire Date *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select name="branch" class="form-control">
                                                <option class="hidden"  selected disabled>Branch</option>
                                                <option  value="sayidka">Sayidka</option>
                                                <option value="basuudi">Basuudi</option>
                                                <option value="jaraaqato">Jaraaqato</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input  name="cus-name"type="text" class="form-control" placeholder="Customer Name *" value="" />
                                        </div>
                                      <br>
                                         <div class="form-group">
                                            <input name="country" type="text" class="form-control"  placeholder="Country *" value="" />
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <select name="customer-type" class="form-control">
                                                <option class="hidden"  selected disabled>Customer Type</option>
                                                <option  value="local">Local</option>
                                                <option value="tourist">Tourist</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input  name="idno" type="text" class="form-control" placeholder="ID No. *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="address" type="text" class="form-control" placeholder="Customer Address *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="text" minlength="10" maxlength="14" name="customer-phone" class="form-control" placeholder="Customer Phone *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select name="quotation-categoty" class="form-control">
                                                <option class="hidden"  selected disabled>Quotaion Category</option>
                                                <option  value="domestic">Domestic</option>
                                                <option value="international">International</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="nationality" type="text" class="form-control"  placeholder="Nationality *" value="" />
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label> Issue Date</label>
                                            <input name="issue-date" type="date" class="form-control"  placeholder="Isue Date *" value="" />
                                        </div>
                                         
                                        <br>
                                        <input type="submit" name="addquote" class="btn btn-primary"  value="Register"/>
                                        <br>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
