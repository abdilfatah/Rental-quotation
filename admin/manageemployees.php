<section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
        <div class="row">
                <div class="py-2 col-md-3">
                        <a href="admin_dashboard.php" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-list-alt"></span> <i class="fa fa-plus"></i> &nbsp; Current Quotations
                        </a>
                </div>
                <div class="py-2 col-md-3">
                        <a href="admin_dashboard.php?q=manageemployees" class="btn btn-warning btn-block">
                        <span class="glyphicon glyphicon-user"></span> <i class="fa fa-check"></i> &nbsp; Manage Employee
                        </a>
                </div>
    </div>
</section>

       <div class="ml-10 col-sm-10">
            <h1>Employees</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr. no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr>
                        <?php
                            require_once("includes/db.php");
                            $con;
                            if ($con) {
                                $x=1;
                                $stmt = $con->prepare("
                                SELECT employee_id, employee_first_name, employee_last_name, employee_email
                                FROM employee_login");
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($employee_id, $employee_first_name, $employee_last_name,
                                $employee_email);

                                while ($stmt->fetch()) {
                                    
                                    echo "
                                    <tr>
                                        <td> {$x} </td>
                                        <td> {$employee_first_name} {$employee_last_name}</td>
                                        <td> {$employee_email} </td>
                                        <td>
                                            <a class='btn btn-danger' href='admin_dashboard.php?q=removeemployee&id={$employee_id}'>
                                                Delete
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
