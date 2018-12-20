<ul class="list-unstyled">
    @foreach($rooms as $room)
        <li class="contact" id-room="{{$room->room_id}}" id="room-{{$room->room_id}}" room-type="{{isset($room->type)?'group':'private'}}">
            <div class="wrap">
                <span class="contact-status online"></span>
                <img src="{{URL('/images/').'/'.$room->image}}" alt="" />
                <div class="meta">
                    <p class="name">{{$room->name}}</p>
                    <p class="preview"><b>{{$room->last_message_sender}} <span style="color: #2c3e50">.</span> </b>{{$room->last_message}}</p>
                </div>
            </div>
            <div class="unread-count {{$room->unread==0?'d-none':''}}">{{$room->unread}}</div>
        </li>
    @endforeach
</ul>