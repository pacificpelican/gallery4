<?php
class Chats extends CI_Controller
{
	//	Chats controller for lovebirdsconsulting.com web app
	//	by Dan McKeown http://danmckeown.info
	//	copyright 2016
public function create_chat()
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');

	    $query = $this->user->get_users_row_via_login($login);

		foreach ($query->result() as $row)
		{
			$uid = $row->id;
		   	$login = $row->login;	
		   	$email0 = $row->email;
		   	$user_level = $row->email;
		}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			$pagedata = array();

			if ($the_l_row['level'] >= USER_LEVEL_MESSAGING) 
			{
				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = "Create Message";

				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('chat_create_view', $pagedata);
				
				$this->load->view('site_footer', $footerdata);
			}
			else 
			{
				$this->session->set_flashdata('info', 'account error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}
		else 
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else 
	{
		$this->session->set_flashdata('info', 'not logged in');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function process_chat()
{
	$this->load->model('user');

	$loginOG = $this->session->userdata('login');

	$this->load->library('form_validation');
	$this->form_validation->set_rules('users_to', 'Usersto', 'trim|required|min_length[2]|max_length[300]');
	$this->form_validation->set_rules('chat', 'Chat', 'required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'message data not complete');
		$this->load->helper('url');
		redirect('/chat/create', 'refresh');
	}
	else
	{
		if ($this->user->check_session_login()) 
		{
			$login = $this->session->userdata('login');

		    $query = $this->user->get_users_row_via_login($login);

				foreach ($query->result() as $row)
				{
					$uid = $row->id;
				   	$login = $row->login;	
				   	$email0 = $row->email;
				}
			if (isset($uid))
			{
			    $query0 = $this->user->get_users_levels_row_via_id($uid);

				$the_l_row = $query0->row_array();

				if ($the_l_row['level'] >= USER_LEVEL_MESSAGING) 
				{
					$postdata = $this->input->post();
					//	put the message in the database and note who it is to and from in chats and users_chats
					$this->load->model('chat');
					$postdata['users_from_id'] = $uid;

					$Alogin = $postdata['users_to'];

					if ($Alogin == "public")
					{
						$this->load->helper('date');
						$newdate = now('America/Los_Angeles');
						$z = date("Y-m-d H:i:s");

						$posted_at = $z;
						$postedat = $z;

						$posted_at_epoch = $newdate;	//	this is the backup date mechanism
						$postedatepoch = $newdate;

						$this->load->helper('user');
						$uid = get_user_id_via_current_login();

						$chat = array(
				        	'updated_at' => $z,
				       		'created_at' => $z,
				       		'created_at_epoch' => $newdate,
				       		'updated_at_epoch' => $newdate,
				       		'chat' => $postdata['chat'],
				       		'users_id' => $uid
							);

						$this->load->database();
						$WriteNewChat = $this->db->insert('public_chats', $chat); 
						$this->session->set_flashdata("info", "message posted to <a href='/timeline'>timeline</a>");
						$this->load->helper('url');
						redirect("/", "refresh");
					}
					else
					{
						$this->load->helper('user');
						$postdata['users_to_id'] = get_users_id_via_login($Alogin);

						if ($postdata['users_to_id'] != null)
						{
							$chatSuccess = $this->chat->doTheEvolution($postdata);
							if ($chatSuccess == TRUE)
							{
								$this->session->set_flashdata("info", "Message sent.");
								$this->load->helper('url');
								redirect("/", "refresh");
							}
							else 
							{
								$this->session->set_flashdata("info", "MESSAGING ERROR: error sending message");
								$this->load->helper('url');
								redirect("/", "refresh");
							}
						}
						else
						{
							$this->session->set_flashdata("info", "MESSAGING ERROR: no recipient");
							$this->load->helper('url');
							redirect("/", "refresh");
						}
					}
				}
				else
				{
					$this->session->set_flashdata("info", "MESSAGING ERROR: account access error");
					$this->load->helper('url');
					redirect("/", "refresh");
				}
			}
			else
			{
				$this->session->set_flashdata("info", "MESSAGING ERROR: account access error");
				$this->load->helper('url');
				redirect("/", "refresh");
			}
		}
		else
		{
			$this->session->set_flashdata("info", "MESSAGING ERROR: user must log in");
			$this->load->helper('url');
			redirect("/", "refresh");
		}
	}
}

public function chat_index()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/messages'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login required");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->model('chat');
		$query0 = $this->chat->get_the_chats_to($uid);

		$posts = array();
		$c = 0;

		foreach ($query0->result() as $row)
		{
			$chats_id = $row->chats_id;
			$users_chats_id = $row->id;
			$users_to_id = $row->users_to_id;
			$users_from_id = $row->users_from_id;
			$updated_date = $row->updated_at;

			$query1 = $this->chat->get_a_chat_by_id($chats_id);

			$the_chat_row = $query1->row_array();

			$chat = $the_chat_row['chat'];
			$the_l_row = array();

			$this->load->model('user');
			$the_l_row['users_from_login'] = $this->user->get_users_login_via_id($users_from_id);

			$the_l_row['chats_id'] = $chats_id;
			$the_l_row['users_to_id'] = $users_to_id;
			$the_l_row['id'] = $users_chats_id;
			$the_l_row['users_from_id'] = $users_from_id;
			$the_l_row['chat'] = $chat;
			$the_l_row['updated_date'] = $updated_date;

			$posts[$c] = $the_l_row;
			$c++;
		}

		$pagedata['title'] = "Your Inbox";
		$pagedata['posts'] = $posts;

		$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";

		$this->load->view('site_head_foundation', $pagedata);
		$this->load->view('nav_foundation_view', $pagedata);
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('chat_index_view', $pagedata);
		$this->load->view('site_footer', $footerdata);
	}
}

public function kill_chat($id)
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if (($uid == FALSE) || ($uid == null))
	{
		$this->session->set_flashdata("info", "login required");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->model('chat');

		$query0 = $this->chat->get_the_users_chats('$id');

		$query0 = $this->chat->get_the_chats_to($uid);

		$the_row = $query0->row_array();

		$killTarget = $the_row['id'];

		if (((isset($the_row)) && ($the_row['users_to_id'] == $uid)) && ($killTarget != null))
			{
				$pdata = array();
				$pdata['users_to_id'] = null;

				$this->load->database();
				$this->db->update('users_chats', $pdata, array('id' => $killTarget));

				$this->session->set_flashdata('info', 'message deleted');
				$this->load->helper('url');
				redirect('/messages', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: message access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
	}
}

public function chats_timeline()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/timeline'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login required to view timeline");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->model('chat');

		$query0 = $this->chat->get_37_chats();

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$users_chats_id = $row->id;
			$users_from_id = $row->users_id;
			$updated_date = $row->updated_at;

			$chat = $row->chat;

			$the_l_row = array();

			$the_l_row['id'] = $users_chats_id;
			$the_l_row['users_from_id'] = $users_from_id;
			$the_l_row['chat'] = $chat;
			$this->load->model('user');
			$the_l_row['users_from_login'] = $this->user->get_users_login_via_id($users_from_id);
			$updated_date = $row->updated_at;
			$the_l_row['updated_at'] = $updated_date;

			$posts[$c] = $the_l_row;
			$c++;
		}

		$pagedata['title'] = "Public Timeline";
		$pagedata['posts'] = $posts;

		$this->load->view('site_head_foundation', $pagedata);
		$this->load->view('nav_foundation_view', $pagedata);
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('public_timeline_view', $pagedata);
		$this->load->view('site_footer');
	}
}

