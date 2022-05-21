<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome2 extends CI_Controller {

	function __construct()
  	{
		parent::__construct();
    	$this->load->model('ModelWelcome2');
  	}


	public function index()
	{
		$this->load->view('welcome_message2');
	}

	public function ver()
	{
		$data=$this->ModelWelcome2->getver();
		echo json_encode($data);
	}

}