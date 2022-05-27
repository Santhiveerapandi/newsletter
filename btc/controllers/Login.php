<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user')) {
            redirect('Admin');
        }
        //Do your magic here
        // $this->$this->form_validation->set_error_handler('<strong><div class="danger">', '</div></strong>');
        $this->load->model('Login_Model', 'LoginModel');
    }
    
    public function index()
    {
        $data['title'] = "Welcome to Login";
        // $this->load->view('_admin_panel/include_files/header', $data);
        // $this->load->view('_admin_panel/loginform');
        // $this->load->view('_admin_panel/include_files/footer');
        $this->load->view('layout/header');
        $this->load->view('login', $data);
        $this->load->view('layout/footer');
    }

    public function loginaction()
    {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[150]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]');
        
        if ($this->form_validation->run() == false) {
            # code...
            $output['message']= validation_errors('<span class="error">', '</span><br/>');
            $this->session->set_flashdata('message', $output['message']);

            redirect('login');exit();
        } else {
            # code...
            $output=$this->LoginModel->login();
            if($output) {
                $this->session->set_userdata('user', $output);
                redirect('Admin');exit();
            } else {
                $this->session->set_flashdata('message', '<span class="error">Invalid Login Credential</span>');
                redirect('login');exit();
            }
        }
        // echo json_encode($output);
    }

    public function subscribe()
    {
        # code...
        $data['title'] = "Subscribe News Letter";
        
        $this->load->view('layout/header');
        $this->load->view('subscribe', $data);
        $this->load->view('layout/footer');
    }

    public function subscribeaction()
    {
        $this->form_validation->set_rules('user_name', 'Name', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[250]');
        
        if ($this->form_validation->run() == false) {
            $output['message']= validation_errors('<span class="error">', '</span><br/>');
            $this->session->set_flashdata('message', $output['message']);

            redirect('login/subscribe');exit();
        } else {
            $output=$this->LoginModel->subscribe();
            redirect('login');exit();
            /*if($output) {
                $this->session->set_userdata('user', $output);
                redirect('Admin');exit();
            } else {
                $this->session->set_flashdata('message', '<span class="error">Invalid Login Credential</span>');
                redirect('login');exit();
            }*/
        }
    }
}

/* End of file Login.php */
