/** 
 * Función que se ejecuta al cargar la ventana del navegador
 */
 let etiqueta;
$(window).ready(function() {
    /** 
     * Definicion de variables bandera
     */
    let edit_instructor = false;
    let edit_ambiente = false;
    let edit_competencia = false;
    let edit_programaformacion = false;
    let edit_contrato = false;
    /** 
     * Llamado a las funciones de busqueda
     */
    buscar_instructor();
    buscar_ambiente();
    buscar_competencia();
    buscar_programaformacion();
    buscar_contrato();
    buscar_ayudante();
    buscar_trazabilidad(null);

    document.querySelector('#enlace-atras').addEventListener('click', function() {
        window.history.back();
    });
    /** 
     * Variable que contiene los diferentes enlaces de los fomularios
     */
    etiqueta = document.querySelectorAll('.menu > a');
    /** 
     * Ciclo para dar la función de click a los enlaces de cada formulario para mostrarlos
     */
    for (var i = 0; i < etiqueta.length; i++) {
        etiqueta[i].addEventListener('click', cambiar);
    }
    /** 
     * Se define la función para el cambio de formulario según el evento click definido anteriormente
     */
    function cambiar(ev) {
        /** 
         * Se borra la clase active del elemento que tenga dicha clase
         */
        document.querySelector('.active').classList.remove('active');
        /** 
         * Se agrega la clase active al elemento que se le de click
         */
        ev.target.className = 'active';
        /** 
         * Se borra la clase show del elemento que tenga dicha clase
         */
        document.querySelector('.show').classList.remove('show');
        /** 
         * Toggle es para asignar la clase si no existe y si existe borrarla
         */
        document.querySelector('#' + ev.target.getAttribute('data-class')).classList.toggle('show');
    }
    /** 
     * Se define la función submit para el formulario de agregar instructor
     */
    document.querySelector('#btn-instructor').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormInstructor()) {
            /** 
             * variable que almacena los valores de los input en un objeto
             */
            const datos = {
                nombres: $('#nombres').val(),
                apellidos: $('#apellidos').val(),
                documento: $('#documento').val(),
                correo: $('#correo').val(),
                tipoContrato: $('#tipoContrato').val(),
                color: $('#color').val(),
                id: $('#id').val()
            };
            /** 
             * Condición para identificar si se agregará o se editará información
             */
            let lugar = edit_instructor === false ? 'peticionesAjax&p=agregar' : 'peticionesAjax&p=editar';
            /** 
             * Condición para validar si se ejecutó la función
             */
            peticion(lugar, "POST", datos);
            buscar_instructor();
            $("#agregar_instructor").trigger('reset');
            $('#documento').attr('disabled', false);
            /** 
             * Se declara la variable bandera de instructor como false para que la condición del lugar
             * Se pueda cumplir 
             */
            edit_instructor = false;
        }
    });

    /** 
     * Se define el evento de click al botón borrar de la lista de instructores
     */
    $("#instructor").on('click', '.borrar', function(ev) {
        /** 
         * Conndición para validar si le dio por error o realmente quiere eliminar el dato
         */
        if (confirm("Está seguro de eliminar esto?")) {
            /** 
             * Variables donde se almacena el atributo data-id de la fila donde se dio click
             */
            let element = $(this)[0].parentElement.parentElement;
            let id = {
                id: $(element).attr('data-id')
            };
            /** 
             * Ajax que hará la consulta para eliminar instructor según el id
             */
            peticion("peticionesAjax&p=eliminar", "POST", id);
            buscar_instructor();
        }
    });
    /** 
     * Se define el evento de click al botón editar de la lista de instructores
     */
    $("#instructor").on("click", ".editar", function() {
        /** 
         * Se obtiene el atributo data-id de la fila de donde se dio click al botón editar
         * y almacenarlo en la variable id
         */
        let element = $(this)[0].parentElement.parentElement;
        let id = {
            id: $(element).attr('data-id')
        };
        /**
         * En este ajax se traen los valores de la base de datos según el id tomado anteriormente
         */
        var instructores = peticion("peticionesAjax&p=obtenerdatos", "POST", id);
        /** 
         * Se insertan los datos que retorna el ajax en los diferentes inputs
         */
        $('#id').val(instructores[0].id);
        $('#nombres').val(instructores[0].nombres);
        $('#apellidos').val(instructores[0].apellidos);
        $('#documento').val(instructores[0].documento);
        $('#correo').val(instructores[0].correo);
        $('#tipoContrato').val(instructores[0].tipoContrato);
        $('#color').val(instructores[0].color);
        $('#documento').attr('disabled', true);
        /** 
         * Variable que permite saber si se editará o se agregará un dato
         * en false lo agrega y en true lo edita
         */
        edit_instructor = true;
        validarLength();
    });

    document.querySelector('#btn-ambiente').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormAmbiente()) {
            /** 
             * variable que almacena los valores de los input en un objeto
             */
            const datos = {
                nombre_ambiente: $('#nombre_ambiente').val(),
                descripcion_ambiente: $('#descripcion_ambiente').val(),
                id_amb: $('#id_amb').val()
            };
            /** 
             * Condición para identificar si se agregará o se ediará información
             */
            let lugar = edit_ambiente === false ? 'peticionesAjaxAmbiente&p=agregar' : 'peticionesAjaxAmbiente&p=editar';
            peticion(lugar, "POST", datos); // Se llama la función que hace la petición ajax
            buscar_ambiente(); // Se llama la función que busca los ambientes
            $("#agregar_ambiente").trigger('reset'); // Se resetea el formulario
            // Se declara la variable bandera de ambiente como false para que el lugar sea agregar
            edit_ambiente = false;
        }
    });
    /** 
     * Se define el evento de click al botón borrar de la lista de ambiente
     */
    $("#ambiente").on('click', '.borrar', function(ev) {
        /** 
         * Condicional que pregunta si está seguro de borrar esos datos y 
         * en caso verdadero hará la respectiva consulta
         */
        if (confirm("Are you sure you want to delete it?")) {
            /** 
             * Se obtiene el atributo data-id de la fila de donde se dio click al botón editar
             * y almacenarlo en la variable id
             */
            let element = $(this)[0].parentElement.parentElement;
            let id_amb = {
                id_amb: $(element).attr('data-id')
            };
            /** 
             * función que hace la petición Ajax que hará la consulta para eliminar ambiente según el id
             */
            peticion("peticionesAjaxAmbiente&p=eliminar", "POST", id_amb);
            /**Se llama la función que busca los ambientes */
            buscar_ambiente();
        }
    });
    /**
     * Se define el evento click al boton editar de la lista de ambiente
     */
    $("#ambiente").on("click", ".editar", function() {
        /** 
         * Se obtiene el atributo data-id de la fila de donde se dio click al botón editar
         * y almacenarlo en la variable id
         */
        let element = $(this)[0].parentElement.parentElement;
        let id_amb = {
            id_amb: $(element).attr('data-id')
        };
        /** 
         * Se llama la función que hace la peticion ajax para obtener los datos
         * según el atributo que se tomó anteriormente y se almacenan en una variable
         */
        var ambiente = peticion("peticionesAjaxAmbiente&p=obtenerdatos", "POST", id_amb);
        /** 
         * Se insertan los datos que se almacenaron en la variable ambiente en los respectivos
         * inputs dell formulario
         */
        $('#id_amb').val(ambiente[0].id_amb);
        $('#nombre_ambiente').val(ambiente[0].nombre_ambiente);
        $('#descripcion_ambiente').val(ambiente[0].descripcion_ambiente);
        /** 
         * Se declara la variable bandera de ambiente como true para que el lugar sea editar
         */
        edit_ambiente = true;
        validarLength();
    });

    document.querySelector('#btn-competencia').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormCompetencia()) {
            const datos = {
                nombre_comp: $('#nombre_comp').val(),
                descripcion_comp: $('#descripcion_comp').val(),
                id_comp: $('#id_comp').val()
            };
            /** 
             * Condición para identificar si se agregará o se ediará información
             */
            let lugar = edit_competencia === false ? 'peticionesAjaxCompetencia&p=agregar' : 'peticionesAjaxCompetencia&p=editar';
            peticion(lugar, "POST", datos); // Se llama la función que hace la petición ajax
            buscar_competencia(); // Se llama la función que busca los competencias
            $("#agregar_competencia").trigger('reset'); // Se resetea el formulario
            // Se declara la variable bandera de competencia como false para que el lugar sea agregar
            edit_competencia = false;
        }
    });
    /** 
     * Se define el evento de click al botón borrar de la lista de ambiente
     */
    $("#competencia").on('click', '.borrar', function(ev) {
        /** 
         * Condicional que pregunta si está seguro de borrar esos datos y 
         * en caso verdadero hará la respectiva consulta
         */
        if (confirm("Está seguro que quiere eliminar esto?")) {
            /** 
             * Se obtiene el atributo data-id de la fila de donde se dio click al botón editar
             * y almacenarlo en la variable id
             */
            let element = $(this)[0].parentElement.parentElement;
            let id_comp = {
                id_comp: $(element).attr('data-id')
            };
            /**
             * función que hace la petición Ajax que hará la consulta para eliminar ambiente según el id
             */
            peticion("peticionesAjaxCompetencia&p=eliminar", "POST", id_comp);
            /** 
             * Se llama la función que busca los ambientes
             */
            buscar_competencia();
        }
    });
    /** 
     * Se define el evento click al boton editar de la lista de ambiente
     */
    $("#competencia").on("click", ".editar", function() {
        /** 
         * Se obtiene el atributo data-id de la fila de donde se dio click al botón editar
         * y almacenarlo en la variable id
         */
        let element = $(this)[0].parentElement.parentElement;
        let id_comp = {
            id_comp: $(element).attr('data-id')
        };
        /** 
         * Se llama la función que hace la peticion ajax para obtener los datos
         * según el atributo que se tomó anteriormente y se almacenan en una variable
         */
        var competencia = peticion("peticionesAjaxCompetencia&p=obtenerdatos", "POST", id_comp);
        /** 
         * Se insertan los datos que se almacenaron en la variable ambiente en los respectivos
         * inputs dell formulario
         */
        $('#id_comp').val(competencia[0].id_comp);
        $('#nombre_comp').val(competencia[0].nombre_comp);
        $('#descripcion_comp').val(competencia[0].descripcion_comp);
        /** 
         * Se declara la variable bandera de ambiente como true para que el lugar sea editar
         */
        edit_competencia = true;
        validarLength();
    });

    document.querySelector('#btn-programa').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormPrograma()) {
            const datos = {
                nombre_programa: $('#nombre_programa').val(),
                descripcion_programa: $('#descripcion_programa').val(),
                id_pf: $('#id_pf').val()
            };
            /** 
             * Condición para identificar si se agregará o se editará información
             */
            let lugar = edit_programaformacion === false ? 'peticionesAjaxProgramaFormacion&p=agregar' : 'peticionesAjaxProgramaFormacion&p=editar';
            peticion(lugar, "POST", datos);
            buscar_programaformacion();
            $('#agregar_programaformacion').trigger('reset');
            edit_programaformacion = false;
        }
    })
    /** 
     * Se define el evento click al boton borrar de la lista de programa
     */
    $("#programa").on('click', '.borrar', function(ev) {
        if (confirm("Are you sure you want to delete it?")) {
            let element = $(this)[0].parentElement.parentElement;
            let id_pf = {
                id_pf: $(element).attr('data-id')
            };
            peticion("peticionesAjaxProgramaFormacion&p=eliminar", "POST", id_pf);
            buscar_programaformacion();
        }
    });
    /** 
     * Se define el evento click al boton editar de la lista de programa
     */
    $("#programa").on("click", ".editar", function() {
        let element = $(this)[0].parentElement.parentElement;
        let id_pf = {
            id_pf: $(element).attr('data-id')
        };
        /**
         * En este ajax se insertan los valores de la base de datos en los diferentes input
         * Que tiene el formulario4, con una peticion de consulta que se hace en el servlet obtenerId
         */
        var programaformacion = peticion("peticionesAjaxProgramaFormacion&p=obtenerdatos", "POST", id_pf);
        /** 
         * Se insertan los datos que se almacenaron en la variable ambiente en los respectivos
         * inputs del formulario
         */
        $('#id_pf').val(programaformacion[0].id_pf);
        $('#nombre_programa').val(programaformacion[0].nombre_programa);
        $('#descripcion_programa').val(programaformacion[0].descripcion_programa);
        edit_programaformacion = true;
        validarLength();
    });

    document.querySelector('#btn-contrato').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormContrato()) {
            const datos = {
                descripcion_tipocontrato: $('#descripcion_contrato').val(),
                horas_tipocontrato: $('#horas_contrato').val(),
                id_cont: $('#id_contrato').val()
            };
            /** 
             * Condición para identificar si se agregará o se editará información 
             */
            let lugar = edit_contrato === false ? 'peticionesAjaxContrato&p=agregar' : 'peticionesAjaxContrato&p=editar';
            peticion(lugar, "POST", datos)
            buscar_contrato();
            $('#agregar_contrato').trigger('reset');
            edit_contrato = false;
        }
    })
    /** 
     * Se define el evento click al boton editar de la lista del contrato
     */
    $("#contrato").on('click', '.borrar', function(ev) {
        if (confirm("Está seguro que quiere eliminar esto?")) {
            let element = $(this)[0].parentElement.parentElement;
            let id_cont = {
                id_cont: $(element).attr('data-id')
            };
            peticion("peticionesAjaxContrato&p=eliminar", "POST", id_cont);
            buscar_contrato();
        }
    });
    /** 
     * Se define el evento click al boton editar de la lista del contrato
     */
    $("#contrato").on("click", ".editar", function() {
        let element = $(this)[0].parentElement.parentElement;
        let id_cont = {
            id_cont: $(element).attr('data-id')
        };
        /**
         * En este ajax se insertan los valores de la base de datos en los diferentes input
         * Que tiene el formulario4, con una peticion de consulta que se hace en el servlet obtenerId
         */
        var contrato = peticion("peticionesAjaxContrato&p=obtenerdatos", "POST", id_cont);
        $('#id_contrato').val(contrato[0].id_cont);
        $('#descripcion_contrato').val(contrato[0].descripcion_tipocontrato);
        $('#horas_contrato').val(contrato[0].horas_tipocontrato);
        edit_contrato = true;
        validarLength();
    });

    document.querySelector('#btn-ayudante').addEventListener('click', function(ev) {
        ev.preventDefault();
        if (validateFormAyudante()) {
            const datos = {
                nombres: $('#name').val(),
                apellidos: $('#lastname').val(),
                correo: $('#email').val(),
                contrasena: $('#pw').val()
            };
            /** 
             * Condición para identificar si se agregará o se editará información 
             */
            peticion("peticionUsuario&p=insertAyudante", "POST", datos);
            buscar_ayudante();
            $('#agregar_ayudante').trigger('reset');
            // $.ajax({
            //     url: "http://localhost/WEM/index.php?v=peticionUsuario&p=insertAyudante",
            //     type: "POST",
            //     data: datos,
            //     success: function(response) {
            //         buscar_ayudante();
            //         $('#agregar_ayudante').trigger('reset');
            //     }
            // });
        }
    });
    /** 
     * Se define el evento click al boton editar de la lista del contrato
     */
    $("#ayudante").on('click', '.borrar', function(ev) {
        if (confirm("Está seguro que quiere eliminar esto?")) {
            let element = $(this)[0].parentElement.parentElement;
            let id = {
                id: $(element).attr('data-id')
            };
            peticion("peticionUsuario&p=eliminar", "POST", id);
            buscar_ayudante();
        }
    });


    var botones = document.querySelectorAll('.cancelar');
    for (var i = 0; i < botones.length; i++) {
        botones[i].addEventListener('click', function() {
            edit_instructor = false;
            edit_ambiente = false;
            edit_competencia = false;
            edit_programaformacion = false;
            edit_contrato = false;
            $('#agregar_instructor').trigger('reset');
            $('#agregar_ambiente').trigger('reset');
            $('#agregar_competencia').trigger('reset');
            $('#agregar_programaformacion').trigger('reset');
            $('#agregar_contrato').trigger('reset');
            validarLength();
        });
    }
});
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos del instructor
 */
