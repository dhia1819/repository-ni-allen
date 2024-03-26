
var screen_width = $(window).width();
var screen_height = $(window).height();

$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.sidenav').css('z-index', '99');
     
    $(".close").click(function() {
        $(".alert").hide();
    });

    // // for navbar
    // $('.modal').on('hidden.bs.modal', function () {
    //     $('.sidenav').css('z-index', '9999');
    // })

    // $('.modal').on('shown.bs.modal', function () {
    //     $('.sidenav').css('z-index', '-1');
    // })
    // $("#iconNavbarSidenav").click(function() {
    //     if($('body').hasClass('g-sidenav-pinned')){
    //     }else{
    //         $('.sidenav').css('z-index', '-1');
    //     }
    // });

    // // id="iconNavbarSidenav"
    
});

