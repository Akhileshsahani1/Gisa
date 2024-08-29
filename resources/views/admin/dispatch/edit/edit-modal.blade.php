<!-- Full width modal -->

<div id="dispatch-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Dispatch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.dispatch.update') }}" method="POST" id="dispatchForm">
                   <input type="hidden" name="id" value="" id="dispatch_id"/>

                    @csrf
                    <div class="row m-2">
                        <div class="col-3">
                            <label for="dispatch_date" class="form-label">Dispatch Date</label>
                        </div>
                        <div class="col-9">
                            <input type="date" required class="form-control" id="dispatch_date" name="dispatch_date">
                        </div>
                    </div>

                    <div class="row m-2">
                        <div class="col-2">
                            <label for="dispatch_by" class="form-label">Dispatch By</label>
                        </div>
                        <div class="col-2">
                            <input type="checkbox"  value="courier" name="dispatch_by">
                            <label for="dispatch_by" class="form-label">By courier</label>
                        </div>
                        <div class="col-2">
                            <input type="checkbox"  value="employee" name="dispatch_by">
                            <label for="dispatch_by" class="form-label">By Employee</label>
                        </div>
                        <div class="col-2">
                            <input type="checkbox"  value="self" name="dispatch_by">
                            <label for="dispatch_by" class="form-label">By Self</label>
                        </div>
                        <div class="col-2">
                            <input type="checkbox"  value="whatsapp" name="dispatch_by">
                            <label for="dispatch_by" class="form-label">By Whatsapp</label>
                        </div>
                        <div class="col-2">
                            <input type="checkbox"  value="email" name="dispatch_by">
                            <label for="dispatch_by" class="form-label">By Email</label>
                        </div>

                    </div>

                    <div id="formFieldsData"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="dispatchForm" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
