<ul class="list-unstyled">
	@foreach($users as $user)
	<li class="contact" id-user="{{$user->id}}">
		<div class="wrap">
			<img src="{{config('global.base_url').'/images/'.$user->avatar}}" alt="">
			<div class="meta">
				<p class="name">{{$user->name}}</p>
			</div>
			<p class="preview"></p>
		</div>
	</li>
	@endforeach
</ul>