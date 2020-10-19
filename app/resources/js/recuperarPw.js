var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        validarLength();
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
