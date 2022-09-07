<?php
require_once "includes/db.php";
require_once "currentquots.php";
$id = (int) $_SESSION["admin_id"];
if ($_GET['status'] == "accepted") {
	$stmt = $con->prepare("UPDATE  quotation SET quotation_status = 'accepted' WHERE admin_id={$id} and employee_id = {$_GET['id']} and quotation_id = {$_GET['quotation_id']}");
} elseif($_GET['status'] == "rejected") {
	$stmt = $con->prepare("UPDATE  quotation SET quotation_status = 'rejected' WHERE admin_id={$id} and employee_id = {$_GET['id']} and quotation_id = {$_GET['quotation_id']}");
}
$stmt->execute();
