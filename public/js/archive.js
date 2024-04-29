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

        
    
        // Event listener for filter select elements
        $('#category_filter, #status_filter').on('change', function() {
            // Get selected filter values
            var category = $('#category_filter').val();
            var status = $('#status_filter').val();
            
    
            // Apply filters using DataTables API
            table.columns(1).search(category).draw();
    
            // Show the clear filters button when any filter is selected
            $('#reset_filters').show();
        });
    
        // Event listener for reset filters button
        $('#reset_filters').click(function() {
            // Reset all filter select elements to their default value
            $('.select2-filter').val('').trigger('change');
    
            // Clear filters using DataTables API
            table.columns().search('').draw();
    
            // Hide the clear filters button after resetting filters
            $(this).hide();
        });
    
        // Check if all filter select elements are at their default value and hide the "Clear Filters" button accordingly
        function checkClearFiltersButton() {
            var allDefault = true;
            $('.select2-filter').each(function() {
                if ($(this).val() !== '') {
                    allDefault = false;
                    return false; // Exit the loop early if a non-default value is found
                }
            });
            if (allDefault) {
                $('#reset_filters').hide();
            }
        }
    
        // Call the function initially to hide the "Clear Filters" button if all filters are at their default value
        checkClearFiltersButton();
    
        // Event listener for filter select elements to continuously check the status of the "Clear Filters" button
        $('.select2-filter').on('change', function() {
            checkClearFiltersButton();
        });
    });

});