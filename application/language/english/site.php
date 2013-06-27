<?php

class Site extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	function welcomemine()
	{
//		$this->load->view('logged_in_area');
	$data['main_content'] = 'welcomemine';
		$this->load->view('includes/template', $data);
	}
	function members_area()
	{
//		$this->load->view('logged_in_area');

	$data['main_content'] = 'logged_in_area';
		$this->load->view('includes/template', $data);

	}
	
	function another_page() // just for sample
	{
		echo 'good. you\'re logged in.';
	}
	function list_view() // just for sample
	{
	$data = array();
	// get user id to post new wines	
	$theUserName = $this->session->userdata('username');
	
	$this->load->model('membership_model');
	$data['userIdNumber'] = $this->membership_model->getUserIdNumber($theUserName);
	
	$this->load->model('list_view');
	// main list of wines
	$data['rows'] = $this->list_view->getList($theUserName);
	// for auto suggest
	$data['varietalRows'] = $this->list_view->getValietalList();	
	$data['main_content'] = 'list_view';
	$this->load->view('includes/template', $data);	
	
	
	}
	function detail_view() // just for sample
	{
	$theWineId = $this->uri->segment(3);
	// model auto loaeded aleady
	$this->load->model('detail_view');
	$data['detailViewWineName']= $this->detail_view->getWineName($theWineId);	
	$data['wineHist']= $this->detail_view->getWineHist($theWineId);	
	$data['formWineProcess']= $this->detail_view->getFormWineProcess();	
	$data['formLabProcess']= $this->detail_view->getFormLabProcess();	
	$data['main_content'] = 'detail_view';
	$this->load->view('includes/template', $data);

	}	
	function create (){
		$data = array(
		
		'wineId' => $this->input->post('wineId'),		
		'date' => date_to_mysqldatetime($this->input->post('date')),
		'notes' => $this->input->post('notes')
		);

		//$this->detail_view->addRecord($data);	
		if($this->input->post('processSelect') == 'wineAction')
			{
				$wineActionsDescIdPost = $this->input->post('wineProcess');				
				
				$this->detail_view->addWineProcessRecord($data, $wineActionsDescIdPost);
			}
		else if($this->input->post('processSelect') == 'labAction')
			{
			$data2 = array(
			'wineActionsDescId' => $this->input->post('labProcess'),	
			'labValue' => $this->input->post('value'),	
			'labUnit' => $this->input->post('labUnit')			
			);
			// insert into tables labActions and theMaking
			$this->detail_view->addLabProcessRecord($data, $data2);
			}
		
		
		// model auto loaded
		//$this->detail_view->addRecord($data);
		redirect('site/detail_view/'.$data['wineId']);
	//echo "original date". $this->input->post('date')."<br>";
	//echo "original date". date_to_timestamp($this->input->post('date'))."<br>";
	//echo "date_to_mysqldatetime date: ".$data['date'];
	}
	function deleteTheMaking() {
		$this->detail_view->deleteTheMakingRecord($this->uri->segment(3));
//		redirect('site/detail_view/'.$data['wineId']);

//redirect('site/detail_view/'.$this->uri->segment(3));
	}
	function deleteWine() {
		$this->load->model('list_view');	
		$this->list_view->deleteWineRecord($this->uri->segment(3));
//		redirect('site/detail_view/'.$data['wineId']);

//redirect('site/detail_view/'.$this->uri->segment(3));
	}
	function addNewWine() {
		// get ajax posts. convert varietal name to id. Create array to add to database. 
		$this->load->model('list_view');	
		$varietalName = $this->input->post('varietalPost');		
		$data = array(		
		'userId' => $this->input->post('userIdPost'),		
		'wineName' => $this->input->post('wineNamePost'),
		'varietalId' => $this->list_view->getVarietalIdNumber($varietalName),
		'vintage' => $this->input->post('vintagePost'),
		'quantity' => $this->input->post('quantityPost'),
		'container' => $this->input->post('wineContainerPost'),
		);
		$this->list_view->addWineRecord($data);
	}
	function updateWine() {
		// get ajax posts. convert varietal name to id. Create array to add to database. 
		$this->load->model('list_view');	
		$varietalName = $this->input->post('varietalUpdatePost');		
		$wineIdToUpdate = $this->input->post('wineIdUpdatePost');
		$data = array(				
		'wineName' => $this->input->post('wineNameUpdatePost'),
		'varietalId' => $this->list_view->getVarietalIdNumber($varietalName),
		'vintage' => $this->input->post('vintageUpdatePost'),
		'quantity' => $this->input->post('quantityUpdatePost'),
		'container' => $this->input->post('wineContainerUpdatePost'),
		);
		$this->list_view->updateWineRecord($data, $wineIdToUpdate);
	}
	function addNewWineEvent (){
		$data = array(
		
		'wineId' => $this->input->post('wineIdPost'),		
		'date' => date_to_mysqldatetime($this->input->post('datePost')),
		'notes' => $this->input->post('notesPost')
		);

		//$this->detail_view->addRecord($data);	
		if($this->input->post('actionTypePost') == 'wineAction')
			{
				$wineActionsDescIdPost = $this->input->post('wineActionIdPost');				
				
				$this->detail_view->addWineProcessRecord($data, $wineActionsDescIdPost);
			}
		else if($this->input->post('actionTypePost') == 'labAction')
			{
			$data2 = array(
			'wineActionsDescId' => $this->input->post('labActionIdPost'),	
			'labValue' => $this->input->post('labValuePost'),	
			'labUnit' => $this->input->post('unitValuePost')			
			);
			// insert into tables labActions and theMaking
			$this->detail_view->addLabProcessRecord($data, $data2);
			}
		
		
		// model auto loaded
		//$this->detail_view->addRecord($data);
		redirect('site/detail_view/'.$data['wineId']);
	//echo "original date". $this->input->post('date')."<br>";
	//echo "original date". date_to_timestamp($this->input->post('date'))."<br>";
	//echo "date_to_mysqldatetime date: ".$data['date'];
	}
	function updateWineEvent (){
		$data = array(
		'calendarId' => $this->input->post('calendarIdPostUpdate'),			
		'date' => date_to_mysqldatetime($this->input->post('datePostUpdate')),
		'notes' => $this->input->post('notesPostUpdate')
		);
		//echo "data array";
		//print_r ($data);
		//$this->detail_view->addRecord($data);	
		if($this->input->post('actionTypePostUpdate') == 'wineActionUpdate')
			{
				$wineActionsDescIdPost = $this->input->post('wineActionIdPostUpdate');				
				
				$this->detail_view->updateWineProcessRecord($data, $wineActionsDescIdPost);
			}
		else if($this->input->post('actionTypePostUpdate') == 'labActionUpdate')
			{
			//echo "lab action";	
			$data2 = array(
			'wineActionsDescId' => $this->input->post('labActionIdPostUpdate'),	
			'labValue' => $this->input->post('labValuePostUpdate'),	
			'labUnit' => $this->input->post('unitValuePostUpdate')			
			);
			// insert into tables labActions and theMaking
			$this->detail_view->updateLabProcessRecord($data, $data2);
			}
		
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		//	echo "not logged in";
		//$data['main_content'] = 'welcomemine2';
		//$this->load->view('includes/template', $data);	
			redirect('login');
		//	echo 'You don\'t have permission to access this page. <a href="'. base_url().'login">Login</a>';	
		//	$this->load->view('login_form');
		//	die();		
			//$this->load->view('login_form');
		}		
	}	

}
