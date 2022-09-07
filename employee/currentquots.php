
    <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
        <div class="row">
                <div class="py-2 col-md-3">
                        <a href="employee_dashboard.php?q=addquote" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-user"></span> <i class="fa fa-plus"></i> &nbsp; Create Quotation
                        </a>
                </div>
    </div>
</section>

<div class="row">
       <div class="col-sm-12">
            <h1>Current Quotations</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th> Sr.no </th>
                        <th>Company</th>
                        <th>debitor</th>
                        <th>Expire Date</th>
                        <th>Branch</th>
                        <th>Customer Name</th>
                        <th>Issue Date</th>
                        <th>Country</th>
                        <th>Status</th>
                    </tr>
                        <?php
                            require_once("includes/db.php");                            
                            $con;
                            if ($con) {
                                $x=1;
                                $eid = $_SESSION['employee_id'];
                                $stmt = $con->prepare("
                                SELECT quotation_id, company, debitor, expire_date, branch, customer_name, issue_date, country, quotation_status
                                FROM quotation WHERE quotation_status = ? or quotation_status = ? AND employeeforquotation_id =?");
                                $status = "not yet accepted";
                                $status1 = "accepted";
                                $stmt->bind_param('sss', $status, $status1, $eid);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($quotation_id, $company,
                                $debitor, $expire_date, $branch,
                                $customer_name, $issue_date, $country, $quotation_status);

                                while ($stmt->fetch()) {
                                    echo "
                                    <tr>
                                        <td> {$x} </td>
                                        <td> {$company} </td>
                                        <td> {$debitor} </td>
                                        <td> {$expire_date} </td>
                                        <td> {$branch} </td>
                                        <td> {$customer_name}</td>
                                        <td> {$issue_date} </td>
                                        <td> {$country} </td>

                                        <td>
                                            {$status}
                                        </td>
                                    </tr>
                                    ";
                                    $x++;
                                }
                            }
                            else{
                                echo "Server Prob";
                            }
                        ?>
                </table>
            </div>
       </div>
   </div>
</div>
</div>