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

    $(".select2-create").select2({ dropdownParent: $("#addEquipment") });
    $(".select2-update").select2({ dropdownParent: $("#editEquipment") });
    $(".select2-filter").select2({ dropdownParent: $("#filters") });

    $('#category_filter, #condition_filter, #status_filter').on('change', function() {
        var category = $('#category_filter').val();
        var condition = $('#condition_filter').val();
        var status = $('#status_filter').val();

        // Loop through each row of the table
        $('#equipment_table_body tr').each(function() {
            var rowCategory = $(this).find('td:eq(2)').text().trim(); // Get the category from the third column
            var rowCondition = $(this).find('td:eq(5)').text().trim(); // Get the condition from the sixth column
            var rowStatus = $(this).find('td:eq(6)').text().trim(); // Get the status from the seventh column

            // Show or hide rows based on the selected filters
            if ((category === '' || category === rowCategory) && 
                (condition === '' || condition === rowCondition) && 
                (status === '' || status === rowStatus.toLowerCase())) {
                $(this).show();
            } else {
                $(this).hide();
            }
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
