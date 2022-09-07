<?php

    function check_admin_login(){
        if(isset($_SESSION["admin_id"])){
            return true;
        }
        else{
            return false;
        }
    }


    function confirm_admin_login(){
        if(check_admin_login()==false){
            Header("Location: admin_login.php");
        }
    }

    

    //Lawyer
    function check_employee_login()
    {
     if (isset($_SESSION["employee_id"])) {
      return true;
     } else {
      return false;
     }
    }

    function confirm_employee_login()
    {
     if (check_employee_login() == false) {
      echo "Login Required";
      header("Location: admin_login.php");
     }
    }
 ?>
