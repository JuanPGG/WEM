// Función para la validación de que las contraseñas coincidan al momento de cambiarlas
function validatePassword() {
  var pass1 = document.getElementById("newpw").value;
  var pass2 = document.getElementById("confirmpw").value;
  // setCustomValidity es para un cuadro de texto html5
  pass1 != pass2 
  ? document.getElementById("confirmpw").setCustomValidity("Las contraseñas no coinciden") 
  : document.getElementById("confirmpw").setCustomValidity('');
}
document.getElementById("resetPw").onclick = validatePassword;