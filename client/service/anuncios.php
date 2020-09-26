<?php

include_once 'db.php';

class anuncios extends DB
{

    private $id;
    private $name;
    private $description;
    private $requirements;
    private $limit_at;
    private $created_at;
    private $status;
    private $category_id;
    private $place_id;
    public static $table = 'job';

    function __construct()
    {
        parent::__construct();
    }

    public function getJob($id)
    {
        $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($id), ENT_QUOTES)));
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e %M %Y') ,DATE_FORMAT(job.created_at, '%W  %e %M %Y'),status,category.name,place.name,job.img
                FROM job
            INNER JOIN category on
                job.category_id=category.id
            INNER JOIN place on
                job.place_id=place.id
            WHERE job.id=$codigo
            ORDER BY
                job.name");
        return $this->setDataBy($sql);
    }

    public function getJobs()
    {
        $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y') ,DATE_FORMAT(job.created_at, '%W, %e de %M del %Y - %H:%i'),status,category.name,place.name,job.img,job.category_id
                    FROM job
                INNER JOIN category on
                    job.category_id=category.id
                INNER JOIN place on
                    job.place_id=place.id
                ORDER BY
                    job.name");

        return $this->setDataJobs($sql);
    }


    public function getJobsPag($pagina)
    {
        $iniciar = ($pagina - 1) * 6;
        $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");

        $mysqli = new mysqli("localhost", "root", "", "recrutador");

        $sql = $mysqli->prepare("SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y') ,DATE_FORMAT(job.created_at, '%W, %e de %M del %Y - %H:%i'),status,category.name,place.name,job.img,job.category_id
                    FROM job
                INNER JOIN category on
                    job.category_id=category.id
                INNER JOIN place on
                    job.place_id=place.id
                ORDER BY
                    job.name
                LIMIT ?,6");

        return $this->setData($sql, $iniciar);
    }



    public function getJobByCategory($id)
    {
        $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($id), ENT_QUOTES)));
        $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e %M %Y') ,DATE_FORMAT(job.created_at, '%W  %e %M %Y'),status,category.name,place.name,job.img,job.category_id
                    FROM job
                INNER JOIN category on
                    job.category_id=category.id
                INNER JOIN place on
                    job.place_id=place.id
                where job.category_id=$codigo
                ORDER BY
                    job.name");

        return $this->setDataJobs($sql);
    }


    public function getJobByCategoryPag($pagina, $id)
    {
        $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($id), ENT_QUOTES)));
        $iniciar = ($pagina - 1) * 6;
        $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");

        $mysqli = new mysqli("localhost", "root", "", "recrutador");



        $sql = $mysqli->prepare("SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e %M %Y') ,job.created_at,status,category.name,place.name,job.img,job.category_id
                FROM job
                INNER JOIN category on
                    job.category_id=category.id
                INNER JOIN place on
                    job.place_id=place.id
                where job.category_id=$codigo
                ORDER BY
                    job.name
                LIMIT ?,6");

        return $this->setData($sql, $iniciar);
    }

    public function getJobByPlace($id)
    {
        $codigo = mysqli_real_escape_string($this->connect(), (strip_tags(($id), ENT_QUOTES)));
        $sql = mysqli_query($this->connect(), "SET GLOBAL lc_time_names = 'es_MX'");
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e %M %Y') ,DATE_FORMAT(job.created_at, '%W  %e %M %Y'),status,category.name,place.name,job.img,job.category_id
                    FROM job
                INNER JOIN category on
                    job.category_id=category.id
                INNER JOIN place on
                    job.place_id=place.id
                where job.place_id=$codigo
                ORDER BY
                    job.name");

        return $this->setDataJobs($sql);
    }

    public function addQuestion($d, $cod, $r1, $r2, $r3, $r4, $r5)
    {
        $rows = mysqli_query($this->connect(), "SELECT * FROM question");


        $dni = mysqli_real_escape_string($this->connect(), (strip_tags(($d), ENT_QUOTES)));
        $jobid = mysqli_real_escape_string($this->connect(), (strip_tags(($cod), ENT_QUOTES)));
        $res1 = mysqli_real_escape_string($this->connect(), (strip_tags(($r1), ENT_QUOTES)));
        $res2 = mysqli_real_escape_string($this->connect(), (strip_tags(($r2), ENT_QUOTES)));
        $res3 = mysqli_real_escape_string($this->connect(), (strip_tags(($r3), ENT_QUOTES)));
        $res4 = mysqli_real_escape_string($this->connect(), (strip_tags(($r4), ENT_QUOTES)));
        $res5 = mysqli_real_escape_string($this->connect(), (strip_tags(($r5), ENT_QUOTES)));

        $insert = mysqli_query($this->connect(), "INSERT INTO question(dni,jobId,pre1,pre2,pre3,pre4,pre5) VALUES('$dni','$jobid','$res1','$res2','$res3','$res4','$res5')");

        if ($insert) {
        } else {
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos.</div>';
        }
    }


    public function getByDate($hoy)
    {
        include_once 'fechaconversion.php';
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y'),DATE_FORMAT(job.created_at, '%W, %e de %M del %Y - %H:%i'),job.status,job.category_id,job.place_id,job.img,category.name as categoryName ,place.name as placeName from " . self::$table . " inner join category on job.category_id=category.id inner join place on place.id=job.place_id");
        $jobs = [];



        while ($row = mysqli_fetch_row($sql)) {

            $fechaHoy = convertirFechaHoy($hoy, $row[5]);
            $fechaSql = convertir($hoy, $row[5]);

            if ($fechaHoy == $fechaSql) {
                $job = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'description' => $row[2],
                    'requirements' => $row[3],
                    'limit_at' => $row[4],
                    'created_at' => $row[5],
                    'status' => $row[6],
                    'category_id' => $row[10],
                    'place_id' => $row[11],
                    'img' => $row[9]
                ];

                array_push($jobs, $job);
            } else {
            }
        }

        return $jobs;
    }

    public function getByDayYesterday($day)
    {
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y'),created_at,job.status,job.category_id,job.place_id,job.img,category.name as categoryName ,place.name as placeName from " . self::$table . " inner join category on job.category_id=category.id inner join place on place.id=job.place_id WHERE DAYOFYEAR(created_at)=DAYOFYEAR(NOW()) - $day ");
        $valor = 'ayer';


        return $this->setDataJobs($sql, $valor);
    }

    public function getByWeek($week)
    {
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y'),created_at,job.status,job.category_id,job.place_id,job.img,category.name as categoryName ,place.name as placeName from " . self::$table . " inner join category on job.category_id=category.id inner join place on place.id=job.place_id where WEEKOFYEAR(created_at)=WEEKOFYEAR(now())-$week");
        $jobs = [];
        $valor = '';
        if ($week != 0) {
            $valor = 'la semana pasada';
        } else {
            $valor = 'esta semana';
        }

        return $this->setDataJobs($sql, $valor);
    }

    public function getByMonth($month)
    {
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y'),created_at,job.status,job.category_id,job.place_id,job.img,category.name as categoryName ,place.name as placeName from " . self::$table . " inner join category on job.category_id=category.id inner join place on place.id=job.place_id where MONTH(created_at)=MONTH(now())-$month");
        $jobs = [];
        $valor = '';
        if ($month != 0) {
            $valor = 'el mes pasado';
        } else {
            $valor = 'este mes';
        }

        return $this->setDataJobs($sql, $valor);
    }


    public function getByName($busqueda)
    {
        $sql = mysqli_query($this->connect(), "SELECT job.id,job.name,job.description,job.requirements,DATE_FORMAT(job.limit_at, '%W  %e de %M del %Y'),DATE_FORMAT(job.created_at, '%W  %e de %M del %Y'),job.status,job.category_id,job.place_id,job.img,category.name as categoryName ,place.name as placeName from " . self::$table . " inner join category on job.category_id=category.id inner join place on place.id=job.place_id  where job.name LIKE '%$busqueda%' or category.name LIKE '%$busqueda%' or place.name LIKE '%$busqueda%'");
        $jobs = [];


        while ($row = mysqli_fetch_row($sql)) {

            $job = [
                'id' => $row[0],
                'name' => $row[1],
                'description' => $row[2],
                'requirements' => $row[3],
                'limit_at' => $row[4],
                'created_at' => $row[5],
                'status' => $row[6],
                'category_id' => $row[10],
                'place_id' => $row[11],
                'img' => $row[9],

            ];

            array_push($jobs, $job);
        }

        return $jobs;
    }



    //LLENAR DATOS


    public function setDataJobs($sql, $valor = null, $hoy = null)

    {
        $jobs = [];
        if ($valor === null) {

            while ($row = mysqli_fetch_row($sql)) {

                $job = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'description' => $row[2],
                    'requirements' => $row[3],
                    'limit_at' => $row[4],
                    'created_at' => $row[5],
                    'status' => $row[6],
                    'category_id' => $row[7],
                    'place_id' => $row[8],
                    'img' => $row[9],
                    '   ' => $row[10]
                ];

                array_push($jobs, $job);
            }

            return $jobs;
        } else {
            while ($row = mysqli_fetch_row($sql)) {

                $job = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'description' => $row[2],
                    'requirements' => $row[3],
                    'limit_at' => $row[4],
                    'created_at' => $valor,
                    'status' => $row[6],
                    'category_id' => $row[10],
                    'place_id' => $row[11],
                    'img' => $row[9],
                    '   ' => $row[10]
                ];

                array_push($jobs, $job);
            }

            return $jobs;
        }
        if ($hoy != null) {
        }
    }

    public function setDataBy($sql)
    {
        $row = mysqli_fetch_row($sql);
        if ($row >= 0) {
            $job = [
                'id' => $row[0],
                'name' => $row[1],
                'description' => $row[2],
                'requirements' => $row[3],
                'limit_at' => $row[4],
                'created_at' => $row[5],
                'status' => $row[6],
                'category_id' => $row[7],
                'place_id' => $row[8],
                'img' => $row[9]
            ];
            return $job;
        } else {
            echo "ERROR";
        }
    }

    public function setData($sql, $iniciar)
    {
        $sql->bind_param("s", $iniciar);
        $sql->execute();
        $sql->bind_result($id, $name, $description, $requirements, $limit_at, $created_at, $status, $categoryName, $placeName, $img, $category_id);

        $jobs = [];

        while ($sql->fetch()) {

            $job = [
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'requirements' => $requirements,
                'limit_at' => $limit_at,
                'created_at' => $created_at,
                'status' => $status,
                'category_id' => $categoryName,
                'place_id' => $placeName,
                'img' => $img,
            ];

            array_push($jobs, $job);
        }

        return $jobs;
    }
}
