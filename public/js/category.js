$(function() {

    $('#tbl-cat').dataTable({
        'language':{
            
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX' : (screen_height > screen_width) ? true : false
    });
    $(".select2-create").select2({ dropdownParent: $("#create_modal")});
    $(".select2-update").select2({ dropdownParent: $("#edit_modal")});    

    
    $(document).ready(function() {
        var table = $('#tbl-cat').DataTable();
        
        
        $('#tbl-cat').on('click', '.btn-edit-cat', function() {
            var row = $(this).closest('tr');
            var rowId = $(this).data('rowid');
            var name = row.find('td:eq(0)').text().trim();
            var status = row.find('td:eq(1)').text().trim();
        
            console.log("Status:", status); 
        
            $('#category').val(name);
            $('#status').val(status);
        
            $('#rowid').val(rowId);
        });
        
    });
    
    
    
    });