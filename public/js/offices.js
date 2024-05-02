$(function() {

    $('#tbl-offices').dataTable({
        'language':{
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX' : (screen_height > screen_width) ? true : false
    });
    
    $(".select2-create").select2({ dropdownParent: $("#create_modal")});
    $(".select2-edit").select2({ dropdownParent: $("#edit_modal")});

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tbl-offices').DataTable();
    
        // Event handler for the edit button click
        $('#tbl-offices').on('click', '.btn-edit-off', function() {
            var row = $(this).closest('tr');
            var code = row.find('td:eq(0)').text().trim();
            var office = row.find('td:eq(1)').text().trim();
            var type = row.find('td:eq(2)').text().trim();
            var rowId = $(this).data('rowid');
    
            // Populate the form fields with row data
            $('#code').val(code);
            $('#office').val(office);
            $('#type').val(type);
            $('#rowid').val(rowId);
        });
    });
    
});