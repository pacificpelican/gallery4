<?php 
class User extends CI_Model  
//	This file should be named User.php (first letter capitalized)
{
	//	User model for LoveBird created by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->
	function add_new_user($postdata)
	{	//	this function is called to add a new user after duplicate checks etc.
		$this->load->database();
		$ht = $postdata['password'];

		$alg = PW_ALGORITHM;
		$postdata['password'] = hash($alg, $ht);	//	This stores the password as a hash

		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata['created_at'] = $z;				//	this is the mySQL-standard date
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		$key_mix0 = rand(5, 1500);
		$key_mix = $key_mix0 + $newdate;

		$api_alg = API_ALGORITHM;
		$apikey = hash($api_alg, $key_mix);
		$postdata['api_key'] = $apikey;

		$postdata['login'] = strtolower($postdata['login']);

		$wantedLogin = $postdata['login'];
		$this->load->helper('user');
		$isLogin = verify_nonduplicate_login($wantedLogin);

		if ($isLogin != null)
		{
			return FALSE;
		}
		else
		{
			if ($postdata['login'] == 'public')
			{
				return FALSE;
			}
			else
			{
				$this->db->insert('users', $postdata); 
				$users_id = $this->db->insert_id();

				$this->load->helper('user');
				$new_basic_user_created = create_default_user_level($users_id);
			}
		}
	}

	function start_session($logondata)
	{	//	a session is started (user is logged in) based on array argument
		$this->session->set_userdata($logondata);
	}

	function end_session()
	{	//	the user's session is ended by unsetting both login variables
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('logged');
	}

	function check_session_login()
	{
		if ($this->session->userdata('logged') == TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_user_login($p)
	{	//	this should return TRUE if the user is currently logged in (session exists)
		$login = $p['login'];
		$login = strtolower($login);
		$password_dig = $p['password'];

		$alg = PW_ALGORITHM;
		$password = hash($alg, $password_dig);

		$this->load->database();

		$q1 = "SELECT * FROM users WHERE login='" . $login . "'";
		$query = $this->db->query($q1);

		foreach ($query->result() as $row)
		{
		   $lg = $row->login;
		   $pw = $row->password;
		   $uid = $row->id;
		}

		if (isset($pw))
		{
			if ($password == $pw)
			{
				// $q0 = "SELECT * FROM users_levels WHERE users_id='" . $uid . "'";
				// $query0 = $this->db->query($q0);

				$q0 = "SELECT * FROM users_levels WHERE users_id = ?";
				$query0 = $this->db->query($q0, array($uid));

				$the_l_row = $query0->row_array();

				if ($the_l_row['level'] >= 1) 
				{
					return TRUE;
				}
				else 
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function get_users_login_via_id($id)
	{	//	a useful utility function for getting user login from database quickly
		$this->load->database();
		// $q1 = "SELECT login FROM users WHERE id='" . $id . "'";
		// $query = $this->db->query($q1);
		$q1 = "SELECT login FROM users WHERE id = ?";
		$query = $this->db->query($q1, array($id));
		$thestrain = $query->row_array();

		return $thestrain['login'];
	}

	public function check_dup($usr1)
	{	//	check to see if the argument provided is an existing login ing the database
		$this->load->database();
		// $q1 = "SELECT * FROM users WHERE login='" . $usr1 . "'";
		// $query = $this->db->query($q1);
		$q1 = "SELECT * FROM users WHERE login = ?";
		$query = $this->db->query($q1, array($usr1));
		$thestrain = $query->row();

		if($query->num_rows() > 0)
		{
    		return FALSE;
		} 
		else 
		{
   			return TRUE;
		}
	}

	function edit_a_user($postdata)
	{	//	this function is called to change a user's (non-password) info after permission checks
		$this->load->database();
		$loginOG = $this->session->userdata('login');
		// $q1 = "SELECT * FROM users WHERE login='" . $loginOG . "'";
		// $query = $this->db->query($q1);
		$q1 = "SELECT * FROM users WHERE login = ?";
		$query = $this->db->query($q1, array($loginOG));
		$theuser = $query->row_array();
		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
	
		$z = date("Y-m-d H:i:s");

		$postdata['updated_at'] = $z;
		$postdata['updated_at_epoch'] = $newdate;

		$dbLogin = $theuser['login'];
		$postLogin = $postdata['login'];

		$postdata['login'] = strtolower($postdata['login']);

		$postLogin = $postdata['login'];
		$this->load->helper('user');

		if ($loginOG != $postLogin) {
			$isLogin = verify_nonduplicate_login($postLogin);
		}
		else
		{
			$isLogin = null;
		}
		
		if ($isLogin != null)
		{
			return FALSE;
		}
		else
		{
			if ($postLogin == 'public')
			{	//	this is to prevent someone from trying to become 'public' as it is reserved in Chats
				return FALSE;
			}
			else
			{
				$dbEmail = $theuser['email'];
				$postEmail = $postdata['email'];

				$dbName = $theuser['name'];
				$postName = $postdata['name'];

				$dbURL = $theuser['URL'];
				$postURL = $postdata['URL'];

				if (($dbLogin != $postLogin) || ($dbEmail != $postEmail) || ($dbName != $postName) || ($dbURL != $postURL)) {
					$this->db->update('users', $postdata, array('id' => $theuser['id']));
					return TRUE; 
				}
				else {
					return FALSE;
				}
			}
		}
	}

	function edit_a_user_pw($postdata)
	{	//	the function used to change a user password in general after permission verification
		$this->load->helper('user');
		$theuser_id = get_user_id_via_current_login();

		$ht = $postdata['password'];
		$alg = PW_ALGORITHM;
		$postdata['password'] = hash($alg, $ht);

		$this->load->helper('user');
		$dates = djm_date();
		$z = $dates[1];
		$newdate = $dates[0];

		$postdata['updated_at'] = $z;
		$postdata['updated_at_epoch'] = $newdate;

		$this->db->update('users', $postdata, array('id' => $theuser_id)); 
	}

	function edit_a_user_pw_reset($postdata)
	{	//	a specialized function for editing user password when using password reset
		$this->load->helper('user');
		$theuser_id = $postdata['id'];

		$ht = $postdata['password'];
		$alg = PW_ALGORITHM;
		$postdata['password'] = hash($alg, $ht);

		$this->load->helper('user');
		$dates = djm_date();
		$z = $dates[1];
		$newdate = $dates[0];

		$postdata['updated_at'] = $z;
		$postdata['updated_at_epoch'] = $newdate;

		$this->db->update('users', $postdata, array('id' => $theuser_id));
		return TRUE;
	}

	function get_users_name_via_id($id)
	{	//	a useful utility function for getting user login from database quickly
		$this->load->database();
		// $q1 = "SELECT name FROM users WHERE id='" . $id . "'";
		// $query = $this->db->query($q1);
		$q1 = "SELECT name FROM users WHERE id = ?";
		$query = $this->db->query($q1, array($id));
		$thestrain = $query->row_array();

		return $thestrain['name'];
	}

	function get_users_row_via_login($login)
	{
		$this->load->database();
		$query = $this->db->select('*')->from('users')
	    ->where('login', $login)
	    ->get();

	    return $query;
	}

	function get_users_levels_row_via_id($uid) 
	{
		$this->load->database();
		$query0 = $this->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

		return $query0;
	}
}
