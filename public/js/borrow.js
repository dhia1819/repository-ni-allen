$(document).ready(function() {
    // Function to parse date string (without time) into Date object
    function parseDateWithoutTime(dateString) {
        if (!dateString) return null; // Return null for empty strings
        var parts = dateString.split(' | ')[0].split(', '); // Split and extract date part
        var dateStr = parts[1] + ' ' + parts[0]; // Reformat to 'YYYY-MM-DD' for parsing
        return new Date(dateStr);
    }

    function convertInputDate(inputDate) {
        if (!inputDate) return ''; // Return empty string if input date is empty
    
        var date = new Date(inputDate);
        var month = date.toLocaleString('en-US', { month: 'long' });
        var day = date.getDate();
        var year = date.getFullYear();
    
        return month + ' ' + day + ', ' + year;
    }

    function applyFilters() {
        var borrowedFilter = convertInputDate($('#borrowed_filter').val());
        var returnedFilter = convertInputDate($('#returned_filter').val());
        console.log('Filtered Date (Borrowed):', borrowedFilter);
        console.log('Filtered Date (Returned):', returnedFilter);
    
        $('#equipment_table_body tr').each(function() {
            var dateBorrowed = $(this).find('td:nth-child(3)').text().trim();
            var dateReturned = $(this).find('td:nth-child(4)').text().trim();
            console.log('Date Borrowed (Table):', dateBorrowed);
            console.log('Expected Return Date (Table):', dateReturned);
    
            // Compare table dates with filter dates
            var matchesBorrowed = (borrowedFilter === '' || dateBorrowed.includes(borrowedFilter));
            var matchesReturned = (returnedFilter === '' || dateReturned.includes(returnedFilter));
    
            // Show/hide table row based on filter matches
            $(this).toggle(matchesBorrowed && matchesReturned);
        });
    }
    
    function convertDateToString(date) {
        // Convert Date object to formatted date string: Month Day, Year (e.g., April 16, 2024)
        var month = date.toLocaleString('en-US', { month: 'long' });
        var day = date.getDate();
        var year = date.getFullYear();
    
        var formattedDate = month + ' ' + day + ', ' + year;
        return formattedDate;
    }

    // Event listeners for filter change
    $('#office_filter, #borrowed_filter, #returned_filter, #employee_filter').change(function() {
        applyFilters();
    });

    // Initial application of filters on page load
    applyFilters();
});