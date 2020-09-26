<?php
include 'header.php';
include 'nav.php';
include_once '../service/anuncios.php';
include_once '../service/person.php';
include_once '../service/messages.php';
include_once '../service/question.php';


if (isset($_POST['siguiente'])) {

    $person = new Person();

    $person->setFile($_FILES['curriculum']['name']);
    $extensiones = array("pdf", "doc", "docx");
    $extensiosn = explode(".", $person->getFile());
    $extension = end($extensiosn);
    $directorio = "../../admin/uploads/";
    $person->setDni($_POST['dni']);
    $dni = $_POST['dni'];
    $jobid = $_POST['codigo'];
    $person->setName($_POST['nombres']);
    $person->setLastname($_POST['apellidos']);
    $person->setPhone($_POST['celular']);
    $person->setEmail($_POST['email']);
    $person->setJob_id($_POST['codigo']);
    $codigoId = $_POST['codigo'];
    date_default_timezone_set('America/Bogota');
    $hoy = getdate();
    $person->setCreated_at($hoy['year'] . "-" . $hoy['mon'] . "-" . $hoy['mday'] . " " . $hoy['hours'] . ":" . $hoy['minutes'] . ":" . $hoy['seconds']);
    $person->setStatus(1);
    $tipo_archivo = $_FILES['curriculum']['type'];
    $tamano_archivo = $_FILES['curriculum']['size'];
    $destino = $directorio . $person->getFile();



    if ((($tipo_archivo == "application/msword") || ($tipo_archivo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($tipo_archivo == "application/pdf")) && ($tamano_archivo < 2000000) && in_array($extension, $extensiones)) {

        if ($person->addPerson($person)) {
            move_uploaded_file($_FILES["curriculum"]["tmp_name"], $destino);
            $message = new Message();
            $message->getMessages("success");
        } else {

            header("Location: postula.php?codigo=" . $person->getJob_id() . "&error");
            exit;
        }
    } else {

        header("Location: postula.php?codigo=" . $person->getJob_id() . "&errorarchivo");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}


$obanuncio = new anuncios();
$anuncio = $obanuncio->getJob($jobid);

?>

<div id="titulo-index">
    <h1 class="h1-strong h1-strong-detalle" id="h1-strong">Cuestionario </h1>

    <div class="float-right" id="redes">
        <a href=#><span class="icon">f</span></a>
        <a href=#><span class="icon">g</span></a>
        <a href=#><span class="icon">t</span></a>
    </div>
    <div class="clearfix"></div>
</div>




<section class="col-lg-12 mx-auto mb-5 section-responsive">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Bolsa de trabajo</a></li>
            <li class="breadcrumb-item"><a href="detalle.php?codigo=<?php echo $jobid; ?>">Postulación</a></li>
            <li class="breadcrumb-item"><a href="postula.php?codigo=<?php echo $jobid; ?>"><?php echo $anuncio['name']; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Responde cuestionario</li>
        </ol>
    </nav>
    <h3 class="h3-strong-category">Responde las siguientes preguntas</h3>

    <form method="POST" action="registrar.php">
        <div class="row col-10 mx-auto form-preguntas">
            <div class="col-8 mx-auto">
                <?php
                $person = new Person();
                $id = $person->getPersonId($dni, $jobid);
                $question = new Question();
                $questions = $question->getQuestion();
                $i = 0;
                foreach ($questions as $pre) {
                    $i++;
                ?> <div class="form-group">
                        <label><?php echo $pre['description']; ?></label>
                        <input type="text" class="form-control" name="rp<?php echo $i; ?>">
                        <input type="hidden" value="<?php echo $pre['id_question']; ?>" name="pre<?php echo $i; ?>">
                    </div>
                <?php
                }
                ?>
                <input type="hidden" value="<?php echo $id['id']; ?>" name="personId">
                <input type="hidden" value="<?php echo $_GET['codigo'] ?>" name="questionId">

                <div class="col-12 mt-5">
                    <input type="submit" name="encuesta" id="encuesta-submit" value="Enviar encuesta" class="btn btn-danger btn-lg d-block mx-auto m-2 col-8 ">
                </div>
            </div>
    </form>
</section>

<script>
    $(document).ready(function() {
        $('#h1-strong').css('opacity', '1');
        $('.contenedor-opciones').css('opacity', '1');
    });
</script>

<?php include 'end.php'; ?>