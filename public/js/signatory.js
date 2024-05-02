$(function() {

    $('#tbl-signatories').dataTable({
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


    $(document).on('click', '.btn-edit-signatory', function() {
        $('#edit_modal_first_name').val($(this).data('first-name'));
        $('#edit_modal_middle_name').val($(this).data('middle-name'));
        $('#edit_modal_last_name').val($(this).data('last-name'));
        $('#edit_modal_suffix').val($(this).data('suffix'));

        $('#edit_modal').modal('toggle');
        $('#edit_modal_form').attr('action', '/signatories/'+$(this).attr('id')+'/update');
    });
});