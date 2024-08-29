  <div class="row">
      <div class="col-12">
          <div class="card">

              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table id="basic-datatable-dis" class="table table-striped dt-responsive nowrap w-100">
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
                                      <th class="bg-secondary text-white">{{ __('Mode') }}</th>
                                      <th class="bg-secondary text-white">{{ __('Dispatch Status') }}</th>
                                      <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (isset($dispatches))
                                      @foreach ($dispatches as $dispatch)
                                          @php
                                              $badge = match ($dispatch->status) {
                                                  'Filled' => 'badge bg-success',
                                                  'Pending' => 'badge bg-warning',
                                                  'default' => 'badge bg-secondary',
                                              };
                                          @endphp
                                          <tr>
                                              <td>
                                                  <div class="form-check">
                                                      <input type="checkbox" class="form-check-input checkbox-row"
                                                          name="rows" id="customCheck{{ $dispatch->id }}"
                                                          value="{{ $dispatch->id }}">
                                                      <label class="form-check-label"
                                                          for="customCheck{{ $dispatch->id }}">&nbsp;</label>
                                                  </div>
                                              <td>{{ $dispatch->id }}</td>
                                              <td>{{ policy_data($dispatch->policy?->id, 'policy_no') }}</td>
                                              <td>{{ \Carbon\Carbon::parse($dispatch->created_at)->format('M d Y') }}
                                                  <br><small>{{ \Carbon\Carbon::parse($dispatch->created_at)->format('h:i A') }}</small>
                                              </td>
                                              <td class="table-user">
                                                  <a href="{{ route('admin.customers.show', $dispatch->policy?->quotation?->customer_id) }}"
                                                      class="text-body fw-semibold">{{ $dispatch->policy?->quotation?->customer?->firstname }}
                                                      {{ $dispatch->policy?->quotation?->customer?->lastname }}</a>
                                              </td>

                                              <td>{{ $dispatch->policy?->quotation?->policy?->name }}<br><small>{{ $dispatch->policy?->quotation?->policyType?->type }}</small>
                                              </td>
                                              <td>
                                                  {{ $dispatch->dispatch_by ? ucfirst($dispatch->dispatch_by) : 'N/A' }}
                                              </td>
                                              <td>
                                                  <span class="{{ $badge }}"> {{ $dispatch->status }}</span>
                                              </td>
                                              <td class="text-end">
                                                  <div class="btn-group">
                                                      @if ($dispatch->status != 'Pending')
                                                          @can('Edit Dispatch Policy')
                                                              <a href="#" id="edit-dispatch"
                                                                  did="{{ $dispatch->id }}"
                                                                  mode="{{ $dispatch->dispatch_by }}"
                                                                  data="{{ $dispatch->data }}"
                                                                  dispatch_date="{{ $dispatch->dispatch_date }}"
                                                                  class="btn btn-primary edit-dispatch">
                                                                  <i class="mdi mdi-pencil"></i>
                                                              </a>
                                                          @endcan
                                                      @endif
                                                      @can('Show Dispatch Policy')
                                                          <a href="{{ route('admin.dispatch.fill', $dispatch->id) }}"
                                                              class="btn btn-warning">Show Dispatch</a>
                                                      @endcan
                                                      @can('Delete Dispatch Policy')
                                                          <a href="javascript:void(0);"
                                                              onclick="confirmDelete('{{ $dispatch->id }}')"
                                                              class="btn btn-danger">
                                                              <i class="mdi mdi-delete"></i></a>
                                                      @endcan
                                                      <form id='delete-form{{ $dispatch->id }}'
                                                          action='{{ route('admin.dispatch.delete') }}' method='POST'>
                                                          <input type='hidden' name='_token'
                                                              value='{{ csrf_token() }}'>
                                                          <input type='hidden' name='id'
                                                              value='{{ $dispatch->id }}'>
                                                      </form>
                                                  </div>
                                              </td>
                                          </tr>
                                      @endforeach
                              </tbody>
                          </table>
                          <div id="dispatchpolicy_table">
                          {{ $dispatches->appends(request()->query())->links('pagination::bootstrap-5') }}
                      </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
