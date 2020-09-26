<?php
	
	include_once 'db.php';


	class Ciudad extends DB{


    private $id; 
    private $name;

      function __construct() {
        parent::__construct();
    }

    public function getPlaces(){        
            
            $sql = mysqli_query($this->connect(), "SELECT * from place order by name");                        
    
            $categorys = [];
    
    
            while ($row = mysqli_fetch_row($sql)) {
    
                $category = [
                    'id' => $row[0],
                    'name' => $row[1]                   
                ];
    
                array_push($categorys, $category);
            }
    
            return $categorys;
    }

    public function getPlace($id) {
        $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($id), ENT_QUOTES)));
        $sql = $sql = mysqli_query($this->connect(), "SELECT * from place where id=$codigo");
        $row = mysqli_fetch_row($sql);
        if ($row >= 0) {
            $job = [
                'id' => $row[0],
                'name' => $row[1]                
            ];
            return $job;
        } else {
            echo "ERROR";
        }
    }
  
	}
