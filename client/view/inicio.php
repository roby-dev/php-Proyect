<?php
include 'header.php';
include 'nav.php';
include_once '../service/anuncios.php';
include_once '../service/messages.php';
include_once '../service/categoria.php';
include_once '../service/ciudad.php';

$obanuncios = new anuncios();
$message = new Message();
$obCategoria = new Categoria();
$obLugar = new Ciudad();

if (isset($_GET['success'])) {
  $message->getMessages("success2");
}

if (isset($_GET['welcome'])) {
?><div class="preloader">
    <div class="content-preloader">
      <strong>Bienvenido</strong>
    </div>
  </div>

<?php
}
?>


<div class="titulo-index d-flex justify-content-end">
  <div class="align-self-end" id="redes">
    <a href=#><span class="icon">f</span></a>
    <a href=#><span class="icon">g</span></a>
    <a href=#><span class="icon">t</span></a>
  </div>
  <div class="clearfix"></div>
</div>

<div id="titulo" class="inicio-titulo">
  <h1 class="h1-inicio montserrat">Ofertas Laborales <small><a href="index.php?welcome&pagina=1">Ver todo</a></small></h1>
</div>

<section>
  <div class="inicio-content">
    <h2>¿QUÉ ES?
    </h2>
    <p>Es un servicio que realiza intermediación laboral entre la oferta (buscadores de empleo) y la demanda laboral (empresas) a través del recojo de información de las partes interesadas de tal manera que los primeros encuentren un puesto de trabajo y los segundos cubran sus vacantes.</p>
    <h2>¿A QUIÉNES ESTÁ DIRIGIDO?
    </h2>
    <p>Este servicio está dirigido a ciudadanos (desempleados fundamentalmente) que requieren asistencia para la intermediación y colocación laboral.</p>
    <h2>¿CUÁLES SON LOS REQUISITOS?
    </h2>
    <p>Para acceder a este servicio necesitas llenar/subir estos documentos correctamente:</p>
    <ul>
      <li>DNI original y vigente o documento análogo en el caso seas extranjero.</li>
      <li>Curriculum Vitae, de preferencia documentado.</li>
    </ul>
  </div>
</section>


<?php

include 'end.php';

?>