let ingresar = document.querySelector('#ingresar');
window.addEventListener('load', function() {
    validarLength();
    //Función de click para el botón del formulario
    //para asegurarnos de que no se envíe si no cumple con las validaciones
    ingresar.addEventListener('click', function(e) {
        //Este comando evita recargar la página
        e.preventDefault();
        if (validateForm1()) {
            const datos = {
                correo: $('#email1').val(),
                contrasena: $('#pw').val()
            }
            const response = peticion('peticionUsuario&p=entrar', 'POST', datos);
            switch (response) {
                case 'Ok':
                    window.location = `${url}index.php?v=fichas`;
                    break;
                case 'Error':
                    mostraAlerta('Usuario o contraseña incorrectos.');
                    $('#pw').val('');
                    $('#pw').focus();
                    break;
            }
        }
    });
    document.getElementById("enviar").addEventListener('click', function(e) {
        //Este comando evita recargar la página
        e.preventDefault();
        if (validateForm2()) {
            const datos = {
                receptor: $('#email2').val()
            }
            const response = peticion('peticionUsuario&p=setToken', 'POST', datos);
            switch (response) {
                case 'Ok':
                    mostraAlerta('Se envió un link a su correo para cambiar contraseña.');
                    $("#containerRecuperar").trigger("reset");
                    validarLength();
                    break;
                case 'No':
                    mostraAlerta(`El correo ${datos['receptor']} no existe.`);
                    $('#email2').focus();
                    break;
                case 'Error':
                    mostraAlerta('Ha ocurrido un error al enviar el correo de recuperación.');
                    $('#email2').focus();
                    break;
                default:
                    mostraAlerta('Ha ocurrido un error al enviar el correo de recuperación.');
                    $('#email2').focus();
                    break;
            }
        }
    }); //Resetear o vaciar el formulario cuando el módulo cargue
    // $("#containerSesion").trigger("reset");
    // $("#containerRecuperar").trigger("reset");
});


var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        validarLength();
    });
}
var recuperar = document.getElementById('recuperar');
var volver = document.getElementById('volver');
var containerRecuperar = document.getElementById('containerRecuperar');
var containerSesion = document.getElementById('containerSesion');
recuperar.addEventListener('click', function() {
    containerRecuperar.style.display = 'block';
    containerSesion.style.display = 'none';
});
volver.addEventListener('click', function() {
    containerRecuperar.style.display = 'none';
    containerSesion.style.display = 'block';
});
//Función para las diferentes validciones del formulario de REGISTRO
function validateForm1() {
    // declarion de variables
    var correo1 = $("#email1").val();
    var contrasena = $("#pw").val();
    // declaración de expresiones regulares para las diferentes validaciones
    const expresionCorreo = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const expresionContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,16}$/;
    //Validación del campo correo no esté vacío
    if (correo1 == "" || correo1 == null) {
        call("email1", "El campo del email es obligatorio.");
        return false;
        //Validación del campo correo que cumpla con el formato example_12@example.com
    } else if (!expresionCorreo.test(correo1)) {
        call("email1", "Ingresa un email válido como: example@example.com");
        return false;
    } else {
        colorDefault("email1");
    }
    return true;
}

function validateForm2() {
    var correo2 = $("#email2").val();
    const expresionCorreo2 = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    //Validación del campo correo no esté vacío
    if (correo2 == "" || correo2 == null) {
        call("email2", "El campo del email es obligatorio.");
        return false;
        //Validación del campo correo que cumpla con el formato example_12@example.com
    } else {
        colorDefault("email2");
    }
    return true;
}