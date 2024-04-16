$(function() {

    $('#tbl-supplies').dataTable({
        'language': {
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX': (screen.height > screen.width) ? true : false
    });
   
});
