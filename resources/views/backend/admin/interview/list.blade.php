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
                {{__("interview.Interview List")}}
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


            @forelse($get_apply_job as $value)
                  <div class="col-md-6">
                     <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="d-flex flex-column mr-auto">
                                 <a href="{{ url('school-profile/'.$value->job->slug) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->job->user->school_id }} ({{ $value->job->get_school_type->getName() }})</a>
                                 <span class="text-muted font-weight-bold">
                                 {{__("interview.Salary")}}: @if(!empty($value->job->get_salary_minimum)) {{ $value->job->get_salary_minimum->name }} - @endif  @if(!empty($value->job->get_salary_maximum)) {{ $value->job->get_salary_maximum->name }} @endif
                                 </span>
                                 <span class="text-muted font-weight-bold">
                                 {{__("interview.Location")}}: @if(!empty($value->job->get_location())) {{ $value->job->get_location() }} @endif 
                                 </span>
                              </div>
                           </div>
                           <hr />
                           <div class="d-flex align-items-center">
                              <div class="d-flex flex-column mr-auto">
                                 <a href="{{ url('teacher-profile/'.$value->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->user->teacher_id }} ({{ $value->user->name }})</a>
                                 <span class="text-muted font-weight-bold">
                                 {{__("interview.Nationality")}}: {{ !empty($value->user->nationality) ? $value->user->nationality->getName() : '' }}
                                 </span>
                              </div>
                           </div>

                           <hr />
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
                                        @if($interview_time->status == 1)
                                            <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{__("interview.Unconfirmed")}}</span>
                                        @elseif($interview_time->status == 2)
                                            <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{__("interview.Confirmed")}}</span>
                                        @endif
                                         
                                    </td>
                                    @if($value->is_confirm != 3)
                                    <td class="text-center">
                                       @if($interview_time->status == 2)
                                          <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
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

                            <span id="getNote{{ $value->id }}">{{  $value->note }}</span>

                            <a href="javascript:;" id="{{ $value->id }}" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm ChangeNote"><i class="flaticon-edit-1"></i></a>

                           </p>
                           <div class="d-flex flex-wrap">

                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Created By")}}</span>
                                 <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text" style="text-transform: capitalize;">{{ $value->type }}</span>
                              </div>

                               <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">@if($value->type == 'school') {{__("interview.Teacher")}} @else {{__("interview.School")}} @endif {{__("interview.Confirm Status")}}</span>
                                 <span class="btn {{ $value->confirm->class }} btn-sm font-weight-bold btn-upper btn-text">{{ $value->confirm->name }}</span>
                              </div>




                              <div class="mr-12 d-flex flex-column mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Status")}}</span>
                                 <select class="form-control ChangeInterviewStatus" id="{{ $value->id }}">
                                    @foreach($get_status as $status)
                                      <option {{ ($value->status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                         

                              <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                 <span class="font-weight-bolder mb-4">{{__("interview.Action")}}</span>
                                 <div class="symbol-group symbol-hover">
                                    
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('common/interview/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                                    <i class="flaticon2-trash text-danger"></i>
                                    </a>
                                    
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
                    {!! $get_apply_job->links() !!}
                 </div>
              </div>
            </div>



      </div>
   </div>
</div>


<div class="modal fade" id="UpdateNotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("interview.Update Note")}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
          <form action="" method="post" id="UpdateNoteForm">
             {{ csrf_field() }}
            <div class="modal-body">
                <label>{{__("interview.Note")}}</label>
                <input type="hidden" name="id" id="getInterviewID">
                <textarea name="note" required id="getNote" rows="10" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary font-weight-bold">{{__("interview.Save")}}</button>
            </div>
          </form>
        </div>
    </div>
</div>



@endsection
@section('script')

<script type="text/javascript">

$('body').delegate('.ChangeNote','click',function(){
      var id = $(this).attr('id');
      var text = $('#getNote'+id).html();
      $('#getInterviewID').val(id);
      $('#getNote').val(text);
      $('#UpdateNotesModal').modal('show');
});



$('#UpdateNotesModal').delegate('#UpdateNoteForm','submit',function(e){
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "{{ url('admin/interview/note_update') }}",
          data: $(this).serialize(),
          dataType: "json",
          success: function (data) {
              $('#getNote'+data.id).html(data.note);
              alert(data.success);
              $('#UpdateNotesModal').modal('hide');

          },
          error: function (data) {
          }
      });
});





$('body').delegate('.ChangeInterviewStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   $.ajax({
      url: "{{ url('admin/interview/change_status') }}",
      type: "POST",
      data:{
        "_token": "{{ csrf_token() }}",
          id:id,
          status:status,
       },
       dataType:"json",
       success:function(response){
           alert(response.success);
       },
   });
});

</script>

@endsection