function buscar_instructor() {
    var instructores = peticion("peticionesAjax&p=mostrar", "GET", null);
    let template = '';
    instructores.forEach(instructor => {
        template += `
        <tr data-id="${instructor['id']}">
        <td>${instructor['nombres']}</td>
        <td>${instructor['apellidos']}</td>
        <td>${instructor['documento']}</td>
        <td>${instructor['correo']}</td>
        <td>${instructor['tipoContrato']}</td>
        <td style="background-color:${instructor['color']}; color: black;"></td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`
    });
    $('#lista_instructor').html(template);
}
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos del ambiente
 */
function buscar_ambiente() {
    var ambientes = peticion("peticionesAjaxAmbiente&p=mostrar", "GET", null);
    let template = '';
    ambientes.forEach(ambiente => {
        template += `
        <tr data-id="${ambiente['id_amb']}">
        <td>${ambiente['nombre_ambiente']}</td>
        <td>${ambiente['descripcion_ambiente']}</td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`
    });
    $('#lista_ambiente').html(template);
}
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos de la competencia
 */
function buscar_competencia() {
    var competencias = peticion("peticionesAjaxCompetencia&p=mostrar", "GET", null);
    let template = '';
    competencias.forEach(competencia => {
        template += `
        <tr data-id="${competencia['id_comp']}">
        <td>${competencia['nombre_comp']}</td>
        <td>${competencia['descripcion_comp']}</td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`
    });
    $('#lista_competencia').html(template);
}
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos de la ficha
 */
