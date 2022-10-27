<?php
class M_auth extends CI_Model{	
	
	// untuk validasi pada saat login dan lupa password
	public function cek_username($table, $username){	
		return $this->db->get_where($table,['username' => $username])->row_array();
	}

	// sign up atau registrasi users
	public function registrasi_users($table,$data){
		$this->db->insert($table,$data);
	}

	// untuk validasi jika username sudah terdaftar
	public function cek_users($username){
		$this->db->where('username',$username);
		$this->db->from('testing');
		$query = $this->db->get();
		if($query->num_rows() > 0){
		 return true;
		 }else{
			return false;
		}
	}

	// lupa password
	public function lupa_password($table, $data){
        $username = $this->input->post('username', true);
        $this->db->where('username', $username);
        $this->db->update($table, $data);
    }
}
