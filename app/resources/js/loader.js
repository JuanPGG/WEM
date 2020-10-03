// Función para ocultar el loader en el transcurso de 1 segundo
window.addEventListener('load', function(){
	// definición de variables
	let body = document.getElementsByTagName('body')[0];
	let ocultar = document.getElementById('onload');
	//Tiempo de ejecución y estilos para esconder
	ocultar.style.transition='1s';
	ocultar.style.opacity='0';
	ocultar.style.zIndex='-1';
	//Quitar la clase hidden de la etiqueta body
	body.classList.remove('hidden');
});