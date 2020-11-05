@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
   margin-bottom: 8px;
   }
   .required {
   color: red;
   }
   select {
   -moz-appearance:none; /* Firefox */
   -webkit-appearance:none; /* Safari and Chrome */
   appearance:none;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">New Feedback</h2>
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
               <div class="card card-custom card-stretch">
                  <div class="card-header py-3">
                     <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">New Feedback</h3>
                     </div>
                  </div>
                  





<form class="form" method="post" action="" enctype="multipart/form-data">

   {{ csrf_field() }}

   <div class="card-body" style="padding-top: 10px;">
     
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">Title <span class="required">*</span></label>
               <input type="text" name="title" value="" required placeholder="Title" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label  class="col-form-label">Review <span class="required">*</span></label>
               <textarea placeholder="Minimum 50 words" minlength="50" required name="review" class="form-control form-control-lg form-control-solid"></textarea>
            </div>
         </div>
      </div>

       <div class="row">
         <div class="col-md-12">
            <div class="form-group">
                 <label style="display: block;"  class="col-form-label">Photo (Minimum 1 Photo) <span class="required">*</span>
                  <a href="javascript:;" class="btn btn-sm btn-success" id="AddMorePhoto">Add More Photo</a>
            </div>
         </div>
      </div>

       <div class="row">
           <div class="col-md-6" style="margin-bottom: 10px;">
               <div class="form-group">
                  <input type="file" class="form-control form-control-lg form-control-solid" required name="photo[]">
               </div>
            </div>
            
      </div>

      <div id="appendPhoto"></div>



        <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">Video  <span class="required">*</span></label>
                <input type="file" required class="form-control form-control-lg form-control-solid" name="video_url">
            </div>
         </div>
      </div>


      <div class="form-group row">
         <div class="col-lg-12 col-xl-12 text-right">
            <br>
            <button type="submit" class="btn btn-success mr-2">Save</button>
         </div>
      </div>
   </div>
   
</form>



               </div>
            </div>
         </div>
      </div>
   </div>
   
</div>
@endsection
@section('script')


<script type="text/javascript">
   var i = 1;
   $('#AddMorePhoto').click(function() {
      var html = '<div class="row" id="RemoveImage'+i+'" ><div class="col-md-6">\n\
            <div class="form-group">\n\
               <input class="form-control form-control-lg form-control-solid" type="file" required name="photo[]">\n\
               <a href="javascript:;" id="'+i+'" class="btn btn-danger btn-sm RemoveImageDelete" style="margin-top: 10px;">Delete</a>\n\
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
