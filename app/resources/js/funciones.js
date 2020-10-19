/**
 * Esta fucncion devuelve el número de caracteres de una cadena segun 
 * la cantidad.
 */
function validarLength() {
    var inputs = document.querySelectorAll('.input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value.length >= 1) {
            inputs[i].nextElementSibling.classList.add('fijar');
        } else {
            inputs[i].nextElementSibling.classList.remove('fijar');
        }
    }
}
/**
 * Esta funcion esta cumpliendo con el objetivo para utilizar de forma general 
 * para la diferentes peticiones
 * @param {*} lugar
 * @param {*} tipo
 * @param {*} datos
 * @return {*} 
 */
function peticion(lugar, tipo, datos) {
    let respuesta;
    $.ajax({
        url: "http://localhost/WEM/index.php?v=" + lugar,
        type: tipo,
        data: datos,
        async: false,
        success: function(response) {
            if (!response) {
                respuesta = false;
                return;
            }
            respuesta = JSON.parse(response);
            // funcion();
            // $('#'+idform).trigger('reset');
        }
    });
    return respuesta;
}

function jornada() {
    var jornada = document.querySelector('#jornada').value;
    var mañana = document.querySelector('#mañana');
    var tarde = document.querySelector('#tarde');
    var noche = document.querySelector('#noche');
    switch (jornada) {
        case 'mañana':
            mañana.style.display = 'table-row-group';
            tarde.style.display = 'none';
            noche.style.display = 'none';
            break;
        case 'tarde':
            tarde.style.display = 'table-row-group';
            mañana.style.display = 'none';
            noche.style.display = 'none';
            break;
        case 'noche':
            noche.style.display = 'table-row-group';
            tarde.style.display = 'none';
            mañana.style.display = 'none';
            break;
    }
}
// function generarimg() {
//     html2canvas($("table")[0], {
//         onrendered: function(canvas) {
//             canvas.toBlob(function(blob) {
//                 saveAs(blob, "horario.png");
//             }, "image/png", 1);
//         }
//     });
// }

function generarpdf(nombre) {
    var pdf = new jsPDF('p', 'mm', [300, 254]);
    html2canvas($("table")[0], {
        onrendered: function(canvas) {
            var imgData = canvas.toDataURL("image/png", 1.0);
            var width = canvas.width;
            var height = canvas.clientHeight;
            pdf.setFont('helvetica');
            pdf.setFontType('bold');
            pdf.setFontSize(30);
            pdf.text(110, 20, 'Horario');
            pdf.addImage(imgData, 'PNG', 10, 30, (width - 965), (height));
            pdf.save(nombre + '.pdf');
            location.reload();
        }
    });
}

function quitarColor(archivo) {
    switch (archivo) {
        case 1:
            quitar1();
            break;
        case 2:
            quitar2();
            break;
        case 3:
            quitar3();
            break;
    }

}

function quitar1() {
    let herramienta = document.querySelectorAll('.opciones');
    let bg = 'transparent';
    let fondos = document.querySelectorAll('.caja');
    let jornada = document.querySelector('#jornada');
    jornada.style.color = 'black';
    jornada.style.border = 'none';
    let select_instructor = document.querySelector('#select_instructor');
    select_instructor.style.color = 'black';
    select_instructor.style.border = 'none';
    document.querySelectorAll('table')[0].style.background = 'none';
    document.querySelector('#th_jornada').style.display = 'none';
    document.querySelector('#fecha').setAttribute('colspan', '12');
    var tbody = document.querySelectorAll('tbody');
    tbody[0].style.display = 'table-row-group';
    tbody[1].style.display = 'table-row-group';
    tbody[2].style.display = 'table-row-group';
    for (var i = 0; i < fondos.length; i++) {
        fondos[i].style.background = bg;
    }
    for (var i = 0; i < herramienta.length; i++) {
        herramienta[i].style.display = 'none';
    }
    for (var i = 0; i < td.length; i++) {
        td[i].style.background = bg;
    }
    for (var i = 0; i < th.length; i++) {
        th[i].style.background = bg;
        th[i].style.color = 'black';
    }
}

function quitar2() {
    var bg = 'transparent';
    var fondos = document.querySelectorAll('.caja');
    var herramienta = document.querySelectorAll('.opciones');
    document.querySelectorAll('table')[0].style.background = 'none';
    for (var i = 0; i < fondos.length; i++) {
        fondos[i].style.background = bg;
    }
    for (var i = 0; i < herramienta.length; i++) {
        herramienta[i].style.display = 'none';
    }
    for (var i = 0; i < td.length; i++) {
        td[i].style.background = bg;
    }
    for (var i = 0; i < th.length; i++) {
        th[i].style.background = bg;
        th[i].style.color = 'black';
    }
}

