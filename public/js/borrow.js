$(document).ready(function() {
    
    $('#office_filter, #category_filter').select2();

    $('#start_date_borrowed, #end_date_borrowed').on('change', function() {
        applyFilters(); 
    });

    
    if (typeof borrowedData !== 'undefined' && Array.isArray(borrowedData)) {
        console.log('Borrowed Data:', borrowedData);

        
        borrowedData.forEach(function(transaction) {
            
            var borrower = transaction.BORROWER || 'N/A';
            var office = transaction.OFFICE || 'N/A';
            var category = transaction.CATEGORY || 'N/A';
            var dateBorrowed = transaction['DATE BORROWED'] || 'N/A';
            var dateReturned = transaction['DATE RETURNED'] || 'N/A';
            var action = transaction.ACTION || 'N/A';

            
            console.log('Borrower:', borrower);
            console.log('Office:', office);
            console.log('Category:', category);
            console.log('Date Borrowed:', dateBorrowed);
            console.log('Date Returned:', dateReturned);
            console.log('Action:', action);

            
        });
    } else {
        console.log('No Borrowed Data available or data format is incorrect.');
    }

    
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
        var startDateReturn = $('#start_date_return').val();
        var endDateReturn = $('#end_date_return').val();
        var officeFilter = $('#office_filter').val();
        var categoryFilter = $('#category_filter').val();
    
        
        var table = $('#tbl-borrowed').DataTable();
    
        
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var dateBorrowed = parseDateWithoutTime(data[3]); // Assuming Date Borrowed column index is 3
            var dateReturned = parseDateWithoutTime(data[4]); // Assuming Date Returned column index is 4
    
            
            var isDateInRangeBorrowed = (!startDateBorrowed || dateBorrowed >= parseDateWithoutTime(startDateBorrowed)) &&
                (!endDateBorrowed || dateBorrowed <= parseDateWithoutTime(endDateBorrowed));
    
            var isDateInRangeReturn = (!startDateReturn || dateReturned >= parseDateWithoutTime(startDateReturn)) &&
                (!endDateReturn || dateReturned <= parseDateWithoutTime(endDateReturn));
    
            return isDateInRangeBorrowed && isDateInRangeReturn;
        });
    
        
        table.column(1).search(officeFilter).draw(); 
        table.column(2).search(categoryFilter).draw(); 
    
        
        table.draw();
    
        
        $.fn.dataTable.ext.search.pop();
    
        
        var info = table.page.info();
    
        
        var allFiltersCleared = !startDateBorrowed && !endDateBorrowed && !startDateReturn && !endDateReturn && !officeFilter && !categoryFilter;
        
        
        if (allFiltersCleared) {
            $('#tbl-borrowed_info').text('Showing ' + (info.start + 1) + ' to ' + info.end + ' of ' + info.recordsTotal + ' entries');
        } else {
            $('#tbl-borrowed_info').text('Showing ' + (info.start + 1) + ' to ' + info.end + ' of ' + info.end + ' entries (filtered from ' + info.recordsTotal + ' total entries)');
        }
    
        
        toggleClearFiltersButton();
    }

    
    function toggleClearFiltersButton() {
        var anyFilterActive =
            $('#start_date_borrowed').val() ||
            $('#end_date_borrowed').val() ||
            $('#start_date_return').val() ||
            $('#end_date_return').val() ||
            $('#office_filter').val() ||
            $('#category_filter').val();

        if (anyFilterActive) {
            $('#reset_filter').show(); 
        } else {
            $('#reset_filter').hide(); 
        }
    }

    
    $('#office_filter, #start_date_borrowed, #end_date_borrowed, #start_date_return, #end_date_return, #category_filter').on('change', function() {
        applyFilters(); 
        toggleClearFiltersButton(); 
    });

    // Event listener for Clear Filters button
    $('#reset_filter').click(function() {
        resetFilters(); 
    });

    
    toggleClearFiltersButton();
});

function resetFilters() {
    
    $('#start_date_borrowed').val('');
    $('#end_date_borrowed').val('');
    $('#start_date_return').val('');
    $('#end_date_return').val('');

    
    $('#office_filter').val('').trigger('change');
    $('#category_filter').val('').trigger('change');

    
    
    $('#start_date_borrowed').show(); 
    $('#end_date_borrowed').hide();   
    $('#start_date_label').show();    
    $('#end_date_label').hide();      

    
    $('#start_date_return').show();   
    $('#end_date_return').hide();     
    $('#start_date_return_label').show();  
    $('#end_date_return_label').hide();    

   
}

function parseDateWithoutTime(dateString) {
    if (!dateString) return null; 

    
    var parts = dateString.split('|');

    
    var datePart = parts[0].trim();

    
    var dateObj = new Date(datePart);

    
    return new Date(dateObj.getFullYear(), dateObj.getMonth(), dateObj.getDate());
}


function convertInputDate(inputDate) {
    if (!inputDate) return ''; 
    var date = new Date(inputDate);
    var month = date.toLocaleString('en-US', { month: 'long' });
    var day = date.getDate();
    var year = date.getFullYear();
    return month + ' ' + day + ', ' + year;
}


function handleStartDateChange(type) {
    var startDateInput, endDateInput;
    var startLabel, endLabel;

    if (type === 'borrowed') {
        startDateInput = document.getElementById('start_date_borrowed');
        endDateInput = document.getElementById('end_date_borrowed');
        startLabel = document.getElementById('start_date_label');
        endLabel = document.getElementById('end_date_label');
    } else if (type === 'returned') {
        startDateInput = document.getElementById('start_date_return');
        endDateInput = document.getElementById('end_date_return');
        startLabel = document.getElementById('start_date_return_label');
        endLabel = document.getElementById('end_date_return_label');
    } else {
        return; 
    }

    
    endDateInput.style.display = 'inline-block';
    endLabel.style.display = 'inline-block';


    startDateInput.style.display = 'none';
    startLabel.style.display = 'none';

    
    endDateInput.addEventListener('change', function() {
        
        var parsedEndDate = parseDateWithoutTime(endDateInput.value);
        var formattedEndDate = convertInputDate(parsedEndDate);
        console.log("Formatted End Date (" + type + "):", formattedEndDate);
    });

    
    var parsedStartDate = parseDateWithoutTime(startDateInput.value);
    var formattedStartDate = convertInputDate(parsedStartDate);
    console.log("Formatted Start Date (" + type + "):", formattedStartDate);
}




