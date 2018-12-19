var base_url =''; 
var chatting_user = 0;
var userToken = '';
var chatting_room = 0;
var chatting_user_info = {};
var myId;
var tempMessageId = 0;
var isViewPinnedMess = 0;
$(document).ready(function(){
    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });
    myId = $("#profile").attr('my-id');

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
    $("#contacts").toggleClass("expanded");
});
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
    getListMessage(2);
	base_url = $("#base-url").html();
	registerFirebase();


    $('.messages').scroll(function (event) {
        var scroll = $(this).scrollTop();
        if(scroll == 0){
            getListMessageRoom(chatting_room,$(".message-wraper li:first-child").attr('id-message'),'add');
        }
    });

	$("#search-user").keyup(function(){
		searchUser($(this).val());
	});

	$(document).on('click', '.contact', function(event) {
        isViewPinnedMess = 0;
		console.log('chatting user : ',chatting_user);
        $(".contact").removeClass('active');
        $(this).addClass('active');
		var selected_user = $(this).attr('id-user');
        if(selected_user){
            chatting_user = selected_user;
            $.get( base_url+"get_info_user/"+chatting_user, function( data ) {
                data = JSON.parse(data)[0];
                $(".content .contact-profile img").attr('src',base_url+'images/'+data.avatar);
                $(".content .contact-profile p").html('<b>'+data.name+'</b>');
                chatting_user_info = data;
            });
            getListMessage(selected_user);
        }else{
            chatting_room = $(this).attr('id-room');
             $.get( base_url+"get_info_room/"+chatting_room, function( data ) {
                data = JSON.parse(data)[0];
                $(".content .contact-profile img").attr('src',base_url+'images/'+data.image);
                $(".content .contact-profile p").html('<b>'+data.name+'</b>');
                chatting_user_info = data;
            });
            getListMessageRoom(chatting_room);
        }

        if(!$(this).find('.unread-count').hasClass('.d-none')){
            markSeenMessageEvent();
        }
		
	});

	
	$('#message-input').keyup(function(e){
	     if(e.keyCode == 13)
	    {
	    	console.log('enter input message: ',$(this).val());
			sendMessage($(this).val());
	    }
	});

    getAllRoom();
    // $(".")
});



function searchUser(searchQuery) {
	if(searchQuery){
			$.get( base_url+"get_list_user/"+searchQuery, function( data ) {
			 	$("#contacts").html(data);
			});
		}else{
	}
}


function getListMessage(userId,lastIdMessage=0) {
	if(userId!=0){
        $.get( base_url+"get_list_message/"+userId+'/'+lastIdMessage, function( data ) {
            data = JSON.parse(data);
            console.log(data);
            chatting_room = data.roomId;
            
                $(".message-wraper").html('');
                $(".message-wraper").prepend('<ul>'+data.listMessage+'</ul>');
                if(lastIdMessage == 0){
                    scroll_bottom_chat();
                }
            // $(".content .messages").animate({ scrollTop:10}, 200);
        });
    }
}


function registerFirebase () {
   var config = {
    apiKey: "AIzaSyANSpJtaRMw3mgxmQaWRfDogmG1w8lekT8",
    authDomain: "chat-e0e90.firebaseapp.com",
    databaseURL: "https://chat-e0e90.firebaseio.com",
    projectId: "chat-e0e90",
    storageBucket: "chat-e0e90.appspot.com",
    messagingSenderId: "1053329777922"
  };
  firebase.initializeApp(config);
  navigator.serviceWorker.register(base_url+'js/sw.js')
        .then((registration) => {

            console.log(registration);
            const messaging = firebase.messaging();
            messaging.useServiceWorker(registration);
            messaging.requestPermission()
                .then(function () {
                    console.log("Notification permission granted.");
                    // get the token in the form of promise
                    return messaging.getToken();
                })
                .then(function(token) {
                	console.log(token);
                	userToken = token;
					subscribeToTopic(token,'user','user');
					subscribeToTopic(token,'allRoom','allRoom');

                    // subscribeToTopic(token);
                })
                .catch(function (err) {
                    console.log("Unable to get permission to notify.", err);
                });

            messaging.onMessage(function(payload) {
                console.log("Message received. ", payload);
                if(!payload.data.message){
                    subscribeToTopic(userToken,payload.data.roomId,'room');
                }

                // Nối vào tin nhắn
                if(payload.data.type == 'message'){
                    addRecivedMessages(payload.data);
                }else if(payload.data.type == 'mark_seen' && payload.data.id_sender != myId){
                    markSeenMessageInChat();
                }
                
            });

            // Callback fired if Instance ID token is updated.
            messaging.onTokenRefresh(function() {
              messaging.getToken().then(function(refreshedToken) {
              		userToken = refreshedToken;
                    subscribeToTopic(refreshedToken);
                	
              }).catch(function(err) {
                console.log('Unable to retrieve refreshed token ', err);
                showToken('Unable to retrieve refreshed token ', err);
              });
            });

        });
}

function subscribeToTopic(token,roomId,type) {//type là chỉ 'room' hoặc 'user'-(đăng ký topic của chính mình mà ai cũng có thể gửi đến)
    $.get( base_url+"subscribe_topic/"+token+"/"+roomId+"/"+type, function( data ) {
      // console.log(data);
    });
}

