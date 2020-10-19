var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
window.addEventListener('load', function() {
    datosTrimestre();
    datosInstructores();
    jornada();

});
document.querySelector('#jornada').addEventListener('change', jornada);

document.querySelector('#enlace-pdf').addEventListener('click', function() {
    quitarColor(3);
    generarpdf('HorarioInstructor');
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

document.querySelector('#select_instructor').addEventListener('change', function(){
    var idI = document.querySelector('#select_instructor').value;
    var f_inicio = document.querySelector('#fecha').getAttribute('data-inicio');
    var f_fin = document.querySelector('#fecha').getAttribute('data-fin');
    buscarHorario(idI, f_inicio, f_fin);
});
function datosInstructores() {
    let select_instructor = document.querySelector('#select_instructor');
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
    if(inst == null){
        datos = {
            id_instructor: $('.table').attr('data-id'),
            fecha_inicio: inicio,
            fecha_fin: fin
        }
    }else{
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
            var contar = 0;
            if(response != 'No encontrado'){
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
                            $('#horasp').html(`<p>Horas programadas: ${contar}</p>`);
                        }
                    });
                });
            }else{
                $('#horasp').html(`<p>Horas programadas: ${contar}</p>`);
            }
        }
    });
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});