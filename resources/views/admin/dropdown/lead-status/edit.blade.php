<div class="modal fade" id="modal-edit-dropdown">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @include('admin.includes.flash-message')
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-dropdown" action="">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        

                        <div class="form-group col-sm-12">
                            <label for="name" class="col-form-label">Name <span
                                    class="text-danger">*</span></label>
                            <input id="edit-name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="" placeholder="Enter Lead Status" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="lastname" class="col-form-label">Sort Order </label>
                            <input id="edit-sort-order" type="text"
                                class="form-control @error('sort_order') is-invalid @enderror" name="sort_order"
                                value="" placeholder="Enter Customer sort_order">
                            @error('sort_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="gender" class="col-form-label">Status <span
                                    class="text-danger">*</span></label>
                            <select id="edit-status" class="form-select @error('status') is-invalid @enderror"
                                name="status" >
                                
                                <option value="1" {{ old('status', isset($lead) ? $lead->status : '') == '1' ? 'selected' : '' }}>Enabled
                                </option>
                                <option value="0" {{ old('status', isset($lead) ? $lead->status : '') == '0' ? 'selected' : '' }}>Disabled
                                </option>
                              
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit-dropdown">Save</button>
            </div>
        </div>

    </div>
</div>