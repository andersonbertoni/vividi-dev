<?php

class Model_login extends CI_Model
{
    function cek_login($user, $pass)
    {
        $this->db->where('user_login', $user);
        $this->db->where('user_pass', $pass);
        return $this->db->get('wpwj_users');
    }

    function login($user, $pass){
    	$query = $this->db->query("SELECT * FROM wpwj_users where user_login = '$user' and user_pass = '$pass'");
    	return $query;
	}

    function proses_login($user, $pass)
    {
        $this->db->select('wpwj_users.user_email, wpwj_users.user_login, wpwj_users.user_pass, wpwj_usermeta.meta_value, wpwj_users.display_name, wpwj_users.ID, wpwj_users.name_hotel');
        $this->db->from('wpwj_users');
        $this->db->join('wpwj_usermeta', 'wpwj_users.ID = wpwj_usermeta.user_id');
        $this->db->where('wpwj_users.user_login', $user);
        $this->db->where('wpwj_users.user_pass', $pass);
        $this->db->where('wpwj_usermeta.meta_key', 'wpwj_capabilities');
        $query = $this->db->get()->row();
        return $query;
    }
}
