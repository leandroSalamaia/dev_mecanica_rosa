<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_home' , 'modelHome');

    }

	public function index(){
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('template/footer');
        $this->load->view('template/funcoes');
        
    }
}