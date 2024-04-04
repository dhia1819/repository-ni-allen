$(function() {

    $('#employees').dataTable({
        'language':{
            // 'zeroRecords': '<center><span class="badge text-white bg-danger">No Records Found</span></center>',
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
        var table = $('#employees').DataTable();
    
        // Event handler for the edit button click
        $('#employees').on('click', '.btn-edit-employee', function() {
            var row = $(this).closest('tr');
            var fullName = row.find('td:eq(0)').text().trim();
            var position = row.find('td:eq(1)').text().trim();
            var status = row.find('td:eq(2)').text().trim();
            var rowId = $(this).data('rowid');
    
            // Populate the form fields with row data
            $('#fullName').val(fullName);
            $('#position').val(position);
            $('#status').val(status);
            $('#rowid').val(rowId);
        });
    });
  
  
  
  
  });