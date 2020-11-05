@if(!empty($getRecord))
	<div class="form-group">
		@foreach($getRecord as $value)
	   	    <label class="col-md-12" style="margin-bottom: 5px;">
	   	    	 @if($value->is_admin == 3)
		        	<a href="javascript:;" id="{{ $value->id }}" data-val="{{ $value->school_name }} ({{ $value->school_id }})" class="btn btn-success btn-sm AssignAlreadyMemberGroup">{{ __('chat.Add') }}</a> 		       
		        	{{ $value->school_name }} ({{ $value->school_id }})
	        	@else
	        		<a href="javascript:;" id="{{ $value->id }}" data-val="{{ $value->name }}  @if(!empty($value->teacher_id)) ({{ $value->teacher_id }}) @endif" class="btn btn-success btn-sm AssignAlreadyMemberGroup">{{ __('chat.Add') }}</a> 
	        		{{ $value->name }}  @if(!empty($value->teacher_id)) ({{ $value->teacher_id }}) @endif
		        @endif
		    </label>
		@endforeach
	</div>
@endif