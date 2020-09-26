<?php

ob_start();

if (!isset($_GET['pagina'])) {
  header("location: index.php?pagina=1");
}



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

if (isset($_GET['errorRespuesta'])) {
  $message->getMessages("errorRespuesta");
}
date_default_timezone_set('America/Lima');


?>
<button class="btn btn-lg menu-hidden2" id="menu-responsive2"><i class="fas fa-search"></i></button>
<button class="btn btn-lg menu-visible2" id="menu-responsive-hidden2"><i class='fas fa-angle-double-left'></i></button>
<div id="titulo-index">
  <h1 class="h1-strong" id="h1-strong">Bolsa de Trabajo</h1>


  <div class="col-md-4 row mx-auto d-flex justify-content-center contenedor-opciones">
    <div id="content-lugar" class="col-6">
      <ul id="categorias" class="mt-3">
        <li id="li-lugar"><a>Lugares &nbsp;<i class="fas fa-angle-down"></a></i>
          <ul id="sub-content-lugar">
            <li><a href="index.php">Limpiar...</a></li>
            <?php
            $lugares = $obLugar->getPlaces();
            foreach ($lugares as $lugar) {
              echo "<li><a href='index.php?idlug=" . $lugar['id'] . "&pagina=1'>" . $lugar['name'] . "</a></li>";
            }
            ?>
          </ul>
        </li>
      </ul>

    </div>

    <div id="content-categorias" class="col-6">
      <ul id="categorias" class="mt-3">
        <li id="li-lugar"><a>Categorias &nbsp;<i class="fas fa-angle-down"></a></i>
          <ul id="sub-content-categorias">
            <li><a href="index.php">Limpiar...</a></li>
            <?php
            $categorias = $obCategoria->getCategorys();
            foreach ($categorias as $categoria) {
              echo "<li><a href='index.php?idcat=" . $categoria['id'] . "&pagina=1'>" . $categoria['name'] . "</a></li>";
            }
            ?>
          </ul>
        </li>
      </ul>

    </div>
  </div>
  <div class="float-right" id="redes">
    <a href=#><span class="icon">f</span></a>
    <a href=#><span class="icon">g</span></a>
    <a href=#><span class="icon">t</span></a>
  </div>
  <div class="clearfix"></div>
</div>

<section>

  <div id="containt" class="contenedor-principal">


    <div class="filtros" id="filtros">
      <?php
      include_once 'filtros.php';
      ?>
    </div>
    <div class="main-content">
      <div class="content-main mx-auto">
        <nav aria-label="breadcrumb" style="width:100%;">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Bolsa de Trabajo</li>
          </ol>
        </nav>
        <?php
        if (isset($_GET['idcat'])) {
          $category = $obCategoria->getCategory($_GET['idcat']);
          echo "<h3 class='h3-strong-category'>Convocatorias y Resultados<small> - " . $category['name'] . "</small></h3>";
        } else if (isset($_GET['idlug'])) {
          $lugar = $obLugar->getPlace($_GET['idlug']);
          echo "<h3 class='h3-strong-category'>Convocatorias y Resultados<small> - " . $lugar['name'] . "</small></h3>";
        } else {
          echo "<h3 class='h3-strong-category'>Convocatorias y Resultados";
        }
        ?>

        <?php
        if (isset($_GET['idcat'])) {
          $anuncios = $obanuncios->getJobByCategory($_GET['idcat']);
        } else if (isset($_GET['idlug'])) {

          $anuncios = $obanuncios->getJobByPlace($_GET['idlug']);
        } else if (isset($_GET['filtro']) and $_GET['filtro'] != '') {
          if ($_GET['filtro'] == 'hoy') {
            $anuncios = $obanuncios->getByDate(getdate());
            $link = 'index.php?filtro=hoy&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Hoy</small></h3>";
          }
          if ($_GET['filtro'] == 'ayer') {
            $anuncios = $obanuncios->getByDayYesterday(1);
            $link = 'index.php?filtro=ayer&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Ayer</small></h3>";
          }
          if ($_GET['filtro'] == 'semana') {
            $anuncios = $obanuncios->getByWeek(0);
            $link = 'index.php?filtro=semana&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Esta semana</small></h3>";
          }
          if ($_GET['filtro'] == 'semanapast') {
            $anuncios = $obanuncios->getByWeek(1);
            $link = 'index.php?filtro=semanapast&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Hace una semana</small></h3>";
          }
          if ($_GET['filtro'] == 'thismonth') {
            $anuncios = $obanuncios->getByMonth(0);
            $link = 'index.php?filtro=thismonth&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Este mes</small></h3>";
          }
          if ($_GET['filtro'] == 'pastmonth') {
            $anuncios = $obanuncios->getByMonth(1);
            $link = 'index.php?filtro=pastmonth&pagina=';
            $numrows = count($anuncios);
            $paginas = ceil($numrows / 6);
            echo "<small> - Mes pasado</small></h3>";
          }
        } else if (isset($_GET['busqueda']) and $_GET['busqueda'] != '') {
          $anuncios = $obanuncios->getByName($_GET['busqueda']);
          $link = 'index.php?filtro=pastmonth&pagina=';
          $numrows = count($anuncios);
          $paginas = ceil($numrows / 6);
          echo "<small> - Busqueda</small></h3>";
        } else {
          $numrows = count($obanuncios->getJobs());

          $paginas = ceil($numrows / 6);
          echo "</h3>";
          if ($_GET['pagina'] > $paginas) {

            header("location: index.php?pagina=1");
            exit;
          }
          $anuncios = $obanuncios->getJobsPag($_GET['pagina']);
          $link = 'index.php?pagina=';
        }

        if (count($anuncios) == 0) {
          echo "<div class=' d-flex align-items-center justify-content-center mx-auto alert alert-danger col-md-6 mt-4 text-center'>No hay resultados</div>";
        } else {
          foreach ($anuncios as $anuncio) {
            include 'anuncios.php';
          }
        }
        ?>



      </div>
      <?php
      if (isset($_GET['idcat']) || isset($_GET['idlug'])) {
      } else {
      ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mt-5">
            <li class="page-item
        <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="<?php echo $link . "1" ?>"> <i class="fas fa-fast-backward"></i></a>
            </li>
            <li class="page-item
        <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="<?php echo $link . $_GET['pagina'] - 1 ?>" tabindex="-1">
                Anterior
              </a>
            </li>
            <?php for ($j = 0; $j < $paginas; $j++) : ?>
              <li class="page-item
                <?php echo $_GET['pagina'] == $j + 1 ? 'active' : '' ?>">
                <a class="page-link" href="<?php echo $link . ($j + 1); ?>"><?php echo $j + 1; ?> </a>
              </li>
            <?php endfor ?>
            <li class="page-item
        <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
              <a class="page-link" href="<?php echo $link . ($_GET['pagina'] + 1); ?>">Siguiente</a>
            </li>
            <li class="page-item
        <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
              <a class="page-link" href="<?php echo $link . $paginas ?>"> <i class="fas fa-fast-forward"></i></a>
            </li>

          </ul>
        </nav>
      <?php
      }
      ?>

    </div>
    <div class="clearfix"></div>

</section>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalInfo" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-4">
        Bienvenido a la Bolsa de Trabajo, aquí puedes seleccionar y revisar el trabajo de tu interés
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="../js/index.js"></script>


<?php

if (isset($_GET['welcome'])) {
  echo "<script>     
    
        $(function(){
                            $('#modalInfo').modal();
                            });
                            
   
</script>";
}

include 'end.php';
ob_end_flush();
?>