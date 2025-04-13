let  mensaje_error_ajax = 'Solicitud fallida: Hubo un error al tratar de contactarse con el servidor' //mensaje cuando falla la solicitud ajax

const mensaje_confirmacion = Swal.mixin({
    icon: 'info',
    showConfirmButton: true, 
    showCancelButton: true,
    confirmButtonText: '<i class="fas fa-check-circle"></i> Aceptar', cancelButtonText: '<i class="fa fa-times-circle"></i> Cancelar', 
    focusConfirm: true,
    customClass: 
    {
        confirmButton: 'btn btn-flat btn-outline-primary btn_swe_margin btn_swe_width',
        cancelButton: 'btn btn-flat btn-outline-danger btn_swe_width'
    },
    buttonsStyling: false,        
    allowOutsideClick: false,
    width : '400px'
});
function alerta_showLoading(titulo, html)
{
    Swal.fire(
    {
        title: titulo,
        html: html,
        showConfirmButton:false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        willOpen: () =>
        {
            Swal.showLoading()
        }
    })
}
// LOS ICONOS PARA LAS ALERTAS SON  success, error, warning, info y question
// LAS POSICIONES PARA MOSTRAR LA ALERTA SON 'top', 'top-start', 'top-end', 'center',
// 'center-start', 'center-end', 'bottom', 'bottom-start', or 'bottom-end'.
// TIEMPO DEFINIDO DE LA FUNCION ES 5500
function alerta_global(icon, message, time, position)
{
    Swal.fire(
        {
            toast: true,
            showConfirmButton: false,
            showCloseButton: true,
            icon: (icon)? icon:'success',
            title: message,
            timer: (time)? time:'5500',
            position: (position)? position:'top-end',
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
}
function swal_alerta(icon = 'success', title, message, time = 6000 , position = 'center')
{
    Swal.fire({
        icon: icon,
        title: title,
        html: message,
        showConfirmButton: false,
        showCloseButton: true,
        timerProgressBar: true,
        timer: time,
        position : position,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
}