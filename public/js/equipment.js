$(function() {

    $('#tbl-equipment').dataTable({
        'language': {
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX': (screen.height > screen.width) ? true : false
    });



    //
    $(".select2-return").select2({
        dropdownParent: $("#received_by").parent() // Changed to parent() instead of selecting by ID
    });


    $(".select2-create").select2({ dropdownParent: $("#addEquipment") });
    $(".select2-update").select2({ dropdownParent: $("#editEquipment") });
    $(".select2-filter").select2({ dropdownParent: $("#filters") });

    
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tbl-equipment').DataTable();

        
    
        // Event listener for filter select elements
        $('#category_filter, #condition_filter, #status_filter').on('change', function() {
            // Get selected filter values
            var category = $('#category_filter').val();
            var condition = $('#condition_filter').val();
            var status = $('#status_filter').val();
            
    
            // Apply filters using DataTables API
            table.columns(1).search(category).draw(); // Filter by category in the third column
            table.columns(4).search(condition).draw(); // Filter by condition in the sixth column
            // Filter by status in the seventh column
    
            if (status === 'available') {
                table.columns(5).search('^Available$', true, false).draw(); // Filter only "available" items, case-sensitive
            } else if (status === 'unavailable') {
                table.columns(5).search('^Unavailable$', true, false).draw(); // Filter only "unavailable" items, case-sensitive
            } else {
                table.columns(5).search(status).draw(); // Filter by status for all items
            }
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
    
    
    

    document.getElementById('conditionDropdown').addEventListener('change', function(event) {
        // Submit the form when an option is selected
        document.getElementById('conditionForm').submit();
    });

    document.getElementById('conditionDropdown').addEventListener('change', function(event) {
        // Get the selected option value
        const selectedOption = event.target.value;

        // Execute action based on the selected option
        switch (selectedOption) {
            case 'Good':
                // Action when "Good" is selected
                console.log('Good condition selected');
                break;
            case 'Fair':
                // Action when "Fair" is selected
                console.log('Fair condition selected');
                break;
            case 'Poor':
                // Action when "Poor" is selected
                console.log('Poor condition selected');
                break;
            default:
                // Default action if none of the above options match
                console.log('Unknown condition selected');
        }
    });

    $(".select2-create").select2({ dropdownParent: $('#office').parent() });

});