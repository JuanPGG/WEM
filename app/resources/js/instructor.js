let td = document.querySelectorAll('td');
let th = document.querySelectorAll('th');
window.addEventListener('load', function() {
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
    const fechas = peticion('peticionesAjaxTrimestre&p=fechas', 'GET', null);
    fechas.forEach(fecha => {
        let option = document.createElement("option");
        option.text = `${fecha['fecha_inicio']} / ${fecha['fecha_fin']}`;
        select_fecha.add(option);
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
    const instructores = peticion('peticionesAjax&p=mostrar', 'GET', null);
    instructores.forEach(instructor => {
        let option = document.createElement("option");
        option.text = instructor['nombres'];
        option.value = instructor['id'];
        select_instructor.add(option);
    });
}

function buscarHorario(inst, inicio, fin) {
    let datos;
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
    let array = document.querySelectorAll('.drops');
    array.forEach(ar => {
        ar.innerHTML = '';
    });
    const horarios = peticion('peticionesAjaxHorario&p=obtenerInstructor', 'POST', datos);
    let contar = 0;
    if (horarios != 'No encontrado') {
        let template = '';
        document.querySelector('#select_instructor').value = horarios[0].id;
        horarios.forEach(horario => {
            template = `
                    <div class='caja' style='background-color:${horario['color']};'>
                    <h3>${horario['ficha']} - ${horario['programa']}</h3>
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
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});