function buscar_ficha() {
    var fichas = peticion("peticionesAjaxFicha&p=mostrar", "GET", null);
    let template = '';
    fichas.forEach(ficha => {
        template += `
        <tr data-id="${ficha['id_fic']}">
        <td>${ficha['num_ficha']}</td>
        <td>${ficha['nombre_gestor']}</td>
        <td>${ficha['id_programa']}</td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`;
    });
    $('#lista_ficha').html(template);
}
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos del programa formacion
 */
function buscar_programaformacion() {
    var programasformaciones = peticion("peticionesAjaxProgramaFormacion&p=mostrar", "GET", null);
    let template = '';
    programasformaciones.forEach(programaformacion => {
        template += `
        <tr data-id="${programaformacion['id_pf']}">
        <td>${programaformacion['nombre_programa']}</td>
        <td>${programaformacion['descripcion_programa']}</td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`;
    });
    $('#lista_programa').html(template);
}
let select_contrato = document.querySelector('#tipoContrato');
/**
 *llenar el select del formualario del instructor para aisgnar el tipo de contrato
 * @param {*} [array=[]]
 */
function tipoContrato(array = []) {
    $("#tipoContrato option").remove();
    let optionDefault = document.createElement("option");
    optionDefault.text = "Tipo de contrato";
    optionDefault.value = 0;
    select_contrato.add(optionDefault);
    for (var i = 0; i < array.length; i++) {
        let option = document.createElement("option");
        option.text = array[i]['descripcion_tipocontrato'];
        option.value = array[i]['id_cont'];
        select_contrato.add(option);
    }
}
/**
 *Esta funciona solo estamos haciendo la peticion para mostrar los datos del contrato
 */
