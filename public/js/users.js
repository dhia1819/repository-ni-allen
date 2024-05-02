$(function() {

  $('#tbl-users').dataTable({
      'language':{
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
  
$('.btn-edit-user').click(function () {
  var rowId = $(this).data('rowid');

  var row = $(this).closest('tr');

  var UserName = row.find('td:eq(0)').text().trim();
  var FullName = row.find('td:eq(1)').text().trim();
  var Classification = row.find('td:eq(2)').text().trim(); 
  var status = row.find('td:eq(3)').text().trim(); 

  // Populate the modal form fields with the retrieved data
  $('#name').val(FullName);
  $('#username').val(UserName);

  // Set the classification select element's value
  $('#classification').val(Classification);
  $('#status').val(status);

  // Set the rowid in a hidden input field
  $('#rowid').val(rowId);

  
});




});