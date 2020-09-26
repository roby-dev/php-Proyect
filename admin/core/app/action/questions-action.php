<?php

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {

    $user = new QuestionData();
    $user->description = $_POST["name"];
    $user->add();
    Core::redir("./?view=questions");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {
    $user = QuestionData::getById($_POST["user_id"]);
    $user->description = $_POST["name"];
    $user->update();
    Core::redir("./?view=questions");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
    $category = QuestionData::getById($_GET["id"]);
    $category->del();
    Core::redir("./index.php?view=questions");
}
