<?php
session_start();

$is_pacient = false;
if (isset($_SESSION["pacient_id"])) {
	$is_pacient = true;
}

unset($_SESSION['user_id']);
unset($_SESSION['pacient_id']);

session_destroy();

if ($is_pacient) {
	print "<script>window.location='./?view=pacientlogin';</script>";
}
print "<script>window.location='./';</script>";
