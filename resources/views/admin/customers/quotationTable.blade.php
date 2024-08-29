<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="basic-datatable-quote" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white all" width="3%">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="all-rows">
                                            <label class="form-check-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Id') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Date') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Customer') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Business Type') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Policy') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Payment Status') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Status') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Sales Executive') }}</th>
                                    <th class="bg-secondary text-white">
                                        {{ __('Service Executive') }}</th>
                                    <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotations as $quotation)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkbox-row"
                                                    name="rows" id="customCheck{{ $quotation->id }}"
                                                    value="{{ $quotation->id }}">
                                                <label class="form-check-label"
                                                    for="customCheck{{ $quotation->id }}">&nbsp;</label>
                                            </div>

                                        <td>{{ $quotation->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('M d Y') }}
                                            <br><small>{{ \Carbon\Carbon::parse($quotation->created_at)->format('h:i A') }}</small>
                                        </td>
                                        <td class="table-user">
                                            <a href="{{ route('admin.customers.show', $quotation->customer_id) }}"
                                                class="text-body fw-semibold">{{ $quotation->customer->firstname }}
                                                {{ $quotation->customer->lastname }}</a>
                                        </td>
                                        <td>{{ motor_form($quotation->id, 'business_type') }}
                                        </td>
                                        <td>{{ $quotation->policy->name }}<br><small>{{ $quotation->policyType->type }}</small>
                                        </td>
                                        <td>
                                            {{ $quotation->payment_status }}
                                        </td>
                                        <td>
                                            {{ $quotation->status }}
                                        </td>
                                        <td>{{ $quotation?->salesExecutive?->firstname }}
                                        </td>
                                        <td>{{ $quotation?->serviceExecutive?->firstname }}
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                @can('Edit Quotation')
                                                    <a href="{{ route('admin.quotations.edit', $quotation) }}"
                                                        class="btn btn-primary">
                                                        <i class="mdi mdi-pencil"></i></a>
                                                @endcan
                                                @can('Show Quotation')
                                                    <a href="{{ route('public.quotation.show', base64_encode($quotation->id)) }}"
                                                        class="btn btn-warning" target="_blank">
                                                        <i class="mdi mdi-eye"></i></a>
                                                @endcan

                                                @can('Quotation Transactions')
                                                    <a href="{{ route('admin.quotation.transactions.list', $quotation->id) }}"
                                                        class="btn btn-dark">Transactions</a>
                                                @endcan
                                                @if ($quotation->status != 'Pending')
                                                    @can('Create Policy')
                                                        <a href="{{ route('admin.quotation.convert-policy', $quotation->id) }}"
                                                            class="btn btn-success text-white">Convert
                                                            to Policy</a>
                                                    @endcan
                                                @endif
                                                @can('Delete Quotation')
                                                    <a href="javascript:void(0);"
                                                        onclick="confirmDelete('{{ $quotation->id }}')"
                                                        class="btn btn-danger">
                                                        <i class="mdi mdi-delete"></i></a>
                                                @endcan
                                                <form id='delete-form{{ $quotation->id }}'
                                                    action='{{ route('admin.quotations.destroy', $quotation->id) }}'
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
                        <div id="quotation_Table">
                            {{ $quotations->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
