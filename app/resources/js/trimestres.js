var cont = document.querySelector('#cont_form');
let abierto = false;
window.addEventListener('load', function() {
    var edit_trimestre = false;
    buscarFicha();
    buscarTrimestre();
    var fechas = document.querySelectorAll(".fecha");
    for (var i = 0; i < fechas.length; i++) {
        fechas[i].type = 'text';
        fechas[i].addEventListener('focus', function() {
            this.type = 'date';
        });
        fechas[i].addEventListener('blur', function() {
            this.type = 'text';
            validarLength();
        });
    }
    document.querySelector('#agregar').addEventListener('click', function() {
        mostrarForm();
    });
    document.querySelector('#btn-trimestre').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormTrimestre()) {
            const datos = {
                trimestre: $('#nombre_trimestre').val(),
                fecha_inicio: $('#fecha_inicio').val(),
                fecha_fin: $('#fecha_fin').val(),
                id_ficha: $('.container').attr('id'),
                id_trimestre: $('#id_trimestre').val()
            }
            let lugar = edit_trimestre === false ? "peticionesAjaxTrimestre&p=agregar" : "peticionesAjaxTrimestre&p=editar";
            peticion(lugar, "POST", datos);
            buscarTrimestre();
            $('#form_trimestre').trigger('reset');
            cont.style.display = 'none';
            edit_trimestre = false;
        }
    });

    $('#form_trimestre').submit(function(ev) {
        ev.preventDefault();

    });
    $('#cont_trimestres').on('click', '.editar', function() {
        var id_trimestre = {
            id_trimestre: $(this)[0].parentElement.parentElement.parentElement.id
        };
        mostrarForm();
        var horario = peticion("peticionesAjaxTrimestre&p=obtenerdatos", "POST", id_trimestre);
        $('#id_trimestre').val(horario[0].id_trimestre);
        $('#nombre_trimestre').val(horario[0].nombre_trimestre);
        $('#fecha_inicio').val(horario[0].fecha_inicio);
        $('#fecha_fin').val(horario[0].fecha_fin);
        edit_trimestre = true;
        validarLength();
    });
    $('#cont_trimestres').on('click', '.eliminar', function(ev) {
        if (confirm("Está seguro que desea eliminar esto?")) {
            let id_trimestre = {
                id_trimestre: $(this)[0].parentElement.parentElement.parentElement.id
            };
            peticion("peticionesAjaxTrimestre&p=eliminar", "POST", id_trimestre);
            buscarTrimestre();
        }
    });
    cont.addEventListener('click', function(e) {
        if (abierto == true && ((e.target == cont) || (e.target == cerrar))) {
            abierto = false;
            cont.style.display = 'none';
            edit_trimestre = false;
            $("#form_trimestre").trigger('reset');
        }
    });
});
var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        validarLength();
    });
}

function buscarFicha() {
    let id = {
        id_fic: $(".container").attr('id')
    };
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxFicha&p=obtenerdatos",
        type: "POST",
        data: id,
        success: function(response) {
            const ficha = JSON.parse(response);
            document.querySelector('#num_ficha').innerHTML = ficha[0].num_ficha;
        }
    });
}

function buscarTrimestre() {
    const datos = {
        id_ficha: $(".container").attr('id')
    };
    $.ajax({
        url: "http://localhost/WEM/index.php?v=peticionesAjaxTrimestre&p=mostrar",
        type: "POST",
        data: datos,
        success: function(response) {
            const trimestres = JSON.parse(response);
            let template = '';
            trimestres.forEach(trimestre => {
                template += `
                <div class="trimestres" id=${trimestre['id_trimestre']}>
                <div class="nombre_trimestre">
                <h2>${trimestre['trimestre']}</h2>
                <p>${trimestre['fecha_inicio']} / ${trimestre['fecha_fin']}</p>
                </div>
                <div class="info">
                <p><a href="index.php?v=adminHorario&n=${trimestre["id_ficha"]}&t=${trimestre['id_trimestre']}" class="abrir">Abrir</a></p>
                <p><a class="editar">Editar</a></p>
                <p><a class="eliminar">Eliminar</a></p>
                </div>
                </div>`
            });
            $('#cont_trimestres').html(template);
        }
    });
}

function mostrarForm() {
    cont.style.display = 'flex';
    abierto = true;
    validarLength();
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});

function validateFormTrimestre() {
    var trimestre = $('#nombre_trimestre').val();
    var inicio = $('#fecha_inicio').val();
    var fin = $('#fecha_fin').val();

    if (validarNull(trimestre, "nombre_trimestre") && validarNull(inicio, "fecha_inicio") && validarNull(fin, "fecha_fin")) {
        return true;
    } else {
        return false;
    }
}