var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosFichayTrimestre();
    buscarHorario();
    document.querySelector('#enlace-atras').addEventListener('click', function() {
        window.history.back();
    });
    // Evento de click para mostrar las opciones detalles y eliminar de cada elemento arrastrado a la tabla
    $(document).on('click', '.icon-eye', function(e) {
        // La función toggle inserta o elimina una clase dependiendo de si existe o no
        window.location = 'index.php?v=detallesinstructor&id=' + e.target.id + '&t=' + $('table')[0].id;
    });
});
document.querySelector('#enlace-pdf').addEventListener('click', function() {
    quitarColor();
    generarpdf();
});

function quitarColor() {
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

function generarpdf() {
    var pdf = new jsPDF('l', 'mm', [203, 254]);
    html2canvas($("table")[0], {
        onrendered: function(canvas) {
            var imgData = canvas.toDataURL("image/png", 1.0);
            var width = canvas.width;
            var height = canvas.clientHeight;
            pdf.setFont('helvetica');
            pdf.setFontType('bold');
            pdf.setFontSize(30);
            pdf.text(110, 20, 'Horario');
            pdf.addImage(imgData, 'PNG', 10, 30, (width - 965), (height + 100));
            pdf.save('HorarioTrimestre.pdf');
            location.reload();
        }
    });
}
/**
 *Se defina la función que hace una petición de los datos de la ficha
 *
 */
function datosFichayTrimestre() {
    let id_fic = {
        id_fic: $('.table').attr("id")
    };
    let id_horario = {
        id_horario: $('table')[0].id
    };
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxFicha&p=obtenerdatos",
        type: "POST",
        data: id_fic,
        success: function(response) {
            const ficha = JSON.parse(response);
            template = `<h3>Ficha: ${ficha[0].num_ficha}</h3>`;
            // Se inserta el numero de la ficha en el título de la tabla
            $('#num_ficha').html(template);
        }
    });
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxTrimestre&p=obtenerdatos",
        type: "POST",
        data: id_horario,
        success: function(response) {
            const trimestre = JSON.parse(response);
            template = `<h3>${trimestre[0].nombre_trimestre}</h3>`;
            // Se inserta el numero de la ficha en el título de la tabla
            $('#trimestre').html(template);
            $('#fecha').html(`<p inicio="${trimestre[0].fecha_inicio}" fin="${trimestre[0].fecha_fin}">Fecha: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}</p>`);
        }
    });
}

function buscarHorario() {
    const datos = {
        id_trimestre: $('table')[0].id
    };
    var horarios = peticion("peticionesAjaxDetallesHorario&p=mostrar", "POST", datos);
    let template = '';
    var array = document.querySelectorAll('.drops');
    horarios.forEach(horario => {
        template = `
                    <div class='caja' style='background-color:${horario['color']};'>
                    <h3>${horario['instructor']}</h3>
                    <p>${horario['competencia']}</p>
                    <p>${horario['ambiente']}</p>
                    <div class='opciones'>
                    <i id=${horario['id_instructor']} class='icon-eye'></i>
                    </div>
                    </div>
                 `;
        array.forEach(ar => {
            if ((ar.dataset.dia == horario['dia']) && (ar.parentElement.dataset.inicio == horario['hora_inicio'])) {
                $("#" + ar.id).html(template);
            }
        });
    });
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