function sendMessage(message) {
    tempMessageId += 1;
	var data = {
		message:message,
		idUser:chatting_user,
		token:userToken,
        roomId:chatting_room,
        tempMessageId:tempMessageId
	}

    var messTemplate = `<li class="replies" id-message="temp-`+tempMessageId+`" >
                <img src="`+$("#profile img").attr('src')+`" alt="">
                <p>`+message+`</p>
                <span class="meta-data text-muted unseen">sent at `+moment().format('YYYY-MM-DD H:mm:ss')+`</span>
            </li>`;
    $(".content .messages ul").append(messTemplate);
    setTimeout(function() {
       scroll_bottom_chat();
    
    },100);
      $("#message-input").val('');
    console.log('data send message',data);

	$.ajax({
		type: "POST",
		url: base_url+'send_message',
		data: data,
		dataType: 'text',
		success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $(".contact[id-room="+chatting_room+"]").find(".preview").html("<b> Bạn: </b>"+message);
            if(data.roomId){
                chatting_room = data.roomId;
            }
            

            $(".replies[id-message=temp-"+data.tempMessageId+"]").attr('id-message',data.id_message).append('<i title="Ghim tin nhắn này " onclick="pinMessage(this)" class="fa fa-map-marker pin-message " aria-hidden="true"></i>');
            if(data.roomId){
                chatting_room = data.roomId;
            }

		}
	});
}


function getAllRoom() {
     $.get( base_url+"get_all_room", function( data ) {
        console.log(data);
        $("#contacts").html('');
        $("#contacts").append(data);
    });
}


function getListMessageRoom(idRoom,lastIdMessage=0,type='reset') {
    if(idRoom !=0){
        $(".loader.message-loader").css('display','block');
        $.get( base_url+"get_list_message_room/"+idRoom+'/'+lastIdMessage+'/'+isViewPinnedMess, function( data ) {
            data = JSON.parse(data);
            chatting_room = data.roomId;
            if(lastIdMessage == 0 ){
                $(".replies").remove();
            }
            if(type == 'reset'){
                $(".message-wraper").html('');
                $(".message-wraper").prepend('<ul>'+data.listMessage+'</ul>');
            }else{
                $(".message-wraper ul").prepend(data.listMessage);
            }
            // $(".content .messages").animate({ scrollTop:10}, 200);
            
            
            $(".loader.message-loader").css('display','none');
        });
    }
}

function addRecivedMessages(data) {
    var isActive = true;
    if(data.id_room == chatting_room && data.id_sender!= myId){
        var messTemplate = `<li class="sent unread-message" id-message="`+data.id_message+`">
                <img src="`+base_url+'images/'+data.sender_avatar+`" alt="">
                <p>`+data.message+`</p>
                <span class="meta-data text-muted unseen">sent at `+data.created_at+`</span>
            </li>`;
        $(".content .messages ul").append(messTemplate);
        scroll_bottom_chat();

        $(".content .messages").click(function() {
            markSeenMessageEvent();
        });
    }
    // console.log(data);
    // console.log('data.id_sender',data.id_sender,typeof data.id_sender);
    // console.log('myId',myId,typeof myId);
    var room = $("#room-"+data.id_room);
    if(data.roomId && data.sender != myId){
        var roomTemplate = `
                <li class="contact " id-room="`+data.roomId+`" id="room-`+data.roomId+`">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img src="`+base_url+'images/'+data.sender_avatar+`" alt="" />
                        <div class="meta">
                            <p class="name">`+data.sender_name+`</p>
                            <p class="preview text-bold">`+data.message_alter+`</p>
                        </div>
                    </div>
                    <div class="unread-count">`+data.unseen+`</div>
                </li>
            `;
            $("#contacts .list-unstyled").prepend(roomTemplate);
    }else if(data.id_sender != myId){
        
            
            room.find('.unread-count').html(data.unseen);
            room.find('.unread-count').removeClass('d-none');
            room.find('.preview').html("<b>"+data.sender_name.split(' ').pop()+" : </b>"+ data.message);
            room.find('unread-count').html(data.unseen);

            var room2 = room.clone();
            room.remove();

            $("#contacts .list-unstyled").prepend(room2);
    }
        
}

function scroll_bottom_chat() {
    $(".content .messages").animate({ scrollTop:$(".content .message-wraper").height() }, 500);
}

function markSeenMessageEvent() {
    $("#room-"+chatting_room+" .unread-count").addClass('d-none').find('.preview').removeClass('text-bold');
    $.get( base_url+"mark_seen_message/"+chatting_room, function( data ) {
        console.log(data);
        $(".content .messages .sent .unseen ").html('seen at '+moment().format('YYYY-MM-DD H:mm:ss'));
    });
}


function markSeenMessageInChat() {
        $(".content .messages .replies .unseen ").html('seen at '+moment().format('YYYY-MM-DD H:mm:ss'));
}
// function timeNow() {
//     return new Date().toLocaleString().replace('/', '-').replace(',', '');
// }

function pinMessage(e) {
    e = $(e);
    var idMess = e.parent().parent().attr("id-message");
    console.log(e.parent().parent());
    var mode = '1'
    if(e.hasClass('pinned')){
        mode = '0';
    }

    if(isViewPinnedMess){
        e.parent().parent().animate({ 
            opacity: "0",
        }, 500 );
        setTimeout(function () {
            e.parent().parent().remove();

        },500)

    }

    $.get( base_url+"pin_message/"+mode+'/'+idMess, function( data ) {
        if((mode) == '1'){
            e.addClass('pinned');
        }else{
            e.removeClass('pinned');
        }
    });
}


function getPinnedMessage() {
    isViewPinnedMess = 1;
    $.get( base_url+"get_pinned_message/"+chatting_room, function( data ) {
       $(".message-wraper ul").html(data);
    });

}