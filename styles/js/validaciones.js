$('select[readonly]').focus(function (e) 
{ 
    this.blur();
});
$('.select2, .select2-sm, .select2Html, .selectGroup, .select3, .select2-sm_clear').on('select2:opening', function(e)
{
    if ( $(this).is('[readonly]') ) 
    {
        e.preventDefault();//no se activara evento default
        this.blur();
    }
});
$('.validacion_entero').keypress(function()
{
    return validar_numeros(event,this)
});
$('.validacion_decimal').keypress(function()
{
    return validar_numeros_dos_decimales(event,this)
});
$('.validacion_mayuscula').keyup(function()
{
    return this.value=this.value.toUpperCase();
});

$(".disabled_enter").keypress(function(e) { if (e.which == 13) { return false; }});

function validar_ip(ip)//metodo para utilizar dentro de validar_direccion_ip
{
    var patronIp = new RegExp("^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$");
    var valores;
    // early return si la ip no tiene el formato correcto.
    if(ip.search(patronIp) !== 0)
    {
        return false
    }

    valores = ip.split(".");

    return valores[0] <= 255 && valores[1] <= 255 && valores[2] <= 255 && valores[3] <= 255
}
function validar_direccion_ip(idForm) // onkeyup="validar_direccion_ip(this.id)"
{
    var object = document.getElementById(idForm);
    var valueForm = object.value.split('\n'); // generamos un array de valores separado por el salto de linea
    var isValid = valueForm.every(validar_ip) // validamos que todos los elementos cumplan con la condición dada en validateIp

    if($('#'+idForm).val() == '' || $('#'+idForm).val() == null)
    {
        $('#span_'+idForm).remove();
        object.style.border = "";
        return true;
    }

    if (isValid)
    {
        $('#span_'+idForm).remove();
        object.style.border = "";
        return false;
    }
    else
    {
        $('#span_'+idForm).remove();
        error = '<span id="span_'+idForm+'" class="text-red" style="font-size: 11px;" >Formato de IP invalida, por favor ingrese una IP valida</span>'
        $('#'+idForm).closest('.form-group').append(error);
        object.style.border = "red 1px solid";
        return true;
    }
}
function validar_correo(id) //se llama asi-> onchange="return validar_correo(this.id)"
{
    var object = document.getElementById(id);
    var text = document.getElementById(id).value;
    var expreg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    
    if($('#'+id).val() == '' || $('#'+id).val() == null)
    {
        $('#span_'+id).remove();
        object.style.border = "";
        return true;
    }

    if(expreg.test(text))
    {
        $('#span_'+id).remove();
        object.style.border = "";
        return true;
    }
    else
    {
        $('#span_'+id).remove();
        // document.getElementById(id).value = '';
        error = '<span id="span_'+id+'" class="text-red" style="font-size: 11px;" >Formato de correo invalido, por favor ingrese un correo valido</span>'
        $('#'+id).closest('.form-group').append(error);
        object.style.border = "red 1px solid";
        return false;
    }
}
function validar_correo_swal_alert(id) //se llama asi-> onchange="return validar_correo(this.id)"
{
    var text = document.getElementById(id).value;
    var expreg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    if(expreg.test(text))
    {
        return true;
    }
    else
    {
        document.getElementById(id).value = '';
        return false;
    }
}
function validar_numeros(evt,input)
{
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57)
    {
        if(filtrar_entero(tempValue)=== false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    else if(key == 13)//para que funcione el enter
    {
        return true;
    }
    else
    {
        return false;
    }
}
function filtrar_entero(__val__)
{
    var expreg = new RegExp(/^[0-9]*$/);
    if(expreg.test(__val__))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function validar_numeros_dos_decimales(evt,input)// se le llama asi -> onkeypress="return validar_numeros_dos_decimales(event,this);"
{
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57)
    {
        if(filtrar(tempValue)=== false)
        {
            return false;
        }
        else
        {       
            return true;
        }
    }
    else
    {
        if(key == 8 || key == 13 || key == 0) 
        {     
            return true;              
        }
        else if(key == 46)
        {
            if(filtrar(tempValue)=== false)
            {
                return false;
            }
            else
            {       
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}
function validar_numeros_dos_decimales_sin_enter(evt,input)// se le llama asi -> onkeypress="return validar_numeros_dos_decimales(event,this);"
{
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57)
    {
        if(filtrar(tempValue)=== false)
        {
            return false;
        }
        else
        {       
            return true;
        }
    }
    else
    {
        if(key == 8 || key == 0) 
        {     
            return true;              
        }
        else if(key == 46)
        {
            if(filtrar(tempValue)=== false)
            {
                return false;
            }
            else
            {       
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}
function filtrar(__val__)
{
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true)
    {
        return true;
    }
    else
    {
        return false;
    }
}