<?php
class Pages extends CI_Controller
{
	//	Pages controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function front_page()
{
	$this->load->view('front_page_head_view');
	$this->load->view('nav_bootstrap_view');
	$this->load->view('header_link_flash_view');
	$this->load->view('front_page_view');
	$this->load->view('front_page_footer_view');					
}

public function four_o_four_page()
{
	$pagedata['title'] =  SITE_NAME . " | 404 NOT FOUND";

	$this->load->view('four_o_four_head_view', $pagedata);
	$this->load->view('nav_bootstrap_view');
	$this->load->view('header_link_flash_view');
	$this->load->view('four_o_four_view');
	$this->load->view('front_page_footer_view');					
}

public function create_new_page()
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$this->load->database();

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

			if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING) 
			{
				$pagedata['title'] = "djmblog.com page creation page";
				$this->load->view('site_head', $pagedata);
				$this->load->view('nav_bootstrap_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('page_create_view', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
			}
			else 
			{
				$this->session->set_flashdata('info', 'account cannot create pages');
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

public function process_blog_post()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->database();

		$query0 = $this->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

		$the_l_row = $query0->row_array();
				
		if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING) 
		{

			$postdata  = $this->input->post();
			$loginOG = $this->session->userdata('login');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('page', 'Post', 'required|min_length[10]');
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[2]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'page content not valid');
				$this->load->helper('url');
				redirect('/pages/create', 'refresh');
			}
			else
			{
				$this->load->database();
				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$postdata['created_at'] = $z;	
				$postdata['updated_at'] = $z;

				$this->load->helper('user');
				$users_id = get_user_id_via_current_login();

				$postdata['users_id'] = $users_id;

				$title = $postdata['title'];

				$postdata['alias'] = str_replace(" ","-",$title);

				$u_link = $postdata['alias'];

				$this->db->insert('pages', $postdata);

				$this->session->set_flashdata('info', 'page created');
				$this->load->helper('url');
				redirect("/page/$u_link", "refresh");
			}
		}
		else 
		{
			$this->session->set_flashdata('info', 'account access error');
			$this->load->helper('url');
			redirect("/", "refresh");
		}
	}
	else 
	{
		$this->session->set_flashdata('info', 'error: not logged in');
		$this->load->helper('url');
		redirect("/accounts", "refresh");
	}
}

