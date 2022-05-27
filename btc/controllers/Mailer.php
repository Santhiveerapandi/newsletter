<?php defined('BASEPATH') OR exit('No direct script access allowed');
# controllers/Mailer.php

class Mailer extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function index() {
		$data['title'] = "Sample mail send from";
        $data['user'] = $this->session->userdata('user');
        $data['login_id'] = $this->session->userdata('user')["login_id"];

        
        $this->load->view('_admin_panel/include_files/header', $data);
        
        $this->load->view('_admin_panel/include_files/nav', $data);
        
        $this->load->view('mailer/form', $data);
        
        $this->load->view('_admin_panel/include_files/footer');
	}

	public function send() {
		$this->load->config('email');
		$this->load->library('email');

		$from = 'no-reply@myapp.com';
		$to = $this->input->post('to');

		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject('New email');
		// $this->email->message('New email received!');
		$this->email->message("<h1>Welcome, ${to}!!!</h1>");

		if ($this->email->send()) {
			echo 'Sent with success!';
		} else {
			show_error($this->email->print_debugger());
		}
	}

	public function sendmail() {
		$this->load->config('email');
		$this->load->library('email');

		$from = 'no-reply@myapp.com';
		$letter_id=basename(uri_string());
        if (is_numeric($letter_id)) {
            $res  = $this->db->query("SELECT * FROM subscribers AS s 
			            	INNER JOIN news_letter AS l ON s.letter_id=l.id 
			            	WHERE s.id=?", [$letter_id]);
            $data['letter'] = is_object($res) && $res->num_rows()>0? 
            					$res->result_array()[0]: 0;
            $data['letter_id'] = $letter_id;

            if(isset($data['letter']['email'])) {
            	$to = $data['letter']['email'];

				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject($data['letter']['subject']);
				$mail_content=str_ireplace('#name', 
								$data['letter']['name'], 
								$data['letter']['mail_content']);

				
				$html_template=$this->template($mail_content);
				$this->email->message($html_template);

				if ($this->email->send()) {
					$this->db->set('mail_sent', '1');
							$this->db->where('id', $letter_id);
							$this->db->update('subscribers');
					$this->session->set_flashdata('message', 'Sent with success!');
				} else {
					show_error($this->email->print_debugger());
				}
				redirect('admin');exit();	
            }
        } else {
        	$ids = $this->input->post('chk[]');
        	if($this->input->post('delete')=="Delete") {
	            // var_dump($this->input->post(),$this->input->post('chk[]'));die();
	            $this->db->where_in('id', $ids);
				$this->db->delete('subscribers');
				$this->session->set_flashdata('message', 'Deleted successfully!');
	            redirect('admin');exit();
	        }
	        if($this->input->post('email_send')=="") {
	           

	            $this->db->select('subscribers.*,subscribers.id as subid,news_letter.*');
				$this->db->from('subscribers');
				$this->db->join('news_letter', 'news_letter.id = subscribers.letter_id');
				// $ids = $this->input->post('chk[]');
				$this->db->where_in('subscribers.id', $ids);
				$res = $this->db->get();

            	$data['letter'] = is_object($res) && $res->num_rows()>0? 
            					$res->result_array(): 0;
            	

            	if(is_array($data['letter']) && count($data['letter'])>0) {
            		foreach($data['letter'] as $data_out) {
						$to = $data_out['email'];

						$this->email->from($from);
						$this->email->to($to);
						$this->email->subject($data_out['subject']);
						$mail_content=str_ireplace('#name', 
										$data_out['name'], 
										$data_out['mail_content']);

            			$html_template=$this->template($mail_content);
            			$this->email->message($html_template);
            			if ($this->email->send()) {
            				$this->db->set('mail_sent', '1');
							$this->db->where('id', $data_out['subid']);
							$this->db->update('subscribers');
							//echo 'Sent with success!';
							$this->session->set_flashdata('message', 'Sent with success!');
						} else {
							show_error($this->email->print_debugger());
						}
            		}
            	}
	            redirect('admin');exit();
	        }
       	

        }
	}

	public function template($mail_content) {
		return "<html>
					<head>
					<style>
					body {
						background-image: url(".base_url("assets/img/background.jpg").");
						background-repeat: repeat-y no-repeat;
						background-position: 50% 50%;
					}

					hr {
						height: 2px;
						color:#BDBAB5;
					}
					
					.box {
						background-color: #f8f5ec;
						position: absolute;
						left: 0;
						right: 0;
						margin: auto;
						top: 0;
						bottom: 0;
						font-family:Georgia, Times, serif;
						font-size:14px;
						color:#333333;
						padding: 50px;
					}
					</style>
					</head>
					<body style='background:".base_url("assets/img/background.jpg")."'>
						<div class='container'> 
						<div class='box' style='border:1px solid #000;width:600px;height:500px'>
							<img src=".base_url("assets/img/logo.gif")." />
							<hr/>
							{$mail_content}
							<hr/>
						</div>
						</div>
					</body>
					</html>";
	}

}