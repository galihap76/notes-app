<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {
    
	public function index(){
     	$this->load->view('notes_app');
    }
}