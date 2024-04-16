<div class="modal fade" role="dialog"  id="create_modal">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('add.supp')}}" class="form">
                @csrf()
                <div class="modal-header">
                    <b class="modal-title text-info text-gradient"><i class="fa fa-plus"></i> Add an Item</b>
                    <a class="close text-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-muted">Date Acquired </label> <span class="text-danger">&#x2022;</span>
                                    <input type="date" class="form-control" name="date" value="{{old('name')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted">Remarks</label> <span class="text-danger">&#x2022;</span>
                                    <select class="form-control select2 select2-create" name="remarks" style="width: 100%" required>
                                        <option selected disabled></option>
                                        <option value ="1">Good</option>
                                        <option value ="2">Used</option>
                                        <option value="3">Dispose</option>
                                    </select>
                                </div>
                            </div>
                            <label class="text-muted">Date Acquired </label> <span class="text-danger">&#x2022;</span>
                            <input type="date" class="form-control" name="date" value="{{old('name')}}" required>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="text-muted">Item Name</label> <span class="text-danger">&#x2022;</span>
                                <input type="text" class="form-control" name="supply_name" value="{{old('supply_name')}}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="text-muted">Description</label> <span class="text-danger">&#x2022;</span>
                                <textarea class="form-control" name="supply_desc" value="{{old('supply_desc')}}" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-muted">Quantity</label> <span class="text-danger">&#x2022;</span>
                                    <input type="text" class="form-control" name="quantity" value="{{old('quantity')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted">Unit</label> <span class="text-danger">&#x2022;</span>
                                    <input type="text" class="form-control" name="unit" value="{{old('unit')}}" required>
                                </div>
                            </div>
                            <div class="">

                            </div>
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