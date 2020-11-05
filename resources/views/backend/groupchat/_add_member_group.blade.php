<div class="modal-dialog" role="document">
  <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('chat.Add New Member') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
        </button>
     </div>

    <form action="" id="AddNewMemberForm" enctype="multipart/form-data" method="post">
       {{ csrf_field() }}
       <input type="hidden" id="getAddGroupID" required name="group_id" value="{{ $group_id }}">
       <input type="hidden" id="getAddGroupName" required name="group_name" value="{{ $group->group_name }}">
       <input type="hidden" required name="token" value="{{ Auth::user()->token }}">
       
     <div class="modal-body">

        <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                @foreach($getUser as $member)
                  <label class="checkbox" style="margin-bottom: 5px;">
                      <input class="SelectMemberAdd" value="{{ $member->id }}" type="checkbox" ><span style="margin-right: 10px;"></span> 
                      @if($member->is_admin == 3)
                          {{ $member->school_name }} ({{ $member->school_id }})
                      @else
                          {{ $member->name }}  @if(!empty($value->teacher_id)) ({{ $member->teacher_id }}) @endif
                      @endif
                  </label>          
                @endforeach

                 <span id="getSearchMemberAlreadyHTML"></span>

              </div>

               <div class="form-group">
                   <label>{{ __('chat.Search ID/Name ') }}</label>
                   <input type="text" class="form-control" id="SearchMemberAlready" placeholder="{{ __('chat.Search Member') }}"  >
                </div>

                <span id="getSearchAlreadyMember"></span>


           </div>
        </div>

     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-success font-weight-bold">{{ __('chat.Add') }}</button>
     </div>

   </form>

  </div>
</div>