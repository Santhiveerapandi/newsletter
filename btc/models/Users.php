<?php

class Users extends CI_Model
{
    public $title;
    public $content;
    public $date;

    // public function __construct()
    // {
    //     $this->load->database();
    // }
    
    public function get_last_ten_entries()
    {
        $query = $this->db->get('login', 10);
        return $query->result();
    }

    public function insert_entry()
    {
        $data['title']    = $_POST['title']; // please read the below note
        $data['name']     = 'Test User Three';
        $data['content']  = $_POST['content'];
        // $data['date']     = time();

        $this->db->insert('login', $data);
    }

    public function update_entry()
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('login', $this, array('id' => $_POST['id']));
    }
}
