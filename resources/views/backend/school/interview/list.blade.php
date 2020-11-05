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
                     <h2 class="text-white font-weight-bold my-2 mr-5">{{__("interview.Interview")}}</h2>
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
                  @forelse($get_apply_job as $value)
                  <div class="col-md-6">
                     <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="d-flex flex-column mr-auto">
                                 <a href="{{ url('teacher-profile/'.$value->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $value->user->name }} ({{ $value->user->teacher_id }})</a>
                                 <span class="text-muted font-weight-bold">
                                 {{__("interview.Expected Salary")}}: @if(!empty($value->user->minimum_salary)){{ $value->user->minimum_salary->name }}@endif - @if(!empty($value->user->maximum_salary)){{ $value->user->maximum_salary->name }}@endif
                                 </span>
                              </div>
                           </div>
                           <div class="d-flex flex-wrap mt-14" style="margin-top: 19px !important;">
                              <table class="interview-table">
                                 <tr>
                                    <th>{{__("interview.Interview Time")}}</th>
                                    <th>{{__("interview.Duration")}}</th>
                                    
                                      <th>{{__("interview.Status")}}</th>
                                    @if($value->is_confirm != 3)
                                      <th>{{__("interview.Join")}}</th>
                                    @endif
                                 </tr>
                                 @forelse($value->get_interview_time as $interview_time)
                                 <tr>
                                    <td><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ date('Y-m-d h:i A',$interview_time->interview_date_time) }}</span></td>

                                    <td><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $interview_time->duration }} {{__("interview.min")}}</span></td>

                                    <td>

                                      @if($value->type == 'teacher' && $value->is_confirm != 3)
                                        @if(!empty($value->interview_time_book_count()))
                                          @if($interview_time->status == 1)
                                             <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{__("interview.Unconfirmed")}}</span>
                                          @elseif($interview_time->status == 2)
                                             <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{__("interview.Confirmed")}}</span>
                                          @endif
                                        @else
                                           <select class="form-control change_interview_time_status" id="{{ $interview_time->id }}">
                                             <option {{ ($interview_time->status == '1') ? 'selected' : '' }} value="1">{{__("interview.Unconfirmed")}}</option>
                                             <option {{ ($interview_time->status == '2') ? 'selected' : '' }} value="2">{{__("interview.Confirmed")}}</option>
                                           </select>
                                        @endif

                                        
                                      @else
                                          @if($interview_time->status == 1)
                                             <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text"> {{__("interview.Unconfirmed")}}</span>
                                          @elseif($interview_time->status == 2)
                                             <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text"> {{__("interview.Confirmed")}}</span>
                                          @endif
                                      @endif

                                    </td>

                                    @if($value->is_confirm != 3)
                                      <td class="text-center">
                                         @if($interview_time->status == 2)
                                         <a href="javascript:;" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                            <i class="flaticon-computer text-primary"></i>
                                         </a>
                                         @else 
                                         -
                                         @endif
                                      </td>
                                    @endif
                                 </tr>
                                 @empty
                                 @endforelse
                              </table>
                           </div>
                           <p class="mb-7 mt-3">
                              {{  $value->note }}
                           </p>
                           <div class="d-flex flex-wrap">

                            @if($value->type == 'teacher')

                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Status")}}</span>
                                 @if($value->is_confirm != 3)
                                     <select class="form-control ChangeInterviewConfirmStatus" id="{{ $value->id }}">
                                       @foreach($get_status as $status)
                                          <option {{ ($value->is_confirm == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                                       @endforeach
                                     </select>
                                 @else
                                 <span class="btn {{ $value->confirm->class }} btn-sm font-weight-bold btn-upper btn-text">{{ $value->confirm->name }}</span>
                                 @endif
                              </div>

                            @else

                                <div class="mr-12 d-flex flex-column mb-7">
                                    <span class="font-weight-bolder mb-4">{{__("interview.Status")}}</span>
                                    <span class="btn {{ $value->confirm->class }} btn-sm font-weight-bold btn-upper btn-text">{{ $value->confirm->name }}</span>
                                </div>

                            @endif

                              @if(!empty($user->staff))
                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Support")}}</span>
                                 <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('school/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
                              </div>
                              @endif
                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Offer")}}</span>
                                 <button data-address="{{ $value->job->get_location() }}" class="btn btn-success btn-hover-primary btn-sm SendOffer" id="<?=$value->id?>" data-status="<?=$value->is_confirm?>" type="button"> <i class="flaticon-medal"></i> {{__("interview.Send Offer")}}</button>
                              </div>
                              @if($value->is_confirm == 1)
                              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Action")}}</span>
                                 <div class="symbol-group symbol-hover">
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('common/interview/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                                    <i class="flaticon2-trash text-danger"></i>
                                    </a>
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
                        {!! $get_apply_job->links() !!}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="SendOfferModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("interview.Send Offer")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('school/interview/offer/submit') }}" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="job_apply_id" id="get_job_apply_id">
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label><span class="text-success"><b>{{__("interview.School ID")}}</b></span> {{ $user->school_id }}</label>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label><span class="text-success"><b>{{__("interview.City")}}</b></span> <span id="getCity"></span></label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Salary (Monthly) (¥)")}} <span class="required">*</span></label>
                     <input type="text" name="salary" required placeholder="{{__("interview.Salary (Monthly) (¥)")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label> {{__("interview.Tax(Salary)")}} <span class="required">*</span></label>
                     <select name="tax_salary_id" required class="form-control form-control-lg form-control-solid">
                        @foreach($get_tax_salary as $tax_salary)
                          <option value="{{ $tax_salary->id }}">{{ $tax_salary->getName() }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label> {{__("interview.Holidays")}} </label>
                     <textarea class="form-control form-control-lg form-control-solid" name="holiday" placeholder="{{__("interview.Holidays")}}"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label> {{__("interview.Flights")}}</label>
                     <input type="text" name="flights" placeholder="{{__("interview.Flights")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label> {{__("interview.Contract Length")}} <span class="required">*</span></label>
                     <input type="text" name="contract_length" required placeholder="{{__("interview.Contract Length")}} " class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Insurance")}}</label>
                     <input type="text" name="insurance" placeholder="{{__("interview.Insurance")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Start Date")}} <span class="required">*</span></label>
                     <input type="date" name="start_date" required placeholder="{{__("interview.Start Date")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Apartment")}}</label>
                     <input type="text" name="apartment" placeholder="{{__("interview.Apartment")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Bonus")}}</label>
                     <input type="text" name="bonus" placeholder="{{__("interview.Bonus")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("interview.Offer Expired Date")}} <span class="required">*</span></label>
                     <input type="date" name="expired_date" required placeholder="{{__("interview.Offer Expired Date")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("interview.Notes")}}</label>
                     <textarea class="form-control form-control-lg form-control-solid" name="note" placeholder="{{__("interview.Notes")}}"></textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{__("interview.Send")}}</button>
         </div>

       </form>

      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $('body').delegate('.SendOffer','click',function(){
       var id     = $(this).attr('id');
       var status = $(this).attr('data-status');
       var city   = $(this).attr('data-address');
       $('#get_job_apply_id').val(id);

       if(status == 3)
       {
          $('#getCity').html(city);
          $('#SendOfferModal').modal('show');
       }
       else
       {
          alert('Please complete the interview first, once you mark the interview as completed, you can send an offer to teacher.');
       }
   
   });
   


   
   
    $('body').delegate('.change_interview_time_status','change',function(){
    
       var id = $(this).attr('id');
       var status = $(this).val();
       $.ajax({
          url: "{{ url('school/interview/change_interview_time_status') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
              id:id,
              status:status,
           },
           dataType:"json",
           success:function(response){
               alert(response.success);
               window.location.href = '{{ url('school/interview') }}';
           },
       });
    });
    
    $('body').delegate('.ChangeInterviewConfirmStatus','change',function(){
    
       var id = $(this).attr('id');
       var status = $(this).val();
       $.ajax({
          url: "{{ url('school/interview/change_confirm_status') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
              id:id,
              status:status,
           },
           dataType:"json",
           success:function(response){
               alert(response.success);
               window.location.href = '{{ url('school/interview') }}';
           },
       });
    });
    
</script>
@endsection
