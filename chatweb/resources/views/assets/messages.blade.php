
	@foreach($messages as $ms)
			@php
				$isMyMessage = $ms->id_sender == $curId;
				$status = '';
				$time = '';
				if(!$isMyMessage){
					$status = 'sent';
					$time = $ms->created_at;
				}else{
					$status = $ms->status;
					$time = $status=='sent'?$ms->created_at:$ms->updated_at;
				}
			@endphp
			<li class="{{$isMyMessage?'replies':' sent'}} " id-message="{{$ms->id}}">
				<img src="{{URL('/images/').'/'.$users[$ms->id_sender.'t']->avatar}}" alt="">
				<p>{{$ms->message}}</p>
				<span class="meta-data text-muted {{$ms->status == 'sent'?'unseen':''}}">{{$status}} at {{$time}}</span>
				<span class="function-message"><i title="Ghim tin nhắn này " onclick="pinMessage(this)" class="fa fa-map-marker pin-message {{$ms->pin == 0?'':'pinned'}}" aria-hidden="true"></i></span>
			</li>
			{{-- <li class="replies">
				<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="">
				<p>When you're backed against the wall, break the god damn thing down.</p>
			</li> --}}		
	@endforeach
{{-- Đảo ngược giữa người gửi và người nhận --}}
