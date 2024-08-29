  <div class="row">
      <div class="col-12">
          <div class="card">

              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table id="basic-datatable-rn" class="table table-striped dt-responsive nowrap w-100">
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
                                      <th class="bg-secondary text-white">{{ __('Policy Expire Date') }}</th>
                                      <th class="bg-secondary text-white">{{ __('Policy') }}</th>
                                      <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                      <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                      <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if (isset($renewals))
                                      @foreach ($renewals as $renewal)
                                          @php

                                              $exp_date = policy_data($renewal->policy?->id, 'policy_expiry_date');
                                              if (!empty($exp_date)) {
                                                  $exp = \Carbon\Carbon::parse($exp_date);
                                                  $now = \Carbon\Carbon::now()->toDateString();
                                                  $diff = $exp->diffInDays($now);
                                              } else {
                                                  $diff = 'N/A';
                                              }
                                          @endphp
                                          <tr>
                                              <td>
                                                  <div class="form-check">
                                                      <input type="checkbox" class="form-check-input checkbox-row"
                                                          name="rows" id="customCheck{{ $renewal->id }}"
                                                          value="{{ $renewal->id }}">
                                                      <label class="form-check-label"
                                                          for="customCheck{{ $renewal->id }}">&nbsp;</label>
                                                  </div>
                                              <td>{{ $renewal->id }}</td>
                                              <td>{{ policy_data($renewal->policy?->id, 'policy_no') }}</td>
                                              <td>{{ $exp_date ? \Carbon\Carbon::parse($exp_date)->format('d M, Y') : '' }}
                                                  <br><small class="badge bg-danger">{{ $diff }} Days
                                                      left</small>
                                                  @if (!is_null($renewal->reminder_status))
                                                      <br><small
                                                          class="badge bg-secondary">{{ $renewal->reminder_status }}</small>
                                                  @endif
                                              </td>

                                              <td>{{ $renewal->quotation?->policy?->name }}<br><small>{{ $renewal->quotation?->policyType?->type }}</small>
                                              </td>
                                              <td class="table-user">
                                                  <a href="{{ route('admin.customers.show', $renewal->customer?->id) }}"
                                                      class="text-body fw-semibold">{{ $renewal->customer?->firstname }}
                                                      {{ $renewal->customer?->lastname }}</a>
                                              </td>
                                              <td>
                                                  <span class="badge bg-info"> {{ $renewal->status }}</span>
                                                  @if (isset($renewal->follows))
                                                      @foreach ($renewal->follows as $follow)
                                                          <br><small class="badge bg-primary">Next follow up:
                                                              {{ \Carbon\Carbon::parse($follow?->follow_up_date)->format('d M, Y') }}</small>
                                                      @endforeach
                                                  @endif
                                              </td>

                                              <td class="text-end">
                                                  <div class="btn-group">


                                                      @can('Show Quotation')
                                                          <a href="{{ route('admin.renewal.show', $renewal->id) }}"
                                                              class="btn btn-primary" target="_blank">Show Renewal</a>
                                                      @endcan

                                                  </div>
                                              </td>
                                          </tr>
                                      @endforeach
                              </tbody>
                          </table>
                          <div id="renewal_table">
                            {{ $renewals->appends(request()->query())->links('pagination::bootstrap-5') }}
                          </div>
                      </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
