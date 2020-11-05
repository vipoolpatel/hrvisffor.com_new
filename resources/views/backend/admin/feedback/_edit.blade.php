 <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('feedback.Edit Feedback') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/feedback/update') }}" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id"  value="{{ $feedback->id }}">
         <div class="modal-body">




    <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label  class="col-form-label">{{ __('feedback.Title') }} <span class="required">*</span></label>
               <input type="text" name="title" value="{{ $feedback->title }}"  placeholder="{{ __('feedback.Title') }}" class="form-control form-control-lg form-control-solid">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label  class="col-form-label">{{ __('feedback.Review') }} <span class="required">*</span></label>
               <textarea placeholder="{{ __('feedback.Minimum 50 words') }}" minlength="50"  name="review" class="form-control form-control-lg form-control-solid">{{ $feedback->review }}</textarea>
            </div>
         </div>
      </div>

       <div class="row">
         <div class="col-md-12">
            <div class="form-group">
                 <label style="display: block;"  class="col-form-label">{{ __('feedback.Photo (Minimum 1 Photo)') }} <span class="required">*</span>
                  <a href="javascript:;" class="btn btn-sm btn-success" id="AddMorePhoto">{{ __('feedback.Add More Photo') }}</a>
            </div>
         </div>
      </div>

       <div class="row">
           <div class="col-md-6" style="margin-bottom: 10px;">
               <div class="form-group">
                  <input type="file" class="form-control form-control-lg form-control-solid"  name="photo[]">
               </div>
            </div>
            
      </div>

      <div id="appendPhoto"></div>


      <div class="row">
          @foreach($feedback->get_image as $image)
            @if(!empty($image->getImage()))
               <div class="col-md-2">
                  <img style="width: 100%;height: 100px;margin-bottom: 10px;border-radius: 6px;" src="{{ $image->getImage() }}">
               </div>
            @endif
         @endforeach
      </div>


        <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label  class="col-form-label">{{ __('feedback.Video') }}  <span class="required">*</span></label>
                <input type="file"  class="form-control form-control-lg form-control-solid" name="video_url">
                  @if($feedback->getVideo())
                     <video width="100%" controls>
                        <source src="{{ $feedback->getVideo() }}" type="video/mp4">
                     </video>
                  @endif
            </div>
         </div>
      </div>


         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{ __('feedback.Update') }}</button>
         </div>

       </form>

      </div>
   </div>