<?php
include 'header.php';
include 'nav.php';
include_once '../service/anuncios.php';
include_once '../service/messages.php';

$message = new Message();
if (isset($_GET['error'])) {

    $message->getMessages("error");
}
if (isset($_GET['errorarchivo'])) {
    $message->getMessages("errorarchivo");
}

if (!isset($_GET['codigo'])) {
    header("Location: index.php");
    exit;
} else {
    $id = $_GET['codigo'];
    $anuncios = new anuncios();
    $anuncio = $anuncios->getJob($id);
    $requerimientos = explode(";", $anuncio['requirements']);
    $descripcion = explode(";", $anuncio['description']);
}
?>


<div id="titulo-index">
    <h1 class="h1-strong h1-strong-detalle" id="h1-strong">Postula Ya!</h1>

    <div class="float-right" id="redes">
        <a href=#><span class="icon">f</span></a>
        <a href=#><span class="icon">g</span></a>
        <a href=#><span class="icon">t</span></a>
    </div>
    <div class="clearfix"></div>
</div>

<section class="col-lg-12 mx-auto pb-5 mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Bolsa de trabajo</a></li>
            <li class="breadcrumb-item"><a href="detalle.php?codigo=<?php echo $_GET['codigo']; ?>">Postulación</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $anuncio['name']; ?></li>
        </ol>
    </nav>
    <div class="col-12" id="titulo">
        <h3 class="h3-strong-category">Registrar Postulante<small>- Postula Aquí</small></h1>
    </div>
    <form class="mt-5" action="registro.php" method="POST" enctype="multipart/form-data">
        <div class="form-group row col-10 mx-auto ">
            <label for="proceso" class="col-2 col-form-label">PROCESO: </label>
            <input type="text" class="form-control col-sm-10" name="proceso" disabled="" value="<?php echo $anuncio['name']; ?>">
            <input type="hidden" name="codigo" value="<?php echo $id; ?>">
        </div>
        <div class="col-10 row mx-auto" id="form-postular">
            <div class="col-6 responsive-form">
                <div class="form-group col-12 mx-auto mt-3">
                    <input type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombres*" required="">
                </div>
                <div class="form-group col-12 mx-auto">

                    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos*" required="">
                </div>
                <div class="form-group col-12 mx-auto">

                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI*" required="" minlength="8" maxlength="8" pattern="[0-9]+">
                </div>
            </div>
            <div class="col-6 responsive-form">
                <div class="form-group col-12 mx-auto mt-3">

                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular*" required="">
                </div>
                <div class="form-group col-12 mx-auto">

                    <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico*" pattern="[Aa-Zz0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
                </div>
                <div class="row col-11 responsive-form">
                    <div class="form-group col-6 responsive-form ">
                        <label for="sexo">Sexo:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" checked="" type="radio" name="sexo" id="masculino" value="Masculino">
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="femenino" value="Femenino">
                            <label class="form-check-label" for="femenino">Femenino</label>
                        </div>
                    </div>
                    <div class="form-group col-6 responsive-form">
                        <label for="curriculum">Seleccione Curriculum Vitae:</label>
                        <input type="file" class="mt-1" id="curriculum" name="curriculum" required="">
                    </div>

                </div>
            </div>
            <input type="submit" class="btn btn-danger btn-lg mx-auto mt-3 col-2 p-3 responsive-form-success" value="Siguiente" name="siguiente">
        </div>
    </form>

</section>
<script>
    $(document).ready(function() {
        $('#h1-strong').css('opacity', '1');
        $('.contenedor-opciones').css('opacity', '1');
    });
</script>
<?php
include 'end.php';
?>