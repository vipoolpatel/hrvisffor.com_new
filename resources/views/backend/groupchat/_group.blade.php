


   @foreach($getUser['result'] as $user)
   <a href="javascript:;" id="{{ $user['group_id'] }}" style="padding: 10px;border-bottom: 1px solid #e3e3e3;margin-bottom: 0px !important;" class="getnewchat RemoveClassActive SocketAddClass{{ $user['group_id'] }} d-flex align-items-center justify-content-between mb-5">
      <div class="d-flex align-items-center">
         {{-- 
         <div class="symbol symbol-circle symbol-50 mr-3">
            <img alt="Pic" src="assets/media/users/300_12.jpg"/>
         </div>
         --}}
         <div class="d-flex flex-column">
            <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $user['group_name'] }}</span>
             
         </div>

                


      </div>
      <div class="d-flex flex-column align-items-end">
         <span class="text-muted font-weight-bold font-size-sm">{{ Carbon\Carbon::parse($user['timestamp'])->diffForHumans() }}</span>
          @if(!empty($user['messagecount']))
               <span id="clear_count_{{ $user['group_id'] }}">
               <span class="label label-sm label-success">{{ $user['messagecount'] }}</span>
               </span>
            @endif
      </div>
   </a>
   @endforeach