if (screen.width <= 900) {
	click1 = true;
	click2 = true;
	window.addEventListener('click', function (e) {
		if (document.getElementById('content-lugar').contains(e.target)) {
			document.getElementById('navbar').style.top = '0';
			mostrarLugar(click1);
		} else if (
			document.getElementById('content-categorias').contains(e.target)
		) {
			document.getElementById('navbar').style.top = '0';
			mostrarCategoria(click2);
		} else {
			noMostrarNada();
		}
	});
}
function mostrarLugar(valor) {
	if (valor == true) {
		noMostrarNada();
		$('#sub-content-lugar').css('display', 'block');
		document.getElementById('navbar').style.top = '0';
		$('#content-lugar').css('background', 'rgba(238, 238, 238, 0.7)');
		click1 = false;
		click2 = true;
	} else {
		noMostrarNada();
	}
}

function mostrarCategoria(valor) {
	if (valor == true) {
		noMostrarNada();
		$('#sub-content-categorias').css('display', 'block');
		$('#content-categorias').css('background', 'rgba(238, 238, 238, 0.7)');
		document.getElementById('navbar').style.top = '0';
		click2 = false;
		click1 = true;
	} else {
		noMostrarNada();
	}
}

function noMostrarNada() {
	$('#sub-content-lugar').css('display', 'none');
	$('#content-lugar').css('background', 'none');
	$('#sub-content-categorias').css('display', 'none');
	$('#content-categorias').css('background', 'none');
	click1 = true;
	click2 = true;
}

$(document).ready(function () {
	$('#h1-strong').css('opacity', '1');
	$('.contenedor-opciones').css('opacity', '1');
});
