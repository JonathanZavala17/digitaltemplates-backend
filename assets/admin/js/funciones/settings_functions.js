let envi = base_url+"admin/configuracion";
$(document).ready(function () {

    let token =   $("#get_csrf_hash").val();

    $("#form").on('submit', function(e){
        e.preventDefault();
        $(this).parsley().validate();
        if ($(this).parsley().isValid()){
            save_data();
        }
    });

    $("#form_profile").on('submit', function(e){
        e.preventDefault();
        $(this).parsley().validate();
        if ($(this).parsley().isValid()){
            edit_data();
        }
    });

    $("#departamento").change(function() {
        $("#municipio *").remove();
        $("#select2-municipio-container").text("");
        var ajaxdata = {
            "id_departamento": $("#departamento").val(),
            "csrf_token_name": $("#get_csrf_hash").val(),
        };
        $.ajax({
            url:envi+'/get_municipios',
            type: "POST",
            data: ajaxdata,
            success: function(opciones)
            {
                $("#select2-municipio-container").text("Selecciona un municipio");
                $("#municipio").html(opciones);
                $("#municipio").val("");
            }
        })
    });

    $('#checkbox3').click(function(){
        if('password' == $('#password').attr('type')){
            $('#password').prop('type', 'text');
        }else{
            $('#password').prop('type', 'password');
        }
    });

});

function save_data(){
    let form = $("#form");
    let formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }
    $.ajax({
        type: 'POST',
        url: envi+'/save_changes',
        cache: false,
        data: formdata ? formdata : form.serialize(),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            notification(data.type,data.title,data.msg);
            if (data.type == "success") {
                setTimeout("reload();", 1500);
            }
        }
    });
}

function edit_data() {
    let form = $("#form_profile");
    let formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }
    $.ajax({
        type: 'POST',
        url: base_url+"admin/profile/save_changes",
        cache: false,
        data: formdata ? formdata : form.serialize(),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            notification(data.type,data.title,data.msg);
            if (data.type == "success") {
                setTimeout(location.href=base_url+"admin/profile", 1500);
            }
        }
    });
}

function reload() {
    location.href = envi;
}
