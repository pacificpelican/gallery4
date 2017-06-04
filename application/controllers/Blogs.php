<?php
class Blogs extends CI_Controller
{
	//	Blogs controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function blog_post($posts_id)
{	//	This method is the 'perma-link' single post view, takes the id parameter and checks for post in users_posts
	$this->load->database();

	$query = $this->db->select('*')->from('posts')
    ->where('id', $posts_id)
    ->get();

	$query2 = $this->db->select('*')->from('users_posts')
    ->where('posts_id', $posts_id)
    ->get();

	$the_row = $query2->row_array();

	if ($the_row != null)
	{
		$users_id = $the_row['users_id'];
		$this->load->model('user');
		$author_name = $this->user->get_users_login_via_id($users_id);
		$name0 = $this->user->get_users_name_via_id($users_id);

		foreach ($query->result() as $row)
		{
			$title = $row->title;
			$post = $row->post;
			$created0 = $row->created_at;
			$created = "Posted: " . $created0;
			$createdUTC = $created . " UTC";
			$podcastPayload = $row->podcast_url;
		//	$name0 = $row->name;
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

	if (!(isset($name0)))
	{
		$name0 = "n/a";
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
	            'users_id' => $users_id,
	            'podcastPayload' => $podcastPayload,
	            'writer' => $name0
	        );

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('blog_post_view', $pagedata);
	$this->load->view('blog_skyline_view', $pagedata);
	$this->load->view('blog_post_skyline_view', $pagedata);
	$this->load->view('site_footer', $pagedata);
}

public function create_blog_post()
{	//	This launches the view that has a form to write blog posts (with tags and podcast enclosures allowed)
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING)
			{
				$pagedata['title'] = "djmblog.com blog post creation page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view');
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('blog_post_create_view', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
			}
			else
			{
				$this->session->set_flashdata('info', 'account cannot create blog posts');
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
{	//	This accepts the post data from the blog post writing form and provided conditions are met creates the post
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
			$this->form_validation->set_rules('post', 'Post', 'required|min_length[10]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'blog post not valid');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->load->database();
				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$tagdata = $postdata['tags'];
				unset($postdata['tags']);

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['created_at_epoch'] = $newdate;
				$postdata['updated_at_epoch'] = $newdate;

				$this->db->insert('posts', $postdata);
				$posts_id = $this->db->insert_id();
				$loginOG = $this->session->userdata('login');
				$this->load->helper('user');
				$users_id = get_user_id_via_current_login();

				$postdata2['users_id'] = $users_id;
				$postdata2['posts_id'] = $posts_id;
				$this->db->insert('users_posts', $postdata2);

				$separator = ",";
				$raw_tags = explode($separator, $tagdata);

				foreach ($raw_tags as $key => $value)
				{
					$current = trim($value);

					if ($current != "")
					{
						$tag_data['tag'] = $current;
						$tag_data['users_id'] = $users_id;
						$tag_data['created_at'] = $z;
						$tag_data['updated_at'] = $z;

						$query0 = $this->db->select('*')->from('tags')
                        ->where('tag', $current)
                        ->get();

						$the_T_row = $query0->row_array();

						if (isset($the_T_row['tag']))
						{
							$post_tag_data['tags_id'] = $the_T_row['id'];
						}
						else
						{
							$this->db->insert('tags', $tag_data);

							$post_tag_data['tags_id'] = $this->db->insert_id();
						}

						$post_tag_data['posts_id'] = $posts_id;
						$this->db->insert('posts_tags', $post_tag_data);
					}
				}
				$this->session->set_flashdata('info', 'blog post created');
				$this->load->helper('url');
				redirect("/blogs/$posts_id", "refresh");
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

public function edit_blog_post($p_id)
{	//	This method loads a specific blog post based on parameter provided and puts it into a form for editing
	$this->load->database();

	$query = $this->db->select('*')->from('posts')
    ->where('id', $p_id)
    ->get();

	foreach ($query->result() as $row)
	{
		$title = $row->title;
		$post = $row->post;
		$post_id = $row->id;
		$podcastPayload = $row->podcast_url;
	}

	if (isset($post))
	{
		$pagedata = array(
       		'title' => $title,
            'post' => $post,
            'post_id' => $post_id,
            'podcastPayload' => $podcastPayload
        );

		$this->load->view('site_head_foundation', $pagedata);
		$this->load->view('nav_foundation_view');
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('blog_post_edit_view', $pagedata);
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
{	//	This method accepts the post data from the blog editing form and provided conditions are met, edits the post
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
			$postdata = $this->input->post();
			$post_id = $postdata['post_id'];
		
			$q0 = "SELECT * FROM users_posts WHERE posts_id = ? AND users_id = ?";
			$query0 = $this->db->query($q0, array($post_id, $uid));
			$total = 0;
			foreach ($query0->result() as $row)
			{
				$total++;
			}
			if ($total > 0)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('post', 'Post', 'required|min_length[10]');

				if ($this->form_validation->run() != FALSE)
				{
					$this->load->database();
					$this->load->helper('date');
					$newdate = now('America/Los_Angeles');
					$z = date("Y-m-d H:i:s");
					$postdata['updated_at'] = $z;
					$postdata['updated_at_epoch'] = $newdate;
					unset($postdata['post_id']);
					$this->db->update('posts', $postdata, array('id' => $post_id));
					$this->session->set_flashdata('info', 'blog post updated');
					$this->load->helper('url');
					redirect("/blogs/$post_id", "refresh");
				}
				else
				{
					$this->session->set_flashdata('info', 'blog post not valid');
					$this->load->helper('url');
					redirect('/', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'post access error');
				$this->load->helper('url');
				redirect("/", "refresh");
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

public function blogs_index()
{	//	This creates a page that lists the last 20 blog posts created (ordered by id)
	$this->load->database();
	$q0 = "SELECT * FROM users_posts LEFT JOIN posts on users_posts.posts_id=posts.id ORDER BY posts.id DESC LIMIT 20";

	$query0 = $this->db->query($q0);

	$posts = array();
	$c = 0;
	foreach ($query0->result() as $row)
	{
		$post_id = $row->id;
		$post_title = $row->title;
		$created_date =  $row->created_at;

		$the_l_row = array();
		$the_l_row['post_id'] = $post_id;

		if ($post_title == "")
		{
			$post_title = "posted on " . $created_date;
		}
		$the_l_row['post_title'] = $post_title;

		$posts[$c] = $the_l_row;
		$c++;
	}

	$pagedata['title_posts'] = "Latest Posts";
	$pagedata['title'] = SITE_NAME . " latest blog posts";
	$pagedata['posts'] = $posts;

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('blog_index_view', $pagedata);

	$this->load->view('blog_skyline_view', $pagedata);
	$this->load->view('site_footer');
}

public function user_edit_page()
{	//	This method finds a user's blog posts and lists them for linking, editing and deletion
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
			$q0 = "SELECT * FROM users_posts LEFT JOIN posts on users_posts.posts_id=posts.id WHERE users_id = ? ORDER BY posts.id DESC";
			$query0 = $this->db->query($q0, array($uid));

			$posts = array();
			$c = 0;
			foreach ($query0->result() as $row)
			{
				$post_id = $row->id;
				$post_title = $row->title;
				$created_date =  $row->created_at;

				$the_l_row = array();
				$the_l_row['post_id'] = $post_id;

				if ($post_title == "")
				{
					$post_title = "posted on " . $created_date;
				}
				$the_l_row['post_title'] = $post_title;

				$posts[$c] = $the_l_row;
				$c++;
			}

			$pagedata['title'] = "Edit Posts";
			$pagedata['posts'] = $posts;

			$this->load->view('site_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view');
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('blog_edit_list_view', $pagedata);
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

public function delete_post_process($kill_post_id)
{	//	This method handles requsts to delete a blog post--will carry out deletion if access is granted
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
			$q0 = "SELECT * FROM users_posts LEFT JOIN posts on users_posts.posts_id=posts.id WHERE users_posts.posts_id = ?";
			$query0 = $this->db->query($q0, array($kill_post_id));

			$the_p_row = $query0->row_array();

			if ((isset($the_p_row)) && ($the_p_row['users_id'] == $uid))
			{
				$this->db->where('posts_id', $kill_post_id);
				$this->db->delete('users_posts');

				$this->session->set_flashdata('info', 'post deleted');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: post access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'did not delete: account access error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'log in to delete posts');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function blogs_rss()
{	//	This method generates a valid RSS 2.0 feed based on the last 20 posts
	$Blog_URL = SITE_URL;

	$this->load->database();
	$q0 = "SELECT * FROM users_posts LEFT JOIN posts on users_posts.posts_id=posts.id ORDER BY posts.id DESC LIMIT 20";

	$query0 = $this->db->query($q0);

	$posts = array();
	$c = 0;
	foreach ($query0->result() as $row)
	{
		$post_id = $row->id;
		$post_title = $row->title;
		$created_date = $row->updated_at;
		$post_content = $row->post;
		$podcastPayload = $row->podcast_url;

		$the_l_row = array();
		$the_l_row['post_id'] = $post_id;

		if ($post_title == "")
		{
			$post_title = "posted on " . $created_date;
		}
		$the_l_row['post_title'] = $post_title;
		$the_l_row['post'] = $post_content;
		$the_l_row['updated_at'] = $created_date;
		$the_l_row['podcastPayload'] = $podcastPayload;

		$posts[$c] = $the_l_row;
		$c++;
	}

	$pagedata['title'] = "djmblog.com Latest Posts";
	$pagedata['posts'] = $posts;

	$pagedata['blog_url'] = $Blog_URL;

	$this->output->set_content_type('xml', 'utf-8');	//	This makes the page output as an XML file obviously
	$this->load->view('blog_rss_view', $pagedata);
}

}
