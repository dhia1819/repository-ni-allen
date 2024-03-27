$(function() {

    $('#tbl-equipment').dataTable({
        'language':{
            // 'zeroRecords': '<center><span class="badge text-white bg-danger">No Records Found</span></center>',
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        'scrollX' : (screen_height > screen_width) ? true : false
    });

    $(".select2-create").select2({ dropdownParent: $("#addEquipment")});
    $(".select2-update").select2({ dropdownParent: $("#editEquipment")});    
    
    $('#category_filter').on('change', function() {
        var category = $(this).val();
    
        // Loop through each row of the table
        $('#equipment_table_body tr').each(function() {
            var rowCategory = $(this).find('td:eq(2)').text().trim(); // Get the category from the third column
    
            // Show or hide rows based on the selected category
            if (category === '' || category === rowCategory) {
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
    // JavaScript Event Listener
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
    