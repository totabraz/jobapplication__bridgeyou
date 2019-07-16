<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
        redirect('home', 'refresh');

    }
    
    public function home(){
		$this->load->view('header');
		$this->load->view('list-users');
		$this->load->view('registration');
		$this->load->view('footer');

    }
}
