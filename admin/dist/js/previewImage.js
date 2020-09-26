$(document).ready(function() {

	document.getElementById("image").onchange = function(e) {
	console.log("GAAAAA");
	  // Creamos el objeto de la clase FileReader
	let reader = new FileReader();

	  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
	reader.readAsDataURL(e.target.files[0]);

	  // Le decimos que cuando este listo ejecute el código interno
	 reader.onload = function(){

	    $('#preview').removeAttr('src');
	    

	  	$('#preview').attr("src",reader.result);

	    
	  	};
	};        
       
       
});