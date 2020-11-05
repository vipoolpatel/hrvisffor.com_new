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
   .rating-color {
      color: orange;
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
                  {{ __('feedback.Feedback List') }}
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
            @forelse($get_feedback as $value)
            <div class="col-md-6">
               <div class="card card-custom gutter-b card-stretch">
                  <div class="card-body">
                     <div class="d-flex align-items-center">
                        <div style="width: 100%">


                  <div class="d-flex align-items-center">
                      <div class="d-flex flex-column mr-auto">
                         <a href="{{ url('teacher-profile/'.$value->user->username) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1"> {{ $value->user->teacher_id }} ({{ $value->user->name }})</a>
                         <span class="text-muted font-weight-bold">
                         {{ __('feedback.Nationality') }}: {{ !empty($value->user->nationality) ? $value->user->nationality->getName() : '' }}
                         </span>
                      </div>
                   </div>

                   <hr />

                  
                           <div class="row form-group">
                              <div class="col-md-3 text-primary font-weight-bold">{{ __('feedback.Title') }} </div>
                              <div class="col-md-9">{{ $value->title }}</div>
                           </div>
                           <div class="row form-group">
                              <div class="col-md-3 text-primary font-weight-bold">{{ __('feedback.Review') }}</div>
                              <div class="col-md-9">
                                 {{ $value->review }}
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="col-md-3 text-primary font-weight-bold">{{ __('feedback.Photo') }} </div>
                              <div class="col-md-9">
                                 <div class="row">
                                    @foreach($value->get_image as $image)
                                    @if(!empty($image->getImage()))
                                    <div class="col-md-4">
                                       <img style="width: 100%;height: 100px;margin-bottom: 10px;border-radius: 6px;" src="{{ $image->getImage() }}">
                                    </div>
                                    @endif
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="col-md-3 text-primary font-weight-bold">{{ __('feedback.Video') }} </div>
                              <div class="col-md-9">
                                 @if($value->getVideo())
                                 <video width="100%" controls>
                                    <source  src="{{ $value->getVideo() }}" type="video/mp4">
                                 </video>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex flex-wrap">
                        <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                           <span class="font-weight-bolder mb-4">{{ __('feedback.Action') }}</span>
                           <div class="symbol-group symbol-hover">

                              <a class="btn btn-icon btn-light btn-hover-primary btn-sm EditFeedback" style="margin-right: 10px;" id="{{ $value->id }}" > <i class="flaticon-edit-1"></i> </a>

                              <a onclick="return confirm('{{ __('feedback.Are you sure you want to delete?') }}')" href="{{ url('admin/feedback/delete/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-danger btn-sm"> <i class="flaticon2-trash text-danger"></i> </a>
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
                  {!! $get_feedback->links() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade FeedbackModal" id="FeedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

@endsection
@section('script')
<script type="text/javascript">
   $('body').delegate('.EditFeedback','click',function(){
   
      var id = $(this).attr('id');
    
      $.ajax({
         url: "{{ url('admin/feedback/edit') }}",
         type: "POST",
         data:{
           "_token": "{{ csrf_token() }}",
             id:id,
          },
          dataType:"json",
          success:function(response){
             $('.FeedbackModal').html(response.success);
             $('#FeedbackModal').modal('show');
          },
      });
   });
   
   


   var i = 1;
   $('body').delegate('#AddMorePhoto','click',function(){
      var html = '<div class="row" id="RemoveImage'+i+'" ><div class="col-md-6">\n\
            <div class="form-group">\n\
               <input class="form-control form-control-lg form-control-solid" type="file" required name="photo[]">\n\
               <a href="javascript:;" id="'+i+'" class="btn btn-danger btn-sm RemoveImageDelete" style="margin-top: 10px;">{{ __('feedback.Delete') }}</a>\n\
            </div>\n\
         </div></div>';

      $('#appendPhoto').append(html);
   });

   $('body').delegate('.RemoveImageDelete','click',function(){
         var id = $(this).attr('id');
         $('#RemoveImage'+id).remove();
   });   
   
   
   
</script>
@endsection

