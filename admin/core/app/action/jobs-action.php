<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$user = new JobData();
	$user->name = $_POST["name"];
	$og=$_POST['description'];
	$re=str_replace("\n",";",$og);
	$user->description = $re;
	$original=$_POST['requirements'];
	$reemplazo = str_replace("\n",";",$original);
	$user->requirements = $reemplazo;
	$user->limit_at = $_POST["limit_at"];
	$user->category_id = $_POST["category_id"];
	$user->place_id = $_POST["place_id"];
        $user->img=$_FILES["image"]['name'];
        $name=$_FILES["image"]['name'];        
	$user->add();
        $directorio="dist/img/jobs/";
        $destino=$directorio.$name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $destino);    
	Core::redir("./?view=jobs");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
	$user = JobData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$og=$_POST['description'];
	$re=str_replace("\n",";",$og);
	$user->description = $re;
	$original=$_POST['requirements'];
	$reemplazo = str_replace("\n",";",$original);	
	$user->requirements = $reemplazo;
	$user->limit_at = $_POST["limit_at"];
	$user->category_id = $_POST["category_id"];
	$user->place_id = $_POST["place_id"];
	$user->status = $_POST['status'];
    $user->img = $_POST['imagen'];
	
        if ($_FILES['image']['name']!=null) {
	        $directorio = "dist/img/jobs/";
	        $name = $_FILES["image"]['name'];
	        $destino = $directorio . $name;
	        move_uploaded_file($_FILES["image"]["tmp_name"], $destino);
	        $user->img=$name;
        }
    $user->update();
    Core::redir("./?view=jobs");

	
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$category = JobData::getById($_GET["id"]);
	$category->del();
	Core::redir("./index.php?view=jobs");
}

?>