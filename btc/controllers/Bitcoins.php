<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Panel Controller
 * @author Santhiveerapandi Kamaraj <santhiveerapandi@gmail.com>
 *
 */
class Bitcoins extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
    }
    
    public function request()
    {
        $seller_id=basename(uri_string());
        if (is_numeric($seller_id)) {
            $res  = $this->db->query("select bitcoins from login where login_id=?", [$seller_id]);
            $data['avail_coins'] = $res->num_rows()? $res->result_array()[0]['bitcoins']: 0;
            $data['seller_id'] = $seller_id;
            $data['buyer_id'] = $this->session->userdata("user")["login_id"];
        } else {

        }
        // print_r($data);
        $data['title'] = "Welcome to bitcoins request";
        $data['user'] = $this->session->userdata('user');
        $this->load->view('_admin_panel/include_files/header', $data);
        
        $this->load->view('_admin_panel/include_files/nav', $data);
        
        $this->load->view('_admin_panel/bitcoinrequest', $data);
        
        $this->load->view('_admin_panel/include_files/footer');
    }

    public function submitrequest()
    {
        if (!empty($this->input->post('avail'))) {
            $request_status=($this->input->post('avail')==$this->input->post('requested'))? '1':
            (($this->input->post('avail')<=$this->input->post('requested'))?'2':'1');
            $this->db->query("INSERT INTO coin_request (buyer_id, seller_id, qty, bitcoin_value, request_status) value(?,?,?,?,?)", [$this->input->post('buyer_id'),$this->input->post('seller_id'),$this->input->post('requested'),$this->input->post('requested')*10,$request_status]);
            $this->session->set_flashdata('message', '<span class="success">Bitcoins Submitted Successfully</span>');
            redirect('Admin');exit();
        } else {
            $this->session->set_flashdata('message', '<span class="error">Bitcoins Not available.</span>');
            redirect('');exit();
        }
    }
}

/* End of file Controllername.php */
