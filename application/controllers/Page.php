<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
        redirect('home', 'refresh');

    }
    
    public function home(){
        $dados['page_title'] = "Venturus Sports";
        $this->load->view('header', $dados);
		$this->load->view('list-users');
		$this->load->view('registration');
		$this->load->view('footer');

    }
    public function user(){
        $dados['page_title'] = "Venturus Sports - Users";
        $dados['breadcrumb']['titles'] = ["Users"];
        $this->load->view('header', $dados);
		$this->load->view('list-users');
		$this->load->view('footer');

    }
    public function new(){
        $dados['page_title'] = "Venturus Sports - New";
        $dados['breadcrumb']['titles'] = ["Users", "News"];
        $dados['breadcrumb']['links'] = ['user'];
        $this->load->view('header', $dados);
		$this->load->view('registration');
		$this->load->view('footer');

    }
}
