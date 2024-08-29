<!-- Full width modal -->

<div style="width:90%;left:54px;" id="follow-up-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Follow Up</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered border-secondary table-centered mb-0">
                    <thead>
                        <tr>
                            <th style="width:20%;">Date & Time</th>
                            <th>Contacted Via</th>
                            <th>Comment</th>
                            <th style="width:20%;">Follower</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($renewal->follows as $follow)
                        <tr>
                            @php $date_time = $follow->follow_up_date.' '.$follow->follow_up_time @endphp
                            <td> {{ date('d M, Y g:i A', strtotime($date_time)) ?? '' }}</td>
                            <td>{{ $follow->contacted_via }}</td>
                            <td>{{ $follow->comment }}</td>
                            <td>{{ $follow->user->firstname }} {{ $follow->user->lastname }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No Follow Up Found.</td>
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
