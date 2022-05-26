<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 * public function index()
	 * {
	*	$this->load->view('welcome_message');
	* }
	 */
	
	 // protected $users;
	 public function __construct()
	 {
		 parent::__construct();
		 $DB1 = $this->load->database('default', true);
		//  $DB2 = $this->load->database('btc', true);
		 $this->load->library('pagination');
 
		 // $this->load->library(['table']);
		 // $this->load->database();
		 $this->load->model('Users', '', $DB1);
		 // $this->load->model('Users', '', $db['default']);
	 }
	 /**
	  * Index Page for this controller.
	  *
	  * Maps to the following URL
	  * 		http://example.com/index.php/welcome
	  *	- or -
	  * 		http://example.com/index.php/welcome/index
	  *	- or -
	  * Since this controller is set as the default controller in
	  * config/routes.php, it's displayed at http://example.com/
	  *
	  * So any other public methods not prefixed with an underscore will
	  * map to /index.php/welcome/<method_name>
	  * @see https://codeigniter.com/user_guide/general/urls.html
	  */
	 public function index()
	 {
		 $this->load->helper('url');
		 $this->load->view('welcome_message', ['users'=>$this->Users->get_last_ten_entries()]);
	 }
 
	 public function latestTen()
	 {
		 $this->load->model('Users');
		 $this->load->library('pagination');
 
 
		 $data['query'] = $this->Users->get_last_ten_entries();
 
		 $this->load->view('welcome_message', $data);
	 }
}
