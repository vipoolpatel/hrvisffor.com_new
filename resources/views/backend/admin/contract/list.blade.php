@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 10px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 10px;
   }
   .required {
    color: red;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
               <!--begin::Title-->
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{__("contract.Contract List")}}
               </h2>
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">

@forelse($getContract as $value)

  <div class="col-md-6">
     <div class="card card-custom gutter-b card-stretch">
        <div class="card-body">
           <div class="d-flex align-items-center">
              <div style="width: 100%">
                  <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('school-profile/'.$value->offer->job_apply->job->slug) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->school->school_id }}
                          @if(!empty($value->offer->job_apply->job->get_school_type))
                          ({{ $value->offer->job_apply->job->get_school_type->getName() }})
                          @endif
                        </a>
                         <span class="text-muted font-weight-bold">
                         {{__("contract.Location")}}: @if(!empty($value->offer->job_apply->job->get_location())) {{ $value->offer->job_apply->job->get_location() }} @endif 
                         </span>
                      </div>
                   </div>

                   <hr />

                   <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('teacher-profile/'.$value->teacher->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->teacher->teacher_id }} ({{ $value->teacher->name }})</a>
                         <span class="text-muted font-weight-bold">
                         {{__("contract.Nationality")}}: {{ !empty($value->teacher->nationality) ? $value->teacher->nationality->getName() : '' }}
                         </span>
                      </div>
                   </div>


                   <hr />

                   <div class="row form-group" style="margin-top: 10px;">
                      <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Contract Type")}}</div>
                      <div class="col-md-7">{{ $value->contract_type->getName() }}</div>
                   </div>

                    @if(!empty($value->school_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.School Contract Document")}}</div>
                          <div class="col-md-7"><a class="btn-sm btn btn-warning" target="_blank" href="{!! $value->school_document() !!}">{{__("contract.Download")}}</a></div>
                       </div>
                    @endif

                    @if(!empty($value->teacher_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Teacher Contract Document")}}</div>
                          <div class="col-md-7"><a class="btn-sm btn btn-warning" target="_blank" href="{!! $value->teacher_document() !!}">{{__("contract.Download")}}</a></div>
                       </div>
                    @endif


                    @if(!empty($value->admin_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Admin Send School Contract Document")}}</div>
                          <div class="col-md-7"><a class="btn-sm btn btn-warning" target="_blank" href="{!! $value->admin_document() !!}">{{__("contract.Download")}}</a></div>
                       </div>
                    @endif

                    @if(!empty($value->school_admin_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.School Send Admin Contract Document")}}</div>
                          <div class="col-md-7"><a class="btn-sm btn btn-warning" target="_blank" href="{!! $value->school_admin_document() !!}">{{__("contract.Download")}}</a></div>
                       </div>
                    @endif


                     @if(!empty($value->school_reason) && $value->school_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.School Reject")}}</div>
                          <div class="col-md-7">{{ $value->school_reason }}</div>
                       </div>
                    @endif

                    @if(!empty($value->teacher_reason) && $value->teacher_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.Teacher Reject")}}</div>
                          <div class="col-md-7">{{ $value->teacher_reason }}</div>
                       </div>
                    @endif

                    @if(!empty($value->school_admin_reason) && $value->school_admin_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.School Admin Reject")}}</div>
                          <div class="col-md-7">{{ $value->school_admin_reason }}</div>
                       </div>
                    @endif





              </div>
           </div>
           
           <div class="d-flex flex-wrap">


              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{__("contract.School Status")}}</span>
                 <select class="form-control ChangeContractStatus" data-val="school_status" id="{{ $value->id }}">
                    @foreach($get_status as $school_status)
                        <option {{ ($school_status->id == $value->school_status) ? 'selected' : '' }} value="{{ $school_status->id }}">{{ $school_status->name }}</option>
                    @endforeach
                 </select>
              </div>
                
              @if(!empty($value->teacher_status))

                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{__("contract.Teacher Status")}}</span>
                   <select class="form-control ChangeContractStatus" data-val="teacher_status" id="{{ $value->id }}">
                      @foreach($get_status as $teacher_status)
                          <option {{ ($teacher_status->id == $value->teacher_status) ? 'selected' : '' }} value="{{ $teacher_status->id }}">{{ $teacher_status->name }}</option>
                      @endforeach
                   </select>
                </div>


                <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                   <span class="font-weight-bolder mb-4">{{__("contract.School Contract")}}</span>
                   <div class="symbol-group symbol-hover">
                        <button style="margin: 0px;" class="btn btn-success btn-hover-primary btn-sm SchoolContract" id="<?=$value->id?>"  type="button"> <i class="flaticon-upload-1"></i> {{__("contract.Upload Document")}}</button>
                   </div>
                </div>

                @if(!empty($value->school_admin_document()))

                  <div class="mr-12 d-flex flex-column mb-7">
                     <span class="font-weight-bolder mb-4">{{__("contract.School Send Admin Contract Document Status")}}</span>
                     <select class="form-control ChangeContractStatus" data-val="school_admin_status" id="{{ $value->id }}">
                        @foreach($get_status as $school_admin_status)
                            <option {{ ($school_admin_status->id == $value->school_admin_status) ? 'selected' : '' }} value="{{ $school_admin_status->id }}">{{ $school_admin_status->name }}</option>
                        @endforeach
                     </select>
                  </div>

                @endif

              @endif
              


              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                 <span class="font-weight-bolder mb-4">{{__("contract.Action")}}</span>
                 <div class="symbol-group symbol-hover">
                     <a onclick="return confirm('{{__("contract.Are you sure you want to delete?")}}')" href="{{ url('common/contract/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon2-trash text-danger"></i> </a>
                 </div>
              </div>



           </div>
        </div>
     </div>
  </div>

@empty

@endforelse


         </div>

         <div class="row col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
               <div class="d-flex flex-wrap mr-3">
                  {!! $getContract->links() !!}
               </div>
            </div>
          </div>

      </div>
   </div>
</div>



<div class="modal fade" id="SchoolContractAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("contract.Upload School Contract")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/school/contract_submit') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="contract_id" id="get_contract_id">
           
         <div class="modal-body">

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("contract.Upload Your VISFFOR Service Contract")}} <span class="required">*</span></label>
                     <input type="file" name="document" required class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{__("contract.Upload")}}</button>
         </div>

       </form>

      </div>
   </div>
</div>




<div class="modal fade" id="TeacherSchoolReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('contract.Reason') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/contract/change_status/reject') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id" id="get_contract_id_reason">
           <input type="hidden" name="type" id="get_contract_type">
           <div class="modal-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <label>{{ __('contract.Reason') }} <span class="required">*</span></label>
                       <textarea name="reason" required class="form-control form-control-lg form-control-solid"></textarea>
                    </div>
                 </div>
              </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-danger font-weight-bold">{{ __('contract.Reject') }}</button>
         </div>

       </form>

      </div>
   </div>
</div>







@endsection

@section('script')

  <script type="text/javascript">
        

        

$('body').delegate('.SchoolContract','click',function(){

     var id = $(this).attr('id');

     $('#get_contract_id').val(id);      

     $('#SchoolContractAdminModal').modal('show');      
     
  
});


        
$('body').delegate('.ChangeContractStatus','change',function(){
   var type = $(this).attr('data-val');
   var id = $(this).attr('id');
   var status = $(this).val();



   if(status == 3) {

      $('#get_contract_id_reason').val(id);
      $('#get_contract_type').val(type);
      $('#TeacherSchoolReasonModal').modal('show');

   }
   else
   {
      $.ajax({
          url: "{{ url('admin/contract/change_status') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
              id:id,
              status:status,
              type:type
           },
           dataType:"json",
           success:function(response){
               alert(response.success);
           },
      });
   }
   


});



  </script>

@endsection