<?php

namespace App\Http\Controllers;
use App\User;
use App\Message;
use App\Room;
use App\showRoom;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;
class HomeController extends Controller {
	private $message;
	private $firebaseMessage;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$message = new Message;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// return json_encode(User::where('id',Auth::user()->id)->get()[0]);
		$userList = User::get(['id', 'avatar', 'name']);
		$roomListArr = explode(',', User::where('id', Auth::id())->get(['joined_room_ids'])[0]);
		$roomList = DB::table('rooms')
			->whereIn('id', $roomListArr)
			->get(['id', 'name', 'picture', 'last_message', 'updated_at']);
		return view('mainLayout', ['userList' => $userList, 'roomList' => $roomList]);
	}

	public function getUserListHtml($query='')
	{
		$users = User::where('name','like','%'.$query.'%')->get();
		// return json_encode($users);
		return view('assets.list_user',['users'=>$users]);
	}

	public function getListMessage($userId,$lastIdMessage)
	{
		if(User::checkChattedBefore($userId)){
			$roomId = Room::getPrivateRoomId($userId);

			$userInRoom = [Auth::user()->id,$userId];
			$userInRoom = User::whereIn('id',$userInRoom)->get();
			$userData = [];
			foreach ($userInRoom as $us) {
				$userData[$us->id.'t'] = $us;
			}


			$messageData =  View::make('assets.messages')->with([
				'messages'=>Message::getListMessages($roomId,$lastIdMessage),
				'users'=>$userData,
				'curId'=>Auth::user()->id,
			])->render();
			return json_encode(['roomId'=>$roomId,
					'listMessage'=>$messageData]);
		}else{
			return json_encode(['roomId'=>0,'listMessage'=>'']);
		}
	}

	function sendMessage(Request $rq){
		// return json_encode('ọ');
		$data = (array)$rq->input();
		$user = Auth::user();
		$nam = explode(' ',$user->name);
        $last = array_pop($nam);

		$nam = explode(' ',$user->name);
        $myLastName = array_pop($nam);
		$roomId = 0;

		$type = '';
		$messageToSend = [];
		$needNewRoom = false;
		$idToSend = 0;
		if($data['roomId']!=0 ){
			// $roomId = Room::getPrivateRoomId($data['idUser']);
			// $data['roomId'] = $roomId;
			showRoom::where('room_id',$data['roomId'])->update(['last_message'=>$data['message'],'last_message_sender'=>$user->name]);
			$type = 'room';
			$idToSend = $data['roomId'];
			$data['idUser'] = $this->getUserInRoom($idToSend)[0]->id_member;
		}else{
			$needNewRoom = true;
			$roomId = Room::createRoom($data);
			$firebaseMessage = new Firebase($data['token'],$roomId,'room');
			$firebaseMessage->registerTopic(); //Đăng ký room cho người gửi tin

			$data['roomId'] = $roomId;
			$type = 'user';
			$idToSend = $data['idUser'];
			$messageToSend = array('sender'=>$user->id,'roomId'=>$data['roomId'],'message_alter'=>$data['message'],'sender_name'=>$user->name,'sender_avatar'=>$user->avatar);
		}		
		$savedMessage = Message::saveMessage($data);

		if(!$needNewRoom){
			$messageToSend = $savedMessage;
			$messageToSend['sender_name']=$user->name;
			$messageToSend['sender_avatar']=$user->avatar;
		}
		$unseenCount = Message::where('id_room',$data['roomId'])->where('status','sent')->where('id_reciver',$data['idUser'])->count();
		$messageToSend['unseen']=$unseenCount;
		$messageToSend['type'] = 'message';
		$messageToSend['id_message']= $savedMessage->id;
		$messageToSend['tempMessageId']= $data['tempMessageId'];
		

		Room::where('id',$data['roomId'])->update(['unread'=>$unseenCount]);

		showRoom::where('room_id',$data['roomId'])->where('owner_id',$data['idUser'])->update(['unread'=>$unseenCount,'last_message_sender'=>$myLastName]);
		showRoom::where('room_id',$data['roomId'])->where('owner_id',$user->id)->update(['unread'=>$unseenCount,'last_message_sender'=>'Bạn']);


		$firebaseMessage = new Firebase($data['token'],$idToSend,$type,$messageToSend);
		$rsl = $firebaseMessage->sendMessage();	
		return json_encode($messageToSend);
	}



	public function test($token)
	{
		$nam = explode(' ','Đào Mạnh Khá');
		return  $last = array_pop($nam);
	}

	public function subscribeTopic($token,$roomId,$type)
	{
		$currentUserId = Auth::user()->id;
		$firebaseMessage = '';
		if($roomId == 'user' && $type == 'user'){
			$firebaseMessage = new Firebase($token,$currentUserId,$type);
			$firebaseMessage->registerTopic();
		}else if($roomId == 'allRoom' && $type == 'allRoom'){
			$allChattedRoom = DB::table('members_in_rooms')->where('id_member',$currentUserId)->get(['id_room']);
			foreach ($allChattedRoom as $room) {
				if(isset($room->id)){
					$firebaseMessage = new Firebase($token,$room->id,'room');
					$firebaseMessage->registerTopic();
				}
				
			}
		}else{
			$firebaseMessage = new Firebase($token,$roomId,$type);
			$firebaseMessage->registerTopic();
		}
		return 'ok';
		// return json_encode($firebaseMessage);
	}

	public function removeData()
	{
		DB::table('messages')->delete();
		DB::table('members_in_rooms')->delete();
		DB::table('rooms')->delete();
		DB::table('show_room')->delete();

		DB::table('users')->where('joined_room_ids','<>',null)->update(['joined_room_ids'=>null]);
		DB::table('users')->where('chat_private_with','<>',null)->update(['chat_private_with'=>null]);
	}


	public function getAllRoom()
	{
		$roomData = DB::table('show_room')->where('owner_id',Auth::user()->id)->get();
		return view('assets.list_room',['rooms'=>$roomData]);
	}


	public function getInfoUser($id)
	{
		return json_encode(User::where('id',$id)->get()->toArray());
	}

	public function getInfoRoom($id)
	{
		return json_encode(DB::table('show_room')->where('room_id',$id)->where('owner_id',Auth::user()->id)->get()->toArray());
	}

	public function getListMessageRoom($id,$lastIdMessage,$mode)
	{

			$userInRoom = Room::getUserInRoom($id);
			// $userInRoom = User::whereIn('id',$userInRoom)->get();
			$userData = [];
			foreach ($userInRoom as $us) {
				$userData[$us->id.'t'] = $us;
			}

			// return(json_encode($userData));
			$messageData =  View::make('assets.messages')->with([
				'messages'=>Message::getListMessages($id,$lastIdMessage,$mode),
				'users'=>$userData,
				'curId'=>Auth::user()->id,
			])->render();
			return json_encode(['roomId'=>$id,
					'listMessage'=>$messageData]);
		
	}


	public function getUserInRoom($idRoom)
	{
		return DB::table('members_in_rooms')->where('id_room',$idRoom)->where('id_member','<>',Auth::user()->id)->get();
	}



	public function markSeenMessage($idRoom)
	{
		Message::where('id_room',$idRoom)->where('status','sent')->update(['status'=>'seen']);
		Room::where('id',$idRoom)->update(['unread'=>0]);
		showRoom::where('room_id',$idRoom)->where('owner_id',Auth::user()->id)->update(['unread'=>0]);

		$firebaseMessage = new Firebase('',$idRoom,'room',array('type'=>'mark_seen','id_sender'=>Auth::user()->id));
		$firebaseMessage->sendMessage();
	}


	public function pinMessage($mode,$id)
	{
		Message::where('id',$id)->update(['pin'=>$mode]);
		return json_encode(['ok']);
	}

	public function getPinnedMessage($id)
	{
		$rawData = Message::where('id_room',$id)->where('pin',1)->get();
		$userInRoom = Room::getUserInRoom($id);
		foreach ($userInRoom as $us) {
			$userData[$us->id.'t'] = $us;
		}


		return view('assets.messages',[
				'messages'=>$rawData,
				'users'=>$userData,
				'curId'=>Auth::user()->id,
			]);
	}
}