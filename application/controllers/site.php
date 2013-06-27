<?php

class Site extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	//	$this->is_logged_in();
	
    // Require members to be logged in. If not logged in, redirect to the Ion Auth login page.
    //

		}
	function index()
	{
//		$this->load->view('logged_in_area');
	$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);
	}
	function register()
	{
//		$this->load->view('logged_in_area');
	$data['main_content'] = 'auth/signup';
		$this->load->view('includes/template', $data);
	}	
	function contact()
	{
//		$this->load->view('logged_in_area');
	$data['main_content'] = 'contact_us';
		$this->load->view('includes/template', $data);
	}
	function contactSend()
	{
//		$this->load->view('logged_in_area');
	$name = $this->input->post('nameInputPost');	
	$email = $this->input->post('emailInputPost');
	$message = $this->input->post('messageInputPost');
	$this->load->library('email');
// send email
	$this->email->from($email, $name);
	$this->email->to('aaron.etch@yahoo.com');
	$this->email->subject('Vintners Journal Contact Form');
	$this->email->message($message);
	
	$this->email->send();
	//echo $this->email->print_debugger();
	header('Access-Control-Allow-Origin: *');

	}
}
