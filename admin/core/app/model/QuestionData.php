<?php
class QuestionData
{
    public static $tablename = "question";

    public function QuestionData()
    {
        $this->id_question = "";
        $this->description = "";
    }

    public function add()
    {
        $sql = "insert into question (description) ";
        $sql .= "value (\"$this->description\")";
        return Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from " . self::$tablename . " where id_question=$id";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from " . self::$tablename . " where id_question=$this->id_question";
        Executor::doit($sql);
    }

    // partiendo de que ya tenemos creado un objecto QuestionData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update " . self::$tablename . " set description=\"$this->description\" where id_question=$this->id_question";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id_question=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new QuestionData());
    }

    public static function getAll()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new QuestionData());
    }

    public static function getLike($q)
    {
        $sql = "select * from " . self::$tablename . " where description like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new QuestionData());
    }
}
