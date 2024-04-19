$(document).ready(function() {
    // Initialize Select2 on filter dropdowns
    $('#office_filter, #category_filter').select2();

    $('#start_date_borrowed, #end_date_borrowed').on('change', function() {
        applyFilters(); // Apply filters when date inputs are changed
    });

    // Check if borrowedData is defined and process it
    if (typeof borrowedData !== 'undefined' && Array.isArray(borrowedData)) {
        console.log('Borrowed Data:', borrowedData);

        // Loop through each transaction in borrowedData
        borrowedData.forEach(function(transaction) {
            // Extract relevant properties from each transaction
            var borrower = transaction.BORROWER || 'N/A';
            var office = transaction.OFFICE || 'N/A';
            var category = transaction.CATEGORY || 'N/A';
            var dateBorrowed = transaction['DATE BORROWED'] || 'N/A';
            var expectedReturn = transaction['DATE RETURNED'] || 'N/A';
            var action = transaction.ACTION || 'N/A';

            // Log each transaction's details
            console.log('Borrower:', borrower);
            console.log('Office:', office);
            console.log('Category:', category);
            console.log('Date Borrowed:', dateBorrowed);
            console.log('Expected Return', expectedReturn);
            console.log('Action:', action);

            // Additional processing or logic can be added here
        });
    } else {
        console.log('No Borrowed Data available or data format is incorrect.');
    }

    // Initialize DataTable on #tbl-history table after processing borrowedData
    $('#tbl-borrowed').DataTable({
        paging: true,
        language: {
            paginate: {
                previous: "<",
                next: ">"
            }
        },
        searching: true,
        ordering: true,
        responsive: true
    });

    function applyFilters() {
        var startDateBorrowed = $('#start_date_borrowed').val();
        var endDateBorrowed = $('#end_date_borrowed').val();
        var startDateReturn = $('#start_date_expect').val();
        var endDateReturn = $('#end_date_expect').val();
        var officeFilter = $('#office_filter').val();
        var categoryFilter = $('#category_filter').val();
    
        $('#borrow_table_body tr').each(function() {
            var dateBorrowedStr = $(this).find('td:nth-child(4)').text().trim(); // Assuming date_borrowed column is the 4th column
            var dateReturnStr = $(this).find('td:nth-child(5)').text().trim(); // Assuming date_borrowed column is the 4th column
            var office = $(this).find('td:nth-child(2)').text().trim(); // Assuming office column is the 2nd column
            var category = $(this).find('td:nth-child(3)').text().trim();
    
            // Parse dateBorrowedStr into a Date object (date only, ignoring time)
            var dateBorrowed = parseDateWithoutTime(dateBorrowedStr);
            var dateReturn = parseDateWithoutTime(dateReturnStr);
    
            // Check if the dateBorrowed is within the specified range and matches the selected office filter
            var isDateInRangeBorrowed = (!startDateBorrowed || dateBorrowed >= parseDateWithoutTime(startDateBorrowed)) &&
                                (!endDateBorrowed || dateBorrowed <= parseDateWithoutTime(endDateBorrowed));

            var isDateInRangeReturn = (!startDateReturn || dateReturn >= parseDateWithoutTime(startDateReturn)) &&
                                (!endDateReturn || dateReturn <= parseDateWithoutTime(endDateReturn));

            var isOfficeMatch = !officeFilter || office === officeFilter;
            var isCategoryMatch = !categoryFilter || category === categoryFilter;
    
            // Show/hide table row based on date range and office filter
            $(this).toggle(isDateInRangeBorrowed && isOfficeMatch && isCategoryMatch && isDateInRangeReturn);
        });
    
        toggleClearFiltersButton(); // Toggle Clear Filters button based on active filters
    }

    // Function to toggle visibility of Clear Filters button based on active filters
    function toggleClearFiltersButton() {
        var anyFilterActive =
            $('#start_date_borrowed').val() ||
            $('#end_date_borrowed').val() ||
            $('#start_date_expect').val() ||
            $('#end_date_expect').val() ||
            $('#office_filter').val() ||
            $('#category_filter').val();

        if (anyFilterActive) {
            $('#reset_filter').show(); // Show the Clear Filters button
        } else {
            $('#reset_filter').hide(); // Hide the Clear Filters button
        }
    }

    // Event listener for filter change (including date inputs)
    $('#office_filter, #start_date_borrowed, #end_date_borrowed, #start_date_expect, #end_date_expect, #category_filter').on('change', function() {
        applyFilters(); // Apply filters on filter change
        toggleClearFiltersButton(); // Check if filters are active and toggle button visibility
    });

    // Event listener for Clear Filters button
    $('#reset_filter').click(function() {
        resetFilters(); // Clear filters on button click
    });

    // Initial toggle button visibility on page load
    toggleClearFiltersButton();
});

