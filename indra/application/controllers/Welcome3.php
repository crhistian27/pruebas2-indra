<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome3 extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message3');
	}

}