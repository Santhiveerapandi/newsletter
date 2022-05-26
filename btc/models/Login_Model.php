<?php

class Login_Model extends CI_Model
{
    public $user_email;
    public $password;

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $limit=1;$offset=0;
        $query = $this->db->get_where('login', ['user_email'=> $_POST['user_email'],'password'=> $_POST['password'] ], $limit, $offset);
        return is_object($query) && $query->num_rows()>0?   $query->row_array(): false;
    }

    public function subscribe()
    {
        $data['email']     = $_POST['user_email']; 
        $data['name']      = $_POST['user_name'];
        $data['letter_id'] = $_POST['letter_id'];
        $this->db->insert('subscribers', $data);
    }
}

/* End of file Login_Model.php */
