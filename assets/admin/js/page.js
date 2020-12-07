$(document).ready(function() {
    $(".dropify").dropify({
        messages: {
            default: "Arrastra un archivo o click aqui",
            replace: "Arrastra y suelta, o click para reemplazar",
            remove: "Remover",
            error: "Ooops, algo salio mal."
        },
        error: {
            fileSize: "El archivo es muy grande(1M max)."
        }
    });
    $(".datepicker").flatpickr({
        dateFormat: "d-m-Y",
        locale:{
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            },
            months: {
                shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            },
        }
    });
    $(".timepicker").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i"
    });
    $('.select2').select2();
    $(".data_table").DataTable({
        "paging": true,
        "pageLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    $('[data-toggle="input-mask"]').each(function(a, e) {
        var t = $(e).data("maskFormat")
            , n = $(e).data("reverse");
        null != n ? $(e).mask(t, {
            reverse: n
        }) : $(e).mask(t)
    });

});

function notification(type, title, message){
    if(type=="success" || type=="Success"){
        iziToast.success({
            title: title,
            message: message,
            position: 'topRight',
        });
    }
    else if(type=="info" || type=="Info"){
        iziToast.info({
            title: title,
            message: message,
            position: 'topRight',
        });
    }
    else if(type=="warning" || type=="Warning"){
        iziToast.warning({
            title: title,
            message: message,
            position: 'topRight',
        });
    }
    else if(type=="error" || type=="Error"){
        iziToast.error({
            title: title,
            message: message,
            position: 'topRight',
        });
    }
}


