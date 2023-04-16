window.addEventListener('load', function() {
    buscarDatos();
    validarLength();
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
var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        validarLength();
    });
}

function buscarDatos() {
    var user = {
        user: document.querySelector('#perfil').getAttribute('data-id')
    };
    var datosUsuario = peticion('peticionUsuario&p=mostrar', 'POST', user);
    $('#nombre').val(datosUsuario[0].nombres);
    $('#apellido').val(datosUsuario[0].apellidos);
    $('#correo').val(datosUsuario[0].correo);
}

document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});