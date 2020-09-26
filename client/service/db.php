<?php

    include_once('config.php');

    class DB{
        private $host;
        private $db;
        private $user;
        private $pass;        

        public function __construct(){
            $this->host     = HOST;
            $this->db       = DB;
            $this->user     = USER;
            $this->pass = PASSWORD;        
        }

        //mysql -e "USE todolistdb; select*from todolist" --user=azure --password=6#vWHD_$ --port=49175 --bind-address=52.176.6.0

        function connect(){
        
            try{

                $con = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
                return $con;

            }catch(mysqli_sql_exception $e){
                throw $e;
            }   
        }
}