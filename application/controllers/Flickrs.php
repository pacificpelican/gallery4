<?php
class Flickrs extends CI_Controller
{
	//	Flickrs controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function add_file()
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$this->load->database();

		// $q1 = "SELECT * FROM users WHERE login='" . $login . "'";
		// $query = $this->db->query($q1);

		// $query = $this->db->select('*')->from('users')
	 //    ->where('login', $login)
	 //    ->get();

		$query = $this->user->get_users_row_via_login($login);

		foreach ($query->result() as $row)
		{
			$uid = $row->id;
		   	$login = $row->login;	
		   	$email0 = $row->email;
		}

		if (isset($uid))
		{
			// $q0 = "SELECT * FROM users_levels WHERE users_id='" . $uid . "'";
			// $query0 = $this->db->query($q0);

			// $query0 = $this->db->select('*')->from('users_levels')
		 //    ->where('users_id', $uid)
		 //    ->get();

			$query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING) 
			{
				$this->load->helper('user');
				$users_payload = array();
				$users_payload = get_all_users_ever();
				$pagedata['all_users'] = $users_payload;

				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = SITE_NAME . "file upload page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('header_link_flash_foundation_view', $pagedata);
				$this->load->view('flickrs_upload_view', $pagedata);
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
	       		'page' => '/blindfire/upload'
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

		// $q1 = "SELECT * FROM users WHERE login='" . $login . "'";
		// $query = $this->db->query($q1);

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
			// $q0 = "SELECT * FROM users_levels WHERE users_id='" . $uid . "'";
			// $query0 = $this->db->query($q0);

			$query0 = $this->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

			$the_l_row = $query0->row_array();

			$uploads = array();

			if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING) 
			{
				$filedump = $_FILES['userfiles'];

				$config['image_library'] = IMAGE_LIBRARY_PREFERENCE;
				$config['upload_path'] = GALLERYS_FILE_PATH;
				$config['allowed_types'] = GALLERYS_ALLOWED_FILE_UPLOAD_TYPES;
				$config['max_size'] = GALLERYS_MAX_FILE_UPLOAD_SIZE;

				$this->load->library('upload', $config);

				foreach ($filedump as $key => $value) 
				{
					$uploads[$key] = $value;
				}

				$result = array();
				$countTotal = count($uploads);

				foreach ($uploads as $key => $value) 
				{
					$total = count($value);

					for ($i=0; $i<$total; $i++) 
					{
						$result[$i][$key] = $value[$i];
					}
				}

				$messageTo = "";
				
				//	Create a new item in the gallery table--
				//	No validations for the gallerys DB table as it is essentially bypassable (default 0)

				$gallery_name = $_POST['gallery_name'];
				$customer = $_POST['users_id'];
			//	echo "users id: " . $customer;
			//	die;

				$newPhotoNameRoot = $gallery_name;

				$gallerydata = array();

				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$gallerydata['created_at'] = $z;
				$gallerydata['updated_at'] = $z;

				if (($gallery_name === null) || ($gallery_name === '')) 
				{
					$gallery_name = $newdate;
				}
				$gallerydata['title'] = $gallery_name;
				$gallerydata['users_id'] = $uid;
				$gallerydata['customers_id'] = $customer;

				$newGalleryName0 = str_replace(" ", "-", $gallery_name);
				$newGalleryName = str_replace(",", "-", $newGalleryName0);
				$newGalleryName = str_replace("?", "-", $newGalleryName);
				$newGalleryName = str_replace("@", "-", $newGalleryName);
				$newGalleryName = str_replace("$", "-", $newGalleryName);
				$newGalleryName = str_replace(":", "-", $newGalleryName);
				$newGalleryName = str_replace("/", "-", $newGalleryName);
				$newGalleryName = str_replace("=", "-", $newGalleryName);
				$newGalleryName = str_replace("+", "-", $newGalleryName);
				$newGalleryName = str_replace(";", "-", $newGalleryName);
				$newGalleryName = str_replace("&", "-", $newGalleryName);
				$newGalleryName = str_replace("*", "-", $newGalleryName);
				$newGalleryName = str_replace("%", "-", $newGalleryName);

			//	echo "gallery data: ";
			//	var_dump($gallerydata);
			//	die;

				$this->db->insert('gallerys', $gallerydata);
				$g_id = $this->db->insert_id();

				$eachCount = 0;
				$eXT = null;

				foreach ($result as $key => $value) 
				{

					if ($value['type'] === 'image/jpeg')
					{
						$eXT = ".jpg";
					}
					elseif ($value['type'] === 'image/png') {
						$eXT = ".png";
					}
					elseif ($value['type'] === 'image/gif') {
						$eXT = ".gif";
					}
					elseif ($value['type'] === 'image/webp') {
						$eXT = ".webp";
					}
					else
					{
						// do nothing
					}

					if ($eXT !== null)
					{
						if ($eachCount > 0)
						{
							$realCount = $eachCount + 1;
							$value['name'] = $newGalleryName . $realCount . $eXT;
						}
						else
						{
							$value['name'] = $newGalleryName . $eXT;
						}
					}
					
					$eachCount++;

					$_FILES['userfiles'] = $value;

					if ($this->upload->do_upload('userfiles')) 
					{

	                	$data = array('upload_data' => $this->upload->data());

	                	if (!(isset($g_id)))
	                	{
	                		$g_id = 0;
	                	}
		
						$file_name = $data['upload_data']['file_name'];
						$file_url = $data['upload_data']['full_path'];
						$image_status = $data['upload_data']['is_image'];
						$file_ext = $data['upload_data']['file_ext'];
						$file_type = $data['upload_data']['file_type'];

						$this->load->helper('date');
						$newdate = now('America/Los_Angeles');
						$z = date("Y-m-d H:i:s");

						$postdata['created_at'] = $z;
						$postdata['updated_at'] = $z;

						$postdata['file_url'] = $file_url;
						$postdata['file_name'] = $file_name;
						$postdata['is_image'] = $image_status;
						$postdata['extension'] = $file_ext;
						$postdata['file_type'] = $file_ext;

						$postdata['users_id'] = $uid;
						$postdata['customers_id'] = $customer;
						$postdata['gallerys_id'] = $g_id;

						$newPhotoName = str_replace("-", " ", $gallery_name);
						if ($eachCount === 1) 
						{
							$postdata['photo_title'] = $newPhotoNameRoot;
						}
						else
						{
							$postdata['photo_title'] = $newPhotoNameRoot . " " . $eachCount;
						}

						$this->load->database();
						$WriteNewUserFile = $this->db->insert('photos', $postdata);

						$base_url = GALLERYS_FILE_URL . $file_name;
						$super_file_url = "<a href='" . $base_url . "'>" . $file_url . "</a>";

						$configURL = "." . $base_url;

						$messageTo = $messageTo . "<br /> FILE UPLOADED TO $super_file_url";

						//   This is for the watermarking
						 if (($image_status === true) && (file_exists(WATERMARK_IMAGE_URL)))
						 {
							$config['source_image'] = $configURL;

							$config['wm_type'] = 'overlay';
			
							$config['wm_overlay_path'] = WATERMARK_IMAGE_URL;
							$config['wm_vrt_alignment'] = WATERMARK_POSITION_VERTICAL;
							$config['wm_hor_alignment'] = WATERMARK_POSITION_HORIZONTAL;
					//		$config['wm_padding'] = '20';	//	like saying "I want it cut off by 20"
					//		$config['wm_opacity'] = '99';	//	this doesn't seem to work on the test server

							$this->load->library('image_lib');
							$this->image_lib->initialize($config);
							$this->image_lib->watermark();

							$waterErrors = $this->image_lib->display_errors();
							$messageTo = $messageTo . " <span>$waterErrors</span>";
						}
	            	} 
	            	else 
	            	{
	            		$error = array('error' => $this->upload->display_errors());
				
						$elError = $error['error'];
						$this->session->set_flashdata("info", "ERROR: $elError");
						$this->load->helper('url');
						redirect('/blindfire/upload', 'refresh');
	           		}
				}

				$this->session->set_flashdata("info", "UPLOADS: $messageTo");
				$this->load->helper('url');
				redirect("/blindfire/upload", "refresh");
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
		$intent = array(
	       		'page' => '/blindfire/files'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login required");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		// $q0 = "SELECT * FROM photos WHERE users_id='" . $uid . "' ORDER BY created_at DESC LIMIT 100";
		// $query0 = $this->db->query($q0);

		$q0 = "SELECT * FROM photos WHERE users_id = ? ORDER BY created_at DESC LIMIT 100";
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

		$this->load->view('site_head_foundation', $pagedata);
		$this->load->view('header_link_flash_foundation_view', $pagedata);
		$this->load->view('flickrs_index_view', $pagedata);
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

		// $q0 = "SELECT * FROM photos WHERE id='" . $files_id . "'";
		// $query0 = $this->db->query($q0);

		$query0 = $this->db->select('*')->from('photos')
	    ->where('id', $files_id)
	    ->get();

		$the_row = $query0->row_array();

		$killTarget = $the_row['file_url'];

		if (((isset($the_row)) && ($the_row['users_id'] == $uid)) && ($killTarget != null))
			{
				//	delete file's record from database
				$this->db->where('id', $files_id);
				$this->db->delete('photos');

				//	delete actual file
				unlink($killTarget);

				$this->session->set_flashdata('info', 'photo file deleted');
				$this->load->helper('url');
				redirect('/blindfire/files', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'did not delete: file access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
	}
}

public function image_view($img_name)
{
	//	look up the image name in the DB
		$this->load->database();

		// $q0 = "SELECT * FROM photos WHERE file_name='" . $img_name . "' ORDER BY created_at DESC LIMIT 1";
		// $query0 = $this->db->query($q0);

		$q0 = "SELECT * FROM photos WHERE file_name = ? ORDER BY created_at DESC LIMIT 1";
		$query0 = $this->db->query($q0, array($img_name));

		$the_row = $query0->row_array();

	//	package up the image's name and URL as an object
		$p_location = $the_row['file_url'];
		$f_name = $the_row['file_name'];
		$p_title = $the_row['photo_title'];
		$img_status = $the_row['is_image'];

		$photo_full_url = SITE_URL . GALLERYS_FILE_URL . $f_name;
		$photo_object_var['private_photo_object'] = "[{ name: '" . $p_title . "', url: '" . $p_location . "', filename: '" . $f_name . "' }]";
		$photo_object_var['photo_object'] = "[{ name: '" . $f_name . "', title: '" . $p_title . "', location: '" . $photo_full_url . "' }]";
		$photo_object_var['file_name'] = $f_name;
		$photo_object_var['photo_url'] = $p_location;
		$photo_object_var['photo_title'] = $p_title;

		$photo_object_var['created'] = $the_row['created_at'];
	//	load the view with the image's info

		if ($p_title === "")
		{
			$photo_object_var['photo_info'] = $f_name;
		}
		else
		{
			$photo_object_var['photo_info'] = $p_title;
		}

		if ($img_status === '1')
		{
			$this->load->view('flickrs_photo_view', $photo_object_var);
			$this->load->view('flickrs_photo_footer', $photo_object_var);
		}
		else
		{
			$this->session->set_flashdata("info", "a photo was not found");
			$this->load->helper('url');
			redirect("/404", "refresh");
		}
}

public function image_view_json($img_name)
{
	//	look up the image name in the DB
		$this->load->database();

		// $q0 = "SELECT * FROM photos WHERE file_name='" . $img_name . "' ORDER BY created_at DESC LIMIT 1";
		// $query0 = $this->db->query($q0);

		$q0 = "SELECT * FROM photos WHERE file_name = ? ORDER BY created_at DESC LIMIT 1";
		$query0 = $this->db->query($q0, array($img_name));

		$the_row = $query0->row_array();

	//	package up the image's name and URL as an object
		$p_location = $the_row['file_url'];
		$f_name = $the_row['file_name'];
		$p_title = $the_row['photo_title'];
		$img_status = $the_row['is_image'];

		$photo_full_url = SITE_URL . GALLERYS_FILE_URL . $f_name;
		$photo_object_var['private_photo_object'] = "[{ name: '" . $p_title . "', url: '" . $p_location . "', filename: '" . $f_name . "' }]";
		$photo_object_var['photo_object'] = "[{ name: '" . $f_name . "', title: '" . $p_title . "', location: '" . $photo_full_url . "' }]";
		$photo_object_var['file_name'] = $f_name;
		$photo_object_var['photo_url'] = $p_location;
		$photo_object_var['photo_title'] = $p_title;

		$photo_object_var['created'] = $the_row['created_at'];
	//	load the view with the image's info

		if ($p_title === "")
		{
			$photo_object_var['photo_info'] = $f_name;
		}
		else
		{
			$photo_object_var['photo_info'] = $p_title;
		}

		if ((file_exists($p_location)) && ($img_status === '1'))
		{
			$this->load->view('flickrs_photo_view_json', $photo_object_var);
		}
		else
		{
			$this->session->set_flashdata("info", "photo not found");
			$this->load->helper('url');
			redirect("/404", "refresh");
		}
}

}
