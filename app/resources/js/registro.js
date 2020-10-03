window.addEventListener('load',function(){
  //Función de click para el botón del formulario
  //para asegurarnos de que no se envíe si no cumple con las validaciones
  document.getElementsByName("registrar")[0].addEventListener('click', function(e){
    //Este comando evita recargar la página
    e.preventDefault();
    validateForm();
  });
  
  //Resetear o vaciar el formulario cuando el módulo cargue
  $("form").trigger("reset");
});

//Función para las diferentes validciones del formulario de REGISTRO
function validateForm() {
  // declarion de variables
  var nombre = $("#name").val();
  var apellido = $("#lastname").val();
  var correo = $("#email").val();
  var contrasena1 = $("#pw").val();
  var contrasena2 = $("#pw2").val();

  // declaración de expresiones regulares para las diferentes validaciones
  const expresionNombApell = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
  const expresionCorreo = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  const expresionContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,16}$/;

  //Validación del campo nombre no esté vacío
  if(nombre == "" || nombre == null){
    call("name", "El campo del nombre es obligatorio.");
    return false;
    //Validación del campo nombre que no tenga números o caracteres especiales
  }else if(!expresionNombApell.test(nombre)){
    call("name", "Ingrese un nombre válido. (Solo letras)");
    return false;
  }else{
    colorDefault("name");
  }

  //Validación del campo nombre no esté vacío
  if (apellido == "" || apellido == null) {
    call("lastname", "El campo del apellido es obligatorio.");
    return false;
    //Validación del campo apellido que no tenga números o caracteres especiales
  }else if(!expresionNombApell.test(apellido)){
    call("lastname", "Ingrese un apellido válido. (Solo letras)");
    return false;
  }else{
    colorDefault("lastname");
    }

  //Validación del campo correo no esté vacío
  if (correo == "" || correo == null) {
    call("email", "El campo del email es obligatorio.");
    return false;
    //Validación del campo correo que cumpla con el formato example_12@example.com
  }else if(!expresionCorreo.test(correo)){
    call("email", "Ingresa un email válido como: example@example.com");
    return false;
  }else{
    colorDefault("email");
  }

  //Validación del campo contrasena no esté vacío
  if (contrasena1 == "" || contrasena1 == null) {
      call("pw", "El campo de la contraseña es obligatorio.");
    return false;
    //Validación del campo contrasena que cumpla con: de 8 a 16 caracteres, 
    //una minúscula, una mayúscula y un número
  }else if(!expresionContrasena.test(contrasena1)){
    call("pw", "Ingrese una contraseña válida. (De 8 a 16 caracteres, al menos una letra minúscula, una mayúscula y un número)");
    return false;
  }else{
    colorDefault("pw");
  }
  //Validación del campo contrasena no esté vacío
  if (contrasena2 == "" || contrasena2 == null) {
      call("pw2", "El campo de confirmar contraseña es obligatorio.");
    return false;
  }
  //Validación de que las contraseñas coincidan o sean iguales
  if(contrasena1 != contrasena2){
    call("pw2", "Las contraseñas no coinciden.");
    return false; 
  }else{
    colorDefault("pw2");
  }
  $('#form').submit();
  return true;
}

//Función que hace el llamado a las demás funciones (Especialmente para ahorrar código)
//Recibe el id del input y el mensaje que será mostrado según el caso
function call(id, mensaje){
  cambiarColor(id);
  mostraAlerta(mensaje);
  //Hacerle focus al input que no cumpla con las validaciones especificadas
  $("#"+id).focus();
}

// creamos un funcion de color por defecto a los bordes de los inputs
function colorDefault(dato) {
  document.querySelector("#"+dato).style.border = "none";
  document.querySelector("#"+dato).style.borderBottom = "3px solid rgb(252, 115, 35)";
}

// creamos una funcio para cambiar de color a su bordes de los input
function cambiarColor(dato) {
  document.querySelector("#"+dato).style.border = '3px solid red';
}

// funcion para mostrar la alerta
function mostraAlerta(texto) {
  document.querySelector("#alerta").style.display = "flex";
  document.querySelector("#alerta").value = texto;
  document.querySelector("#alerta").innerHTML = texto;
}