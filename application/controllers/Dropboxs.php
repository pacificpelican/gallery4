<?php
class Dropboxs extends CI_Controller
{
	//	Dropboxs controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function add_file()
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

			if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING) 
			{
				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = SITE_NAME . "file upload page";
				$this->load->view('files_head_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('file_upload_view', $pagedata);
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
		$intent = array(
	       		'page' => '/files'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata('info', 'not logged in');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function process_upload()
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$this->load->database();

		$query = $this->db->select('*')->from('users')
	    ->where('login', $login)
	    ->get();

			foreach ($query->result() as $row)
			{
				$uid = $row->id;
			   	$login = $row->login;	
			   	$email0 = $row->email;
			}

		if (isset($uid))
		{
			$query0 = $this->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING) 
			{
				$this->load->helper(array('form', 'url'));
				$config['upload_path'] = DROPBOXS_FILE_PATH;
				$config['allowed_types'] = ALLOWED_FILE_UPLOAD_TYPES;
				$config['max_size'] = MAX_FILE_UPLOAD_SIZE;
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
				
					$elError = $error['error'];
					$this->session->set_flashdata("info", "ERROR: $elError");
					$this->load->helper('url');
					redirect('/upload', 'refresh');
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
		
					$file_name = $data['upload_data']['file_name'];
					$file_url = $data['upload_data']['full_path'];
					$image_status = $data['upload_data']['is_image'];

					$this->load->helper('date');
					$newdate = now('America/Los_Angeles');
					$z = date("Y-m-d H:i:s");

					$postdata['created_at'] = $z;
					$postdata['updated_at'] = $z;

					$postdata['file_url'] = $file_url;
					$postdata['file_name'] = $file_name;
					$postdata['is_image'] = $image_status;

					$postdata['users_id'] = $uid;

					$this->load->database();
					$WriteNewUserFile = $this->db->insert('users_files', $postdata);

					$base_url = "./assets/files/" . $file_name;
					$super_file_url = "<a href='" . $base_url . "'>" . $file_url . "</a>";

					$this->session->set_flashdata("info", "FILE UPLOADED TO $super_file_url");
					$this->load->helper('url');
					redirect("/files", "refresh");
				}
			}
			else
			{
				$this->session->set_flashdata("info", "FILE UPLOAD ERROR: account access error");
				$this->load->helper('url');
				redirect("/", "refresh");
			}
		}
		else
		{
			$this->session->set_flashdata("info", "FILE UPLOAD ERROR: account access error");
			$this->load->helper('url');
			redirect("/", "refresh");
		}
	}
	else
	{
		$this->session->set_flashdata("info", "FILE UPLOAD ERROR: user must log in");
		$this->load->helper('url');
		redirect("/", "refresh");
	}
}

public function files_index()
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
		$this->load->database();

		$q0 = "SELECT * FROM users_files WHERE users_id = ? ORDER BY created_at DESC LIMIT 100";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->file_name;
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
		$pagedata['title'] = "Your Files";
		$pagedata['posts'] = $posts;

		$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";

		$this->load->view('files_head_view', $pagedata);
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('file_index_view', $pagedata);
		$this->load->view('site_footer', $footerdata);
	}
}

public function kill_file($files_id)
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
		$this->load->database();

		$q0 = "SELECT * FROM users_files WHERE id = ?";
		$query0 = $this->db->query($q0, array($files_id));

		$the_row = $query0->row_array();

		$killTarget = $the_row['file_url'];

		if (((isset($the_row)) && ($the_row['users_id'] == $uid)) && ($killTarget != null))
			{
				//	delete file's record from database
				$this->db->where('id', $files_id);
				$this->db->delete('users_files');

				//	delete actual file
				unlink($killTarget);

				$this->session->set_flashdata('info', 'file deleted');
				$this->load->helper('url');
				redirect('/files', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: file access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
	}
}

}
