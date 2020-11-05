<div class="modal-dialog" role="document">
  <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('chat.Leave Member') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
        </button>
     </div>

    <form action="" id="LeavMemberForm" enctype="multipart/form-data" method="post">
       {{ csrf_field() }}
       <input type="hidden" id="LeaveGroupID" required name="group_id" value="{{ $group_id }}">
       <input type="hidden" required name="token" value="{{ Auth::user()->token }}">
       
     <div class="modal-body">

        <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label>{{ __('chat.Select Member') }} <span style="color: red" class="required">*</span></label>
                  <select class="form-control" id="LeavMemberMemberID" required="">
                      <option value="">{{ __('chat.Select') }}</option>
                      @foreach($getUser as $value)
                          @if($value->is_admin == 3)
                              <option value="{{ $value->id }}">{{ $value->school_name }} ({{ $value->school_id }})</option>
                          @else
                            <option value="{{ $value->id }}">{{ $value->name }} @if(!empty($value->teacher_id)) ({{ $value->teacher_id }}) @endif </option>  
                          @endif
                      @endforeach
                  </select>
              </div>
           </div>
        </div>

     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-success font-weight-bold">{{ __('chat.Leave') }}</button>
     </div>

   </form>

  </div>
</div>