$(document).ready(function () {
	carrito.addEventListener('click', function (e) {
		console.log('Ra');
	});
});

let ubicacionPrincipal = window.pageYOffset;

window.onscroll = function () {
	let desplazamientoActual = window.pageYOffset;

	if (ubicacionPrincipal >= desplazamientoActual || ubicacionPrincipal == 0) {
		document.getElementById('header').style.top = '0';
		document.getElementById('user-data').style.top = '0';
	} else {
		document.getElementById('header').style.top = '-300px';
		document.getElementById('user-data').style.top = '-300px';
	}

	ubicacionPrincipal = desplazamientoActual;

	const carrito = document.getElementById('carrito');
};
