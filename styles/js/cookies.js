function setCookie(cname, cvalue, exdays) 
{
    let expires = "";
    if (exdays) 
    {
        let d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        expires = "expires=" + d.toUTCString() + ";";
    }
    document.cookie = cname + "=" + cvalue + ";" + expires + "path=/";
}
function removeCookie(cname)//función que dado el nombre de una cookie (cname) la elimina. 
{
    setCookie(cname,"",-1);
}
function getCookie(cname) //función que dado el nombre de una cookie (cname) devuelve su contenido.
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0) == ' ') 
        {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) 
        {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function detectCookie(cname) // función que dado el nombre de una cookie (cname) devuelve true si existe y tiene contenido y false si no existe o existe pero no contiene contenido
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0) == ' ') 
        {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0 && (name.length != c.length))  
        {
            return true;
        }
    }
    return false;
}