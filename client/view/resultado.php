<?php

include 'header.php';
include 'nav.php';
include_once '../service/resultados.php';
include_once '../service/anuncios.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
} else {
    $id = $_GET['id'];
    $resultado = new Resultado();
    $job = new anuncios();
    $resultados = $resultado->getResultado($_GET['id']);
    $jobs = $job->getJob($_GET['id']);
    if($jobs['name']==""){
        header('Location: index.php?pagina=1');
    }
}
?>
<div id="titulo-index">
    <h1 class="h1-strong h1-strong-detalle" id="h1-strong">Postulantes </h1>

    <div class="float-right" id="redes">
        <a href=#><span class="icon">f</span></a>
        <a href=#><span class="icon">g</span></a>
        <a href=#><span class="icon">t</span></a>
    </div>
    <div class="clearfix"></div>
</div>




<section class="col-lg-12 mx-auto mb-5 section-responsive mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Bolsa de trabajo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Resultados</li>
        </ol>
    </nav>
    <h3 class="h3-strong-category">Lista de postulantes para la entrevista<br><small><a href='detalle.php?codigo=<?php echo $jobs['id']; ?>'><?php echo $jobs['name'] ?></a></small></h3>
    <?php if (count($resultados) != 0) {

    ?>
        <table class="table table-hover col-9 mx-auto mt-5 mb-5">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center" style="background-color:#344b63;color:#eee ">N°</th>
                    <th scope="col" class="text-left" style="background-color:#344b63;color:#eee ">Nombres y Apellidos</th>
                    <th scope="col" class="text-center" style="background-color:#344b63;color:#eee ">DNI</th>
                    <th scope="col" class="text-center" style="background-color:#344b63;color:#eee ">Fecha de Postulación</th>
                    <th scope="col" class="text-center" style="background-color:#344b63;color:#eee ">Estado</th>
                </tr>
            </thead>
            <tbody class="col-12">
                <?php

                $articulosPagina = 10;
                $mysqli = new mysqli("localhost", "root", "", "recrutador");
                $iniciar = ($_GET['pagina'] - 1) * $articulosPagina;

                $numrows = count($resultados);

                $sql = $mysqli->prepare(" SELECT person.id,person.name,person.lastname,person.dni,DATE_FORMAT(person.created_at,'%d/%m/%Y'),person.job_id,person.status,job.name as jobName
                                        FROM person
                                    INNER JOIN job on
                                        job.id=person.job_id                    
                                    where job.id=" . $_GET['id'] . "
                                    ORDER BY person.status ASC
                                    LIMIT ?,10
                                    
                                    ");


                $sql->bind_param("s", $iniciar);
                $sql->execute();
                $sql->bind_result($id, $name, $lastname, $dni, $created_at, $job_id, $status, $jobName);

                $rests = [];



                while ($row = $sql->fetch()) {

                    $resultado = [
                        'id' => $id,
                        'name' => $name . " " . $lastname,
                        'dni' => $dni,
                        'created_at' => $created_at,
                        'job_id' => $job_id,
                        'status' => $status,
                        'jobName' => $jobName,
                    ];

                    array_push($rests, $resultado);
                }

                $paginas = ceil($numrows / $articulosPagina);


                $i = $iniciar + 1;
                foreach ($rests as $campo) {
                ?>
                    <tr>
                        <th scope="row" class="text-center text-muted"><?php echo $i; ?></th>
                        <td style="text-align:left;color:#555" class="text-muted"><?php echo $campo['name']; ?></td>
                        <td style="text-align:center;color:#555" class="text-muted"><?php echo $campo['dni']; ?></td>
                        <td style="text-align:center;color:#555" class="text-muted"><?php echo $campo["created_at"]; ?></td>
                        <td style="text-align:center;color:#555" class="text-muted">
                            <?php
                            if ($campo['status'] == '1' || $campo['status'] == '0' || $campo['status'] == '2') echo "<span style='color:blue'>Aceptado</span>";
                            else if ($campo['status'] == '3') echo "<span style='color:red'>No apto</span>";
                            else if ($campo['status'] == null || $campo['status'] == '3') echo "<span> - </span>";

                            ?>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item
        <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="resultado.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo "1" ?>"> <i class="fas fa-fast-backward"></i></a>
                </li>
                <li class="page-item
        <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="resultado.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>" tabindex="-1">
                        Anterior
                    </a>
                </li>
                <?php for ($j = 0; $j < $paginas; $j++) : ?>
                    <li class="page-item
                <?php echo $_GET['pagina'] == $j + 1 ? 'active' : '' ?>">
                        <a class="page-link" href="resultado.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $j + 1; ?>"><?php echo $j + 1; ?> </a>
                    </li>
                <?php endfor ?>
                <li class="page-item
        <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="resultado.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                </li>
                <li class="page-item
        <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="resultado.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $paginas ?>"> <i class="fas fa-fast-forward"></i></a>
                </li>

            </ul>
        </nav>


    <?php
    } else {
        echo "<div class='alert alert-danger col-10 mx-auto mt-5 mb-5 text-center d-flex justify-content-center align-items-center'><b>No hay resultado de postulantes para este trabajo</b></div>";
    }
    ?>

</section>
<div class="col-12">
    <ul class="row detalle-lista" id="enlaces">
        <li class="p-3"><a href="detalle.php?codigo=<?php echo $jobs['id'] ?>">Detalles</a></li>
        <?php


        if ($jobs['status'] === "1") {
            echo "<li class='p-3'><a href='resultado.php?id=" . $jobs['id'] . "&pagina=1'>Entrevista</a></li>";
            echo "<li class='p-3'><a>Resultados</a></li>";
        } else if ($jobs['status'] === "0") {
            echo "<li class='p-3'><a href='resultado.php?id=" . $jobs['id'] . "&pagina=1' >Entrevista</a></li>";
            echo "<li class='p-3'><a href='merito.php?id=" . $jobs['id'] . "&pagina=1'>Resultados</a></li>";
        } else if ($jobs['status'] == null) {
            echo "<li class='p-3'><a href='resultado.php?id=" . $jobs['id'] . "&pagina=1' >Entrevista</a></li>";
            echo "<li class='p-3'><a>Resultados</a></li>";
        }
        ?>



    </ul>
</div>
<script>
    $(document).ready(function() {
        $('#h1-strong').css('opacity', '1');
        $('.contenedor-opciones').css('opacity', '1');
    });
</script>

<?php include 'end.php'; ?>