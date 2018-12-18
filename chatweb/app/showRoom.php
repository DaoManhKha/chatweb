<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class showRoom extends Model
{
    protected $table = 'show_room';
	public $timestamps = true;

	public static function createShowRoom($data)
	{
		$sr = new showRoom;
		foreach ($data as $key => $value) {
			$sr->{$key} = $value;
		}
		$sr->save();
		return $sr->id;
	}
}
