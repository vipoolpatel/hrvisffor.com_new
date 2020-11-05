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
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
               id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                {{ __('interview.Interviews') }}                
               </h2>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class="container">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_shcool_teacher')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="row">
                  @forelse($get_apply_job as $value)
                  <div class="col-md-6">
                     <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="d-flex flex-column mr-auto">
                                 <a href="{{ url('school-profile/'.$value->job->slug) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->job->user->school_id }} ({{ $value->job->get_school_type->getName() }})</a>
                                 <span class="text-muted font-weight-bold">
                                 Salary: @if(!empty($value->job->get_salary_minimum)) {{ $value->job->get_salary_minimum->name }} - @endif  @if(!empty($value->job->get_salary_maximum)) {{ $value->job->get_salary_maximum->name }} @endif
                                 </span>
                              </div>
                           </div>
                           <div class="d-flex flex-wrap mt-14" style="margin-top: 19px !important;">
                              <table class="interview-table">
                                 <tr>
                                    <th>{{ __('interview.Interview Time') }}</th>
                                    <th>{{ __('interview.Duration') }}</th>
                                    <th>{{ __('interview.Status') }}</th>
                                    @if($value->is_confirm != 3)
                                    <th>{{ __('interview.Join') }}</th>
                                    @endif
                                 </tr>
                                 @forelse($value->get_interview_time as $interview_time)
                                 <tr>
                                    <td><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ date('Y-m-d h:i A',$interview_time->interview_date_time) }}</span></td>
                                    <td><span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $interview_time->duration }} {{ __('interview.min') }}</span></td>

                                    <td>
                                       @if($value->type == 'school' && $value->is_confirm != 3)
                                          @if(!empty($value->interview_time_book_count()))
                                            @if($interview_time->status == 1)
                                               <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ __('interview.Unconfirmed') }}</span>
                                            @elseif($interview_time->status == 2)
                                               <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ __('interview.Confirmed') }}</span>
                                            @endif
                                          @else
                                            <select class="form-control change_interview_time_status" id="{{ $interview_time->id }}">
                                               <option {{ ($interview_time->status == '1') ? 'selected' : '' }} value="1">{{ __('interview.Unconfirmed') }}</option>
                                               <option {{ ($interview_time->status == '2') ? 'selected' : '' }} value="2">{{ __('interview.Confirmed') }}</option>
                                            </select>
                                          @endif
                                       @else

                                          @if($interview_time->status == 1)
                                             <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ __('interview.Unconfirmed') }}</span>
                                             @elseif($interview_time->status == 2)
                                             <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ __('interview.Confirmed') }}</span>
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

                              @if($value->type == 'school')

                                <div class="mr-12 d-flex flex-column mb-7">
                                    <span class="font-weight-bolder mb-4">{{ __('interview.Status') }}</span>
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
                                    <span class="font-weight-bolder mb-4">{{ __('interview.Progress') }}</span>
                                    <span class="btn {{ $value->confirm->class }} btn-sm font-weight-bold btn-upper btn-text">{{ $value->confirm->name }}</span>
                                 </div>

                              @endif




                             
                              @if(!empty($user->staff))
                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{ __('interview.Support') }}</span>
                                 <a class="btn btn-light btn-hover-primary btn-sm" href="{{ url('teacher/support') }}"> <i class="flaticon-speech-bubble"></i> {{ $user->staff->name }}</a>
                              </div>
                              @endif
                              @if($value->is_confirm == 1)
                              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                 <span class="font-weight-bolder mb-4">{{ __('interview.Action') }}</span>
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
@endsection
@section('script')

<script type="text/javascript">
   
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
               window.location.href = '{{ url('teacher/interview') }}';
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
              window.location.href = '{{ url('teacher/interview') }}';
           },
       });
    });


</script>

@endsection