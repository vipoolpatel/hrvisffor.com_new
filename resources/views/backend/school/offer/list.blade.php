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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{ __('offer.Offer List') }}</h2>
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
              
@forelse($getOffer as $value)

  <div class="col-md-6">
     <div class="card card-custom gutter-b card-stretch">
        <div class="card-body">
           <div class="d-flex align-items-center">
              <div style="width: 100%">
                  <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('teacher-profile/'.$value->job_apply->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->job_apply->user->teacher_id }} ({{ $value->job_apply->user->name }})</a>
                         <span class="text-muted font-weight-bold">
                         {{ __('offer.Nationality') }}: {{ !empty($value->job_apply->user->nationality) ? $value->job_apply->user->nationality->getName() : '' }}
                         </span>
                      </div>
                   </div>

                   <hr />


                 <div class="row form-group" style="margin-top: 10px;">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Salary') }}</div>
                    <div class="col-md-7">¥ {{ $value->salary }} {{__("offer.Monthly")}} ({{ $value->tax->getName() }})</div>
                 </div>
                 
                 @if(!empty($value->flights))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Flights') }}</div>
                    <div class="col-md-7"> {{ $value->flights }}</div>
                 </div>
                 @endif
                 @if(!empty($value->holiday))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Holidays') }}</div>
                    <div class="col-md-7">{{ $value->holiday }}</div>
                 </div>
                  @endif

                  @if(!empty($value->contract_length))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Contract Length') }}</div>
                    <div class="col-md-7">{{ $value->contract_length }}</div>
                 </div>
                 @endif

                 @if(!empty($value->insurance))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Insurance') }}</div>
                    <div class="col-md-7">{{ $value->insurance }}</div>
                 </div>
                 @endif


                 @if(!empty($value->start_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Start Date') }}</div>
                    <div class="col-md-7"><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $value->start_date }}</span></div>
                 </div>
                 @endif

                 @if(!empty($value->apartment))
                 <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Apartment') }}</div>
                    <div class="col-md-7">{{ $value->apartment }}</div>
                 </div>
                @endif 

                @if(!empty($value->bonus))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Bonus') }}</div>
                    <div class="col-md-7">{{ $value->bonus }}</div>
                 </div>
               @endif 

               @if(!empty($value->expired_date))
                  <div class="row form-group">
                    <div class="col-md-5 text-primary font-weight-bold">{{ __('offer.Expired Date') }}</div>
                    <div class="col-md-7"><span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ $value->expired_date }}</span></div>
                 </div>
               @endif


              </div>
           </div>
           <p class="mb-7 mt-3">
              {{ $value->note }}
           </p>
           <div class="d-flex flex-wrap">
              <div class="mr-12 d-flex flex-column mb-7">
                 <span class="font-weight-bolder mb-4">{{ __('offer.Status') }}</span>
                 <span class="btn {{ $value->confirm->class }} font-weight-bold btn-upper btn-text">{{ $value->confirm->teacher_status }}</span>
              </div>

              @if(!empty($user->staff))
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('offer.Support') }}</span>
                   <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('school/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
                </div>
              @endif

              @if($value->is_confirm == 2)
                <div class="mr-12 d-flex flex-column mb-7">
                   <span class="font-weight-bolder mb-4">{{ __('offer.Contract') }}</span>
                   <button data-val="{{ $value->job_apply->user_id }}" class="btn btn-success btn-hover-primary btn-sm SendContract" id="<?=$value->id?>"  type="button"> <i class="flaticon-edit-1"></i> {{ __('offer.Send Contract') }}</button>
                </div>
              @endif

              @if($value->is_confirm != 2)
              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                 <span class="font-weight-bolder mb-4">{{ __('offer.Action') }}</span>
                 <div class="symbol-group symbol-hover">
                     <a onclick="return confirm('{{ __('offer.Are you sure you want to delete?') }}')" href="{{ url('common/offer/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon2-trash text-danger"></i> </a>
                 </div>
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
                          {!! $getOffer->links() !!}
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('offer.Send Contract') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('school/offer/contract/submit') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="offer_id" id="get_offer_id">
           <input type="hidden" name="teacher_id" id="get_teacher_id">
           
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
  
   $('body').delegate('.SendContract','click',function(){
        var id     = $(this).attr('id');
        var teacher_id     = $(this).attr('data-val');
        
        $('#get_offer_id').val(id);
        $('#get_teacher_id').val(teacher_id);
        
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
   

   
   

</script>


@endsection
