<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('m_auth');
		$this->load->helper('cookie');
	}
    
	// nama tabel 
	public $namaTabel = 'testing';

	// sign in users
	public function index(){
		$this->form_validation->set_rules('username','Username', 'required',
				array('required' => 'Username jangan kosong!'));
		$this->form_validation->set_rules('password','Password', 'required',
				array('required' => 'Password jangan kosong!'));

		if($this->form_validation->run()==false){

     		$this->load->view('auth/signin');

		}else{

			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);

			$data = [
				'username' => $username,
				'password' => $password
				];

			$authLogin = $this->m_auth->cek_username($this->namaTabel, $data['username']);
			
			// cek jika username nya ada
			if($authLogin == true){

				// cek jika password nya cocok
				if(password_verify($password, $authLogin['password'])){

					// buat session
					$data_session = [
					'nama' => $username,
					'status' => "login"
					];
			
					// buat cookie	
					$cookie = [
							'name'   => 'auth',
							'value'  => hash('sha512', $username),
							'expire' => time() + (86400 * 30), 
							'path'   => '/',
							'prefix' => '',
							'secure' => true,
							'httponly' => true
						];
						
					// set cookie
					$this->input->set_cookie($cookie);
					
					//set session
					$this->session->set_userdata($data_session);
		
					// redirect halaman notes
					redirect('notes');

				// untuk cek jika password nya salah
				 }else if(!password_verify($password, $authLogin['password'])){
					$this->session->set_flashdata('password tidak valid', '<div class="alert alert-danger text-center" role="alert">
					Password tidak valid!</div>');
					redirect('auth');
				 }
	
				 // untuk cek jika username nya tidak valid
			}else{
				$this->session->set_flashdata('username tidak valid', '<div class="alert alert-danger text-center" role="alert">
				Username tidak valid!</div>');
				redirect('auth');

			}

		}
    }


	// sign up users
	public function signup(){
        $this->form_validation->set_rules('username','Username', 'required',
				array('required' => 'Username jangan kosong!'));
		$this->form_validation->set_rules('password','Password', 'required',
				array('required' => 'Password jangan kosong!'));
        
        if($this->form_validation->run()==false){
            $this->load->view('auth/signup');

		}else{
   
           	$data = [
                'username' => htmlentities($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
               ];
            
			// cek jika username nya sudah terdaftar
		   	if($this->m_auth->cek_users($data['username'])){

				// beri pesan menggunakan set flashdata
				$this->session->set_flashdata('pesan terdaftar', '<div class="alert alert-danger text-center" role="alert">
				Maaf username sudah terdaftar!</div>');
				redirect('auth/signup');

			// misal belum terdaftar
		   }else{

				// lakukan sign up users
				$this->m_auth->registrasi_users($this->namaTabel, $data);
				$this->session->set_flashdata('pesan sukses', '<div class="alert alert-success text-center" role="alert">
				Anda berhasil signup. <br> Silakan login terlebih dahulu!</div>');
				redirect('auth');
		   }
        }
        
    }

	// lupa password
	public function lupa_password(){
		$this->form_validation->set_rules('username','Username', 'required',
		array('required' => 'Username jangan kosong!'));
		$this->form_validation->set_rules('password','Password', 'required',
		array('required' => 'Password jangan kosong!'));
        
        if($this->form_validation->run()==false){
            $this->load->view('auth/lupa_password');

		}else{
            
          $data = [
			'username' => $this->input->post('username', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
          ];
        
		  $username = $this->m_auth->cek_username($this->namaTabel, $data['username']);

		  // cek jika username nya tidak sesuai
		  if($username == false){

				// beri pesan menggunakan set flashdata
				$this->session->set_flashdata('password gagal', '<div class="alert alert-danger text-center" role="alert">
						Password gagal di ubah!</div>');
				redirect('auth/lupa_password');

		  }else{

			   // misal username nya sesuai maka lakukan lupa password
				$this->m_auth->lupa_password($this->namaTabel, $data);
				$this->session->set_flashdata('password baru', '<div class="alert alert-success text-center" role="alert">
				Password berhasil di ubah!</div>');
				redirect('auth');
		    }
		}
        
    }       
 
	//logout untuk hapus session dan cookie
	public function logout(){
		$this->session->sess_destroy();
		$name_cookie = 'auth';
		$domain = '';
		$path = '/';

		delete_cookie($name_cookie, $domain, $path);
		redirect('auth');
	}
}
