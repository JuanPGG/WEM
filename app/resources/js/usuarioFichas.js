window.addEventListener('load', function() {
    mostrarFichas();
});

function mostrarFichas() {
    /** 
     * Esta función hace una petición ajax que trae la información de lo ambientes
     */
    var fichas = peticion("peticionesAjaxFicha&p=mostrar", "GET", null);
    let template = '';
    /** 
     * En este ciclo se recorre la constante que contiene un JSON
     */
    fichas.forEach(ficha => {
        /**
         * En esta variable se almacena el maquetado html que se quiere mostrar
         */
        template += `
        <div class="fichas" id=${ficha["id_fic"]}>
        <div class="numero_ficha">
        <h2>Ficha: ${ficha['num_ficha']} - ${ficha['id_programa']}</h2>
        <p>${ficha['nombre_gestor']}</p>
        </div>
        <div class="info">
        <p><a href="index.php?v=trimestres&n=${ficha["id_fic"]}" class="abrir">Abrir</a></p>
        </div>
        </div>`
    });
    /** 
     * Se agrega el html que se ejecuto en el forEach a el contenedor
     */
    $('#cont_fichas').html(template);
}