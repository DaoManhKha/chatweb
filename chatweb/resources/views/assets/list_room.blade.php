<ul class="list-unstyled">
    @foreach($rooms as $room)
        <li class="contact" id-room="{{$room->room_id}}" id="room-{{$room->room_id}}">
            <div class="wrap">
                <span class="contact-status online"></span>
                <img src="{{URL('/images/').'/'.$room->image}}" alt="" />
                <div class="meta">
                    <p class="name">{{$room->name}}</p>
                    <p class="preview">{{$room->last_message}}</p>
                </div>
            </div>
            <div class="unread-count {{$room->unread==0?'d-none':''}}">{{$room->unread}}</div>
        </li>
    @endforeach
</ul>