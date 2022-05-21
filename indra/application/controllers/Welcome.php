<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
  	{
		parent::__construct();
    	$this->load->model('ModelWelcome');
  	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function ver()
	{
		$data=$this->ModelWelcome->getver();
		echo json_encode($data);
	}

	public function guardar()
	{
		$data=$this->ModelWelcome->getguardar();
		echo json_encode($data);
	}

	public function limpiar()
	{
		$data=$this->ModelWelcome->getlimpiar();
		echo json_encode($data);
	}
}
