


$(document).ready(function () {
    $('#tables').DataTable({
        order: [[0, 'desc']],
        searching: false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,

    });
    $('#tablepublico').DataTable({
        order: [[0, 'desc']],
        searching: false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,

    });

    $('#categorias').multiSelect()

});

function veredicion() {
    $('#form_edicion').removeClass('form-edit');
    $('#noedicion').show();

}
function noedicion() {
    $('#form_edicion').addClass('form-edit');
    $('#noedicion').hide();

}

function updatefavorito() {

    $('#form_fav_edit .form-control:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });
    $('#form_fav_edit .form-select:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/editForm',
        data: $('#form_fav_edit').serialize(),
        success: function (res) {
            if (res == 1) {
                Swal.fire({

                    title: 'Ok',
                    text: "Favorivo Editado Correctamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            }
        }
    });


}

function guardarfavorito() {
    $('#form_fav .form-control:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });
    $('#form_fav_edit .form-select:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/addForm',
        data: $('#form_fav').serialize(),
        success: function (res) {
            if (res == 1) {
                Swal.fire({

                    title: 'Ok',
                    text: "Favorivo Guardado Correctamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            }
        }
    });

}
function guardarCategoria() {
    $('#form_cat .form-control:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/addCat',
        data: $('#form_cat').serialize(),
        success: function (res) {
            if (res == 1) {
                Swal.fire({

                    title: 'Ok',
                    text: "Categoria Guardada Correctamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: '/getCat',
                            success: function (result) {
                                campos = "";
                                $('#table_fav tbody').empty();
                                for (var a = 0; a < result.length; a++) {
                                    campos += '<tr>';
                                    campos += '<td>' + result[a]['id'] + '</td>';
                                    campos += '<td>' + result[a]['nombre'] + '</td>';
                                    if (result[a]['estado'] == 1) {
                                        campos += '<td><button class="btn btn-primary" onclick="privado(' + result[a]['id'] + ')" >Publica</button></td>';
                                    } else {
                                        campos += '<td><button class="btn btn-success" onclick="publico(' + result[a]['id'] + ')" >Privada</button></td>';
                                    }
                                    campos += ' <td><button onclick="editarcat(' + result[a]['id'] + ')" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(' + result[a]['id'] + ')" class="btn btn-danger">Eliminar</button></td>';
                                    campos += '</tr>';
                                }
                                $('#table_fav tbody').append(campos);
                            }
                        });
                    }
                })
            }
        }
    });
}

function updatecat(value) {
    $('#form_cat .form-control:visible:not(.noFilt)').each(function () {
        if ($(this).val() == '') {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            a++;
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/updateCat",
        data: {
            id: value,
            nombre: $("#nombre_categoria").val()
        },
        success: function (res) {
            if (res == 1) {
                Swal.fire({

                    title: 'Ok',
                    text: "Categoria editada Correctamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: '/getCat',
                            success: function (result) {
                                campos = "";
                                $('#table_fav tbody').empty();
                                for (var a = 0; a < result.length; a++) {
                                    campos += '<tr>';
                                    campos += '<td>' + result[a]['id'] + '</td>';
                                    campos += '<td>' + result[a]['nombre'] + '</td>';
                                    if (result[a]['estado'] == 1) {
                                        campos += '<td><button class="btn btn-primary" onclick="privado(' + result[a]['id'] + ')" >Publica</button></td>';
                                    } else {
                                        campos += '<td><button class="btn btn-success" onclick="publico(' + result[a]['id'] + ')" >Privada</button></td>';
                                    }
                                    campos += ' <td><button onclick="editarcat(' + result[a]['id'] + ')" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(' + result[a]['id'] + ')" class="btn btn-danger">Eliminar</button></td>';
                                    campos += '</tr>';
                                }
                                $('#table_fav tbody').append(campos);
                            }
                        });
                    }
                })
            }
        }
    });
}

function cancelaredit() {

    $('#buttons').empty();
    $('#nombre_categoria').val('');
    campos = '<button type="button" onclick="guardarCategoria()" class="btn btn-success">Guardar</button>';
    $('#buttons').append(campos);

}

