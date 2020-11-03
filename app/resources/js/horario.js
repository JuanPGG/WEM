var celdaId;
var td = document.querySelectorAll('td');
var th = document.querySelectorAll('th');
var cont = document.querySelector('#cont_form');
let abierto = false;
window.addEventListener('load', function() {
    datosFicha();
    datosTrimestre();
    datosFormulario();
    buscarHorario();
    jornada();
    document.querySelector('#enlace-atras').addEventListener('click', function() {
        window.history.back();
    });
    for (var i = 0; i < td.length; i++) {
        td[i].addEventListener('dblclick', function(ev) {
            if (ev.target.className == 'drops') {
                celdaId = ev.target.id;
            } else if (ev.target.className == 'caja') {
                celdaId = ev.target.parentElement.id;
            } else if (ev.target.className == 'icon-cog') {
                celdaId = ev.target.parentElement.parentElement.parentElement.id;
            } else {
                celdaId = ev.target.parentElement.parentElement.id;
            }
            // celdaId = ev.target.className === 'drops' ? ev.target.id : ev.target.parentElement.id;
            // celdaId = ev.target.parentElement.id;
            var celda_select = document.querySelector("#" + celdaId);
            const datos = {
                dia: celda_select.getAttribute('data-dia'),
                hora_inicio: celda_select.parentElement.getAttribute('data-inicio'),
                hora_fin: celda_select.parentElement.getAttribute('data-fin'),
                fecha_inicio: $('#fecha p').attr('inicio'),
                fecha_fin: $('#fecha p').attr('fin'),
                id_trimestre: $('table')[0].id
            }
            var resultado = peticion("peticionesAjaxHorario&p=existe", "POST", datos);
            if (resultado.length > 0) {
                var texto = 'El dia ' + resultado[0].dia + ' de ' + resultado[0].hora_inicio + ' a ' + resultado[0].hora_fin + ' ya se encuentra programado.';
                document.querySelector("#alerta").style.display = "flex";
                document.querySelector("#alerta").innerHTML = texto;
            } else {
                mostrarForm(ev);
                document.querySelector("#alerta").style.display = "none";
            }
        });
    }
    document.querySelector('#btn-horario').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormHorario()) {
            var celda_select = document.querySelector("#" + celdaId);
            const datos = {
                dia: celda_select.getAttribute('data-dia'),
                hora_inicio: celda_select.parentElement.getAttribute('data-inicio'),
                hora_fin: celda_select.parentElement.getAttribute('data-fin'),
                id_Ambiente: $('#select_ambiente').val(),
                id_Competencia: $('#select_competencia').val(),
                id_Instructor: $('#select_instructor').val(),
                id_Trimestre: $('table')[0].id,
                id_Usuario: $('main').attr('data-user'),
                fecha_inicio: $('#fecha p').attr('inicio'),
                fecha_fin: $('#fecha p').attr('fin')
            };
            $.ajax({
                url: "http://localhost/WEM/index.php?v=peticionesAjaxHorario&p=agregar",
                type: "POST",
                data: datos,
                success: function(response) {
                    if (response == 'Ok') {
                        cont.style.display = 'none';
                        $("#formulario").trigger('reset');
                        buscarHorario();
                    } else {
                        const respuesta = JSON.parse(response);
                        alert(`${respuesta[0].nombre} ya está programado el dia ${respuesta[0].dia} de ${respuesta[0].hora_inicio} a ${respuesta[0].hora_fin} en la ficha ${respuesta[0].ficha}`);
                        cont.style.display = 'none';
                        $("#formulario").trigger('reset');
                    }
                }
            });
        }
    });
    // Evento de click para mostrar las opciones detalles y eliminar de cada elemento arrastrado a la tabla
    $(document).on('click', '.icon-cog', function(e) {
        // La función toggle inserta o elimina una clase dependiendo de si existe o no
        document.querySelector('#' + e.target.id + " ~ .menu").classList.toggle('a');
    });
    // Evento click sobre la opción detalles que mostrar la información del elemento arrastrado
    $(document).on('click', '.detalles', function(e) {
        window.location = 'index.php?v=detallesinstructor&id=' + e.target.id + '&t=' + $('table')[0].id;
    });
    // Evento click que eliminará el elemento arrastrado de la tabla
    $(document).on('click', '.eliminar', function(e) {
        if (confirm("Está seguro de eliminar esto?")) {
            // Variables donde se almacena el atributo data-id de la fila donde se dio click
            let element = $(this)[0].parentElement.parentElement.parentElement.parentElement.innerHTML = '';
            let id_horario = {
                id_horario: e.target.id
            };
            // Ajax que hará la consulta para eliminar instructor según el id
            peticion("peticionesAjaxHorario&p=eliminar", "POST", id_horario);
            element;
            buscarHorario();
        }
    });
});

