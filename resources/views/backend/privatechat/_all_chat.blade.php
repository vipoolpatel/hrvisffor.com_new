
@if(!empty($chat))

  <div class="card-body">
      <div class="scroll scroll-pull blank-space" data-mobile-height="350">
        <div class="messages" id="getMessageAppend" style="margin-right: 6px;">

        @foreach($chat as $value)

        @if(Auth::user()->id == $value->sender_id)

            <div class="d-flex flex-column mb-5 align-items-end">
              <div class="d-flex align-items-center">
                 <div>
                    <span class="text-muted font-size-sm">{{ Carbon\Carbon::parse($value->created_date)->diffForHumans() }}</span>
                 </div>
              </div>
              <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                {{ $value->message }}
              </div>
           </div>
      
        @else

          <div class="d-flex flex-column mb-5 align-items-start">
              <div class="d-flex align-items-center">
                 <div>
                    <span class="text-muted font-size-sm">{{ Carbon\Carbon::parse($value->created_date)->diffForHumans() }}</span>
                 </div>
              </div>
              <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                {{ $value->message }}
              </div>
           </div>

        @endif


        @endforeach
     
        </div>
     </div>
  </div>

@if(empty($history))

  <div class="card-footer align-items-center">
     <form action="" method="post" id="SubmitReply">
          {{ csrf_field() }}
          <input type="hidden" name="sender_id" value="{{ $sender_id }}">
          <input type="hidden" id="get_receiver_id_chat" name="receiver_id" value="{{ $receiver_id }}">
          <input type="hidden" name="token"  value="{{ Auth::user()->token }}">
          <textarea id="chat-message" name="message" class="form-control border-0 p-0" required rows="2" placeholder="{{ __('chat.Type a message') }}"></textarea>
          <div class="d-flex align-items-center justify-content-between mt-5">
             <div class="mr-3"></div>
             <div><button type="submit" id="DisEnaSendMessage" class="btn btn-success btn-md text-uppercase font-weight-bold chat-send py-2 px-6">{{ __('chat.Send') }}</button></div>
          </div>
     </form>   
  </div>
  
@endif

@else 


<div class="card-body">
   <div class="scroll scroll-pull" data-mobile-height="350">
      <div class="messages text-center">
            <i class="flaticon-speech-bubble icon-4x text-success"></i>
            <h2>{{ __('chat.Select a Conversation') }}</h2>
            <h4>{{ __('chat.Try selecting a conversation or searching for someone specific.') }}</h4>
      </div>      
   </div>
</div>


@endif