var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    // datosTrimestre();
    datosFecha();
    datosInstructores();
    jornada();

});
document.querySelector('#jornada').addEventListener('change', jornada);

document.querySelector('#enlace-pdf').addEventListener('click', function() {
    console.log(document.querySelector('#select_instructor').value);
    if (document.querySelector('#select_instructor').value != "vacio" && document.querySelector('#select_fecha').value != "vacio") {
        quitarColor(3);
        generarpdf('HorarioInstructor');
    } else {
        alert('Por favor elige un instructor y una fecha.');
    }
});
// Se defina la función que hace una petición de los datos de la ficha
function datosTrimestre() {
    let id_trimestre = {
        id_trimestre: $('table')[0].id
    };
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxTrimestre&p=obtenerdatos",
        type: "POST",
        data: id_trimestre,
        success: function(response) {
            const trimestre = JSON.parse(response);
            // Se inserta el numero de la ficha en el título de la tabla
            document.querySelector('#fecha').setAttribute('data-inicio', trimestre[0].fecha_inicio);
            document.querySelector('#fecha').setAttribute('data-fin', trimestre[0].fecha_fin);
            document.querySelector('#fecha').innerHTML = `Fecha: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}`;
            buscarHorario(null, trimestre[0].fecha_inicio, trimestre[0].fecha_fin);
            // $('#fecha').html(`<p inicio="${trimestre[0].fecha_inicio}" fin="${trimestre[0].fecha_fin}">Fecha: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}</p>`);
            // buscarHorario($('.table').attr("id"), trimestre[0].fecha_inicio, trimestre[0].fecha_fin);
        }
    });
}

document.querySelector('#select_instructor').addEventListener('change', function() {
    let idI = document.querySelector('#select_instructor').value;
    if (document.querySelector('#select_fecha').value != "vacio") {
        let finicio = document.querySelector('#select_fecha').value.slice(0, 10);
        let ffin = document.querySelector('#select_fecha').value.slice(13, 23);
        buscarHorario(idI, finicio, ffin);
    }
});
document.querySelector('#select_fecha').addEventListener('change', function() {
    let finicio = document.querySelector('#select_fecha').value.slice(0, 10);
    let ffin = document.querySelector('#select_fecha').value.slice(13, 23);
    if (document.querySelector('#select_instructor').value != "vacio") {
        let idI = document.querySelector('#select_instructor').value;
        buscarHorario(idI, finicio, ffin);
    }
});

function datosFecha() {
    let select_fecha = document.querySelector('#select_fecha');
    let optionDefault = document.createElement("option");
    optionDefault.text = "Seleccionar Fecha";
    optionDefault.value = "vacio";
    optionDefault.selected = true;
    optionDefault.disabled = true;
    select_fecha.add(optionDefault);
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxTrimestre&p=fechas",
        type: "GET",
        success: function(response) {
            const fechas = JSON.parse(response);
            fechas.forEach(fecha => {
                let option = document.createElement("option");
                option.text = `${fecha['fecha_inicio']} / ${fecha['fecha_fin']}`;
                select_fecha.add(option);
            });
        }
    });
}

function datosInstructores() {
    let select_instructor = document.querySelector('#select_instructor');
    let optionDefault = document.createElement("option");
    optionDefault.text = "Seleccionar Instructor";
    optionDefault.value = "vacio";
    optionDefault.selected = true;
    optionDefault.disabled = true;
    select_instructor.add(optionDefault);
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjax&p=mostrar",
        type: "GET",
        success: function(response) {
            const instructores = JSON.parse(response);
            instructores.forEach(instructor => {
                let option = document.createElement("option");
                option.text = instructor['nombres'];
                option.value = instructor['id'];
                select_instructor.add(option);
            });
        }
    });
}

function buscarHorario(inst, inicio, fin) {
    var datos;
    if (inst == null) {
        datos = {
            id_instructor: $('.table').attr('data-id'),
            fecha_inicio: inicio,
            fecha_fin: fin
        }
    } else {
        datos = {
            id_instructor: inst,
            fecha_inicio: inicio,
            fecha_fin: fin
        }
    }
    var array = document.querySelectorAll('.drops');
    array.forEach(ar => {
        ar.innerHTML = '';
    })
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxHorario&p=obtenerInstructor",
        type: "POST",
        data: datos,
        success: function(response) {
            let contar = 0;
            if (response != 'No encontrado') {
                const horarios = JSON.parse(response);
                let template = '';
                document.querySelector('#select_instructor').value = horarios[0].id;
                horarios.forEach(horario => {
                    template = `
                    <div class='caja' style='background-color:${horario['color']};'>
                    <h3>Ficha: ${horario['ficha']}</h3>
                    <p>${horario['competencia']}</p>
                    <p>${horario['ambiente']}</p>
                    </div>`;
                    array.forEach(ar => {
                        if (ar.dataset.dia == horario['dia'] && (ar.parentElement.dataset.inicio >= horario['hora_inicio'] && ar.parentElement.dataset.fin <= horario['hora_fin'])) {
                            $("#" + ar.id).html(template);
                            contar++;
                            $('#horasp').html(`${contar}`);
                        }
                    });
                });
            } else {
                $('#horasp').html(`${contar}`);
            }
        }
    });
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});