<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class Notification extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function notifyUser($idUser,$messa)
	{
		
	}
}
