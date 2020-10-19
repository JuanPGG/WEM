window.addEventListener('load', function() {
    buscarFicha();
    buscarTrimestre();
});

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
                <p><a href="index.php?v=horario&n=${trimestre["id_ficha"]}&t=${trimestre['id_trimestre']}" class="abrir">Abrir</a></p>
                </div>
                </div>`
            });
            $('#cont_trimestres').html(template);
        }
    });
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});