var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosFicha();
    datosTrimestre();
    buscarHorario();
    jornada();
    document.querySelector('#enlace-atras').addEventListener('click', function() {
        window.history.back();
    });
});
setInterval(buscarHorario, 1000);

document.querySelector('#jornada').addEventListener('change', jornada);

document.querySelector('#enlace-pdf').addEventListener('click', function() {
    quitarColor(2);
    generarpdf('HorarioTrimestre');
});

/**
 *Se defina la función que hace una petición de los datos de la ficha
 *
 */
function datosFicha() {
    let id_fic = {
        id_fic: $('.table').attr("id")
    };
    const ficha = peticion('peticionesAjaxFicha&p=obtenerdatos', 'POST', id_fic);
    template = `<h3>Ficha: ${ficha[0].num_ficha}</h3>`;
    // Se inserta el numero de la ficha en el título de la tabla
    $('#num_ficha').html(template);
}

function datosTrimestre() {
    let id_trimestre = {
        id_trimestre: $('table')[0].id
    };
    const trimestre = peticion('peticionesAjaxTrimestre&p=obtenerdatos', 'POST', id_trimestre);
    template = `<h3>${trimestre[0].nombre_trimestre}</h3>`;
    // Se inserta el numero de la ficha en el título de la tabla
    $('#trimestre').html(template);
    $('#fecha').html(`<p inicio="${trimestre[0].fecha_inicio}" fin="${trimestre[0].fecha_fin}">Fecha: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}</p>`);
    switch (trimestre[0].id_tipotabla) {
        case "1":
            document.querySelector('#tabla2').style.display = 'table-row-group';
            document.querySelector('#tabla1').style.display = 'none';
            break;
        case "2":
            document.querySelector('#tabla2').style.display = 'none';
            document.querySelector('#tabla1').style.display = 'table-row-group';
            break;
    }
}

function buscarHorario() {
    const datos = {
        id_trimestre: $('table')[0].id
    };
    var horarios = peticion("peticionesAjaxHorario&p=mostrar", "POST", datos);
    let template = '';
    var array = document.querySelectorAll('.drops');
    horarios.forEach(horario => {
        template = `
                    <div class='caja' style='background-color:${horario['color']};'>
                    <h3>${horario['instructor']}</h3>
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