function buscar_contrato() {
    var contratos = peticion("peticionesAjaxContrato&p=mostrar", "GET", null);
    let template = '';
    tipoContrato(contratos);
    contratos.forEach(contrato => {
        template += `
        <tr data-id="${contrato['id_cont']}">
        <td>${contrato['descripcion_tipocontrato']}</td>
        <td>${contrato['horas_tipocontrato']}</td>
        <td class="cont_boton">
        <div class="editar"><i class="icon-pencil"></i></div>
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`;
    });
    $('#lista_contrato').html(template);
}

function buscar_ayudante() {
    const datos = {
        id: $('.container').attr('data-user')
    }
    const ayudantes = peticion("peticionUsuario&p=ayudantes", "POST", datos);
    let template = '';
    ayudantes.forEach(ayudante => {
        template += `
        <tr data-id="${ayudante['id']}">
        <td>${ayudante['nombres']}</td>
        <td>${ayudante['apellidos']}</td>
        <td>${ayudante['correo']}</td>
        <td class="cont_boton">
        <div class="borrar"><i class="icon-bin"></i></div>
        </td>
        </tr>`;
    });
    $('#lista_ayudantes').html(template);
}
let form_busqueda = document.querySelector('#busqueda');
form_busqueda.addEventListener('submit', function(e) {
    e.preventDefault();
});

