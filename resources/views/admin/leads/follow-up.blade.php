<!-- Full width modal -->

<div id="follow-up-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Follow Up</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            <form id="leadForm" method="POST" action="{{ route('admin.leads.save-follow',$lead->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="follow_up_id" id="edit_follow_id">
                <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="customer_type" class="col-form-label">Contacted Via <span
                                                class="text-danger">*</span></label>
                                <select name="contacted_via"  class="form-select" id="edit_follow_contacted_via" required>
                                             <option value="">Choose One</option>
                                            <option value="Via Phone">
                                                Via Phone
                                            </option>
                                            <option value="Via Email">
                                                Via Email
                                            </option>
                                            <option value="Via WhatsApp">
                                                Via WhatsApp
                                            </option>
                                            <option value="Via Meet">
                                                Via Meet
                                            </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                        <label for="follow_up_date" class="col-form-label">Next Follow Up Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control" name="follow_up_date"
                                            value="" placeholder="Next Follow Up Date" id="edit_follow_up_date" required>
                            </div>
                            <div class="form-group col-sm-12">
                                        <label for="follow_up_time" class="col-form-label">Next Follow Up Time <span
                                                class="text-danger">*</span></label>
                                        <input type="time"
                                            class="form-control" name="follow_up_time"
                                            value="" placeholder="follow_up Time" id="edit_follow_time" required>
                            </div>
                            <div class="form-group">
                                        <label for="comment" class="col-form-label">Comment </label>
                                       <textarea  class="form-control" name="comment" rows="2" placeholder="Write Comment here" id="edit_follow_comment"></textarea>
                            </div>

                        </div>
                </div>
      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
