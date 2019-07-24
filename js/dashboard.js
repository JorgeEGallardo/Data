function p() {
    alert("hello World");
}
var Error1 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
Error1 += '<strong>Error con las bases de datos.</strong> <br>Por favor revise que haya seleccionado una o mas bases.';
Error1 += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
Error1 += '<span aria-hidden="true">&times;</span>';
Error1 += '</button>';
Error1 += '</div>';
var Error2 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
Error2 += '<strong>Error con las bases de datos.</strong> <br>No se pudó encontrar una base de datos por favor revise el archivo de conexión.';
Error2 += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
Error2 += '<span aria-hidden="true">&times;</span>';
Error2 += '</button>';
Error2 += '</div>';
    
function consulta(vars){
    $.ajax({
            data:{"bd":vars}, //datos que se envian a traves de ajax
            url: 'get/dashboard.php', //archivo que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
                    $("#Resultado").html("<h1 style='margin-left:45%;width:50%'>Cargando...</h1><img src='res/loading.gif' style='margin-top:2%; margin-left:25%'></img>");
            },
            success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    if (response.includes("Error1")) {
                            $("#Resultado").html(Error1);
                    } else if (response.includes("Error2")) {
                            $("#Resultado").html(Error2);
                    } else {
                            $("#Resultado").html(response);
                    }
            }
    });
};
function historica(vars){
        var year = document.getElementById("year").value;
        $.ajax({
                data:{"bd":vars, "year":year}, //datos que se envian a traves de ajax
                url: 'get/historica.php', //archivo que recibe la peticion
                type: 'post', //método de envio
                beforeSend: function () {
                        $("#Resultado").html("<h1 style='margin-left:45%;width:50%'>Cargando...</h1><img src='res/loading.gif' style='margin-top:2%; margin-left:25%'></img>");
                },
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        if (response.includes("Error1")) {
                                $("#Resultado").html(Error1);
                        } else if (response.includes("Error2")) {
                                $("#Resultado").html(Error2);
                        } else {
                                $("#Resultado").html(response);
                        }
                }
        });
    };