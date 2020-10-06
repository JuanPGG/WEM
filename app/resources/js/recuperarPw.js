var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        if (this.value.length >= 1) {
            this.nextElementSibling.classList.add('fijar');
        } else {
            this.nextElementSibling.classList.remove('fijar');
        }
    });
}
document.getElementById("resetPw").onclick = validateForm;
//Función para las diferentes validciones del formulario de REGISTRO
function  validateForm()  {
    // declarion de variables
    var  contrasena1  =  $("#newpw").val();
    var contrasena2 = $("#confirmpw").val();
    // declaración de expresiones regulares para las diferentes validaciones
    const expresionContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,16}$/;
    //Validación del campo contrasena no esté vacío
    if  (contrasena1  ==  ""  ||  contrasena1  ==  null)  {  
        call("newpw", "El campo de la contraseña es obligatorio.");
        return  false;
        //Validación del campo contrasena que cumpla con: de 8 a 16 caracteres, 
        //una minúscula, una mayúscula y un número
    } else if (!expresionContrasena.test(contrasena1)) {
        call("newpw", "Ingrese una contraseña válida. (De 8 a 16 caracteres, al menos una letra minúscula, una mayúscula y un número)");
        return false;
    } else {
        colorDefault("newpw");
    }
    //Validación del campo contrasena no esté vacío
    if  (contrasena2  ==  ""  ||  contrasena2  ==  null)  {  
        call("confirmpw", "El campo de confirmar contraseña es obligatorio.");
        return  false;
    }
    //Validación de que las contraseñas coincidan o sean iguales
    if (contrasena1 != contrasena2) {
        call("confirmpw", "Las contraseñas no coinciden.");
        return false;
    } else {
        colorDefault("confirmpw");
    }
    $('#form').submit();
    return  true;
}
//Función que hace el llamado a las demás funciones (Especialmente para ahorrar código)
//Recibe el id del input y el mensaje que será mostrado según el caso
function call(id, mensaje) {
    cambiarColor(id);
    mostraAlerta(mensaje);
    //Hacerle focus al input que no cumpla con las validaciones especificadas
    $("#" + id).focus();
}
// creamos un funcion de color por defecto a los bordes de los inputs
function  colorDefault(dato)  {
    document.querySelector("#" + dato).style.border =  "none";
    document.querySelector("#" + dato).style.borderBottom =  "3px solid rgb(252, 115, 35)";
}
// creamos una funcio para cambiar de color a su bordes de los input
function  cambiarColor(dato)  {
    document.querySelector("#" + dato).style.border = '3px solid red';
}
// funcion para mostrar la alerta
function  mostraAlerta(texto)  {
    document.querySelector("#alerta").style.display = "flex";
    document.querySelector("#alerta").value = texto;
    document.querySelector("#alerta").innerHTML = texto;
}