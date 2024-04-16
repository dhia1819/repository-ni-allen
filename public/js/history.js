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
        var table = $('#tbl-history').DataTable();
    
        // Handle change event of the category filter, start date, and end date
        $('#category_filter, #start_date, #end_date').on('change', function() {
            var category = $('#category_filter').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
    
            // Apply category filter
            table.columns(2).search(category).draw();
    
            // Apply start date filter
            table.columns(4).every(function() {
                var column = this;
                column.search(start_date ? '>=' + start_date : '', true, false);
                column.search(end_date ? '<=' + end_date : '', true, false);
            });
    
            
    
            // Redraw the table
            table.draw();
    
            // Show reset filter button
            $('#reset_filter').show();
        });
    
        // Reset filter button click handler
        $('#reset_filter').click(function() {
            // Reset all filter select elements to their default value
            $('.select2-filter').val('').trigger('change');
            $('#start_date').val('').trigger('change');
            $('#end_date').val('').trigger('change');
    
            // Clear filters using DataTables API
            table.columns().search('').draw();
    
            // Hide the clear filters button after resetting filters
            $('#reset_filter').hide();
        });
    });
    

    $('#reset_filter').click(function() {
        // Reset all filter select elements to their default value
        $('.select2-filter').val('').trigger('change');
        $('#start_date').val('').trigger('change');
        $('#end_date').val('').trigger('change');
        
        // Hide the clear filters button after resetting filters
        $("#reset_filter").hide();

        // Clear filters using DataTables API
        table.columns().search('').draw();

        
    });
});
