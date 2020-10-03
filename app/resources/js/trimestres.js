var cont = document.querySelector('#cont_form');
let abierto = false;
window.addEventListener('load', function() {
    var edit_trimestre = false;
    buscarFicha();
    buscarTrimestre();
    document.querySelector('#agregar').addEventListener('click', function() {
        mostrarForm();
    });
    $('#form_trimestre').submit(function(ev) {
        ev.preventDefault();
        const datos = {
            trimestre: $('#nombre_trimestre').val(),
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_fin: $('#fecha_fin').val(),
            id_ficha: $('.container').attr('id'),
            id_horario: $('#id_trimestre').val()
        }
        let lugar = edit_trimestre === false ? "peticionesAjaxTrimestre&p=agregar" : "peticionesAjaxTrimestre&p=editar";
        peticion(lugar, "POST", datos);
        buscarTrimestre();
        $('#form_trimestre').trigger('reset');
        cont.style.display = 'none';
        edit_trimestre = false;
    });
    $(document).on('click', '.editar', function() {
        var id_horario = {
            id_horario: $(this)[0].parentElement.parentElement.parentElement.id
        };
        console.log(id_horario);
        mostrarForm();
        var horario = peticion("peticionesAjaxTrimestre&p=obtenerdatos", "POST", id_horario);
        console.log(horario);
        $('#id_trimestre').val(horario[0].id_horario);
        $('#nombre_trimestre').val(horario[0].nombre_trimestre);
        $('#fecha_inicio').val(horario[0].fecha_inicio);
        $('#fecha_fin').val(horario[0].fecha_fin);
        edit_trimestre = true;
    });
    $(document).on('click', '.eliminar', function(ev) {
        if (confirm("Está seguro que desea eliminar esto?")) {
            let id_horario = {
                id_horario: $(this)[0].parentElement.parentElement.parentElement.id
            };
            peticion("peticionesAjaxTrimestre&p=eliminar", "POST", id_horario);
            buscarTrimestre();
        }
    });
});
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

function buscarFicha() {
    let id = {
        id_fic: $(".container").attr('id')
    };
    $.ajax({
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxFicha&p=obtenerdatos",
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
        url: "http://localhost/Proyecto-WEM/index.php?v=peticionesAjaxTrimestre&p=mostrar",
        type: "POST",
        data: datos,
        success: function(response) {
            const trimestres = JSON.parse(response);
            let template = '';
            trimestres.forEach(trimestre => {
                template += `
                <div class="trimestres" id=${trimestre['id_horario']}>
                <div class="nombre_trimestre">
                <h2>${trimestre['trimestre']}</h2>
                <p>${trimestre['fecha_inicio']} / ${trimestre['fecha_fin']}</p>
                </div>
                <div class="info">
                <p><a href="index.php?v=crud&n=${trimestre["id_ficha"]}&t=${trimestre['id_horario']}" class="abrir">Abrir</a></p>
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
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});
cont.addEventListener('click', function(e) {
    if (abierto == true && ((e.target == cont) || (e.target == cerrar))) {
        abierto = false;
        cont.style.display = 'none';
        $("#form_trimestre").trigger('reset');
    }
});