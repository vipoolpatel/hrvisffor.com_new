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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{__("contract.Contract List")}}</h2>
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
            @include('backend.layouts._sidebar_school')
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
                         <a href="{{ url('teacher-profile/'.$value->teacher->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->teacher->teacher_id }} ({{ $value->teacher->name }})</a>
                         <span class="text-muted font-weight-bold">
                         {{__("contract.Nationality")}}: {{ !empty($value->teacher->nationality) ? $value->teacher->nationality->getName() : '' }}
                         </span>
                      </div>
                   </div>

                   <hr />

                    <div class="row form-group" style="margin-top: 10px;">
                      <div class="col-md-5 text-danger font-weight-bold">
                      {{__("contract.Disclaimer")}}</div>
                      <div class="col-md-7">{{__("contract.Read your contract carefully before signing. The contract is a legal agreement between you and your new employer.")}}</div>
                   </div>

                   <div class="row form-group" style="margin-top: 10px;">
                      <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Contract Type")}}</div>
                      <div class="col-md-7">{{ $value->contract_type->getName() }}</div>
                   </div>

                 @if(!empty($value->school_document()))
                    <div class="row form-group">
                      <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Contract Document")}}</div>
                      <div class="col-md-7"><a target="_blank" class="btn-sm btn btn-warning" href="{!! $value->school_document() !!}">{{__("contract.Download")}}</a></div>
                   </div>
                 @endif

                 
                    @if(!empty($value->teacher_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Teacher Contract Document")}}</div>
                          <div class="col-md-7">
                            @if($value->teacher_sign_status == 2)
                              @if($value->school_admin_status == 1)
                                    <span class="btn btn-light-primary font-weight-bold btn-upper btn-text" style="text-align: left;">{{__("contract.Once Approve Your Contract Document Admin after Download")}}</span>
                              @elseif($value->school_admin_status == 2)
                                  <a target="_blank" class="btn-sm btn btn-warning" href="{!! $value->teacher_document() !!}">{{__("contract.Download")}}</a>
                              @else
                                  <a id="{{ $value->id }}" data-url="{{ $value->admin_document() }}" class="SendContractAdmin btn-sm btn btn-warning" href="javascript:;">{{__("contract.Download")}}</a>
                              @endif

                            @endif
                          </div>
                       </div>
                    @endif




                    @if(!empty($value->school_admin_document()))
                        <div class="row form-group">
                          <div class="col-md-5 text-primary font-weight-bold">{{__("contract.Uploaded Signature Document")}}</div>
                        <div class="col-md-7"><a target="_blank" class="btn-sm btn btn-warning" href="{!! $value->school_admin_document() !!}">{{__("contract.Download")}}</a></div>
                       </div>
                    @endif



                     @if(!empty($value->school_reason) && $value->school_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.Reject Reason")}}</div>
                          <div class="col-md-7">{{ $value->school_reason }}

                            <a href="javascript:;" id="{{ $value->id }}" class="btn btn-success btn-sm UploadAgainContract">Upload</a>
                          </div>
                       </div>
                    @endif


                    @if(!empty($value->school_admin_reason) && $value->school_admin_status == 3)
                        <div class="row form-group">
                          <div class="col-md-5 text-danger font-weight-bold">{{__("contract.Admin Reject")}}</div>
                          <div class="col-md-7">{{ $value->school_admin_reason }}</div>
                       </div>
                    @endif



              </div>
           </div>

          
           <div class="d-flex flex-wrap">

              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{__("contract.Status")}}</span>
                 <span class="btn {{ $value->school_status_type->class }} font-weight-bold btn-upper btn-text">{{ $value->school_status_type->name }}</span>
              </div>

              @if(!empty($value->teacher_sign_status) && $value->teacher_status == 2)
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{__("contract.Teacher Status")}}</span>
                   @if($value->teacher_sign_status == 2)
                      <span class="btn btn-light-primary font-weight-bold btn-upper btn-text">{{__("contract.Signed")}}</span>
                   @else
                      <span class="btn btn-light-danger font-weight-bold btn-upper btn-text">{{__("contract.Unsigned")}}</span>
                    @endif                   
                </div>
              @endif


              @if(!empty($value->school_admin_status))
              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{__("contract.Admin Contract Status")}}</span>
                 <span class="btn {{ $value->school_admin_status_type->class }} font-weight-bold btn-upper btn-text">{{ $value->school_admin_status_type->name }}</span>
              </div>
              @endif


              
              
              @if(!empty($user->staff))
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{__("contract.Support")}}</span>
                   <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('school/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
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



<div class="modal fade" id="SendContractAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("contract.Download and Upload Contract")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('school/offer/admin_contract_submit') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="contract_id" id="get_contract_id">
           
           
         <div class="modal-body">
          
            <div class="row">
               <div class="col-md-12 form-group" style="color: red">
                 {{__("contract.Before viewing the contract which teacher signed, please download and complete the VISFFOR Service Contract first. ")}} 
              </div>
            </div>

            <div class="row">
               <div class="col-md-12 form-group" >
                  <a target="_blank" class="btn btn-warning btn-hover-primary btn-sm" id="get_download_link" href=""><i class="flaticon-multimedia-4"></i> {{__("contract.Download Contract")}}</a>
              </div>
            </div>


            <div class="row">
               <div class="col-md-12 form-group" >
                    <hr />
              </div>
            </div>

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
            <button type="submit" class="btn btn-success font-weight-bold">{{__("contract.Send")}}</button>
         </div>

       </form>

      </div>
   </div>
</div>


<div class="modal fade" id="SendContractAdminNoticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("contract.Notice")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 form-group" style="color: red;font-size: 16px">
               {{__("contract.Your VISFFOR Service Contract will be ready after 1 working day start from teacher accpeted your offer.")}}  
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('offer.Send Contract') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('school/contract/again_submit') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id" id="get_contract_id_again">
         <div class="modal-body">
          
            <div class="row">
               <div class="col-md-12 form-group" style="color: red">
                  {{ __('offer.Please upload your contract here or you can choose our contract template') }}
              </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{ __('offer.Contract Type') }} <span class="required">*</span></label>
                      <select class="form-control form-control-lg form-control-solid" required name="contract_type_id" id="contract_type_id">
                        <option value="">{{ __('offer.Select Contract Type') }}</option>
                        @foreach($get_contract_type as $value_c)
                            <option value="{{ $value_c->id }}">{{ $value_c->name }}</option>
                        @endforeach
                      </select>
                    
                       <a href="{{ $get_setting->get_contract_document() }}" id="DownloadTemplate" style="display: none;">{{ __('offer.Download Template') }}</a>                  
                  </div>
               </div>
            </div>



            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{ __('offer.Upload Document') }} <span class="required">*</span></label>
                     <input type="file" name="document" required class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('offer.Send') }}</button>
         </div>

       </form>

      </div>
   </div>
</div>








@endsection
@section('script')

<script type="text/javascript">

     $('body').delegate('.UploadAgainContract','click',function(){
        var id     = $(this).attr('id');

        $('#get_contract_id_again').val(id);
        $('#SendContractModal').modal('show');        
   });



   $('body').delegate('#contract_type_id','click',function(){
        var value = $(this).val();
        if(value == 2)
        {
            $('#DownloadTemplate').show();
        }
        else
        {
          $('#DownloadTemplate').hide();
        }
        
   });
   


    $('.SendContractAdmin').click(function(){

          var id = $(this).attr('id');
          var url = $(this).attr('data-url');
          $('#get_contract_id').val(id);    

          if(url != '')
          {
              $('#get_download_link').attr('href',url);
              $('#SendContractAdminModal').modal('show');          
          }
          else
          {
              $('#SendContractAdminNoticeModal').modal('show');
          }
          
    });
</script>

@endsection
