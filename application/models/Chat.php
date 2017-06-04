<?php 
class Chat extends CI_Model  
//	This file should be named Chat.php (first letter capitalized)
{
	//	Chat model originally for djmblog.com by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->

	function doTheEvolution($posted)
	{
		if (!((isset($posted['chat'])) && (isset($posted['users_from_id']))))
		{
			return FALSE;
		}
		else
		{
			//	make the chat
			$chat = $posted['chat'];
	
			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			$posted_at = $z;
			$postedat = $z;

			$posted_at_epoch = $newdate;	//	this is the backup date mechanism
			$postedatepoch = $newdate;

			$chat = array(
	        	'updated_at' => $z,
	       		'created_at' => $z,
	       		'created_at_epoch' => $newdate,
	       		'updated_at_epoch' => $newdate,
	       		'chat' => $chat
				);

			$WriteNewChat = $this->db->insert('chats', $chat); 
			$chats_id = $this->db->insert_id();

			$users_chats = array(
	        	'updated_at' => $z,
	       		'created_at' => $z,
	       		'created_at_epoch' => $newdate,
	       		'updated_at_epoch' => $newdate,
	       		'chats_id' => $chats_id,
	       		'users_from_id' => $posted['users_from_id'],
	       		'users_to_id' => $posted['users_to_id']
				);

			$WriteNewChat = $this->db->insert('users_chats', $users_chats);

			return TRUE;
		}
	}

	function get_the_chats_to($uid)
	{
		$this->load->database();
		$q0 = "SELECT * FROM users_chats WHERE users_to_id = ? ORDER BY created_at DESC LIMIT 100";
		$query0 = $this->db->query($q0, array($uid));
		return $query0;
	}

	function get_the_users_chats($id)
	{
		$this->load->database();
		$query0 = $this->db->select('*')->from('users_chats')
			    ->where('id', $id)
			    ->get();	//	Does this do anything? (where it's used in the controller I mean..)
		return $query0;
	}

	function get_37_chats()
	{
		$this->load->database();
		$q0 = "SELECT * FROM public_chats ORDER BY created_at DESC LIMIT 37";
		$query0 = $this->db->query($q0);
		return $query0;
	}

	function get_all_chats_desc()
	{
		$this->load->database();
		$q0 = "SELECT * FROM public_chats ORDER BY updated_at DESC";
		$query0 = $this->db->query($q0);
		return $query0;
	}

	function go_get_a_public_chat_by_id($id)
	{
		$this->load->database();
		$query0 = $this->db->select('*')->from('public_chats')
			    ->where('id', $id)
			    ->get();
		return $query0;
	}

	function get_users_pubic_chats_desc($uid)
	{
		$this->load->database();
		$q0 = "SELECT * FROM public_chats WHERE users_id = ? ORDER BY updated_at DESC";
		$query0 = $this->db->query($q0, array($uid));
		return $query0;
	}

	function get_a_public_chat_by_id($posts_id)
	{
		$this->load->database();
		$q2 = "SELECT * FROM public_chats WHERE id = ?";
		$query2 = $this->db->query($q2, array($posts_id));
		return $query2;
	}

	function get_a_chat_by_id($chats_id)
	{
		$this->load->database();
		$q1 = "SELECT * FROM chats WHERE id='" . $chats_id . "' ORDER BY created_at ASC LIMIT 100";
		$query1 = $this->db->query($q1);
		return $query1;
	}

}
