$(document).ready(function(){
    $('#KERP').on('click', function(e) {
        document.getElementById("integration").innerHTML='<object type="text/html" data="http://192.168.0.158/KERP/init/index.php" ></object>';
    });
});