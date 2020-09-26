<?php

include_once 'db.php';

class UserQuestion extends DB
{

    function __construct()
    {
        parent::__construct();
        $this->id_person = "";
        $this->id_question = "";
        $this->answer = "";
    }

    public function insertAnswer(UserQuestion $userQuestion)
    {
        $query = "insert into userquestion(id_person,id_question,answer) values($userQuestion->id_person,$userQuestion->id_question,'$userQuestion->answer')";
        echo ($userQuestion->id_person . "\n" . $userQuestion->id_question);
        $insert = mysqli_query($this->connect(), $query);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
}
