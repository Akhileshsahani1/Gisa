 <div class="row">
     <div class="col-12">
         <div class="card">

             <div class="card-body">
                 <div class="row">
                     <div class="col-md-12 table-responsive">
                         <table id="basic-datatable-qp" class="table table-striped dt-responsive nowrap w-100">
                             <thead class="bg-dark">
                                 <tr>
                                     <th class="bg-secondary text-white all" width="3%">
                                         <div class="form-check">
                                             <input type="checkbox" class="form-check-input" id="all-rows">
                                             <label class="form-check-label">&nbsp;</label>
                                         </div>
                                     </th>
                                     <th class="bg-secondary text-white">{{ __('Id') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Policy No.') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Date') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Policy') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Sales Executive') }}</th>
                                     <th class="bg-secondary text-white">{{ __('Service Executive') }}</th>
                                     <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                     </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($policies as $policy)
                                     @php

                                         $badge = match ($policy->status) {
                                             'Generated' => 'badge bg-success',
                                             'Filled' => 'badge bg-info',
                                             'Pending' => 'badge bg-warning',
                                             'default' => 'badge bg-secondary',
                                         };

                                         $dispatch_status = $policy->dispatch ? $policy->dispatch?->status : null;

                                         $dispatch_badge = match ($dispatch_status) {
                                             'Generated' => 'badge bg-success',
                                             'Filled' => 'badge bg-info',
                                             'Pending' => 'badge bg-warning',
                                             null => 'badge bg-secondary',
                                             'default' => 'badge bg-secondary',
                                         };

                                     @endphp
                                     <tr>
                                         <td>
                                             <div class="form-check">
                                                 <input type="checkbox" class="form-check-input checkbox-row"
                                                     name="rows" id="customCheck{{ $policy->id }}"
                                                     value="{{ $policy->id }}">
                                                 <label class="form-check-label"
                                                     for="customCheck{{ $policy->id }}">&nbsp;</label>
                                             </div>
                                         <td>{{ $policy->id }}</td>
                                         <td>{{ policy_data($policy->id, 'policy_no') }}</td>
                                         <td>{{ \Carbon\Carbon::parse($policy->created_at)->format('M d Y') }}
                                             <br><small>{{ \Carbon\Carbon::parse($policy->created_at)->format('h:i A') }}</small>
                                         </td>
                                         <td class="table-user">
                                             <a href="{{ route('admin.customers.show', $policy->quotation->customer_id) }}"
                                                 class="text-body fw-semibold">{{ $policy->quotation->customer->firstname }}
                                                 {{ $policy->quotation->customer->lastname }}</a>
                                         </td>

                                         <td>{{ $policy->quotation->policy->name }}<br><small>{{ $policy->quotation->policyType->type }}</small>
                                         </td>

                                         <td>
                                             <span class="{{ $badge }}"> Policy :
                                                 {{ $policy->status }}</span><br>

                                             @if (!is_null($dispatch_status) && $dispatch_status != 'Pending')
                                                 <span class="{{ $dispatch_badge }}">Dispatched</span><br>
                                                 <span class="badge bg-secondary">Dispatch Date:
                                                     {{ \Carbon\Carbon::parse($policy->dispatch?->dispatch_date)->format('d, M Y') }}</span>
                                             @else
                                                 <span class="{{ $dispatch_badge }}">Dispatch: Pending</span>
                                             @endif

                                         </td>
                                         <td>{{ $policy?->quotation?->salesExecutive?->firstname . ' ' . $policy?->quotation?->salesExecutive?->lastname }}
                                         </td>
                                         <td>{{ $policy?->quotation?->serviceExecutive?->firstname . ' ' . $policy?->quotation?->salesExecutive?->lastname }}
                                         </td>
                                         <td class="text-end">
                                             <div class="btn-group">
                                                 @can('Edit Policy')
                                                     <a href="{{ route('admin.quotation-policy.edit', $policy->id) }}"
                                                         class="btn btn-primary">
                                                         <i class="mdi mdi-pencil"></i></a>
                                                 @endcan
                                                 @can('Show Policy')
                                                     <a href="{{ route('admin.quotation-policy.show', $policy->id) }}"
                                                         class="btn btn-warning">
                                                         <i class="mdi mdi-eye"></i></a>
                                                 @endcan
                                                 @can('Delete Policy')
                                                     <a href="javascript:void(0);"
                                                         onclick="confirmDelete('{{ $policy->id }}')"
                                                         class="btn btn-danger">
                                                         <i class="mdi mdi-delete"></i></a>
                                                 @endcan
                                                 <form id='delete-form{{ $policy->id }}'
                                                     action='{{ route('admin.quotation-policy.delete') }}'
                                                     method='POST'>
                                                     <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                     <input type='hidden' name='id' value='{{ $policy->id }}'>
                                                 </form>
                                             </div>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <div id="policy_table">
                            {{ $policies->appends(request()->query())->links('pagination::bootstrap-5') }}
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
