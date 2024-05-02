$(function() {

    $('#tbl-archive').dataTable({
        'language': {
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX': (screen.height > screen.width) ? true : false
    });

    $(".select2-filter").select2({ dropdownParent: $("#filters") });

    
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tbl-archive').DataTable();

        $('#category_filter, #status_filter').on('change', function() {
            // Get selected filter values
            var category = $('#category_filter').val();
            var status = $('#status_filter').val();
            
            table.columns(1).search(category).draw();
    
            // Show the clear filters button when any filter is selected
            $('#reset_filters').show();
        });

        $('#reset_filters').click(function() {
            $('.select2-filter').val('').trigger('change');
    
            table.columns().search('').draw();
    
            $(this).hide();
        });
    
        function checkClearFiltersButton() {
            var allDefault = true;
            $('.select2-filter').each(function() {
                if ($(this).val() !== '') {
                    allDefault = false;
                    return false; 
                }
            });
            if (allDefault) {
                $('#reset_filters').hide();
            }
        }
    
        checkClearFiltersButton();
    
        $('.select2-filter').on('change', function() {
            checkClearFiltersButton();
        });
    });

});