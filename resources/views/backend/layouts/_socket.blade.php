
@if(Auth::check())


<audio controls id="music" style="display: none;">
    <source src="{{ url('upload/mp3/notification.mp3') }}" type="audio/mpeg">
</audio>

<script src="{{ url('assets/js/moment-timezone.min.js') }}"></script>

{{-- <script src="https://hrvisffor.com:3500/socket.io/socket.io.js"></script> --}}

<script src="http://localhost:3500/socket.io/socket.io.js"></script>



<script type="text/javascript">
	
	// liveserver
	// var app_base_url = 'https://hrvisffor.com:3500';

	// localhost
	var app_base_url = 'http://localhost:3500';

	var socket = io.connect(app_base_url);

	socket.on('connect', function(data) {
	  @if(Auth::check())
	      socket.emit('UpdateSocket', '{"user_id":"{{ Auth::user()->id }}", "auth_token":"{{ Auth::user()->token }}"}');
	  @endif
	});

	var myMusic = document.getElementById("music");


 	socket.on('UpdateSocket', function(data) {
        console.log(data);
    });



	// private chat part

 	socket.on('app_chat', function(data) {
 		if(data.status) {	

 			var sender_id = "{{ Auth::user()->id }}";
			var receiver_id = $('#get_receiver_id_chat').val();

			var get_history = $('#get_history').val();

			var api_receiver_id = data.result.sender_id;
			var api_sender_id = data.result.receiver_id;

			if(parseInt(sender_id) == parseInt(api_sender_id) && parseInt(receiver_id) == parseInt(api_receiver_id)) {
				var date =  moment.unix(data.result.timestamp);
				var create_date =  date.fromNow(); 


				var html = '<div class="d-flex flex-column mb-5 align-items-start">\n\
			            <div class="d-flex align-items-center">\n\
			               <div>\n\
			                  <span class="text-muted font-size-sm">'+create_date+'</span>\n\
			               </div>\n\
			            </div>\n\
			            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">\n\
			              '+data.result.message+'\n\
			            </div>\n\
			         </div>';

			    $('#getMessageAppend').append(html);

				$(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);

				$.ajax({
	                url: "{{ url('update_private_message_count') }}",
	                type: "POST",
	                data:{
	                 "_token": "{{ csrf_token() }}",
	                   receiver_id:receiver_id,
	                },
	                dataType:"json",
	                success:function(response){

	                },
	            });


			}
			else {
				
					$.ajax({
		                url: "{{ url('get_private_chat_user') }}",
		                type: "POST",
		                data:{
		                 "_token": "{{ csrf_token() }}"	,
		                 sender_id:sender_id
		                },
		                dataType:"json",
		                success:function(response){
		                	if(get_history == '')
							{
		                		$('#getChatUserChat').html(response.success)
	                		}
		                	$('#CountPrivateMessageCount').html(response.messagecount)
		                },
		            });
				
					$('#ShowPrivateChatMessageHeader').show();

				myMusic.play();			
			}
 		}
 	});

 	// end private chat part

















 	// chat part

 	socket.on('app_private_chat_send', function(data) {


 		if(data.status) {	

 			// console.log(data.result);


			var sender_id = "{{ Auth::user()->id }}";
			var receiver_id = $('#get_receiver_id_chat').val();
			var main_connect_id = $('#get_main_connect_id_chat').val();
			

			var api_receiver_id = data.result.sender_id;
			var api_sender_id = data.result.receiver_id;

			var api_main_connect_id = data.result.main_connect_id;

			var get_history = $('#get_history').val();

			// console.log(sender_id);
			// console.log(receiver_id);

			// console.log(api_sender_id);
			// console.log(api_receiver_id);

			if(parseInt(sender_id) == parseInt(api_sender_id) && parseInt(receiver_id) == parseInt(api_receiver_id) && parseInt(main_connect_id) == parseInt(api_main_connect_id)) {

				// var date = new Date(data.result.timestamp * 1000);
				// var dec = moment(date);
				var date =  moment.unix(data.result.timestamp);
				var create_date =  date.fromNow(); 

				var html = '<div class="d-flex flex-column mb-5 align-items-start">\n\
			            <div class="d-flex align-items-center">\n\
			               <div>\n\
			                  <span class="text-muted font-size-sm">'+create_date+'</span>\n\
			               </div>\n\
			            </div>\n\
			            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">\n\
			              '+data.result.message+'\n\
			            </div>\n\
			         </div>';

			    $('#getMessageAppend').append(html);

			    

				$(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);

				$.ajax({
	                url: "{{ url('update_message_count') }}",
	                type: "POST",
	                data:{
	                 "_token": "{{ csrf_token() }}",
	                   receiver_id:receiver_id,
	                   main_connect_id:api_main_connect_id,
	                },
	                dataType:"json",
	                success:function(response){

	                },
	            });
			}
			else
			{	

			 	
			 		$.ajax({
		                url: "{{ url('get_chat_user') }}",
		                type: "POST",
		                data:{
		                 "_token": "{{ csrf_token() }}", 
		                 sender_id:sender_id,             
		                },
		                dataType:"json",
		                success:function(response){
		                	if(get_history == "") {
		                		$('#getChatUserChat').html(response.success)
	                		}
		                	$('#CountDashabordMessage').html(response.messagecount)
		                },
		            });
			 	
			 		$('#ShowChatMessageHeader').show();
				
	            myMusic.play();
			}
 		}
 		else {

 		}        
    });


 	// group

 	socket.on('app_group_message_send', function(data) {
		if(data.status) {	
			 // console.log(data);
			var api_group_id = data.result.group_id;

			var api_chat_id = data.result.id;

			var group_id 	 = $('#getGroupID').val();

			var sender_name = data.result.sender_name;
			var message 	= data.result.message;
			var date 		= moment.unix(data.result.timestamp);
			var create_date = date.fromNow();

			var sender_id = "{{ Auth::user()->id }}";
			var app_sender_id = data.result.sender_id;


			if((parseInt(api_group_id) == parseInt(group_id)) && (parseInt(app_sender_id) != parseInt(sender_id))) {

                var html = '<div class="d-flex flex-column mb-5 align-items-start">\n\
	               <div class="d-flex align-items-center">\n\
	               <div>\n\
	                     <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">'+ sender_name +'</a>\n\
	                     <span class="text-muted font-size-sm">'+ create_date +'</span>\n\
	                  </div>\n\
	               </div>\n\
	               <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">\n\
	                 '+ message +'\n\
	               </div>\n\
	            </div>';
               
                $('#getMessageAppend').append(html);  
	            $('.RemoveClassActive').removeClass('active');

    			$('.SocketAddClass'+group_id).addClass('active');

                $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);   



       		 	$.ajax({
	                url: "{{ url('update_group_message_count') }}",
	                type: "POST",
	                data:{
	                 "_token": "{{ csrf_token() }}",
	                   chat_id:api_chat_id,
	                   group_id:api_group_id,
	                },
	                dataType:"json",
	                success:function(response){

	                },
	            });


			}
			else 
			{

			    if(parseInt(app_sender_id) != parseInt(sender_id)) {
					$.ajax({
			            url: "{{ url('get_chat_group') }}",
			            type: "POST",
			            data:{
			             "_token": "{{ csrf_token() }}"	                  
			            },
			            dataType:"json",
			            success:function(response){
	            			$('#getChatUserChat').html(response.success);
			            	$('.RemoveClassActive').removeClass('active');
							$('.SocketAddClass'+group_id).addClass('active');			        	 
			        	 	myMusic.play();
			            },
			        });
				}	         	
			}
		}
	});


	// add new member
	socket.on('app_add_group_member', function(data) {

		$.ajax({
            url: "{{ url('get_chat_group') }}",
            type: "POST",
            data:{
             "_token": "{{ csrf_token() }}"	                  
            },
            dataType:"json",
            success:function(response){
        	 	$('#getChatUserChat').html(response.success);
        	 	myMusic.play();
            },
        });

	});


</script>

@endif