document.querySelector('#jornada').addEventListener('change', jornada);

document.querySelector('#enlace-pdf').addEventListener('click', function() {
    quitarColor(1);
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
    const ficha = peticion("peticionesAjaxFicha&p=obtenerdatos", "POST", id_fic);
    template = `<h3>Ficha: ${ficha[0].num_ficha}</h3>`;
    // Se inserta el numero de la ficha en el título de la tabla
    $('#num_ficha').html(template);
}

function datosTrimestre() {
    let id_trimestre = {
        id_trimestre: $('table')[0].id
    };
    const trimestre = peticion("peticionesAjaxTrimestre&p=obtenerdatos", "POST", id_trimestre);
    template = `<h3>${trimestre[0].nombre_trimestre}</h3>`;
    // Se inserta el numero de la ficha en el título de la tabla
    $('#trimestre').html(template);
    $('#fecha').html(`<p inicio="${trimestre[0].fecha_inicio}" fin="${trimestre[0].fecha_fin}">Fecha: ${trimestre[0].fecha_inicio} / ${trimestre[0].fecha_fin}</p>`);
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
        <i id=op${horario['id_horario']} class='icon-cog'></i>
        <div class='menu'>
        <a class='detalles' id=${horario['id_instructor']}>Detalles</a>
        <a class='eliminar' id=${horario['id_horario']}>Eliminar</a>
        </div>
        </div>
        </div>
        `;
        array.forEach(ar => {
            if (ar.dataset.dia == horario['dia'] && (ar.parentElement.dataset.inicio == horario['hora_inicio'] && ar.parentElement.dataset.fin == horario['hora_fin'])) {
                $("#" + ar.id).html(template);
            }
        });
    });
}

function datosFormulario() {
    let select_instructor = document.querySelector('#select_instructor');

    let optionDefaultInstructor = document.createElement("option");
    optionDefaultInstructor.text = "Seleccione un instructor";
    optionDefaultInstructor.value = 0;
    select_instructor.add(optionDefaultInstructor);

    const instructores = peticion("peticionesAjax&p=mostrar", "GET", null);
    instructores.forEach(instructor => {
        let option = document.createElement("option");
        option.text = instructor['nombres'];
        option.value = instructor['id'];
        select_instructor.add(option);
    });

    let select_competencia = document.querySelector('#select_competencia');

    let optionDefaultCompetencia = document.createElement("option");
    optionDefaultCompetencia.text = "Seleccione un instructor";
    optionDefaultCompetencia.value = 0;
    select_competencia.add(optionDefaultCompetencia);

    const competencias = peticion("peticionesAjaxCompetencia&p=mostrar", "GET", null);
    competencias.forEach(competencia => {
        let option = document.createElement("option");
        option.text = competencia['nombre_comp'];
        option.value = competencia['id_comp'];
        select_competencia.add(option);
    });


    let select_ambiente = document.querySelector('#select_ambiente');

    let optionDefaultAmbiente = document.createElement("option");
    optionDefaultAmbiente.text = "Seleccione un instructor";
    optionDefaultAmbiente.value = 0;
    select_ambiente.add(optionDefaultAmbiente);

    const ambientes = peticion("peticionesAjaxAmbiente&p=mostrar", "GET", null);
    ambientes.forEach(ambiente => {
        let option = document.createElement("option");
        option.text = ambiente['nombre_ambiente'];
        option.value = ambiente['id_amb'];
        select_ambiente.add(option);
    });

}

function mostrarForm(ev) { // Se define la función que se encarga de mostrar el formulario
    // if (ev.target.className == 'drops') {
    cont.style.display = 'flex'; // Se muestra el formulario
    abierto = true; // Se le da el valor true a la variable bandera
    celdaId = ev.target.id;
    // }
}

cont.addEventListener('click', function(e) { // Evento para esconder el formulario según donde se de clic
    // condición para cerrar el form si se da por fuera de este o en la X
    if (abierto == true && ((e.target == cont) || (e.target == cerrar))) {
        abierto = false; // Se declara la variable como false para cerrar el form
        cont.style.display = 'none'; // Se esconde el form
    }
});

function validateFormHorario() {
    var instructor = $('#select_instructor').val();
    var competencia = $('#select_competencia').val();
    var ambiente = $('#select_ambiente').val();
    if (validarSelect(instructor, "select_instructor") && validarSelect(competencia, "select_competencia") && validarSelect(ambiente, "select_ambiente")) {
        return true;
    } else {
        return false;
    }
}