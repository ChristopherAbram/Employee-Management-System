// Expire interval given in seconds:
function setCookie(index, value, expire_interval) {
    var d = new Date();
    d.setTime(d.getTime() + (1000 * expire_interval));
    var expires = "expires="+d.toUTCString();
    document.cookie = index + "=" + value + ";" + expires + ";path=/";
}

function getCookie(index) {
    var name = index + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}