function quitar3() {
    let bg = 'transparent';
    let fondos = document.querySelectorAll('.caja');
    let jornada = document.querySelector('#jornada');
    jornada.style.color = 'black';
    jornada.style.border = 'none';
    let select_instructor = document.querySelector('#select_instructor');
    select_instructor.style.color = 'black';
    select_instructor.style.border = 'none';
    document.querySelectorAll('table')[0].style.background = 'none';
    document.querySelector('#th_jornada').style.display = 'none';
    document.querySelector('#fecha').setAttribute('colspan', '12');
    var tbody = document.querySelectorAll('tbody');
    tbody[0].style.display = 'table-row-group';
    tbody[1].style.display = 'table-row-group';
    tbody[2].style.display = 'table-row-group';
    for (var i = 0; i < fondos.length; i++) {
        fondos[i].style.background = bg;
    }
    for (var i = 0; i < td.length; i++) {
        td[i].style.background = bg;
    }
    for (var i = 0; i < th.length; i++) {
        th[i].style.background = bg;
        th[i].style.color = 'black';
    }
}

function validarNull(texto, id) {
    if (texto == "" || texto == null) {
        call(id, "El campo es obligatorio.");
        return false;
        //Validación del campo texto que no tenga números o caracteres especiales
    } else {
        colorDefault(id);
    }
    return true;
}

function validarText(texto, id) {
    const expresionText = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]*$/;
    if (texto == "" || texto == null) {
        call(id, "El campo de texto es obligatorio.");
        return false;
        //Validación del campo texto que no tenga números o caracteres especiales
    } else if (!expresionText.test(texto)) {
        call(id, "Ingrese un texto válido. (Solo letras)");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarNum(num, id) {
    const expresionDoc = /^[0-9]{4,10}$/;
    if (num == "" || num == null) {
        call(id, "El campo es obligatorio.");
        return false;
        //Validación del campo texto que no tenga números o caracteres especiales
    } else if (!expresionDoc.test(num)) {
        call(id, "Ingrese un numero válido. (Solo números)");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarHoras(horas, id) {
    const expresionDoc = /^[0-9]{2,4}$/;
    if (horas == "" || horas == null) {
        call(id, "El campo es obligatorio.");
        return false;
        //Validación del campo texto que no tenga números o caracteres especiales
    } else if (!expresionDoc.test(horas)) {
        call(id, "Ingrese un numero válido. (Solo números)");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarDocumento(documento, id) {
    const expresionDoc = /^[0-9]{8,11}$/;
    if (documento == "" || documento == null) {
        call(id, "El campo de documento es obligatorio.");
        return false;
        //Validación del campo texto que no tenga números o caracteres especiales
    } else if (!expresionDoc.test(documento)) {
        call(id, "Ingrese un documento válido. (Solo números de 8 a 10 caracteres)");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarCorreo(correo, id) {
    const expresionCorreo = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    //Validación del campo correo no esté vacío
    if (correo == "" || correo == null) {
        call(id, "El campo del correo es obligatorio.");
        return false;
        //Validación del campo correo que cumpla con el formato example_12@example.com
    } else if (!expresionCorreo.test(correo)) {
        call(id, "Ingresa un correo válido como: example@example.com");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarPw(pw, id) {
    const expresionContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,16}$/;
    //Validación del campo contrasena no esté vacío
    if (pw == "" || pw == null) {
        call(id, "El campo de la contraseña es obligatorio.");
        return false;
        //Validación del campo contrasena que cumpla con: de 8 a 16 caracteres, 
        //una minúscula, una mayúscula y un número
    } else if (!expresionContrasena.test(pw)) {
        call(id, "Ingrese una contraseña válida. (De 8 a 16 caracteres, al menos una letra minúscula, una mayúscula y un número)");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarSelect(selector, id) {
    if (selector == "" || selector == 0 || selector == null) {
        call(id, "El campo de seleccion es obligatorio.");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
}

function validarColor(color, id) {
    if (color == "" || color == "#000000") {
        call(id, "El campo color es obligatorio.");
        return false;
    } else {
        colorDefault(id);
    }
    return true;
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
function colorDefault(dato) {
    document.querySelector("#" + dato).style.border = "none";
    document.querySelector("#" + dato).style.borderBottom = "3px solid rgb(252, 115, 35)";
}
// creamos una funcion para cambiar de color a su bordes de los input
function cambiarColor(dato) {
    document.querySelector("#" + dato).style.border = '3px solid red';
}
// funcion para mostrar la alerta
function mostraAlerta(texto) {
    document.querySelector("#alerta").style.display = "flex";
    document.querySelector("#alerta").value = texto;
    document.querySelector("#alerta").innerHTML = texto;
}