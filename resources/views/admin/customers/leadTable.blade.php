<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="basic-datatable-lead" class="table table-stripedx dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white all" width="3%">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="all-rows">
                                            <label class="form-check-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Job Id') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Name') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Assigned to') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Phone Number') }}</th>
                                    {{-- <th class="bg-secondary text-white">{{ __('Customer Type') }}</th> --}}
                                    <th class="bg-secondary text-white">
                                        {{ __('Status') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Email') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Time (ago)') }}</th>
                                    <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)
                                    <tr>


                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkbox-row"
                                                    name="rows" id="customCheck{{ $lead->id }}"
                                                    value="{{ $lead->id }}">
                                                <label class="form-check-label"
                                                    for="customCheck{{ $lead->id }}">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td>{{ $lead->id }}</td>
                                        <td class="table-user {{ empty($lead->seen_by) ? 'seenclr' : '' }}">
                                            <a href="{{ route('admin.leads.show', $lead) }}"
                                                class="text-body fw-semibold">{{ $lead->firstname }}
                                                {{ $lead->lastname }}</a>
                                        </td>
                                        <td class="">
                                            {{ \App\Models\Administrator::find($lead->assigned_to)?->firstname }}
                                            {{ \App\Models\Administrator::find($lead->assigned_to)?->lastname }}
                                        </td>
                                        <td class="">{{ $lead->phone }}
                                        </td>
                                        <td><span class="badge bg-info">{{ $lead->lead_status }}</span>

                                            @if (isset($lead->follows))
                                                @foreach ($lead->follows as $follow)
                                                    <br><small class="badge bg-primary">Next
                                                        follow up:
                                                        {{ \Carbon\Carbon::parse($follow->follow_up_date)->format('d M, Y') }}</small>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="">{{ $lead->email }}
                                        </td>

                                        <td class="">
                                            {{ $lead->created_at->diffForHumans() }}
                                        </td>
                                        <td class="text-end ">
                                            <div class="btn-group">
                                                @can('Edit Lead')
                                                    <a href="{{ route('admin.leads.edit', $lead) }}"
                                                        class="btn btn-primary">
                                                        <i class="mdi mdi-pencil"></i></a>
                                                @endcan
                                                @can('Show Lead')
                                                    <a href="{{ route('admin.leads.show', $lead) }}"
                                                        class="btn btn-warning">
                                                        <i class="mdi mdi-eye"></i></a>
                                                @endcan
                                                @can('Delete Lead')
                                                    <a href="javascript:void(0);"
                                                        onclick="confirmDelete('{{ $lead->id }}')"
                                                        class="btn btn-danger">
                                                        <i class="mdi mdi-delete"></i></a>
                                                @endcan
                                                <form id='delete-form{{ $lead->id }}'
                                                    action='{{ route('admin.leads.destroy', $lead->id) }}'
                                                    method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='_method' value='DELETE'>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="lead_table">
                          {{ $leads->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
