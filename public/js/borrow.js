$(document).ready(function() {
    // Initialize Select2 on filter dropdowns
    $('#office_filter, #employee_filter').select2();

    // Initialize DataTable on #tbl-borrowed table
    $('#tbl-borrowed').DataTable({
        paging: true, // Enable pagination
        language: {
            paginate: {
                previous: "<", // Custom previous page symbol
                next: ">"      // Custom next page symbol
            }
        },
        searching: true, // Enable search/filtering
        ordering: true, // Enable sorting
        responsive: true // Enable responsiveness for mobile devices
    });

    // Event listener for filter change
    $('#office_filter, #borrowed_filter, #returned_filter, #employee_filter').change(function() {
        applyFilters();
        toggleClearFiltersButton(); // Check if filters are active and toggle button visibility
    });

    // Event listener for Clear Filters button
    $('#reset_filters').click(function() {
        resetFilters();
    });

    // Initial application of filters and toggle button on page load
    applyFilters();
    toggleClearFiltersButton();
});

// Function to apply filters based on user selections
function applyFilters() {
    var borrowedFilter = convertInputDate($('#borrowed_filter').val());
    var returnedFilter = convertInputDate($('#returned_filter').val());
    var officeFilter = $('#office_filter').val();
    var employeeFilter = $('#employee_filter').val();

    $('#equipment_table_body tr').each(function() {
        var dateBorrowed = $(this).find('td:nth-child(3)').text().trim();
        var dateReturned = $(this).find('td:nth-child(4)').text().trim();
        var office = $(this).find('td:nth-child(2)').text().trim();
        var employee = $(this).find('td:nth-child(5)').text().trim();

        // Compare table data with filter values
        var matchesBorrowed = (borrowedFilter === '' || dateBorrowed.includes(borrowedFilter));
        var matchesReturned = (returnedFilter === '' || dateReturned.includes(returnedFilter));
        var matchesOffice = (officeFilter === '' || office === officeFilter);
        var matchesEmployee = (employeeFilter === '' || employee === employeeFilter);

        // Show/hide table row based on filter matches
        $(this).toggle(matchesBorrowed && matchesReturned && matchesOffice && matchesEmployee);
    });
}

// Function to toggle visibility of Clear Filters button based on active filters
function toggleClearFiltersButton() {
    var anyFilterActive =
        $('#borrowed_filter').val() ||
        $('#returned_filter').val() ||
        $('#office_filter').val() ||
        $('#employee_filter').val();

    if (anyFilterActive) {
        $('#reset_filters').show(); // Show the Clear Filters button
    } else {
        $('#reset_filters').hide(); // Hide the Clear Filters button
    }
}

// Function to reset/clear all filter inputs
function resetFilters() {
    // Clear date inputs
    $('#borrowed_filter').val('');
    $('#returned_filter').val('');

    // Reset Select2 dropdowns
    $('#office_filter').val('').trigger('change');
    $('#employee_filter').val('').trigger('change');

    // Apply filters again after resetting
    applyFilters();

    // Hide the Clear Filters button after resetting
    toggleClearFiltersButton();
}

// Function to parse date string (without time) into Date object
function parseDateWithoutTime(dateString) {
    if (!dateString) return null; // Return null for empty strings
    var parts = dateString.split(' | ')[0].split(', '); // Split and extract date part
    var dateStr = parts[1] + ' ' + parts[0]; // Reformat to 'YYYY-MM-DD' for parsing
    return new Date(dateStr);
}

// Function to convert input date to string format
function convertInputDate(inputDate) {
    if (!inputDate) return ''; // Return empty string if input date is empty
    var date = new Date(inputDate);
    var month = date.toLocaleString('en-US', { month: 'long' });
    var day = date.getDate();
    var year = date.getFullYear();
    return month + ' ' + day + ', ' + year;
}
