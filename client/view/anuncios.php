<?php
include_once '../service/resultados.php';
include_once '../service/fechaconversion.php';
$resultado = new Resultado();
?>

<div class="card-job">
    <div class="job-status">
        <?php
        if ($anuncio['status'] == "1") {
        ?>
            <div class="status-process text-center"></div>
        <?php
        } else if ($anuncio['status'] == "0") {
        ?>
            <div class="status-failed text-center"></div>
        <?php
        } else if ($anuncio['status'] == null) {
        ?>
            <div class="status-new text-center"></div>
        <?php
        }
        ?>
    </div>
    <div class="job-img">
        <img src="../../admin/dist/img/jobs/<?php echo $anuncio['img'] ?> " alt="">
    </div>
    <div class="job-content">
        <?php

        $hoy = getdate();
        $fechahoy = convertir($hoy, $anuncio['created_at']);


        ?>
        <p class="fecha-hoy"><small>
                <?php
                echo $fechahoy;
                ?>
            </small></p>
        <div class="job-title">
            <h3><?php echo strtoupper($anuncio['name']); ?></h3>
            <ul class="job-category">
                <li>Lugar: <b><?php echo $anuncio['place_id']; ?> </b></li>
                <li>Categoría: <b><?php echo $anuncio['category_id']; ?> </b></li>
            </ul>
        </div>

        <div class="job-stats">
            <div class="job-data">
                <span class="label-stats">Postulantes</span>
                <span class="number-stats">
                    <?php
                    echo count($resultados = $resultado->getResultado($anuncio['id']));
                    ?>
                </span>
            </div>

            <div class="job-data">
                <span class="label-stats">Entrevistas</span>
                <span class="number-stats">
                    <?php
                    if ($anuncio['status'] == '1' or $anuncio['status'] == '0') echo count($resultados = $resultado->getEntrevistas($anuncio['id']));
                    else echo 0;
                    ?>
                </span>
            </div>
            <div class="job-data">
                <span class="label-stats">Aceptados</span>
                <span class="number-stats">
                    <?php
                    if ($anuncio['status'] == '0') echo count($resultados = $resultado->getAceptados($anuncio['id']));
                    else echo 0;
                    ?>
                </span>
            </div>

        </div>
        <?php
        if ($anuncio['status'] == "1") {
        ?>
            <a href="resultado.php?id=<?php echo $anuncio['id']; ?>&pagina=1" class="btn btn-warning job-link" id="detalle">Ver Resultados</a>
            <p><small>Finalizado el <?php echo $anuncio['limit_at']; ?></small></p>
        <?php
        } else if ($anuncio['status'] == "0") {
        ?>
            <a href="merito.php?id=<?php echo $anuncio['id']; ?>&pagina=1" class="btn btn-danger  job-link" id="detalle">Ver Cuadro de Méritos</a>
            <p><small>Finalizado el <?php echo $anuncio['limit_at']; ?></small></p>
        <?php
        } else if ($anuncio['status'] === null) {
        ?>
            <a href="detalle.php?codigo=<?php echo $anuncio['id']; ?>" class="btn btn-success  job-link" id="detalle">Ver Postulación</a>
            <p><small>Postula hasta <?php echo $anuncio['limit_at']; ?></small></p>
        <?php
        }
        ?>
    </div>
</div>