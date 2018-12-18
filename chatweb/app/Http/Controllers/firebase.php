<?php

namespace App\Http\Controllers;
use App\User;
use App\Message;
use DB;
use Illuminate\Support\Facades\Auth;

class Firebase extends Controller {
	public $token;
	public $roomId;
	public $message;
	public $type;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct($token = '',$roomId='',$type,$message='') {
		$this->middleware('auth');

		$this->token = $token;
		$this->roomId = $roomId;
		$this->message = $message;
		$this->type = $type;
	}



	public function registerTopic()
	{

		$headers = array('Content-Type:application/json', 'Authorization:key=AIzaSyB-GoXZZvSRgnZ73SQZTIKugJvUxolNnSw');

		$ch = curl_init();			
		curl_setopt($ch, CURLOPT_URL, "https://iid.googleapis.com/iid/v1/".$this->token."/rel/topics/".$this->type . $this->roomId);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		// var_dump($this->roomId);
		// var_dump($this->type);
		// return $result;


	}


	public function sendMessage()
	{
		$deviceToken = '/topics/'.$this->type.$this->roomId;
		$push_data = array();  

	    $url = 'https://fcm.googleapis.com/fcm/send ';
	    $serverKey = "AAAA9T9Y5QI:APA91bGD144aTten0xCibLoV4_9wG3i1FU4sFtrWTN_yjvlCL1TEtQhS_748UVjeNhQWJz8nZX4EbCo_XsuzzSa9CTWLbRr16h-6lEFRgVo5lovk9fiUKzMrD_uNcT5mdBxw4OSZjopK";
	    $msg = $this->message;   
	    $fields = array();
	    $fields['data'] = $msg;
	    if (is_array($deviceToken)) {
	        $fields['registration_ids'] = $deviceToken;
	    } else {
	        $fields['to'] = $deviceToken;
	        // $fields['notification'] = ["body" => "Hello every one",
	    								// "title" => "Khá đã gửi lời chào đến bạn",];

	    }
	    $headers = array(
	        'Content-Type:application/json',
	        'Authorization:key=' . $serverKey
	    );   
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	    echo json_encode($ch);
	    $result = curl_exec($ch);
	    if ($result === FALSE) {
	        die('FCM Send Error: '  .  curl_error($ch));
	    }
	    return [$result,'/topics/'.$this->type.$this->roomId,$msg];
	    curl_close($ch);
	}


	public function listTopic($token)
	{
		$headers = array('Content-Type:application/json', 'Authorization:key=AIzaSyB-GoXZZvSRgnZ73SQZTIKugJvUxolNnSw');

		$ch = curl_init();			
		curl_setopt($ch, CURLOPT_URL, "https://iid.googleapis.com/iid/info/".$token."?details=true");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return $result;
	}
}
