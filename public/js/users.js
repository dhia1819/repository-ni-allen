$(function() {

  $('#tbl-users').dataTable({
      'language':{
          // 'zeroRecords': '<center><span class="badge text-white bg-danger">No Records Found</span></center>',
          "paginate": {
              "previous": "<",
              "next": ">",
          }
      },
      'scrollX' : (screen_height > screen_width) ? true : false
  });
  
  $(".select2-create").select2({ dropdownParent: $("#create_modal")});
  $(".select2-edit").select2({ dropdownParent: $("#edit_modal")});
  
  $(".btn-destroy").click(function() {
      var id = $(this).data('id');
      var name = $(this).data('name');
      $('.destroy-label').html(name);
      $('#user_id').val(id);
  });
// JavaScript/jQuery code to dynamically set modal target
$('.btn-edit-user').click(function () {
  // Get the rowid from the clicked button
  var rowId = $(this).data('rowid');

  // Find the closest table row to the clicked "Edit" button
  var row = $(this).closest('tr');

  // Extract data from the table row
  var UserName = row.find('td:eq(0)').text().trim();
  var FullName = row.find('td:eq(1)').text().trim();
  var Classification = row.find('td:eq(2)').text().trim(); // Assuming classification is in the third column
  // Adjust indexes according to your table structure

  // Populate the modal form fields with the retrieved data
  $('#name').val(FullName);
  $('#username').val(UserName);

  // Set the classification select element's value
  $('#classification').val(Classification);

  // Set the rowid in a hidden input field
  $('#rowid').val(rowId);

  // Show the modal
  $('#edit_modal').modal('show');
});




});