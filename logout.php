<?php
require_once "includes/sessions.php";
if (isset($_SESSION["admin_id"])) {
 $_SESSION["admin_id"] = null;
 $_SESSION["admin_name"] = null;
} elseif (isset($_SESSION["employee_id"])) {
 $_SESSION["employee_id"] = null;
 $_SESSION["employee_name"] = null;
} 
session_destroy();
header("Location: index.php");
