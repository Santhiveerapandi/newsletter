<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Panel Controller
 * @author Santhiveerapandi Kamaraj <santhiveerapandi@gmail.com>
 *
 */
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
        $this->load->model('MailContent', 'MailContent');
    }
    
    public function logout()
    {
        # code...
        $this->session->unset_userdata('user');
        redirect('login');
    }
    public function index()
    {
        $data['title'] = "Welcome to Admin Panel";
        $data['user'] = $this->session->userdata('user');
        $data['buyer_id'] = $this->session->userdata('user')["login_id"];
        // $res = $this->db->query('SELECT * FROM subscribers');
        $res  = $this->db->query("SELECT * FROM subscribers AS s 
                            INNER JOIN news_letter AS l ON s.letter_id=l.id");
        $data['coins'] = $res->result();
        $data['coinsrow'] = $res->row();
        // var_dump($data['coins']);exit;
        $this->load->view('_admin_panel/include_files/header', $data);
        
        $this->load->view('_admin_panel/include_files/nav', $data);
        
        $this->load->view('_admin_panel/index', $data);
        
        $this->load->view('_admin_panel/include_files/footer');
    }

    public function letter()
    {
        $data['title'] = "Welcome to Subscribe News Letter";
        $data['user'] = $this->session->userdata('user');
        $data['login_id'] = $this->session->userdata('user')["login_id"];

        $letter_id=basename(uri_string());
        if (is_numeric($letter_id)) {
            $res  = $this->db->query("SELECT * FROM news_letter WHERE id=?", [$letter_id]);

            $data['letter'] = $res->num_rows()? $res->result_array()[0]: 0;
            $data['letter_id'] = $letter_id;
        } else {

        }
        // echo "<pre>";print_r($data);die("</pre>");

        $this->load->view('_admin_panel/include_files/header', $data);
        
        $this->load->view('_admin_panel/include_files/nav', $data);
        
        $this->load->view('_admin_panel/letter', $data);
        
        $this->load->view('_admin_panel/include_files/footer');
    }

    public function letteraction()
    {
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('mail_content', 'Body', 'trim|required|min_length[5]|max_length[250]');
        
        if ($this->form_validation->run() == false) {
            $output['message']= validation_errors('<span class="error">', '</span><br/>');
            $this->session->set_flashdata('message', $output['message']);

            redirect('admin/letter');exit();
        } else {
            $data['updated_by'] = $this->session->userdata('user')["login_id"];
            $output=$this->MailContent->letter($data['updated_by']);
            redirect('admin');exit();
        }
    }
}

/* End of file Controllername.php */
