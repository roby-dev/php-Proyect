<?php

include_once 'db.php';

class Question extends DB
{

    function __construct()
    {
        parent::__construct();
        $this->id_question = "";
        $this->description = "";
    }

    public function getQuestion()
    {
        $query = "SELECT * FROM question ORDER BY RAND() LIMIT 5";
        $sql = mysqli_query($this->connect(), $query);
        return $this->setData($sql);
    }

    public function setData($sql)
    {
        $results = [];


        while ($row = mysqli_fetch_row($sql)) {

            $result = [
                'id_question' => $row[0],
                'description' => $row[1],
            ];

            array_push($results, $result);
        }

        return $results;
    }
}
