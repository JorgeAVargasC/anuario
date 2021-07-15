$(document).ready(function() {

    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal.fire({
                        tite: 'CORRECTO',
                        text: 'Se guardó correctamente',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href = 'lista-admin.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se ha creado'
                    })
                }
            }
        })

    });

    //edit registr

    $('#editar-registro').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal.fire({
                        title: 'CORRECTO',
                        text: 'Edicion Exitosa',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href = 'lista-admin.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se ha modificado ningun elemento'
                    })
                }
            }
        })

    });



    // se ejecuta cuando hay un archivo

    $('#editar-registro-miembro').on('submit', function(e) {
        e.preventDefault();

        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var resultado = data;

                if (resultado.respuesta == 'exito') {
                    Swal.fire({
                        title: 'CORRECTO',
                        text: 'Edicion Exitosa',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href = 'lista-miembros.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se ha modificado ningun elemento'
                    })
                }
            }
        })

    });


    $('#guardar-registro-miembro').on('submit', function(e) {
        e.preventDefault();

        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var resultado = data;

                if (resultado.respuesta == 'exito') {
                    Swal.fire({
                        title: 'CORRECTO',
                        text: 'Registro Exitoso',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href = 'lista-miembros.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El miembro no se ha registrado'
                    })
                }
            }
        })

    });


    //login administrador

    $('#login-admin').on('submit', function(e) {
        e.preventDefault(); //CON esto evitamos que se abra otra ventana cuando se crea otro administrador

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exitoso') {
                    Swal.fire(
                        'Login correcto',
                        'Bienvenid@ ' + resultado.usuario + ' !!',
                        'success'
                    )

                    setTimeout(function() {

                        //window.location.href = 'admin-area.php';
                        window.location.href = 'admin-area.php';


                    }, 2000);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Usuario o password incorrecto'
                    })
                }

            }
        })
    });

    $('.borrar_registro').on('click', function(e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');

        Swal.fire({
            title: 'Seguro que desea eliminar este registro?',
            text: "Esta accion no se podra deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.value) {

                $.ajax({

                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },

                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {
                        var resultado = JSON.parse(data);
                        jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove()

                    }
                })
                Swal.fire(
                    'Eliminado!',
                    'Registro eliminado correctamente',
                    'success'
                )

            }

        })


    });
});