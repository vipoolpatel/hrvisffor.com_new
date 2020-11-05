<div class="modal-dialog" role="document">
    <form action="" method="post" id="SubmitPermission">
           {{ csrf_field() }}
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('profile.Permission') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row checkbox-inline">
                	@foreach($permission as $value)

                	   <div class="col-md-6" style="margin-bottom: 2px;"><label class="checkbox"><input {{ ( $value->count($user_id) > 0 ) ? 'checked' : '' }} value="{{ $value->id }}" type="checkbox" name="permission_id[]"><span></span> {{ $value->name }}</label></div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="box-shadow: none;" class="btn btn-primary font-weight-bold">{{ __('profile.Save') }}</button>
            </div>
        </div>
    </form>
</div>