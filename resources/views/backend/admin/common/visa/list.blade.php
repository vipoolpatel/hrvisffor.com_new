@extends('backend.layouts.app')
@section('content')

<style type="text/css">
  .required {
      color: red;
  }
</style>

<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <h2  class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{__("visa.Visa List")}} 
          @if($user->is_admin == 3)
          ({{ $user->school_name }} - {{ $user->school_id }})
          @else
          ({{ $user->name }} - {{ $user->teacher_id }})
          @endif
          
        </h2>

         <a href="{{ url('admin/user/visa/add/'.$user->id) }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
            <i class="flaticon2-plus-1"></i> {{__("visa.Add Extra Visa")}}
         </a>

      </div>
   </div>

   
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
           @include('layouts._message')

         <div class="card card-custom">
            <div class="card-header py-3">
               <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">{{__("visa.Visa Information")}}</h3>
               </div>
            </div>
            <div class="card-body px-0">
               <div class="col-md-12">

                @if($user->is_admin == 3)

                   <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-3">
                           <strong>{{__("visa.Working in China System")}}</strong>


                      </div>

                        <div class="col-md-9">
                          <p>{{ !empty($user->china_system) ? $user->china_system : ''  }}</p>
                          @if($user->china_system == 'Yes')
                          <p><strong>{{__("visa.Account")}} :-</strong>  {{ $user->account_info }}  </p>
                          <p><strong>{{__("visa.Password")}} :-</strong>  {{ $user->account_info }}  </p>
                          @endif

                          

                        </div>



                  </div>

                @endif

              

                  @foreach($get_user_visa as $visa_user)
                     <div class="row" style="margin-bottom: 30px;">
                        <div class="col-md-3">
                           <strong>{{ $visa_user->visa->getName() }}</strong>

@if($user->is_admin == 4)

<select style="margin-top: 10px;" id="{{ $visa_user->id }}" class="form-control VisaAssignUser">
    <option value="">{{__("visa.Select School")}}</option>
    @foreach($get_contract_school as $value_school)
      <option {{ ($visa_user->user_assign_id == $value_school->school_id) ? 'selected' : '' }} 


        value="{{ $value_school->school->id }}">{{ $value_school->school->school_name }} ({{ $value_school->school->school_id }})</option>
    @endforeach
</select>

@elseif($user->is_admin == 3)

<select style="margin-top: 10px;" id="{{ $visa_user->id }}" class="form-control VisaAssignUser">
    <option value="">{{__("visa.Select Teacher")}}</option>
    @foreach($get_contract_teacher as $value_teacher)
      <option {{ ($visa_user->user_assign_id == $value_teacher->teacher_id) ? 'selected' : '' }} value="{{ $value_teacher->teacher->id }}">{{ $value_teacher->teacher->name }} ({{ $value_teacher->teacher->teacher_id }})</option>
    @endforeach
</select>

@endif



                        </div>
                        <div class="col-md-9">

                           @foreach($visa_user->visa->visa_info as $visa_info)
                              <p>{{ $visa_info->getName() }}</p>
                           @endforeach

                           @if(!empty($visa_user->getDocument()))
                           <div style="margin-top: 20px;">
                              <a target="_blank" href="{!! $visa_user->getDocument() !!}" class="btn-sm btn btn-warning">{{__("visa.Download")}}</a>
                           </div>
                           @endif
                           <div style="margin-top: 20px;">
                              <select class="form-control ChangeStatusVisa" id="{{ $visa_user->id }}" style="width: 120px;">
                                 @foreach($get_status as $status)
                                      <option {{ ($visa_user->status == $status->id) ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                                 @endforeach
                              </select>
                           </div>

                           @if(!empty($visa_user->reason) && $visa_user->status == 3)
                              <p style="margin-top: 10px;"><b>{{__("visa.Reject Reason")}} : </b> <span style="color: red;">{{ $visa_user->reason }}</span></p>
                           @endif

                        </div>
                     </div>
                     <hr />
                  @endforeach



              

               </div>
            </div>
         </div>





       <div class="card card-custom" style="margin-top: 20px;" >
            <div class="card-header py-3">
               <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">{{__("visa.Exatra Visa")}}</h3>
               </div>
            </div>
            <div class="card-body px-0">
               <div class="col-md-12">

                  <div class="table-responsive">
                     <table class="table table-head-custom table-vertical-center">
                        <thead>
                           <tr>
                              <th>{{__("visa.Name")}}</th>
                              <th>{{__("visa.China Name")}}</th>
                              <th>{{__("visa.Action")}}</th>
                           </tr>
                           </thead>
                           <tbody>
                                @forelse($get_teacher_record as $teacher_visa)
                                 <tr>
                                      <td>{{ $teacher_visa->name }}</td>   
                                      <td>{{ $teacher_visa->ch_name }}</td>
                                      <td>

                                         <a href="{{ url('admin/user/visa/edit/'.$teacher_visa->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm"> <i class="flaticon-edit-1"></i></a>

                                          <a href="{{ url('admin/user/visa/delete/'.$teacher_visa->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm"> <i class="flaticon2-trash"></i></a>

                                      </td>                              
                                 </tr>
                                @empty

                                <tr>
                                   <td colspan="100%">{{__("visa.Record not found.")}}</td>
                                </tr>

                                @endforelse
                           </tbody>
                     </table>
                  </div>


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
            <h5 class="modal-title" id="exampleModalLabel">{{__("visa.Reason")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/user/visa/reject') }}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="visa_id" id="get_visa_id">
           <div class="modal-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <label>{{__("visa.Reason")}} <span class="required">*</span></label>
                       <textarea name="reason" required class="form-control form-control-lg form-control-solid"></textarea>
                    </div>
                 </div>
              </div>

         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{__("visa.Reject")}}</button>
         </div>

       </form>

      </div>
   </div>
</div>






@endsection


@section('script')

<script type="text/javascript">




$('body').delegate('.VisaAssignUser','change',function(){
      var id = $(this).attr('id');
      var user_id = $(this).val();
      
      $.ajax({
         url: "{{ url('admin/user/visa_assign') }}",
         type: "POST",
         data:{
           "_token": "{{ csrf_token() }}",
             id:id,
             user_id:user_id,
          },
          dataType:"json",
          success:function(response){
              alert(response.success);
          },
      });
  
});

  
$('body').delegate('.ChangeStatusVisa','change',function(){
      var id = $(this).attr('id');
      var status = $(this).val();
      if(status == 3) {
          $('#get_visa_id').val(id)
          $('#ReasonModal').modal('show');
      }
      else
      {
          $.ajax({
             url: "{{ url('admin/user/change_visa_status') }}",
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