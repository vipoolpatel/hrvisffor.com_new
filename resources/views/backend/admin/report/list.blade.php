@extends('backend.layouts.app')
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
                  
                  {{__("report.Report List")}}                               
               </h2>
               <!--end::Title-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
      </div>
   </div>
   <!--end::Subheader-->








 <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
         <div class="row">

@forelse($get_report as $value)


<div class="col-md-6">
   <div class="card card-custom gutter-b card-stretch">
      <div class="card-body">
         <div class="d-flex align-items-center">
            <div style="width: 100%">

               @if($value->user->is_admin == 3)
                   <div class="d-flex align-items-center">
                     <div class="d-flex flex-column mr-auto">
                        <a href="javascript:;" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->user->school_name }} ({{ $value->user->school_id }})</a>
                     </div>
                  </div>
               @else
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column mr-auto">
                     <a href="{{ url('teacher-profile/'.$value->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $value->user->name }} ({{ $value->user->teacher_id }})</a>
                  </div>
               </div>
               @endif
               <hr>
               <div class="row form-group">
                  <div class="col-md-4 text-primary font-weight-bold">{{__("report.Name")}}</div>
                  <div class="col-md-8">{{ $value->name }}</div>
               </div>
            
               <div class="row form-group">
                  <div class="col-md-4 text-primary font-weight-bold">{{__("report.Email")}}</div>
                  <div class="col-md-8">{{ $value->email }}</div>
               </div>
               <div class="row form-group">
                  <div class="col-md-4 text-primary font-weight-bold">{{__("report.Phone")}}</div>
                  <div class="col-md-8">{{ $value->phone }}</div>
               </div>
               <div class="row form-group">
                  <div class="col-md-4 text-primary font-weight-bold">{{__("report.Title")}}</div>
                  <div class="col-md-8">{{ $value->title }}</div>
               </div>
               <div class="row form-group">
                  <div class="col-md-4 text-primary font-weight-bold">{{__("report.Description")}}</div>
                  <div class="col-md-8">{{ $value->description }}</div>
               </div>
               @if($value->status == 3)
               <div class="row form-group">
                  <div class="col-md-4 text-danger font-weight-bold">{{__("report.Reject Rason")}}</div>
                  <div class="col-md-8">{{ $value->reason }}</div>
               </div>
               @endif
            </div>
         </div>
         <div class="d-flex flex-wrap">
            <div class="mr-12 d-flex flex-column mb-7">
               <span class="font-weight-bolder mb-4">{{__("report.Status")}}</span>
               <select class="form-control ChangeReportStatus" id="{{ $value->id }}">
                   @foreach($get_status as $status)
                     <option {{ ($value->status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                   @endforeach
                </select>


            </div>
      
            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
               <span class="font-weight-bolder mb-4">{{__("report.Action")}}</span>
               <div class="symbol-group symbol-hover">
                  <a onclick="return confirm('{{__("report.Are you sure you want to delete?")}}')" href="{{ url('admin/report/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm">
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
                    {!! $get_report->links() !!}
                 </div>
              </div>
            </div>

      </div>
   </div>
</div>


<div class="modal fade" id="ReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("report.Reason")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/report/reject') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id" id="get_report_id">
           <div class="modal-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <label>{{__("report.Reason")}} <span style="color: red" class="required">*</span></label>
                       <textarea name="reason" required class="form-control form-control-lg form-control-solid"></textarea>
                    </div>
                 </div>
              </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{__("report.Reject")}}</button>
         </div>

       </form>

      </div>
   </div>
</div>



@endsection

@section('script')

<script type="text/javascript">    



$('body').delegate('.ChangeReportStatus','change',function(){

   var id = $(this).attr('id');
   var status = $(this).val();
   if(status == 3)
   {

      $('#get_report_id').val(id);    
      $('#ReasonModal').modal('show');  
   }
   else
   {
       $.ajax({
          url:"{{url('admin/report/change_report_status')}}",
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
   }
   
});


</script>


@endsection
