<?php
require_once "includes/db.php";
require_once "currentquots.php";
$id = (int) $_SESSION["admin_id"];
if ($_GET['status'] == "accepted") {
	$stmt = $con->prepare("UPDATE  quotation SET quotation_status = 'accepted' WHERE quotation_id = {$quotation_id}");
} elseif($_GET['status'] == "rejected") {
	$stmt = $con->prepare("UPDATE  quotation SET quotation_status = 'rejected' WHERE quotation_id = {$quotation_id}");
}
$stmt->execute();
