<?php   
    include_once 'db.php';

    class Resultado extends DB{

        private $id_job;
        private $name;    

        function __construct() {
            parent::__construct();
        }

        public function getEntrevistas($job){
            $this->id_job= mysqli_real_escape_string($this->connect(), (strip_tags(($job), ENT_QUOTES)));
            $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
            $sql = mysqli_query($this->connect(), "SELECT person.id,person.name,person.lastname,person.dni,person.created_at,person.job_id,person.status,job.name as jobName
                        FROM person
                    INNER JOIN job on
                        job.id=person.job_id                    
                    where job.id=$this->id_job and (person.status=2 OR person.status=1 or person.status=0)");

            $results = [];
    
    
            while ($row = mysqli_fetch_row($sql)) {
    
                $result = [
                    'id' => $row[0],
                    'name' => $row[1]." ".$row[2],
                    'dni' => $row[3],                    
                    'created_at' => $row[4],
                    'job_id' => $row[5],
                    'status' => $row[6],
                    'jobName' => $row[7],             
                ];
    
                array_push($results, $result);
            }
    
            return $results;

        }

        public function getAceptados($job){
            $this->id_job= mysqli_real_escape_string($this->connect(), (strip_tags(($job), ENT_QUOTES)));
            $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
            $sql = mysqli_query($this->connect(), "SELECT person.id,person.name,person.lastname,person.dni,person.created_at,person.job_id,person.status,job.name as jobName
                        FROM person
                    INNER JOIN job on
                        job.id=person.job_id                    
                    where job.id=$this->id_job and person.status=2 ");

            $results = [];
    
    
            while ($row = mysqli_fetch_row($sql)) {
    
                $result = [
                    'id' => $row[0],
                    'name' => $row[1]." ".$row[2],
                    'dni' => $row[3],                    
                    'created_at' => $row[4],
                    'job_id' => $row[5],
                    'status' => $row[6],
                    'jobName' => $row[7],             
                ];
    
                array_push($results, $result);
            }
    
            return $results;

        }
      
        public function getResultado($job){
            
            $this->id_job= mysqli_real_escape_string($this->connect(), (strip_tags(($job), ENT_QUOTES)));
            $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
            $sql = mysqli_query($this->connect(), "SELECT person.id,person.name,person.lastname,person.dni,person.created_at,person.job_id,person.status,job.name as jobName
                        FROM person
                    INNER JOIN job on
                        job.id=person.job_id                    
                    where job.id=$this->id_job");

            $results = [];
    
    
            while ($row = mysqli_fetch_row($sql)) {
    
                $result = [
                    'id' => $row[0],
                    'name' => $row[1]." ".$row[2],
                    'dni' => $row[3],                    
                    'created_at' => $row[4],
                    'job_id' => $row[5],
                    'status' => $row[6],
                    'jobName' => $row[7],             
                ];
    
                array_push($results, $result);
            }
    
            return $results;

        }

    }
?>