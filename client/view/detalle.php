<?php

include 'header.php';
include 'nav.php';
include_once '../service/anuncios.php';

if (!isset($_GET['codigo'])) {
    header("Location: index.php");
    exit;
} else {
    $id = $_GET['codigo'];
    $anuncios = new anuncios();
    $anuncio = $anuncios->getJob($id);
    if($anuncio['name']==""){
        header("Location:index.php?pagina=1");
    }
    $requerimientos = explode(";", $anuncio['requirements']);
    $descripcion = explode(";", $anuncio['description']);
}
?>
<div id="titulo-index">
    <h1 class="h1-strong h1-strong-detalle" id="h1-strong">Detalle</h1>

    <div class="float-right" id="redes">
        <a href=#><span class="icon">f</span></a>
        <a href=#><span class="icon">g</span></a>
        <a href=#><span class="icon">t</span></a>
    </div>
    <div class="clearfix"></div>
</div>

<section class="col-lg-12 mx-auto mb-5 section-responsive ">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Bolsa de trabajo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle Postulación</li>
        </ol>
    </nav>
    <h3 class="h3-strong-category">Detalle</h3>

    <div class="row col-11 mx-auto mt-5 pt-5 detalle-responsive">
        <div class="col-6 detalle-titulo">
            <div id="titulo-anuncio" class="mx-auto col-10 mb-5">
                <?php
                echo "<h3 class='h3-titulo titulo-detalle' style='color:#54706E !important'>" . $anuncio['name'] . "</h3>";
                ?>
            </div>

            <b>
                <?php
                if ($anuncio['status'] === "1") {
                    echo " <a href='resultado.php?id=$id&pagina=1' class='btn btn-danger btn-lg d-block mx-auto col-5 p-3 mb-5 detalle-boton'><b>Ver Resultados de Postulación</b></a>";
                } else if ($anuncio['status'] === "0") {
                    echo "<a href='merito.php?id=$id&pagina=1' class='btn btn-danger btn-lg d-block mx-auto col-5 p-3 mb-5 detalle-boton'><b>Ver Cuadro de Méritos</b></a>";
                } else if ($anuncio['status'] == null) {
                    echo  "<a href='postula.php?codigo=$id' class='btn btn-danger btn-lg d-block mx-auto col-5 p-3 mb-5 detalle-boton'><b>Postula Aquí</b></a>";
                }
                ?>
            </b>
            </a>
            <div id="imagenes" class="mx-auto col-12 row justify-conten-center">
                <img src="../../admin/dist/img/jobs/<?php echo $anuncio['img']; ?>" class="col-4 mx-auto">

            </div>

        </div>

        <div class="col-6 detalle-descripcion">
            <div id="detalle-convocatoria" class="col-12">
                <h2 class="h3-titulo text-left mb-4" style='color:#54706E !important'>Detalles Convocatoria</h2>
                <?php
                foreach ($descripcion as $desc) {
                    echo "<p>" . $desc . "</p>";
                }
                ?>
                <p>Requisitos: </p>
                <ul>
                    <?php
                    foreach ($requerimientos as $requerimiento) {
                        echo '<li class="ml-5">' . $requerimiento . '</li>';
                    }


                    ?>
                </ul>
            </div>
            <div class="col-12">
                <ul class="row detalle-lista" id="enlaces">
                    <li class="p-3"><a href="detalle.php?codigo=<?php echo $id ?>">Detalles</a></li>
                    <?php

                    if ($anuncio['status'] === "1") {
                        echo "<li class='p-3'><a href='resultado.php?id=$id&pagina=1'>Entrevista</a></li>";
                        echo "<li class='p-3'><a>Resultados</a></li>";
                    } else if ($anuncio['status'] === "0") {
                        echo "<li class='p-3'><a href='resultado.php?id=$id&pagina=1' >Entrevista</a></li>";
                        echo "<li class='p-3'><a href='merito.php?id=$id&pagina=1'>Resultados</a></li>";
                    } else if ($anuncio['status'] == null) {
                        echo "<li class='p-3'><a href='resultado.php?id=$id&pagina=1' >Entrevista</a></li>";
                        echo "<li class='p-3'><a>Resultados</a></li>";
                    }
                    ?>



                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script>
        $(document).ready(function() {
            $('#h1-strong').css('opacity', '1');
            $('.contenedor-opciones').css('opacity', '1');
        });
    </script>
</section>

<?php include 'end.php'; ?>