@extends('layouts.admin')
@section('title', 'Edite Policy Type')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="productForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Policy Type</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <form id="productForm" method="POST" action="{{ route('admin.policies.update-type',$type->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="type">Policy Type <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="Enter Policy Type" value="{{ old('type',$type->type) }}" autofocus>
                                @error('type')
                                    <span id="type-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('enabled') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="enabled">Enabled<span
                                        class="text-danger">*</span></label>
                                <select name="enabled" id="enabled" class="form-select">
                                    <option value="1" {{ $type->enabled == true ? "selected" : "" }}>Yes</option>
                                    <option value="0" {{$type->enabled == true ? "selected" : ""}}>No</option>
                                </select>
                                @error('enabled')
                                    <span id="enabled-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <label class="col-form-label" for="type">Commission </label>

                        <div class="row">
                            
                            <div class="table-responsive">  

                                <table class="table table-bordered" id="dynamic_field">  

                                    @if($type->commissionData && count($type->commissionData) )
                                    @foreach($type->commissionData as $key => $commissions)

                                    <tr>  

                                        <td>

                                            <select required name="commissions[{{ $key }}][company_name]" class="form-control name_list">
                                                <option value="">Please select Insurance Company</option>
                                                @foreach($insurance_companies as $insurance_company)
                                                <option value="{{ $insurance_company->id }}"  @if($commissions->company_name == $insurance_company->id) selected @endif >{{ $insurance_company->company }}</option>
                                                @endforeach
                                            </select>
                                        </td>  
                                        <td><input required type="number" name="commissions[{{$key}}][commissions_value]" value="{{ $commissions->commissions_value }}" placeholder="Enter Commission Value" class="form-control value_list" /></td>  

                                        <td>

                                            @if($key == 0)
                                                <button type="button" name="add-button" data-id="{{ count($type->commissionData) }}" id="add" class="add btn btn-success waves-effect waves-float waves-light">+</button>
                                            @else
                                                <button type="button" name="remove" id="{{ $key }}" class="btn btn-danger btn_remove">X</button>
                                            @endif
                                        </td>  

                                    </tr>  

                                    @endforeach
                                    @else

                                    <tr>  

                                        <td>
                                            <select required name="commissions[0][company_name]" class="form-control name_list">
                                                <option value="">Please select Insurance Company</option>
                                                @foreach($insurance_companies as $insurance_company)
                                                <option value="{{ $insurance_company->id }}">{{ $insurance_company->company }}</option>
                                                @endforeach
                                            </select>
                                        </td>  
                                        <td><input required type="number" name="commissions[0][commissions_value]" placeholder="Enter Commission Value" class="form-control value_list" /></td>  

                                        <td><button type="button" name="add" id="add" class="btn btn-success" data-id="0">Add More</button></td>  

                                    </tr>  

                                    @endif

                                </table>  


                            </div>



                        </div>

                    </div>

                

                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="productForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    
    $(document).ready(function(){      

      var postURL = "<?php echo url('addmore'); ?>";

      var i=0;  





           


      $('#add').click(function(){

         var i = $(this).attr('data-id');
        var iii = ++i;
         $("#add").attr('data-id', iii);

           i++;  

           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select required name="commissions[' + iii + '][company_name]" class="form-control name_list"><option value="">Please select Insurance Company</option>@foreach($insurance_companies as $insurance_company)<option value="{{ $insurance_company->id }}">{{ $insurance_company->company }}</option>@endforeach</select></td> <td><input required type="number" name="commissions[' + iii + '][commissions_value]" placeholder="Enter Commission Value" class="form-control value_list" /></td><td> <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  

      });  



      $(document).on('click', '.btn_remove', function(){ 

      $(this).parents('tr').remove(); 

           /*var button_id = $(this).attr("id"); 

           alert(button_id);  

           $('#row'+button_id+'').remove();  */

      });  



      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });



      $('#submit').click(function(){            

           $.ajax({  

                url:postURL,  

                method:"POST",  

                data:$('#add_name').serialize(),

                type:'json',

                success:function(data)  

                {

                    if(data.error){

                        printErrorMsg(data.error);

                    }else{

                        i=1;

                        $('.dynamic-added').remove();

                        $('#add_name')[0].reset();

                        $(".print-success-msg").find("ul").html('');

                        $(".print-success-msg").css('display','block');

                        $(".print-error-msg").css('display','none');

                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');

                    }

                }  

           });  

      });  



      function printErrorMsg (msg) {

         $(".print-error-msg").find("ul").html('');

         $(".print-error-msg").css('display','block');

         $(".print-success-msg").css('display','none');

         $.each( msg, function( key, value ) {

            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

         });

      }

    });  


</script>

@endpush
