$(function() {

    $('#tbl-offices').dataTable({
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

$('.btn-edit-off').click(function(){
var rowId =$(this).data('rowid');
var row =$(this).closest('tr');
var code=row.find('td:eq(0)').text().trim();
var office = row.find('td:eq(1)').text().trim();
var type =row.find('td:eq(2)').text().trim();

$('#code').val(code);
$('#office').val(office);
$('#type').val(type);
$('#rowid').val(rowId);

});
    
});