let busqueda = document.querySelector('#buscar');
busqueda.addEventListener('keyup', function() {
    if (busqueda.value.length >= 1) {
        let template = '';
        let datos = {
            texto: busqueda.value
        }
        let trazabilidad2 = peticion("peticionesAjaxTrazabilidad&p=buscar", "POST", datos);
        trazabilidad2.forEach(tz2 => {
            template += `
            <tr data-id="${tz2['id_Tz']}">
            <td>${tz2['usuario']}</td>
            <td>${tz2['ficha']}</td>
            <td>${tz2['trimestre']}</td>
            <td>${tz2['instructor']}</td>
            <td>${tz2['competencia']}</td>
            <td>${tz2['ambiente']}</td>
            <td>${tz2['fecha']}</td>
            <td>${tz2['accion']}</td>
            </tr>`;
        });
        $('#lista_trazabilidad').html(template);
    } else {
        buscar_trazabilidad();
    }
});

function buscar_trazabilidad() {
    let template = '';
    let trazabilidad = peticion("peticionesAjaxTrazabilidad&p=mostrar", "GET", null);
    trazabilidad.forEach(tz => {
        template += `
        <tr data-id="${tz['id_Tz']}">
        <td>${tz['usuario']}</td>
        <td>${tz['ficha']}</td>
        <td>${tz['trimestre']}</td>
        <td>${tz['instructor']}</td>
        <td>${tz['competencia']}</td>
        <td>${tz['ambiente']}</td>
        <td>${tz['fecha']}</td>
        <td>${tz['accion']}</td>
        </tr>`;
    });

    $('#lista_trazabilidad').html(template);
}

