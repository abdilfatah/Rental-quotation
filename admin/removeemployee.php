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
                        <span class="glyphicon glyphicon-user"></span> <i class="fa fa-plus"></i> &nbsp; Manage Employee
                        </a>
                </div>
    </div>
</section>

       <?php if(isset($_GET['id'])){ ?>
           <?php
                require_once("includes/db.php");
                $con;
                if ($con) {
                    $stmt = $con->prepare("
                    SELECT employee_first_name
                    FROM employee_login WHERE employee_id=?");
                    $stmt->bind_param('i', $_GET['id']);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($user_name);
                    while ($stmt->fetch()) {
                        $uname = $user_name;
                    }
                }
            ?>
           <div class="col-md-6 col-sm-10 ">
                <h1>Remove employee</h1>
                <div class="alert alert-danger">
                    Are you sure you want to delete employee from  <?php echo $uname;?> ?
                    <br>
                </div>
                <form action="admin_dashboard.php?q=removeemployee&id=<?php echo $_GET['id']; ?>" method="post">
                    <button class="btn btn-success btn-block" name="delete-yes">
                        Yes
                    </button>
                    <button class="btn btn-danger btn-block" name="delete-no">
                        No
                    </button>
                </form>
                <br>

                <?php
                    if(isset($_POST['delete-yes'])){
                        if ($con) {
                            $stmt = $con->prepare("
                            DELETE FROM employee_login WHERE employee_id = ?");
                            $stmt->bind_param('i', $_GET['id']);
                            $stmt->execute();
                            echo "Deleted employee";
                            Header("Location: admin_dashboard.php?q=manageemployees");
                        }
                    }
                    if(isset($_POST['delete-no'])){
                        Header("Location: admin_dashboard.php?q=manageemployees");
                    }
                ?>

           </div>
        <?php } ?>
   </div>
</div>
