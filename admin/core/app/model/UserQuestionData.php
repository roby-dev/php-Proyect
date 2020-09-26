<?php
class UserQuestionData
{
    public static $tablename = "userquestion";

    public function UserQuestionData()
    {

        $this->answer = "";
        $this->description  = "";
    }


    public static function getById($id)
    {
        $sql = "SELECT userquestion.answer,question.description 
        FROM userquestion 
        INNER JOIN question ON userquestion.id_question=question.id_question
        WHERE id_person=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserQuestionData());
    }
}
