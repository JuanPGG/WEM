let td = document.querySelectorAll('td');
let th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosAmbiente();
    datosFecha();
    jornada();
});
document.querySelector('#jornada').addEventListener('change', jornada);

document.querySelector('#enlace-pdf').addEventListener('click', function() {
    console.log(document.querySelector('#select_ambiente').value);
    if (document.querySelector('#select_ambiente').value != "vacio" && document.querySelector('#select_fecha').value != "vacio") {
        quitarColor(4);
        generarpdf('HorarioAmbiente');
    } else {
        alert('Por favor elige un ambiente y una fecha.');
    }
});

document.querySelector('#select_ambiente').addEventListener('change', function() {
    let idA = document.querySelector('#select_ambiente').value;
    if (document.querySelector('#select_fecha').value != "vacio") {
        let finicio = document.querySelector('#select_fecha').value.slice(0, 10);
        let ffin = document.querySelector('#select_fecha').value.slice(13, 23);
        buscarHorario(idA, finicio, ffin);
    }
});
document.querySelector('#select_fecha').addEventListener('change', function() {
    let finicio = document.querySelector('#select_fecha').value.slice(0, 10);
    let ffin = document.querySelector('#select_fecha').value.slice(13, 23);
    if (document.querySelector('#select_ambiente').value != "vacio") {
        let idA = document.querySelector('#select_ambiente').value;
        buscarHorario(idA, finicio, ffin);
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

function datosAmbiente() {
    let select_ambiente = document.querySelector('#select_ambiente');
    let optionDefault = document.createElement("option");
    optionDefault.text = "Seleccionar Ambiente";
    optionDefault.value = "vacio";
    optionDefault.selected = true;
    optionDefault.disabled = true;
    select_ambiente.add(optionDefault);
    const ambientes = peticion('peticionesAjaxAmbiente&p=mostrar', 'GET', null);
    ambientes.forEach(ambiente => {
        let option = document.createElement("option");
        option.text = ambiente['nombre_ambiente'];
        option.value = ambiente['id_amb'];
        select_ambiente.add(option);
    });
}

function buscarHorario(amb, inicio, fin) {
    let datos = {
        idA: amb,
        inicio: inicio,
        fin: fin
    }
    let array = document.querySelectorAll('.drops');
    array.forEach(ar => {
        ar.innerHTML = '';
    });
    const horarios = peticion('peticionesAjaxHorario&p=obtenerAmbiente', 'POST', datos);
    let contar = 0;
    let template = '';
    if (horarios != 'No encontrado') {
        horarios.forEach(horario => {
            template = `<div class='caja' style='background-color:${horario['color']};'>
                    <h3>${horario['instructor']}</h3>
                    <p>${horario['ficha']} - ${horario['programa']}</p>
                    <p>${horario['trimestre']}</p>
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