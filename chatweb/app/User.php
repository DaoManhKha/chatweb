<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function getListUser($type, $query = '') {
		$currentUserId = Auth::id();
		$data = '';
		if ($type == 'all') {
			$data = table('users')
				->join('members_in_rooms', 'users.id', '=', 'members_in_rooms.id_member')
				->select('users.*', 'contacts.phone', 'orders.price')
				->get();
		}
		return $data;
	}
}
