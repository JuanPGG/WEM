window.addEventListener('load', function() {
    buscarDatos();
    $('#usuario').submit(function(ev) {
        ev.preventDefault();
        const data = {
            nombres: $('#nombre').val(),
            apellidos: $('#apellido').val(),
            id: document.querySelector('#perfil').getAttribute('data-id')
        }
        console.log(data);
        peticion('peticionUsuario&p=editar', 'POST', data);
        buscarDatos();
        alert("Para ver los cambios, por favor vuelva iniciar sesión.");
    });
});

function buscarDatos() {
    var user = {
        user: document.querySelector('#perfil').getAttribute('data-id')
    };
    var datosUsuario = peticion('peticionUsuario&p=mostrar', 'POST', user);
    $('#nombre').val(datosUsuario[0].nombres);
    $('#apellido').val(datosUsuario[0].apellidos);
    $('#correo').val(datosUsuario[0].correo);
}
// Se define la función donde se realizará la petición ajax, la cual recibe la url, el tipo y los datos
function peticion(lugar, tipo, datos) {
    // se define la variable que será retornada
    let respuesta;
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=" + lugar,
        type: tipo,
        data: datos,
        async: false,
        success: function(response) {
            // En caso de no haber respuesta, retornará false para poder usar el código general sin error
            if (!response) {
                respuesta = false;
                return;
            }
            // Se almacena la respuesta convertida en JSON en la ariable definida anteriormente
            respuesta = JSON.parse(response);
        }
    });
    return respuesta;
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});