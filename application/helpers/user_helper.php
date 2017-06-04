<?
	//	user helper for lovebirdsconsulting.com by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->
	function get_user_id_via_current_login()
	{	//	a way to check which user is logged in, often used to check for access
		$beast = get_instance();
		$beast->load->database();

		$loginOG = $beast->session->userdata('login');
		// $q1 = "SELECT * FROM users WHERE login='" . $loginOG . "'";
		// $query = $beast->db->query($q1);
		$q1 = "SELECT * FROM users WHERE login = ?";
		$query = $beast->db->query($q1, array($loginOG));
		$theuser = $query->row_array();
		$theuser_id = $theuser['id'];

		if (isset($theuser_id)) {
			return $theuser_id;
		}
		else
		{
			return FALSE;	
		}
	}

	function djm_date()
	{	//	a utilty function to streamline the creation of created_at and updated_at database fields
		$beast = get_instance();
		$beast->load->helper('date');

		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");
		
		$payload = array($newdate, $z);
		return $payload;
	}

	function create_default_user_level($users_id)
	{
		$level = DEFAULT_NEW_USER_LEVEL;

		$beast = get_instance();
		$beast->load->database();

		$l_data = array(
               'users_id' => $users_id,
               'level' => $level
            );

		$beast->db->insert('users_levels', $l_data); 	
	}

	function encrypt_card($incoming)
	{	//	used for storing credit card info at /add/card
		$pass = SUPERCOiN;
		$iv = MINICOiN;

		$method = CARD_METHOD;

		$newData = openssl_encrypt($incoming, $method, $pass, true, $iv);

		return $newData;
	}

	function decrypt_card($stored_data)
	{	//	used for reading credit card info that was stored at /add/card
		$pass = SUPERCOiN;
		$iv = MINICOiN;

		$method = CARD_METHOD;

		$recoveredCard = openssl_decrypt($stored_data, $method, $pass, true, $iv);

		return $recoveredCard;
	}

	function en_test_h($inp)
	{
		$or = $inp;

		$method = CARD_METHOD;

		$pass = SUPERCOiN;
		$iv = MINICOiN;

		$newData = openssl_encrypt($or, $method, $pass, true, $iv);

		$oData = openssl_decrypt($newData, $method, $pass, true, $iv);

		echo "--- $or ecnrypted to $newData and decrypted to $oData";
	}

	function get_users_id_via_login($login)
	{	//	a utility function used for getting data ready for the database etc.
		$beast = get_instance();
		$beast->load->database();
		// $q1 = "SELECT id FROM users WHERE login='" . $login . "'";
		// $query = $beast->db->query($q1);
		$q1 = "SELECT id FROM users WHERE login = ?";
		$query = $beast->db->query($q1, array($login));
		$thestrain = $query->row_array();

		return $thestrain['id'];
	}

	function verify_nonduplicate_login($login)
	{	//	a check against reusing user names
		$beast = get_instance();
		$beast->load->database();
	
		// $q1 = "SELECT * FROM users WHERE login='" . $login . "'";
		// $query = $beast->db->query($q1);

		$q1 = "SELECT * FROM users WHERE login = ?";
		$query = $beast->db->query($q1, array($login));

		$theuser = $query->row_array();

		return $theuser;
	}

	function get_all_users_ever()
	{
		$beast = get_instance();
		$beast->load->database();

		$q1 = "SELECT * FROM users ORDER BY created_at ASC LIMIT 100";
		$theusers = $beast->db->query($q1);

		$n = array();
		$c = 0;

		foreach ($theusers->result() as $row)
		{
		   $n[$c]['users_id'] = $row->id;	
		   $n[$c]['login'] = $row->login;
		   $c++;
		}

		return $n;
	}
	function return_users_levels_row_via_id($uid) 
	{
		$beast = get_instance();
		$beast->load->database();

		$query0 = $beast->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

		return $query0;
	}

?>