<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
        <form method="post" action="{{ route('user.update', ['id' => $user->id]) }}" class="form" id="edit_modal_form" >
                @csrf()
                <div class="modal-header">
                    <b class="modal-title text-info text-gradient"><i class="fa fa-plus"></i> Update User</b>
                    <a class="close text-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12">
                            <label class="text-info">Personal Information</label><br>
                        </div>
                        <div class="col-md-12">
                        <input type="hidden" class="form-control" name="rowid" id="rowid" value="" required>

                            <label class="text-muted">Full Name</label> <span class="text-danger">&#x2022;</span>
                            <input type="text" class="form-control" name="name" id="name" value="" required>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="text-muted">Username</label> <span class="text-danger">&#x2022;</span>
                                <input type="text" class="form-control" name="username" id="username" value="" required>
                            </div>
                            <label class="text-muted">Classification</label> <span class="text-danger">&#x2022;</span>
                            <select class="form-control select2 select2-edit" name="classification" id="classification"style="width: 100%" required>
                                <option selected disabled></option>
                                <option value ="1">Overall Administrator</option>
                                <option value ="2">Administrator</option>
                                <option value="3">Staff</option>
                            </select>
                            <label class="text-muted">Status</label> <span class="text-danger">&#x2022;</span>
                            <select class="form-control select2 select2-edit" name="status" id="status"style="width: 100%" required>
                                <option selected disabled></option>
                                <option value ="1">Active</option>
                                <option value ="2">Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn bg-gradient-success btn-submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
