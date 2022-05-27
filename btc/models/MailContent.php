<?php

class MailContent extends CI_Model
{
    public $subject;
    public $mail_content;

    public function __construct()
    {
        parent::__construct();
    }

    public function letter($updated_by)
    {
        $data['subject']        = $_POST['subject']; 
        $data['mail_content']   = $_POST['mail_content'];
        $data['updated_by']     = $updated_by;
        $this->db->where('id', $_POST['letter_id']);
        $this->db->update('news_letter', $data);
        return ['message'=>'Updated Successfully'];
    }
}

/* End of file Login_Model.php */