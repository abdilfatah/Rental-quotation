
    <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
        <div class="row">
                <div class="py-2 col-md-3">
                        <a href="admin_dashboard.php" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-list-alt"></span> <i class="fa fa-plus"></i> &nbsp; Current Quotations
                        </a>
                </div>
                <div class="py-2 col-md-3">
                        <a href="admin_dashboard.php?q=manageemployees" class="btn btn-warning btn-block">
                        <span class="glyphicon glyphicon-user"></span> <i class="fa fa-people-roof"></i> &nbsp; Manage Employees
                        </a>
                </div>
                <div class="py-2 col-md-3">
                        <a href="admin_dashboard.php?q=createemployee" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-user"></span> <i class="fa fa-plus"></i> &nbsp; Create Employee
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
                                $stmt = $con->prepare("
                                SELECT quotation_id, company, debitor, expire_date, branch, customer_name, issue_date, country, quotation_status
                                FROM quotation WHERE quotation_status = ? or quotation_status = ? ");
                                $status = "not yet accepted";
                                $status1 = "accepted";
                                $stmt->bind_param('ss', $status, $status1);
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
                                            <a name='status' class='btn btn-success' href='admin_dashboard.php?q=addquotation&id={$quotation_id}&status=accepted&quotation_id={$quotation_id}}'>
                                                Accept
                                            </a>
                                            <a name='status' class='btn btn-danger' href='admin_dashboard.php?q=addquotation&id={$quotation_id}&status=rejected&quotation_id={$quotation_id}}'>
                                                 Reject
                                            </a>
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