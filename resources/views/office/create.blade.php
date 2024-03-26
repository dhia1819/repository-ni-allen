<div class="modal fade" role="dialog"  id="create_modal">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <form method="post" action="/office/store" class="form">
                @csrf()
                <div class="modal-header">
                    <b class="modal-title text-info text-gradient"><i class="fa fa-plus"></i> Add Office</b>
                    <a class="close text-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12">
                            <label class="text-info">Office Information</label><br>
                        </div>
                        <div class="col-md-12">
                            <label class="text-muted">Code</label> <span class="text-danger">&#x2022;</span>
                            <input type="text" class="form-control" name="code" value="" required>
                        </div>
                       
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="text-muted">Office</label> <span class="text-danger">&#x2022;</span>
                                <input type="text" class="form-control" name="office" value="" required>
                            </div>
                            <label class="text-muted">Type</label> <span class="text-danger">&#x2022;</span>
                            <select class="form-control select2 select2-create" name="type" style="width: 100%" required>
                                <option selected disabled></option>
                                <option value ="InterOffice">InterOffice</option>
                                <option value ="Off The Office">Off the Office</option>

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