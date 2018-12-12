<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$userList = User::get(['id', 'avatar', 'name']);
		$roomListArr = split(',', User::where('id', Auth::id())->get(['joined_room_ids'])[0]);
		$roomList = DB::table('rooms')
			->whereIn('id', $roomListArr)
			->get(['id', 'name', 'picture', 'last_message', 'updated_at']);
		return view('mainLayout', ['userList' => $userList, 'roomList' => $roomList]);
	}
}
