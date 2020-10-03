var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosFichayTrimestre();
    document.querySelector('#enlace-pdf').addEventListener('click', function() {
        quitarColor();
        generarpdf();
    });

    function quitarColor() {
        var bg = 'transparent';
        var fondos = document.querySelectorAll('.caja');
        var herramienta = document.querySelectorAll('.icon-cog');
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
                pdf.save('HorarioInstructor.pdf');
                location.reload();
            }
        });
    }
});
// Se defina la función que hace una petición de los datos de la ficha
function datosFichayTrimestre() {
    let id = {
        id: $('.table').attr("id")
    };
    let id_horario = {
        id_horario: $('table')[0].id
    };
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjax&p=obtenerdatos",
        type: "POST",
        data: id,
        success: function(response) {
            const instructor = JSON.parse(response);
            var nombre = instructor[0].nombres;
            var mayus = nombre.toUpperCase();
            template = `<p>Instructor: ${mayus} </p>`;
            // Se inserta el numero de la ficha en el título de la tabla
            $('#instructor').html(template);
        }
    });
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxTrimestre&p=obtenerdatos",
        type: "POST",
        data: id_horario,
        success: function(response) {
            const trimestre = JSON.parse(response);
            // Se inserta el numero de la ficha en el título de la tabla
            $('#fechainicio').html(`<p inicio="${trimestre[0].fecha_inicio}" fin="${trimestre[0].fecha_fin}">Fecha Inicio: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}</p>`);
            buscarHorario(trimestre[0].fecha_inicio, trimestre[0].fecha_fin);
        }
    });
}

function buscarHorario(inicio, fin) {
    const datos = {
        id_instructor: $('.table')[0].id,
        fecha_inicio: inicio,
        fecha_fin: fin
    };
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxDetallesHorario&p=obtenerInstructor",
        type: "POST",
        data: datos,
        success: function(response) {
            const horarios = JSON.parse(response);
            let template = '';
            var array = document.querySelectorAll('.drops');
            horarios.forEach(horario => {
                template = `
                    <div class='caja' style='background-color:${horario['color']};'>
                    <h3>Ficha: ${horario['ficha']}</h3>
                    <p>${horario['competencia']}</p>
                    <p>${horario['ambiente']}</p>
                    </div>
                 `;
                array.forEach(ar => {
                    if ((ar.dataset.dia == horario['dia']) && (ar.parentElement.dataset.inicio == horario['hora_inicio'])) {
                        $("#" + ar.id).html(template);
                    }
                });
            });
        }
    });
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});