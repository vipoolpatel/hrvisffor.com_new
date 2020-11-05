
 @foreach($getUser['result'] as $user)
  @php
      $i = 1;
  @endphp

  @if(!empty($name)) 
      @php
         if(preg_match("/".$name."/i", $user['name'])  == 0 ) {
               $i = 0;
         }
      @endphp
  @endif

@if(!empty($i))
   <a href="javascript:;" class="d-flex align-items-center justify-content-between mb-5 getnewchat"
   id="{{ $user['user_id'] }}"
   data-name="{{ $user['name'] }}"
   data-senderid="{{ $sender_id }}" 
   data-schoolid="{{  $user['school_id']  }}"
   data-teacherid="{{ $user['teacher_id'] }}"
   data-schoolstaffid="{{ $user['school_staff_id'] }}"
   data-teacherstaffid="{{ $user['teacher_staff_id'] }}" 
   data-main_connect_id="{{ $user['main_connect_id'] }}" 
   >

      <div class="d-flex align-items-center">
         <div class="symbol symbol-circle symbol-50 mr-3">
            <img src="{{ $user['profile_pic'] }}" />
         </div>
         <div class="d-flex flex-column">
            <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $user['name'] }}</div>
         </div>
      </div>
      <div class="d-flex flex-column align-items-end">
         <span class="text-muted font-weight-bold font-size-sm">{{ Carbon\Carbon::parse($user['timestamp'])->diffForHumans() }}</span>
         @if(!empty($user['messagecount']))
            <span id="clear_count_{{ $user['main_connect_id'] }}">
            <span class="label label-sm label-success">{{ $user['messagecount'] }}</span>
            </span>
         @endif
      </div>
   </a>
   <!--end:User-->
@endif 

@endforeach
