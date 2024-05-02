<div class="modal fade" role="dialog"  id="create_modal">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <form method="post" action="/users/store" class="form">
                @csrf()
                <div class="modal-header">
                    <b class="modal-title text-info text-gradient"><i class="fa fa-plus"></i> Add User</b>
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

                            <label class="text-muted">Full Name</label> <span class="text-danger">&#x2022;</span>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="text-info">Account Information</label>
                            <p style="font-size: 0.75rem" class="text-muted">Note: For every new account the default password is "12345678"</p>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="text-muted">Username</label> <span class="text-danger">&#x2022;</span>
                                <input type="text" class="form-control" name="username" value="{{old('username')}}" required>
                            </div>
                            <label class="text-muted">Classification</label> <span class="text-danger">&#x2022;</span>
                            <select class="form-control select2 select2-create" name="classification" style="width: 100%" required>
                                <option selected disabled></option>
                                <option value ="1">Overall Admin</option>
                                <option value ="2"> Admin</option>
                                <option value="3">Staff</option>
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