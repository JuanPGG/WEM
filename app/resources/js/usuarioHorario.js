var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosFichayTrimestre();
    buscarHorario();
    jornada();
    document.querySelector('#enlace-atras').addEventListener('click', function() {
        window.history.back();
    });
    // Evento de click para mostrar las opciones detalles y eliminar de cada elemento arrastrado a la tabla
    $(document).on('click', '.icon-eye', function(e) {
        // La función toggle inserta o elimina una clase dependiendo de si existe o no
        window.location = 'index.php?v=detallesinstructor&id=' + e.target.id + '&t=' + $('table')[0].id;
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
function datosFichayTrimestre() {
    let id_fic = {
        id_fic: $('.table').attr("id")
    };
    let id_trimestre = {
        id_trimestre: $('table')[0].id
    };
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxFicha&p=obtenerdatos",
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
        url: "http://localhost/WEM/index.php?v=peticionesAjaxTrimestre&p=obtenerdatos",
        type: "POST",
        data: id_trimestre,
        success: function(response) {
            const trimestre = JSON.parse(response);
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
    });
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