function privado(value) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/privado',
        data: {
            id: value
        },
        success: function (res) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/getCat',
                success: function (result) {
                    campos = "";
                    $('#table_fav tbody').empty();
                    for (var a = 0; a < result.length; a++) {
                        campos += '<tr>';
                        campos += '<td>' + result[a]['id'] + '</td>';
                        campos += '<td>' + result[a]['nombre'] + '</td>';
                        if (result[a]['estado'] == 1) {
                            campos += '<td><button class="btn btn-primary" onclick="privado(' + result[a]['id'] + ')" >Publica</button></td>';
                        } else {
                            campos += '<td><button class="btn btn-success" onclick="publico(' + result[a]['id'] + ')" >Privada</button></td>';
                        }
                        campos += ' <td><button onclick="editarcat(' + result[a]['id'] + ')" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(' + result[a]['id'] + ')" class="btn btn-danger">Eliminar</button></td>';
                        campos += '</tr>';
                    }
                    $('#table_fav tbody').append(campos);
                }
            });
        }
    });
}
function publico(value) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/publico',
        data: {
            id: value
        },
        success: function (res) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/getCat',
                success: function (result) {
                    campos = "";
                    $('#table_fav tbody').empty();
                    for (var a = 0; a < result.length; a++) {
                        campos += '<tr>';
                        campos += '<td>' + result[a]['id'] + '</td>';
                        campos += '<td>' + result[a]['nombre'] + '</td>';
                        if (result[a]['estado'] == 1) {
                            campos += '<td><button class="btn btn-primary" onclick="privado(' + result[a]['id'] + ')" >Publica</button></td>';
                        } else {
                            campos += '<td><button class="btn btn-success" onclick="publico(' + result[a]['id'] + ')" >Privada</button></td>';
                        }
                        campos += ' <td><button onclick="editarcat(' + result[a]['id'] + ')" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(' + result[a]['id'] + ')" class="btn btn-danger">Eliminar</button></td>';
                        campos += '</tr>';
                    }
                    $('#table_fav tbody').append(campos);
                }
            });
        }
    });
}


function verfav(value) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/verfav',
        data: {
            id: value
        }
    })

}



function eliminarcat(value) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/deletecat",
        data: {
            id: value,
        },
        success: function (res) {
            if (res == 1) {
                Swal.fire({

                    title: 'Ok',
                    text: "Categoria Eliminada Correctamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: '/getCat',
                            success: function (result) {
                                campos = "";
                                $('#table_fav tbody').empty();
                                for (var a = 0; a < result.length; a++) {
                                    campos += '<tr>';
                                    campos += '<td>' + result[a]['id'] + '</td>';
                                    campos += '<td>' + result[a]['nombre'] + '</td>';
                                    if (result[a]['estado'] == 1) {
                                        campos += '<td><button class="btn btn-primary" onclick="privado(' + result[a]['id'] + ')" >Publica</button></td>';
                                    } else {
                                        campos += '<td><button class="btn btn-success" onclick="publico(' + result[a]['id'] + ')" >Privada</button></td>';
                                    }
                                    campos += ' <td><button onclick="editarcat(' + result[a]['id'] + ')" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(' + result[a]['id'] + ')" class="btn btn-danger">Eliminar</button></td>';
                                    campos += '</tr>';
                                }
                                $('#table_fav tbody').append(campos);
                            }
                        });
                    }
                })
            }
        }
    });

}

function editarcat(value) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/editCat',
        data: {
            id: value
        },
        success: function (res) {
            $('#form_cat').empty();
            for (let index = 0; index < res.length; index++) {
                console.log(res);
                campos = "";
                campos += "<div class='mb-3'>";
                campos += "<label class='form-label' >Nombre</label>"
                campos += "<input class='form-control' name='nombre_categoria' id='nombre_categoria' value='" + res[index]['nombre'] + "' type='text'>";
                campos += "</div>";
                campos += "<div id='buttons'>";
                campos += "<button type='button' onclick='updatecat(" + res[index]['id'] + ")' class='btn btn-warning'>Editar</button>";
                campos += "&nbsp;";
                campos += "<button type='button' onclick='cancelaredit()' class='btn btn-danger'>X</button>";
                campos += "</div>";
            }

            $('#form_cat').append(campos);

        }
    });
}