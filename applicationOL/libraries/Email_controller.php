<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_controller
{
	protected $CI;

	public function __construct()
	{
	    $this->CI = & get_instance();
      $this->CI->load->library('email');
      $this->CI->load->model('Model');
	}

	function send_mail($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()) {


    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'bijebdi@gmail.com', // change it to yours
  'smtp_pass' => 'bijebdi123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

             $message = $message;
        $this->CI->load->library('email', $config);
      $this->CI->email->set_newline("\r\n");
      $this->CI->email->from('bijebdi@gmail.com'); // change it to yours
      $this->CI->email->to($emailTo);// change it to yours
       if (!empty($cc_emails)) {
            foreach ($cc_emails as $key => $value) {
                $this->CI->email->cc($value);
            }
        }
      $this->CI->email->subject($subjet);
      $this->CI->email->message($message);
      if (!empty($attach)) {
            foreach ($attach as $att)
                $this->CI->email->attach($att);
        }
      if($this->CI->email->send())
     {
      return true;
     }
     else
    {
     show_error($this->email->print_debugger());
     return false;
    }
	}
}