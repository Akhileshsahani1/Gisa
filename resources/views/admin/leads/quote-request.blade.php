<!-- Full width modal -->
<div style="width:90%;left:54px;" id="quote-request-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Quote Request</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                 <form action="{{ route('admin.lead.quote.request') }}" method="POST">
                <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                  <div class="mb-3">
                    <label class="col-form-label" for="policy_id">Service Executive <span class="text-danger">*</span></label>
                    <select name="service_executive_id" id="service_executive_id" class="form-select">
                        <option value="">Choose Service Executive</option>
                    </select>
                </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Comment:</label>
                    <textarea name="comment" class="form-control"></textarea>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
