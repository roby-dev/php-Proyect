let ubicacionPrincipal = window.pageYOffset;

window.onscroll = function () {
	let desplazamientoActual = window.pageYOffset;
	console.log(window.pageYOffset);
	if (window.pageYOffset >= 465) {
		$('#navbar').addClass('navMostrar');
	} else {
		$('#navbar').removeClass('navMostrar');
	}

	ubicacionPrincipal = desplazamientoActual;
};

$(document).ready(function () {
	setTimeout(function () {
		$('.preloader').fadeOut('slow');
	}, 1400);

	let comprobar = true;

	$('.ir-arriba').click(function () {
		$('body, html').animate(
			{
				scrollTop: '0px',
			},
			500
		);
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.ir-arriba').fadeIn('slow');
		} else {
			$('.ir-arriba').fadeOut('slow');
		}
	});

	$('#menu-responsive').click(function (event) {
		$('#menu-responsive').css('display', 'none');
		$('#menu-responsive2').css('display', 'none');
		$('.navbar-nav').css('left', '0');
		$('#menu-responsive-hidden').css('right', '0');

		comprobar = false;

		$('#menu-responsive-hidden').click(function (event) {
			$('.navbar-nav').css('left', '-100vh');
			$('#menu-responsive').css('display', 'block');
			$('#menu-responsive2').css('display', 'block');
			$('#menu-responsive-hidden').css('right', '-100px');
		});
	});

	$('#menu-responsive2').click(function (event) {
		$('#menu-responsive').css('display', 'none');
		$('#menu-responsive2').css('display', 'none');
		$('#menu-responsive-hidden2').css('right', '0');
		$('#filtros').css('left', '0');
		comprobar = false;

		$('#menu-responsive-hidden2').click(function (event) {
			$('#menu-responsive').css('display', 'block');
			$('#menu-responsive2').css('display', 'block');
			$('#menu-responsive-hidden2').css('right', '-100px');
			$('#filtros').css('left', '-600px');
		});
	});
	click = false;
	if (screen.width <= 900) {
		window.addEventListener('click', function (e) {
			let inputs = document.getElementsByTagName('INPUT');

			for (i = 0; i < inputs.length; i++) {
				if (inputs[i].contains(e.target)) {
					document.getElementById('navbar').style.top = '0';
					document.getElementById('menu-responsive').style.left = '0';
					console.log('ra');
				}
			}
			if (click == false) {
				document.getElementById('navbar').style.top = '-300px';
				$('#menu-responsive').css('left', '-50px');
				$('#menu-responsive2').css('left', '-50px');
				click = true;
			} else {
				document.getElementById('navbar').style.top = '0';
				$('#menu-responsive').css('left', '0');
				$('#menu-responsive2').css('left', '0');
				click = false;
			}
			if (
				document.getElementById('menu-responsive').contains(e.target) ||
				document.getElementById('menu-responsive2').contains(e.target)
			) {
				console.log(e.target);
				document.getElementById('navbar').style.top = '0';
				$('#menu-responsive').css('left', '0');
				$('#menu-responsive2').css('left', '0');
			}
		});
	}
});
