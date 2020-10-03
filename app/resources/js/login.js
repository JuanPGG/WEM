//Validación del input email
let email = document.querySelector('#email');
email.setAttribute('pattern', "^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$");
email.setAttribute('required', true);
email.setAttribute('title', 'Ingresa un correo válido'); 


var recuperar = document.getElementById('recuperar');
var volver = document.getElementById('volver');
var containerRecuperar = document.getElementById('containerRecuperar');
var containerSesion = document.getElementById('containerSesion');

recuperar.addEventListener('click', function(){
	containerRecuperar.style.display = 'block';
	containerSesion.style.display = 'none';
});
volver.addEventListener('click', function(){
	containerRecuperar.style.display = 'none';
	containerSesion.style.display = 'block';
});
