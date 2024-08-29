<!-- Full width modal -->

<div id="dispatch-view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Dispatch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped dt-responsive table-centered">
                    <thead class="bg-dark">
                        <tr>
                            <th class="bg-secondary text-white" style="width:20%;">Field</th>
                            <th class="bg-secondary text-white" style="width:20%;">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (dispatch_data($dispatch->id) as $k => $data)
                        <tr>
                            <td> {{ ucwords(Str::replace('_',' ',$k)) }}</td>
                            <td>{{ $data }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No Data Found.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
