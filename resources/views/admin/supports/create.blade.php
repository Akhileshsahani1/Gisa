@extends('layouts.admin')
@section('title', 'Show Ticket')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
      {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
    /* Style the dropdown container */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Style the input field */


    /* Style the dropdown list */
    .dropdown-list {
      position: absolute;
      display: none;
      z-index: 1;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
      width: 100%;
    }

    /* Style list items */
    .dropdown-list-item {
      padding: 8px;
      cursor: pointer;
    }

    /* Highlight the selected item */
    .dropdown-list-item:hover {
      background-color: #ddd;
    }
  </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="ticketForm" onclick="createDisabled();" id="ticketCreateDisabled"><i
                        class="mdi mdi-database me-1"></i>Save</button>
                </div>
                <h4 class="page-title">Create Ticket</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.grievance.store') }}" method="POST" id="ticketForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="dropdown col-sm-12">
                                <label class="col-form-label" for="">Subject*</label>
                                <input type="text" class="form-control" placeholder="Enter Subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label" for="description">Description*</label>
                                <textarea type="text" id="description" class="form-control" rows="4"
                                    placeholder="Please explain about issue here" name="description" >{{ old('description') }}</textarea>
                                @error('description')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label" for="customer_id">Customer</label>
                                <select class="form-select select-customer_id select2" data-toggle="select2" name="customer_id" id="customer_id">
                                    <option value="" selected>Please Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label class="col-form-label" for="role_id">Department</label>
                                <select name="role_id" id="role_id" class="form-control select2" data-toggle="select2">
                                    <option value="">Please Select Department</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label" for="attachment">Attachment</label>
                                <input type="file" class="form-control" name="attachment" id="attachment">
                                @error('attachment')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label" for="priority">Priority*</label>
                                <select name="priority" id="priority" class="form-control" >
                                    <option value="">Please Select</option>
                                    <option value="High">
                                        High</option>
                                    <option value="Low">
                                        Low</option>
                                    <option value="Medium">Medium</option>
                                </select>
                                @error('priority')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script>

    $(document).ready(function() {

    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
         $('#customer-search-id').autocomplete({
          'source': function(request, response) {
              $.ajax({
                  url: "{{ route('admin.customers.search') }}",
                  dataType: 'json',
                  type: "GET",
                  data: 'query=' + $('#customer-search-id').val(),
                  success: function(json) {
                      response($.map(json, function(item) {
                          return {
                              label: item.firstname+' '+item.lastname,
                              value: item.firstname+' '+item.lastname,
                              data: item.id
                          }
                      }));
                  }
              });
          },
          'select': function(item,ui) {
              $('#customer-search-id').val(ui.item.label);
              $('#customer-id').val(ui.item.data);
              getBookings(ui.item.data);
          }
        });

         function getBookings(id){
             $.ajax({
                  url: "{{ route('admin.quotation-policies.customer') }}",
                  dataType: 'json',
                  type: "GET",
                  data: 'customer_id=' + id,
                  success: function(json) {
                     let html = '<option>Please Select Policy</option>';
                     if((json.policies).length > 0 ){
                         (json.policies).map(function(item){
                            html += '<option value="'+ item.id +'"> Id-'+ item.id +',Policy Name- '+ item.name +'</option>';
                         });
                     }else{
                         html = '<option value=""> No Policy found</option>';;
                     }
                     $('#booking_id').html(html);
                  }
              });
         }
    });
    </script>


 <script>
  // JavaScript logic for the searchable dropdown
  const input = document.getElementById('searchInput');
  const dropdownList = document.getElementById('dropdownList');

  input.addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const items = dropdownList.getElementsByClassName('dropdown-list-item');

    for (let i = 0; i < items.length; i++) {
      const textValue = items[i].textContent || items[i].innerText;
      if (textValue.toLowerCase().indexOf(filter) > -1) {
        items[i].style.display = '';
      } else {
        items[i].style.display = 'none';
      }
    }
  });

  input.addEventListener('click', function() {
    dropdownList.style.display = 'block';
  });

  document.addEventListener('click', function(e) {
    if (!e.target.matches('.dropdown-input')) {
      dropdownList.style.display = 'none';
    }
  });

  dropdownList.addEventListener('click', function(e) {
    if (e.target.matches('.dropdown-list-item')) {
      const selectedValue = e.target.getAttribute('data-value');
      input.value = e.target.textContent;
      dropdownList.style.display = 'none';
      console.log('Selected value:', selectedValue);
    }
  });
</script>
<script>
    function createDisabled(){
        document.getElementById("ticketCreateDisabled").innerHTML = 'submitting wait..';
        setTimeout(myFunction, 3000);
    }
    function myFunction() {
        document.getElementById("ticketCreateDisabled").disabled = true;
    }
</script>
@endpush
