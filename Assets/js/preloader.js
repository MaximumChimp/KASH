$(document).ready(function() {
    setTimeout(function() {
        $("#preloader").hide();
        $("#content").css("display", "flex");
    }, 5000); // Preloader will be displayed for 5 seconds
});
