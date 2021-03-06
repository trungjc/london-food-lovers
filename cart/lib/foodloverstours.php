<?php
/**
 * Checkfront Sample Code: Browse inventory & create booking.
 *
 * This is sample code is for demonstration only and should not be used in production
 * without modifcation.  It does not adequtly secure your OAuth tokens.
 *
 * see:
 *
 * API Documenation:  http://www.checkfront.com/developers/api/
 * API Error Codes:  http://www.checkfront.com/developers/api-error
 * PHP SDK - https://github.com/Checkfront/PHP-SDK
 * CQL Documenation: http://www.checkfront.com/developers/api-cql/
 *
 */

/*
 * @access public
 * @package Checkfront
 */

include('CheckfrontAPI.php');

class Checkfront extends CheckfrontAPI {

	public $tmp_file = '.checkfront_oauth';

	public function __construct($data) {
		parent::__construct($data,session_id());
	}

	/* DUMMY Data store.  This sample stores oauth tokens in a text file...
	 * This is NOT reccomened in production.  Ideally, this would be in an encryped
	 * database or other secure source.  Never expose the client_secret or access / refresh
	 * tokens.
	 *
	 * store() is called from the parent::CheckfrontAPI when fetching or setting access tokens.
	 *
	 * When an array is passed, the store should save and return the access tokens.
	 * When no array is passed, it should fetch and return the stored access tokens.
	 *
	 * param array $data ( access_token, refresh_token, expire_token )
	 * return array
	 */
	final protected function store($data=array()) {
		$tmp_file = sys_get_temp_dir() . DIRECTORY_SEPARATOR. $this->tmp_file;
		if(count($data)  ) {
			file_put_contents($tmp_file,json_encode($data,true));
		} elseif(is_file($tmp_file)) {
			$data = json_decode(trim(file_get_contents($tmp_file)),true);
		}
		return $data;
	}

	public function session($session_id,$data=array()) {
		//session_id($session_id);
		if(!empty($data)){
			$_SESSION = array_merge($_SESSION,$data);
		}
	}
}

/*
 * You need to create a new application in your Checkfront Account under
 Manage / Extend / Api and supply the details below.

 This example bybasses the oauth authorization redirect by supplying "oob"
 (Out Of Bounds) as the redirect_uri, and by generating the access and
 refresh tokens from within Checkfront.

 For more infomration on your endpoints see:
 http://www.checkfront.com/developers/api/#endpoints
 */

// a general class that wraps the api along with some custom calls
class Booking {

	public $cart = array();
	public $session = array();

	function __construct() {
		// apply a session_id to the request if one is specified
		//if (!empty($_GET['cart_id'])) session_id($_GET['cart_id']);
		//@session_start();
		// create api connection to Checkfront
		// you can generate a token pair under Manage / Developer in your account
		$this->Checkfront = new Checkfront(
			array(
    			'host' => 'foodloverstours.checkfront.co.uk',
    			'auth_type' => 'token',
    			'api_key' => '1eeadb1c44fdcde1a2638e0950c3bf7298becc3c',
    			'api_secret' => 'cad70bf0257de60c58fd0d408850d80fc376e042280bf261e6e0286fc5c5f36e',
    			'account_id' => 'off',
			)
		);

		// init shopping cart
		$this->cart();
	}

	// fetch categories
	public function query_categories() {
		$response = $this->Checkfront->get('category');
		return $response['category'];
	}

	public function category_avail($category_id , $date = false){
		if($date){
			$response = $this->Checkfront->get('category/'.$category_id,array('date'=>$date,'ui'=>'calendar'));
		}
		else{
			$response = $this->Checkfront->get('category/'.$category_id,array('ui'=>'calendar'));
		}
		return $response;
	}

	// fetch items from inventory based on date
	public function query_items($data) {
		$response = $this->Checkfront->get('item',array('category_id'=>$data['category_id']));
		return $response['items'];
	}

	// fetch items from inventory based on date
	public function query_inventory($data) {
		$response = $this->Checkfront->get('item',array('start_date' => $data['start_date'],'category_id'=>$data['category_id'] , 'discount_code' => @$data['discount_code'] ,'available' => $data['available'] , 'param'=> $data['param']));
		return $response['items'];
	}

	// fetch categories from inventory based on date
	public function query_item($item_id) {
		$response = $this->Checkfront->get('item/'.$item_id);
		return $response;
	}

	public function update_booking($booking_id , $status = 'PAID'){
		$response = $this->Checkfront->post('booking/'.$booking_id.'/update',array('status_id' => $status));
		return $response;
	}

	// add slips to the booking session
	public function set($slips=array()) {
		$data = array('slip'=>$slips);
		$response = $this->Checkfront->post('booking/session',$data);
		$this->Checkfront->set_session($response['booking']['session']['id'], $response['booking']['session']);
		$this->cart();
	}

	// get the booking form fields required to make a booking
	public function form() {
		$response = $this->Checkfront->get('booking/form');
		return $response['booking_form_ui'];
	}

	// get cart session
	public function cart() {
		if(!empty($_SESSION)) {
			$response = $this->Checkfront->get('booking/session');
			if(!empty($response['booking']['session']['item'])) {
				foreach($response['booking']['session']['item']  as $line_id => $data) {
					// store for later
					$this->cart[$line_id] = $data;
				}
			}
			$this->Checkfront->set_session($response['booking']['session']['id'], $response['booking']['session']);
		}
	}

	// create a booking using the session and the posted form fields
	public function create($form) {
		$form['session_id'] = session_id();
		if($response = $this->Checkfront->post('booking/create',array('form'=>$form))) {
			return $response;
		}
	}

	// clear the current remote session
	public function clear() {
		$response = $this->Checkfront->post('booking/session/clear',array());
		//session_destroy();
	}
}