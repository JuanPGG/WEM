window.addEventListener('load', function() {
    buscarFicha();
    buscarTrimestre();
});

function buscarFicha() {
    let id = {
        id_fic: $(".container").attr('id')
    };
    const ficha = peticion('peticionesAjaxFicha&p=obtenerdatos', "POST", id);
    document.querySelector('#num_ficha').innerHTML = ficha[0].num_ficha;
}

function buscarTrimestre() {
    const datos = {
        id_ficha: $(".container").attr('id')
    };
    const trimestres = peticion('peticionesAjaxTrimestre&p=mostrar', 'POST', datos);
    let template = '';
    trimestres.forEach(trimestre => {
        template += `
                <div class="trimestres" id=${trimestre['id_trimestre']}>
                <div class="nombre_trimestre">
                <h2>${trimestre['trimestre']}</h2>
                <p>${trimestre['fecha_inicio']} / ${trimestre['fecha_fin']}</p>
                </div>
                <div class="info">
                <p><a href="${url}index.php?v=horario&n=${trimestre["id_ficha"]}&t=${trimestre['id_trimestre']}" class="abrir">Abrir</a></p>
                </div>
                </div>`;
    });
    $('#cont_trimestres').html(template);
}
document.querySelector('#enlace-atras').addEventListener('click', function() {
    window.history.back();
});