public function user_edit_page()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
		{
			$this->load->model('chat');
			$query0 = $this->chat->get_all_chats_desc();

			$posts = array();
			$c = 0;
			foreach ($query0->result() as $row)
			{
				$post_id = $row->id;
				$post_title = $row->chat;
				$created_date = $row->updated_at;

				$the_l_row = array();
				$the_l_row['post_id'] = $post_id;
				$the_l_row['post_title'] = $post_title;

				$posts[$c] = $the_l_row;
				$c++;
			}

			$pagedata['title'] = "Edit Public Timeline Posts";
			$pagedata['posts'] = $posts;

			$this->load->view('site_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('chat_edit_list_view', $pagedata);
			$this->load->view('blog_sidebar_view', $pagedata);
			$this->load->view('site_footer');
		}
		else
		{
			$this->session->set_flashdata('info', 'account access error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'log in to edit posts');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function kill_public_chat($y)
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
		{
			//	delete the public timeline message
			$this->load->database();
			$this->db->where('id', $y);
			$this->db->delete('public_chats');

			$this->session->set_flashdata('info', 'public timeline post deleted');
			$this->load->helper('url');
			redirect('/timeline/edit', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('info', 'public timeline item not deleted--ACCOUNT ACCESS ERROR');
			$this->load->helper('url');
			redirect('/timeline', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function kill_public_chat_of_user($id)
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if (($uid == FALSE) || ($uid == null))
	{
		$this->session->set_flashdata("info", "login required");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->model('chat');
		$query0 = $this->chat->go_get_a_public_chat_by_id($id);

		$the_row = $query0->row_array();

		$killTarget = $the_row['id'];

		if (((isset($the_row)) && ($the_row['users_id'] == $uid)) && ($killTarget != null))
			{
				$this->load->database();
				$this->db->where('id', $id);
				$this->db->delete('public_chats');

				$this->session->set_flashdata('info', 'message deleted');
				$this->load->helper('url');
				redirect('/messages', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: message access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
	}
}

public function user_edit_timeline_page()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_MESSAGING)
		{
			$this->load->model('chat');
			$query0 = $this->chat->get_users_pubic_chats_desc($uid);

			$posts = array();
			$c = 0;
			foreach ($query0->result() as $row)
			{
				$post_id = $row->id;
				$post_title = $row->chat;
				$created_date = $row->updated_at;

				$the_l_row = array();
				$the_l_row['post_id'] = $post_id;
				$the_l_row['post_title'] = $post_title;

				$posts[$c] = $the_l_row;
				$c++;
			}

			$pagedata['title'] = "Edit Public Timeline Posts";
			$pagedata['posts'] = $posts;

			$this->load->view('site_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('chat_edit_list_user_view', $pagedata);
			$this->load->view('blog_sidebar_view', $pagedata);
			$this->load->view('site_footer');
		}
		else
		{
			$this->session->set_flashdata('info', 'account access error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'log in to edit posts');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function create_chat_get($id)
{
	$this->load->model('user');
	$lG = $this->user->get_users_login_via_id($id);
	$r_loc = '/chat/to/' . $lG;

	$this->load->helper('url');
	redirect($r_loc, 'refresh');
}

public function create_chat_get_page($getter)
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');

		$query = $this->user->get_users_row_via_login($login);

			foreach ($query->result() as $row)
			{
				$uid = $row->id;
			   	$login = $row->login;	
			   	$email0 = $row->email;
			   	$user_level = $row->email;
			}

		if (isset($uid))
		{
			$query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			$pagedata = array();

			if ($the_l_row['level'] >= USER_LEVEL_MESSAGING) 
			{
				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = "Create Message";
				$pagedata['message_to'] = $getter;

				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('chat_create_get_view', $pagedata);
				$this->load->view('site_footer', $footerdata);
			}
			else 
			{
				$this->session->set_flashdata('info', 'account error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}
		else 
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else 
	{
		$this->session->set_flashdata('info', 'not logged in');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function inbox_redirect()
	{
		$this->load->helper('url');
		redirect('/messages', 'refresh');
	}

public function post_view($posts_id)
{
	$this->load->model('chat');
	$query2 = $this->chat->get_a_public_chat_by_id($posts_id);

	$the_row = $query2->row_array();

	if ($the_row != null)
	{
		$users_id = $the_row['users_id'];
		$this->load->model('user');
		$author_name = $this->user->get_users_login_via_id($users_id);

		foreach ($query2->result() as $row)
		{
			$post = $row->chat;
			$created0 = $row->created_at;
			$created = "Posted: " . $created0;
			$createdUTC = $created . " UTC";
		}
		if (!(isset($post))) 
		{
			$post = "NOT FOUND";
			$created = null;
			$createdUTC = $created;
		}
		else if (!(isset($title))) {
			$title = "";
		}
	}
	else 
	{
		$title = "404";
		$post = "NOT FOUND";
		$created = null;
		$createdUTC = $created;
	}

	if (!(isset($author_name)))
	{
		$author_name = "anonymous";
	}

	if (!(isset($users_id))) 
	{
		$users_id = null;
	}

	if (!(isset($podcastPayload)))
	{
		$podcastPayload = null;
	}

	$title_mx = "post by $author_name";

	$pagedata = array(
		       		'title' => $title_mx,
		       		'title_main' => $title,
		            'post' => $post,
		            'post_date'=> $createdUTC,
		            'writer' => $author_name,
		            'users_id' => $users_id
	        	);
	
	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('chat_post_view', $pagedata);
	$this->load->view('blog_skyline_view', $pagedata);
	$this->load->view('blog_post_skyline_view', $pagedata);
	$this->load->view('site_footer', $pagedata);
}

}
