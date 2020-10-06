/**
 * Definición de variables
 */
let botones = document.getElementsByClassName('btn-header');
let texto = document.getElementsByClassName('move')[0];
let texto2 = document.getElementsByClassName('move2')[0];
let btn = document.getElementsByClassName('btn')[0];
/** 
 * Función que se ejecuta cuando carga la ventana del navegador
*/
window.addEventListener('load', function() {
    /** 
     * Se le quitan clases para ejecutar un movimiento segun el tiempo de transición
    */
    texto.style.transition = '1s';
    texto.classList.remove('move');
    texto2.style.transition = '1.3s';
    texto2.classList.remove('move2');
    btn.style.transition = '1.6s';
    btn.classList.remove('btn');
});
$('#enlaces .btn-header').click(function(e) {
    console.log(e.target);
    var strAncla = $(this).attr('data-enlace'); //id del ancla
    $('body,html').stop(true, true).animate({
        scrollTop: $(strAncla).offset().top - 100
    }, 1000);
});