<?php

namespace App;
use \DB;
use Illuminate\Database\Eloquent\Model;
use App\Room;

use Illuminate\Support\Facades\Auth;
class Message extends Model
{
	protected $table = 'messages';
	public $timestamps = true;

	public static function saveMessage($data)
	{
		
		$newMessage = new Message;
		// foreach ($mss as $key => $value) {
		// 	$newMessage->{$key} = $value;
		// }
		$newMessage->id_sender=Auth::user()->id;
		$newMessage->id_room=$data['roomId'];
		$newMessage->message=$data['message'];
		$newMessage->status='sent';
		$newMessage->id_reciver=$data['idUser'];
		$newMessage->save();

		return $newMessage;
	}


	public static function getListMessages($roomId,$lastIdMessage)
	{
		$dataRaw = '';
		Message::where('id_room',$roomId)->where('status','sent')->update(['status'=>'seen']);
		if($lastIdMessage == 0){
			$dataRaw = DB::table('messages')->where('id_room',$roomId)->orderBy('id','DESC')->latest()->take(10)->get()->reverse();
		}else{
			$dataRaw = DB::table('messages')->where('id_room',$roomId)->where('id','<',$lastIdMessage)->latest()->take(10)->get()->reverse();
		}
		return $dataRaw;
	}
}