function resetFilters() {
    // Clear date inputs
    $('#start_date_borrowed').val('');
    $('#end_date_borrowed').val('');
    $('#start_date_expect').val('');
    $('#end_date_expect').val('');

    // Reset Select2 dropdowns
    $('#office_filter').val('').trigger('change');
    $('#category_filter').val('').trigger('change');

    // Reset start date inputs and labels
    // For Date Borrowed
    $('#start_date_borrowed').show(); // Show start date input
    $('#end_date_borrowed').hide();   // Hide end date input
    $('#start_date_label').show();    // Show start date label
    $('#end_date_label').hide();      // Hide end date label

    // For Date Return
    $('#start_date_expect').show();   // Show start date input
    $('#end_date_expect').hide();     // Hide end date input
    $('#start_date_expect_label').show();  // Show start date label
    $('#end_date_expect_label').hide();    // Hide end date label
}


function parseDateWithoutTime(dateString) {
    if (!dateString) return null; // Return null for empty strings

    // Split the dateString by '|' to separate date and time parts
    var parts = dateString.split('|');

    // Trim the date part to remove leading/trailing spaces
    var datePart = parts[0].trim();

    // Use JavaScript Date constructor to parse the date part
    var dateObj = new Date(datePart);

    // Return the date object (without considering the time)
    return new Date(dateObj.getFullYear(), dateObj.getMonth(), dateObj.getDate());
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

// Function to handle start date change for either 'borrowed' or 'returned' type
function handleStartDateChange(type) {
    var startDateInput, endDateInput;
    var startLabel, endLabel;

    if (type === 'borrowed') {
        startDateInput = document.getElementById('start_date_borrowed');
        endDateInput = document.getElementById('end_date_borrowed');
        startLabel = document.getElementById('start_date_label');
        endLabel = document.getElementById('end_date_label');
    } else if (type === 'returned') {
        startDateInput = document.getElementById('start_date_expect');
        endDateInput = document.getElementById('end_date_expect');
        startLabel = document.getElementById('start_date_expect_label');
        endLabel = document.getElementById('end_date_expect_label');
    } else {
        return; // Invalid type
    }

    // Show end date input and label
    endDateInput.style.display = 'inline-block';
    endLabel.style.display = 'inline-block';

    // Hide start date input and label
    startDateInput.style.display = 'none';
    startLabel.style.display = 'none';

    // Attach event listener to end date input
    endDateInput.addEventListener('change', function() {
        // Parse and format the end date input
        var parsedEndDate = parseDateWithoutTime(endDateInput.value);
        var formattedEndDate = convertInputDate(parsedEndDate);
        console.log("Formatted End Date (" + type + "):", formattedEndDate);
    });

    // Parse and format the start date input
    var parsedStartDate = parseDateWithoutTime(startDateInput.value);
    var formattedStartDate = convertInputDate(parsedStartDate);
    console.log("Formatted Start Date (" + type + "):", formattedStartDate);
}




