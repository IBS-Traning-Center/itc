$(document).ready(function(){
    $('#up_menu li a.first').hover(
        function()
        {
           $('#up_menu li a').removeClass("selected_blue");
           $(this).addClass("selected_blue");
        },
        function() { }
    );
    $('#up_menu li a.selected').hover(
        function()
        {
           $('#up_menu li a').removeClass("selected_blue");
           $(this).addClass("selected_blue");
        },
        function() { }
    );
    $('#up_menu li ul').hover(
        function() {        },
        function()
        {
           $('#up_menu li a').removeClass("selected_blue");
        }
    );
});
