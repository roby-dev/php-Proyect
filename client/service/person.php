<?php

include_once 'db.php';

class Person extends DB
{

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getJob_id()
    {
        return $this->job_id;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setJob_id($job_id)
    {
        $this->job_id = $job_id;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function addPerson(Person $person)
    {

        $rows = mysqli_query($this->connect(), "SELECT * FROM person");
        $comprobar = false;

        foreach ($rows as $row) {

            if ($person->getDni() == $row['dni'] && $person->getJob_id() == $row['job_id']) {
                $comprobar = true;
                break;
            } else {
                $comprobar = false;
            }
        }

        if ($comprobar == true) {
            return false;
        } else {

            $dni = mysqli_real_escape_string($this->connect(), (strip_tags(($person->dni), ENT_QUOTES)));
            $nombres = mysqli_real_escape_string($this->connect(), (strip_tags(($person->name), ENT_QUOTES)));
            $apellidos = mysqli_real_escape_string($this->connect(), (strip_tags(($person->lastname), ENT_QUOTES)));
            $archivo = mysqli_real_escape_string($this->connect(), (strip_tags(($person->file), ENT_QUOTES)));
            $celular = mysqli_real_escape_string($this->connect(), (strip_tags(($person->phone), ENT_QUOTES)));
            $email = mysqli_real_escape_string($this->connect(), (strip_tags(($person->email), ENT_QUOTES)));
            $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($person->job_id), ENT_QUOTES)));
            $creado = mysqli_real_escape_string($this->connect(), (strip_tags(($person->created_at), ENT_QUOTES)));
            $estado = mysqli_real_escape_string($this->connect(), (strip_tags(($person->status), ENT_QUOTES)));
            $insert = mysqli_query($this->connect(), "INSERT INTO person(name,lastname,dni,file,phone,email,job_id,created_at,status)  VALUES('$nombres','$apellidos','$dni','$archivo','$celular','$email','$codigo','$creado',null)");

            if ($insert) {
                return true;
            } else {
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos.</div>';
                return false;
            }
        }
    }

    public function getPersonId($d, $j)
    {
        $dni = mysqli_real_escape_string($this->connect(), (strip_tags(($d), ENT_QUOTES)));
        $jobid = mysqli_real_escape_string($this->connect(), (strip_tags(($j), ENT_QUOTES)));

        $sql = $sql = mysqli_query($this->connect(), "SELECT * from person where dni='$dni' and job_id=$jobid;");
        $row = mysqli_fetch_row($sql);
        if ($row >= 0) {
            $job = [
                'id' => $row[0]
            ];
            return $job;
        } else {
            echo "ERROR";
        }
    }
}
