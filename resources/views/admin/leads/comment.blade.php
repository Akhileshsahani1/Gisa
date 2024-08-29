<!-- Full width modal -->

<div style="width:90%;left:54px;" id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Lead Comments</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered border-secondary table-centered mb-0">
                    <thead>
                        <tr>
                            <th style="width:20%;">Date & Time</th>
                            <th>Comment</th>
                            <th style="width:20%;">Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lead->comments as $comment)
                        <tr>
                            <td> {{ date('d-m-Y g:i:A', strtotime($comment->created_at)) ?? '' }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->user?->firstname }} {{ $comment->user?->lastname }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No Comment Found.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
