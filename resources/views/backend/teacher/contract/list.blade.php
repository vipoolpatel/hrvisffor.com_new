@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 5px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 5px;
   }
   .form-group {
   margin-bottom: 15px;
   }
   .required {
    color: red;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1" style="width: 100%;">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column" style="width: 100%;">
               <div class="row">
                  <div class="col-sm-6">
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{ __('contract.Contract List') }}</h2>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
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
                         {{ __('contract.Location') }}: @if(!empty($value->offer->job_apply->job->get_location())) {{ $value->offer->job_apply->job->get_location() }} @endif 
                         </span>
                      </div>
                   </div>

                   <hr />

                   <div class="row form-group" style="margin-top: 10px;">
                      <div class="col-md-5 text-danger font-weight-bold">{{ __('contract.Disclaimer') }}</div>
                      <div class="col-md-7">{{ __('contract.Read your contract carefully before signing. The contract is a legal agreement between you and your new school.') }}</div>
                   </div>

           
                    @if(!empty($value->school_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{ __('contract.Contract') }}</div>
                          <div class="col-md-7"><a target="_blank" href="{!! $value->school_document() !!}">{{ __('contract.Download') }}</a></div>
                       </div>
                    @endif

                    @if(!empty($value->teacher_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{ __('contract.Upload your signed contract') }}</div>
                          <div class="col-md-7"><a target="_blank" href="{!! $value->teacher_document() !!}">{{ __('contract.Download') }}</a></div>
                       </div>
                    @endif


                   @if(!empty($value->teacher_reason) && $value->teacher_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.Reject Reason")}}</div>
                          <div class="col-md-7">{{ $value->teacher_reason }}

                            <button class="btn btn-success btn-hover-primary btn-sm SendContract" style="margin-top: 10px;" id="<?=$value->id?>"  type="button"> <i class="flaticon-edit-1"></i> {{ __('contract.Upload Contract') }}</button>

                          </div>
                       </div>
                    @endif

              </div>
           </div>
           
           <div class="d-flex flex-wrap">

              @if(!empty($user->staff))
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('contract.Support') }}</span>
                   <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('teacher/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
                </div>
              @endif

              @if(empty($value->teacher_status))
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('contract.Contract') }}</span>
                   <button class="btn btn-success btn-hover-primary btn-sm SendContract" id="<?=$value->id?>"  type="button"> <i class="flaticon-edit-1"></i> {{ __('contract.Upload Contract') }}</button>
                </div>
              @else

              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{ __('contract.Status') }}</span>
                 <span class="btn {{ $value->teacher_status_type->class }} font-weight-bold btn-upper btn-text">{{ $value->teacher_status_type->name }}</span>
              </div>
              
              @endif

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
   </div>
</div>


<div class="modal fade" id="SendContractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('contract.Send Contract') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('teacher/offer/contract/submit') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="contract_id" id="get_contract_id">
         <div class="modal-body">
          
            <div class="row">
               <div class="col-md-12 form-group" style="color: red">
                  {{ __('contract.Please upload your contract signature document') }}
              </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{ __('contract.Upload Document') }} <span class="required">*</span></label>
                     <input type="file" name="document" required class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('contract.Send') }}</button>
         </div>

       </form>

      </div>
   </div>
</div>

@endsection
@section('script')


<script type="text/javascript">
  
   $('body').delegate('.SendContract','click',function(){
        var id     = $(this).attr('id');
        $('#get_contract_id').val(id);
        $('#SendContractModal').modal('show');        
   });

</script>

@endsection
