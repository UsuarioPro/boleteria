<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Icono -->
        <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= _SERVER_ ?>styles/css/error_pago.css">        
        <title>SISTEMA SUSPENDIDO</title>
    </head>
    <body>
        <div class="txt1">SERVICIO SUSPENDIDO</div>
        <div class="txt2">Esta cuenta a sido suspendida.</div>
        <input type="hidden" name="url_web" id="url_web" value="<?= _SERVER_?>">
        <div id="orbit-system">
                <div class="system">
                    <div class="satellite-orbit">
                    <div class="satellite">SUSPENDIDO</div>
                    </div>
                    <div class="planet"><img src="<?= _SERVER_?>/styles/img/error_pago/suspendido.png" height="300px"> </div>
                </div>
            </div>
        <div class="txt3">Este sistema web está suspendido por falta de pago. <br> Por favor liquide las cuotas inmediatamente para restablecer los servicios.</div>
        <p class="info">
            Copyright &copy; <?php echo date("Y");?> <a href="https://fact-cloud.grupoaventuraada.net/" target="_blank">Fact-Cloud.</a> 
        </p>
        <div class="buttons-container">
            <a  href="#" id="btn_verificar">
                <div class="button">Verificar Licencia</div>
            </a>
            <a target="_blank" href="https://api.whatsapp.com/send?phone=51912380970&text=Mi%20Sistema%20se%20encuentra%20suspendido%20por%20falta%20de%20pago.%20Deseo%20cancelar%20la%20deuda">
                <div class="button">Renovar Licencia</div>
            </a>
        </div>
        <script src="<?= _SERVER_?>styles/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= _SERVER_?>styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- sweetalert2 -->
        <script src="<?= _SERVER_?>styles/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= _SERVER_?>styles/js/alerta_global.js" type="text/javascript" charset="utf-8" async defer></script>

        <script type="text/javascript" charset="utf-8" async defer>
            function verificar_renovacion()
            {
                Swal.fire(
                { 
                    icon: 'info',
                    title: 'Necesitamos de tu Confirmacion', 
                    html:`<span>Esta a punto de verificar si su licencia ya fue renovada</span>`,
                    showConfirmButton: true, 
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check-circle"></i> Aceptar', 
                    cancelButtonText: '<i class="fa fa-times-circle"></i> Cancelar', 
                    focusConfirm: true,
                    allowOutsideClick: false,
                }).then((result) =>
                {
                    if (result.value == true)
                    {
                        $.ajax({
                            url : $('#url_web').val() + '?verificacion=verificar_online',
                            type : 'POST',
                            dataType: 'JSON', // Esperar texto simple como respuesta
                            beforeSend: function()
                            {
                                alerta_showLoading("Espere un momento", "Estamos Verificando...");
                            },
                            }).done(function(data) 
                            {  
                                if(data['rpta'] == 'ok')
                                {
                                    alerta_global('info', data['mensaje']['mensaje']);
                                    if(data['mensaje']['rpta'] == 'renovacion' || data['mensaje']['rpta'] == 'ok')
                                    {
                                        location.href =  $('#url_web').val();
                                    }
                                }
                                else
                                {
                                    alerta_global('info', data['mensaje']);
                                }
                            }).always(function() 
                            {
                            }).fail(function(jqXHR, textStatus, errorThrown)
                            {
                                alerta_global("error",jqXHR);
                            });
                    }
                })
            }
            $('#btn_verificar').click(verificar_renovacion);
        </script>
    </body>
</html>