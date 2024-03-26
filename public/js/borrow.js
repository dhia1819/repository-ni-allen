$(function() {
    // Initialize the DataTable
    $('#tbl-equipment').DataTable({
        language: {
            paginate: {
                previous: '<',
                next: '>'
            }
        },
        scrollX: screen.height > screen.width
    });

    // Handle change event of the category filter
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
});
