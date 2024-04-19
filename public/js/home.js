$(document).ready(function() {
    // Initialize Select2 on filter dropdowns
    $('#office_filter, #category_filter').select2();

    $('#start_date_borrowed, #end_date_borrowed').on('change', function() {
        applyFilters(); // Apply filters when date inputs are changed
    });
});