let forms = document.getElementsByClassName('menu')[0];
let mostrar = document.getElementById('enlace-form');
let abierto = true;
mostrar.addEventListener('click', function() {
    menuforms();
});
/** 
 *  Función para abrir o cerrar el menú del nav cuando está responsive
 */
function menuforms() {
    if (abierto) {
        forms.style.height = `${(etiqueta.length - 1) * 40}px`;
        abierto = false;
    } else {
        forms.style.height = '0px';
        forms.style.overflow = 'hidden';
        abierto = true;
    }
}
window.addEventListener('click', function(e) {
    if (abierto == false) {
        /** 
         * condición para cerrar el menú si se da por fuera o en el icono
         */
        if (e.target !== mostrar) {
            forms.style.height = '0px';
            forms.style.overflow = 'hidden';
            abierto = true;
        }
    }
});

/** 
 * Registra un evento a un objeto en específico. 
 * El ObJeto especifico puede ser un simple elemento en un archivo
 */
window.addEventListener('resize', function() {
    if (screen.width >= 700) {
        abierto = true;
        forms.style.removeProperty('overflow');
        forms.style.removeProperty('height');
    }
});
var inputs = document.querySelectorAll('.input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function() {
        validarLength();
    });
}
//Función para las diferentes validciones del formulario de REGISTRO
function validateFormInstructor() {
    // declarion de variables
    var nombres = $("#nombres").val();
    var apellidos = $("#apellidos").val();
    var documento = $('#documento').val();
    var correo = $("#correo").val();
    var tipoContrato = $('#tipoContrato').val();
    var color = $('#color').val();
    if (validarText(nombres, "nombres") && validarText(apellidos, "apellidos") && validarDocumento(documento, "documento") && validarCorreo(correo, "correo") && validarSelect(tipoContrato, "tipoContrato") && validarColor(color, "color")) {
        return true;
    } else {
        return false;
    }
}

function validateFormAmbiente() {
    var ambiente = $("#nombre_ambiente").val();
    if (validarNull(ambiente, "nombre_ambiente")) {
        return true;
    } else {
        return false;
    }
}

function validateFormCompetencia() {
    var competencia = $('#nombre_comp').val();
    if (validarNull(competencia, "nombre_comp")) {
        return true;
    } else {
        return false;
    }
}

function validateFormPrograma() {
    var programa = $('#nombre_programa').val();
    if (validarNull(programa, "nombre_programa")) {
        return true;
    } else {
        return false;
    }
}

function validateFormContrato() {
    var contrato = $('#descripcion_contrato').val();
    var horas = $('#horas_contrato').val();
    if (validarText(contrato, "descripcion_contrato") && validarHoras(horas, "horas_contrato")) {
        return true;
    } else {
        return false;
    }
}

function validateFormAyudante() {
    let nombres = $('#name').val();
    let apellidos = $('#lastname').val();
    let correo = $('#email').val();
    let contrasena = $('#pw').val();
    if (validarText(nombres, "name") && validarText(apellidos, "lastname") && validarCorreo(correo, "email") && validarPw(contrasena, "pw")) {
        return true;
    } else {
        return false;
    }
}