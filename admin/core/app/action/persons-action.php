<?php
if (isset($_GET['job'])) {
	$link = $_GET['job'];
}


if (isset($_GET["opt"]) && $_GET["opt"] == "accept") {
	$category = PersonData::getById($_GET["id"]);
	$category->accept();
} else if (isset($_GET["opt"]) && $_GET["opt"] == "accepCont") {
	$category = PersonData::getById($_GET["id"]);
	$category->acceptCont();
} else if (isset($_GET["opt"]) && $_GET["opt"] == "denied") {
	$category = PersonData::getById($_GET["id"]);
	$category->denied();
} else if (isset($_GET["opt"]) && $_GET["opt"] == "deniedEnt") {
	$category = PersonData::getById($_GET["id"]);
	$category->deniedEnt();
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
	$category = PersonData::getById($_GET["id"]);
	$category->del();
}

if (isset($_GET['job'])) {
	$link = $_GET['job'];
	Core::redir("./index.php?view=persons&id=$link");
} else {
	Core::redir("./index.php?view=persons");
}
