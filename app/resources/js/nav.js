// definición de variables
let nav = document.getElementById('nav');
let menu = document.getElementById('enlaces');
let abrir = document.getElementById('open');
let cerrado = true;

function apertura(){ // Función para abrir o cerrar el menú del nav cuando está responsive
	if(cerrado){
		menu.style.height = '100vh';
		cerrado = false;
	}else{
		menu.style.height = '0px';
		menu.style.overflow = 'hidden';
		cerrado = true;
	}
}
function menus(){ // Función para el cambio de estilo del nav al momento de hacer scroll
	// Se toma el desplazamiento del scrol y se almacena en una variable
	let desplazamiento_actual = window.pageYOffset;
	if(desplazamiento_actual <= 10){
		nav.classList.remove('nav2');
		nav.className = ('nav1');
		nav.style.transition = 'all 1s ease';
		menu.classList.remove('enlaces2');
		menu.className = ('enlaces');
		menu.style.top='80px';
		abrir.style.color='white';
	}else{
		nav.classList.remove('nav1');
		nav.className = ('nav2');
		nav.style.transition = 'all 1s ease';
		menu.classList.remove('enlaces');
		menu.className = ('enlaces2');
		menu.style.top='100px';
		abrir.style.color='black';
	}
}
// función que se ejecuta cuando se carga la ventana del navegador
window.addEventListener('load', function(){
	menus();
});
// Función que se ejecuta cada que se hace scroll en el navegador
window.addEventListener('scroll',function(){
	menus();
});
// Función que se ejecuta cuando se cambia el tamaño de la ventana
window.addEventListener('resize',function(){
	if(screen.width>=700){
		cerrado=true;
		menu.style.removeProperty('overflow');
		menu.style.removeProperty('height');
	}
});

abrir.addEventListener('click', function(){
	apertura();
});

window.addEventListener('click', function(e){
	if(cerrado==false){
		let span = document.querySelector('span');
		// condición para cerrar el menú si se da por fuera o en el icono
		if(e.target !== span && e.target !== abrir){
			menu.style.height = '0px';
			menu.style.overflow = 'hidden';
			cerrado = true;
		}
	}
})