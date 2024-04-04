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
            table.columns(2).search(category).draw(); // Filter by category in the third column
            table.columns(5).search(condition).draw(); // Filter by condition in the sixth column
            table.columns(6).search(status).draw(); // Filter by status in the seventh column

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
