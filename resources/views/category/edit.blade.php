<div class="modal fade" id="edit_modal" role="dialog">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('category.update', ['id' => $cat->id]) }}" class="form">
                @csrf()
                <div class="modal-header">
                    <b class="modal-title text-info text-gradient"><i class="fa fa-edit"></i> Update Category</b>
                    <a class="close text-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12">
                        <input type="hidden" class="form-control" name="rowid" id ="rowid" value=""required>

                            <label class="text-muted">Category</label> <span class="text-danger">&#x2022;</span>
                            <input type="text" class="form-control" name="category" id ="category" value=""required>
                        </div>
                        <div class="col-md-12">
                            <label class="text-muted">Status</label> <span class="text-danger">&#x2022;</span>
                            <select class="form-control select2 select2-update" name="status" id="status" style="width: 100%" required>
                                <option selected disabled></option>
                                <option  value="1">Active</option>
                                <option  value="0">Inactive</option>
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