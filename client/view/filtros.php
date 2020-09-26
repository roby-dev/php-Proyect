<div class="filtros-content" id="filtros-content">
    <h3>Filtros por palabra</h3>

    <input id="busqueda" onkeyup="onKeyUp(event)" type="text" class="form-control busqueda mb-5" id="inlineFormInputGroupUsername2" placeholder="Búsqueda">

    <h3>Filtros por fecha</h3>
    <ul>
        <li><a href='index.php?pagina=1'>Ninguno..</a></li>
        <li><a href='index.php?filtro=hoy&pagina=1'>Hoy</a></li>
        <li><a href='index.php?filtro=ayer&pagina=1'>Ayer</a></li>
        <li><a href='index.php?filtro=semana&pagina=1'>Esta semana</a></li>
        <li><a href='index.php?filtro=semanapast&pagina=1'>Semana pasada</a></li>
        <li><a href='index.php?filtro=thismonth&pagina=1'>Este mes</a></li>
        <li><a href='index.php?filtro=pastmonth&pagina=1'>Hace un mes</a></li>
    </ul>
</div>

<script>
    function onKeyUp(event) {
        var keycode = event.keyCode;
        let valor = $('#busqueda').val();
        if (keycode == '13') {
            window.location = "index.php?busqueda=" + valor + "&pagina=1";
        }
    }
</script>