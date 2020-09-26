<?php

include_once '../service/user-question.php';
$status = false;

if (isset($_POST['encuesta'])) {
    $respuesta = new UserQuestion();
    $respuesta->id_person = $_POST['personId'];

    for ($i = 0; $i < 5; $i++) {
        $respuesta->answer = $_POST['rp' . ($i + 1)];
        $respuesta->id_question = $_POST['pre' . ($i + 1)];
        if ($respuesta->insertAnswer($respuesta)) {
            $status = true;
        } else {
            $status = false;
            break;
        }
    }

    if ($status === true) {
        header("location: index.php?success&pagina=1");
    } else {
        header("location: index.php?errorRespuesta&pagina=1");
    }
}
