$(function() {
    // Initialize the DataTable
    $('#tbl-history').DataTable({
        language: {
            paginate: {
                previous: "<",
                next: ">"
            }
        },
        scrollX: screen.height > screen.width
    });

    $(".select2-filter").select2({ dropdownParent: $("#filter")});

    $(document).ready(function(){
        var table =$('#tbl-history').DataTable();
        // Handle change event of the category filter
        $('#category_filter').on('change', function() {
            var category = $(this).val();

            table.columns(2).search(category).draw();

            $('#reset_filter').show();
        });

        
    });

    $('#reset_filter').click(function() {
        // Reset all filter select elements to their default value
        $('.select2-filter').val('').trigger('change');

        // Clear filters using DataTables API
        table.columns().search('').draw();

        // Hide the clear filters button after resetting filters
        $(this).hide();
    });
});
