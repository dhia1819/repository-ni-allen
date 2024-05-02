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
        dropdownParent: $("#received_by").parent()
    });


    $(".select2-create").select2({ dropdownParent: $("#addEquipment") });
    $(".select2-update").select2({ dropdownParent: $("#editEquipment") });
    $(".select2-filter").select2({ dropdownParent: $("#filters") });

    
    $(document).ready(function() {
        var table = $('#tbl-equipment').DataTable();

        
        $('#category_filter, #condition_filter, #status_filter').on('change', function() {
            // Get selected filter values
            var category = $('#category_filter').val();
            var condition = $('#condition_filter').val();
            var status = $('#status_filter').val();
            
    
            table.columns(1).search(category).draw(); 
            table.columns(4).search(condition).draw();
           
    
            if (status === 'available') {
                table.columns(5).search('^Available$', true, false).draw(); 
            } else if (status === 'unavailable') {
                table.columns(5).search('^Unavailable$', true, false).draw(); 
            } else {
                table.columns(5).search(status).draw(); 
            }
            // Show the clear filters button when any filter is selected
            $('#reset_filters').show();
        });
    
        $('#reset_filters').click(function() {
            $('.select2-filter').val('').trigger('change');
    
            table.columns().search('').draw();
    
            $(this).hide();
        });
    
        // Check if all filter select elements are at their default value
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