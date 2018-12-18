<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use \DB;
use App\User;
use App\showRoom;

use Illuminate\Support\Facades\Auth;
class Room extends Model {
	protected $table = 'rooms';
	public $timestamps = true;

	public static function createRoom($roomInfo)
	{
		$dataInsert = [
			'name'=>'',
			'picture'=>'',
			'id_creater'=>Auth::user()->id,
			'last_message'=>$roomInfo['message'],
			'memberids_in_rooms'=>Auth::user()->id.','.$roomInfo['idUser'],
			'number_user'=>2
		];
		

		$newRoom = new Room;
		foreach ($dataInsert as $key => $value) {
			$newRoom->$key = $value;
		}
		// Tạo room mới
		$newRoom->save();
		$insertedRoomId  = $newRoom->id;

		// Tạo hiển thị đối với từng room cho từng người trong nhóm
		$ob = User::where('id',$roomInfo['idUser'])->get()[0];
	

		showRoom::createShowRoom(
			['room_id'=>$insertedRoomId,
			'owner_id'=>Auth::user()->id,
			'name'=>$ob->name,
			'image'=>$ob->avatar,
			'last_message'=>$roomInfo['message']
			]);

		showRoom::createShowRoom(
			[   'room_id'=>$insertedRoomId,
				'owner_id'=>$roomInfo['idUser'],
				'name'=>Auth::user()->name,
				'image'=>Auth::user()->avatar,
				'last_message'=>$roomInfo['message']
			]);

		// Cập nhật private room 
		$currentUser = User::where('id',Auth::user()->id)->get()[0];
		$currentUser->update([
			'chat_private_with'=>$currentUser->chat_private_with.$roomInfo['idUser'].',','joined_room_ids'=>$currentUser->joined_room_ids.$insertedRoomId.',']);
		$reciveUser = User::where('id',$roomInfo['idUser'])->get()[0];
		$reciveUser->update([
			'chat_private_with'=>$reciveUser->chat_private_with.Auth::user()->id.',','joined_room_ids'=>$reciveUser->joined_room_ids.$insertedRoomId.',']);

		
		DB::table('members_in_rooms')->insert([
			['id_member'=>$roomInfo['idUser'],'id_room'=>$insertedRoomId],
			['id_member'=>Auth::user()->id,'id_room'=>$insertedRoomId]
		]);

		return $insertedRoomId;
	}

	public static function getPrivateRoomId($idUser)
	{
		$rooms = Room::where('number_user',2)->where('memberids_in_rooms','like','%'.$idUser.'%')->get();
		foreach ($rooms as $room) {
			if(in_array(Auth::user()->id.'', explode(',', $room->memberids_in_rooms))){
				return $room->id;
			}
		}
	}


	public static function getUserInRoom($id)
	{
		$idUsers = explode(',', Room::where('id',$id)->get(['memberids_in_rooms'])[0]->memberids_in_rooms);
		return User::whereIn('id',$idUsers)->get(); 
	}

}