public function blog_post($pages_alias)
{
	$this->load->database();

	$query = $this->db->select('*')->from('pages')
		    ->where('alias', $pages_alias)
		    ->get();

	$the_row = $query->row_array();

	if ($the_row != null)
	{
		$users_id = $the_row['users_id'];
		$this->load->model('user');
		$author_name = $this->user->get_users_login_via_id($users_id);

		foreach ($query->result() as $row)
		{
			$title = $row->title;	
			$post = $row->page;
			$created0 = $row->updated_at;
			$created = "Updated: " . $created0;
			$createdUTC = $created . " UTC";
		}
		if (!(isset($post))) 
		{
			$title = "404";
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

	$title_mx = $title . " | " . SITE_NAME;

	$pagedata = array(
	       		'title' => $title_mx,
	       		'title_main' => $title,
	            'post' => $post,
	            'post_date'=> $createdUTC,
	            'writer' => $author_name,
	            'users_id' => $users_id
	        );
	$footerdata = array("footerBrand" => "<a id='footer_page_link' href='" . SITE_URL . "'><button class='btn btn-link' id='page_footer_button'>" . SITE_NAME . "</button></a>");

	$this->load->view('page_head', $pagedata);
	$this->load->view('page_view', $pagedata);
	$this->load->view('site_footer', $footerdata);
}

public function user_edit_page()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();

		$q0 = "SELECT * FROM users_levels WHERE users_id = ?";
		$query0 = $this->db->query($q0, array($uid));

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING)
		{
			$q0 = "SELECT * FROM pages WHERE users_id = ? ORDER BY id DESC";
			$query0 = $this->db->query($q0, array($uid));

			$posts = array();
			$c = 0;
			foreach ($query0->result() as $row)
			{
				$post_id = $row->id;
				$post_title = $row->title;
				$created_date =  $row->created_at;
				$alias =  $row->alias;

				$the_l_row = array();
				$the_l_row['post_id'] = $post_id;
				
				if ($post_title == "")
				{
					$post_title = "posted on " . $created_date;
				}
				$the_l_row['post_title'] = $post_title;
				$the_l_row['alias'] = $alias;

				$posts[$c] = $the_l_row;
				$c++;
			}

			$pagedata['title'] = "Edit Pages";
			$pagedata['posts'] = $posts;

			$this->load->view('site_head', $pagedata);
			$this->load->view('nav_bootstrap_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('page_edit_list_view', $pagedata);
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
		$this->session->set_flashdata('info', 'log in to edit pages');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function delete_post_process($kill_post_id)
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$q0 = "SELECT * FROM users_levels WHERE users_id = ?";
		$query0 = $this->db->query($q0, array($uid));
		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING)
		{
			$q0 = "SELECT * FROM pages WHERE id = ?";
			$query0 = $this->db->query($q0, array($kill_post_id));

			$the_p_row = $query0->row_array();

			if ((isset($the_p_row)) && ($the_p_row['users_id'] == $uid))
			{
				$this->db->where('id', $kill_post_id);
				$this->db->delete('pages');

				$this->session->set_flashdata('info', 'page deleted');
				$this->load->helper('url');
				redirect('/edit/pages', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: page access error');
				$this->load->helper('url');
				redirect('/edit/pages', 'refresh');
			}
		}
		else 
		{
			$this->session->set_flashdata('info', 'did not delete: account access error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'log in to delete pages');
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
}

public function edit_blog_post($p_id)
{
	$this->load->database();

	$q1 = "SELECT * FROM pages WHERE alias = ?";
	$query = $this->db->query($q1, array($p_id));

	foreach ($query->result() as $row)
	{
		$title = $row->title;	
		$post = $row->page;
		$post_id = $row->id;
		$alias = $row->alias;
	}
		
	if (isset($post))
	{
		$pagedata = array(
       		'title' => $title,
            'post' => $post,
            'post_id' => $post_id,
            'podcastPayload' => $alias
        );

		$this->load->view('site_head', $pagedata);
		$this->load->view('nav_bootstrap_view', $pagedata);
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('page_edit_view', $pagedata);
		$this->load->view('blog_sidebar_view', $pagedata);
		$this->load->view('site_footer');
		}
	else 
	{
		$this->session->set_flashdata('info', 'error');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function edit_blog_process()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$q0 = "SELECT * FROM users_levels WHERE users_id = ?";
		$query0 = $this->db->query($q0, array($uid));
		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING)
		{
			$postdata = $this->input->post();
			$post_id = $postdata['post_id'];
			
			$q0 = "SELECT * FROM pages WHERE id = ? AND users_id = ?";
			$query0 = $this->db->query($q0, array($post_id, $uid));
			$total = 0;
			foreach ($query0->result() as $row)
			{
				$total++;
			}
			if ($total > 0)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('page', 'Post', 'required|min_length[10]');

				if ($this->form_validation->run() != FALSE)
				{
					$this->load->database();
					$this->load->helper('date');
					$newdate = now('America/Los_Angeles');
					$z = date("Y-m-d H:i:s");
					$postdata['updated_at'] = $z;
					unset($postdata['post_id']);
					$this->db->update('pages', $postdata, array('id' => $post_id));
					$this->session->set_flashdata('info', 'page updated');
					$this->load->helper('url');
					redirect("/edit/pages", "refresh");
				}
				else
				{
					$this->session->set_flashdata('info', 'page not valid');
					$this->load->helper('url');
					redirect('/edit/pages', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'page access error');
				$this->load->helper('url');
				redirect("/edit/pages", "refresh");
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'account access error');
			$this->load->helper('url');
			redirect("/account", "refresh");
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'not logged in');
		$this->load->helper('url');
		redirect("/login", "refresh");
	}
}

public function take_to_magazine()
{
	$this->load->helper('url');
	redirect("/page/magazine", "refresh");
}

}
