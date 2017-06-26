<?php
class Gallerys extends CI_Controller
{
	//	Gallerys controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function add_file()
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
			}

		if (isset($uid))
		{
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
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('gallerys_upload_view', $pagedata);
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
	       		'page' => '/gallerys/upload'
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

			$uploads = array();

			if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING) 
			{
				$this->load->database();

				$filedump = $_FILES['userfiles'];

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

				$gallerydata = array();

				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$gallerydata['created_at'] = $z;
				$gallerydata['updated_at'] = $z;

				if (($gallery_name === 'null') || ($gallery_name === null) || ($gallery_name === '')) 
				{
					$gallery_name = $newdate;
				}
				$gallerydata['name'] = $gallery_name;
				$gallerydata['users_id'] = $uid;
				$gallerydata['customers_id'] = $customer;

				$this->load->model('photo');

				$newGalleryName = $this->photo->makeStringURL_safe_ish($gallery_name);

				$this->db->insert('gallerys', $gallerydata);
				$g_id = $this->db->insert_id();

				$eachCount = 0;
				$eXT = null;

				foreach ($result as $key => $value) {
					$messageTo = $this->photo->uploadGalleryImage($value, $eachCount, $eXT, $newGalleryName, $uid, $customer, $messageTo, $g_id);
					$eachCount++;
				}

				$wm_message = '';
				$eachCount = 0;
				$eXT = null;

				$this->load->library('upload', $config);

				foreach ($result as $key => $value) {
					$wm_message = $this->photo->uploadPreviewImage($value, $eachCount, $eXT, $newGalleryName, $uid, $customer, $wm_message);
					$eachCount++;
				}

				$this->session->set_flashdata("info", "UPLOADS: $messageTo $wm_message");
				$this->load->helper('url');
				redirect("/gallerys/upload", "refresh");
				
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

		$q0 = "SELECT * FROM photos WHERE users_id = ? ORDER BY created_at ASC LIMIT 100";
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

public function myphotos()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/myphotos'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login to account to view photos");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		$q0 = "SELECT * FROM photos WHERE customers_id = ? ORDER BY created_at ASC LIMIT 500";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->thumbnail_name;
			$photo_title = $row->photo_title;
			$created_date =  $row->created_at;
			$file_name =  $row->file_name;

			$the_l_row = array();
			$the_l_row['post_id'] = $post_id;
			
			if ($post_title == "")
			{
				$post_title = "posted on " . $created_date;
			}
			$the_l_row['post_title'] = $post_title;
			$the_l_row['photo_title'] = $photo_title;
			$the_l_row['file_name'] = $file_name;

			$this->load->model('photo');

			$isInCart = $this->photo->isThisPhotoInThisUsersCart($post_id, $uid);

				$c2 = 0;
				foreach ($isInCart->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "carted";
				}
				else
				{
					$photo_state = "clean";
				} 


			$isOwned = $this->photo->isThisPhotoOwnedByThisUser($post_id, $uid);

				$c2 = 0;
				foreach ($isOwned->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "owned";
				}
				else if ($photo_state !== "carted")
				{
					$photo_state = "clean";
				} 
			
			$the_l_row['photo_state'] = $photo_state;

			$posts[$c] = $the_l_row;
			$c++;
		}
		$pagedata['title'] = "Your Images";
		$pagedata['posts'] = $posts;

		$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";

		$this->load->view('myphotos_view', $pagedata);
	}
}	

public function add_to_cart_process($id_photo)
{	//	check for the photo
	$msg = "add photo #" . $id_photo . " to the photo cart..";

	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		//	check that user is logged in, get their id
	    $query = $this->user->get_users_row_via_login($login);

		foreach ($query->result() as $row)
		{
			$uid = $row->id;
		   	$login = $row->login;	
		   	$email = $row->email;
		}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			$pagedata = array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE)
			{	//	check that the logged in user id has permissions
				$this->load->model('photo');
				$query01 = $this->photo->getPhotoData($id_photo);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row_p)
				{
					$the_photos_id = $row_p->id;
					$customers_id = $row_p->customers_id;
					$c++;
				}
				if ($uid !== $customers_id) {
					//	redirect: access deined
					$this->session->set_flashdata('info', 'access denied');
					$this->load->helper('url');
					redirect('/', 'refresh');
				}

				//	check the photos_purchases to see if it's already purchased
				$query01 = $this->photo->isThisPhotoOwnedByThisUser($id_photo, $uid);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row)
				{
					$the_photos_id = $row->photos_id;
					$customers_id = $row->customers_id;
					$c++;
				}
				if ($c > 0) {
					$this->session->set_flashdata('info', 'already purchased');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}

				//	check the photos_cart to see if it's aleady in the cart
				$query01 = $this->photo->isThisPhotoInThisUsersCart($id_photo, $uid);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row)
				{
					$the_photos_id = $row->photos_id;
					$customers_id = $row->customers_id;
					$c++;
				}
				if ($c > 0) {
					//	redirect: already in cart
					$this->session->set_flashdata('info', 'already in cart');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}

				//	if conditions are satisified make an entry in the photos_cart table
				$cartData = array();
				$cartData['photos_id'] = $the_photos_id;
				$cartData['users_id'] = $customers_id;
				
				$WriteNewCartRow = $this->photo->addNewPhotoToPhotoCart($cartData);

				if ($WriteNewCartRow === TRUE)
				{
					$this->session->set_flashdata('info', 'photo added to cart');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error: not added to cart');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}
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
			$this->session->set_flashdata('info', 'account error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function remove_from_cart_process($id_photo)
{	//	check for the photo
	$msg = "add photo #" . $id_photo . " to the photo cart..";

	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		//	check that user is logged in, get their id
	    $query = $this->user->get_users_row_via_login($login);

		foreach ($query->result() as $row)
		{
			$uid = $row->id;
		   	$login = $row->login;	
		   	$email = $row->email;
		}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			$pagedata = array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE)
			{	//	check that the logged in user id has permissions
				$this->load->model('photo');
				$query01 = $this->photo->getPhotoData($id_photo);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row_p)
				{
				//	var_dump($row);
					$the_photos_id = $row_p->id;
					$customers_id = $row_p->customers_id;
					$c++;
				}
				if ($uid !== $customers_id) {
					//	redirect: access deined
					$this->session->set_flashdata('info', 'access denied');
					$this->load->helper('url');
					redirect('/', 'refresh');
				}

				//	check the photos_purchases to see if it's already purchased
				$query01 = $this->photo->isThisPhotoOwnedByThisUser($id_photo, $uid);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row)
				{
					$the_photos_id = $row->photos_id;
					$customers_id = $row->customers_id;
					$c++;
				}
				if ($c > 0) {
					$this->session->set_flashdata('info', 'already purchased');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}

				//	check the photos_cart to see if it's in the cart
				$query01 = $this->photo->isThisPhotoInThisUsersCart($id_photo, $uid);

				$posts = array();
				$c = 0;
				foreach ($query01->result() as $row)
				{
					$the_photos_id = $row->photos_id;
					$customers_id = $row->customers_id;
					$c++;
				}
				if ($c === 0) {
					//	redirect: not in cart
					$this->session->set_flashdata('info', 'not in cart; cannot be removed');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}

				//	if conditions are satisified make an entry in the photos_cart table
				$cartData = array();
				$cartData['photos_id'] = $the_photos_id;
				$cartData['users_id'] = $customers_id;
				
				$killCartRow = $this->photo->removePhotoFromPhotoCart($cartData);

				if ($killCartRow === TRUE)
				{
					$this->session->set_flashdata('info', 'photo removed from cart');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error: photo not removed from cart');
					$this->load->helper('url');
					redirect('/myphotos', 'refresh');
				}
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
			$this->session->set_flashdata('info', 'account error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function view_photo_cart()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();
	$trueCart = array();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/myphotos'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login to account to view photos");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		$q0 = "SELECT * FROM photos WHERE customers_id = ? ORDER BY created_at ASC LIMIT 500";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->thumbnail_name;
			$photo_title = $row->photo_title;
			$created_date =  $row->created_at;
			$file_name =  $row->file_name;

			$the_l_row = array();
			$the_l_row['post_id'] = $post_id;
			
			if ($post_title == "")
			{
				$post_title = "posted on " . $created_date;
			}
			$the_l_row['post_title'] = $post_title;
			$the_l_row['photo_title'] = $photo_title;
			$the_l_row['file_name'] = $file_name;

			$this->load->model('photo');

			$isInCart = $this->photo->isThisPhotoInThisUsersCart($post_id, $uid);

				$c2 = 0;
				foreach ($isInCart->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "carted";
				}
				else
				{
					$photo_state = "clean";
				} 


			$isOwned = $this->photo->isThisPhotoOwnedByThisUser($post_id, $uid);

				$c2 = 0;
				foreach ($isOwned->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "owned";
				}
				else if ($photo_state !== "carted")
				{
					$photo_state = "clean";
				} 
			
			$the_l_row['photo_state'] = $photo_state;

			if ($photo_state === "carted")
			{
				$trueCart[$c] = $the_l_row;
			}

			$posts[$c] = $the_l_row;
			$c++;
		}
		$pagedata['title'] = "Your Cart";
		$pagedata['posts'] = $trueCart;

		$cartCount = count($trueCart);
		$pagedata['cartCount'] = $cartCount;

		$photo_credits = $this->photo->get_users_photo_credits($uid);

		if ($photo_credits == null)
		{
			$credits_total = 0;
		}
		else
		{
			$credits_total = $photo_credits->credits;
		}

		$pagedata['photoCredits'] = $credits_total;

		if (($cartCount - $credits_total) <= 0)
		{
			$subtotal = 0;
		}
		else {
			$subtotal = PHOTOGRAPHY_PRICE_PER_IMAGE * ($cartCount - $credits_total);
		}
		$pagedata['subtotal'] = $subtotal;		

		$this->load->view('myphotos_cart_view', $pagedata);
	}
}

public function photo_checkout()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();
	$trueCart = array();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       	'page' => '/myphotos'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login to account to view photos");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		$q0 = "SELECT * FROM photos WHERE customers_id = ? ORDER BY created_at ASC LIMIT 500";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->thumbnail_name;
			$photo_title = $row->photo_title;
			$created_date =  $row->created_at;
			$file_name =  $row->file_name;

			$the_l_row = array();
			$the_l_row['post_id'] = $post_id;
			
			if ($post_title == "")
			{
				$post_title = "posted on " . $created_date;
			}
			$the_l_row['post_title'] = $post_title;
			$the_l_row['photo_title'] = $photo_title;
			$the_l_row['file_name'] = $file_name;

			$this->load->model('photo');

			$isInCart = $this->photo->isThisPhotoInThisUsersCart($post_id, $uid);

				$c2 = 0;
				foreach ($isInCart->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "carted";
				}
				else
				{
					$photo_state = "clean";
				} 

			$isOwned = $this->photo->isThisPhotoOwnedByThisUser($post_id, $uid);

				$c2 = 0;
				foreach ($isOwned->result() as $row)
				{
					$c2++;
				}
				if ($c2 > 0) {
					$photo_state = "owned";
				}
				else if ($photo_state !== "carted")
				{
					$photo_state = "clean";
				} 
			
			$the_l_row['photo_state'] = $photo_state;

			if ($photo_state === "carted")
			{
				$trueCart[$c] = $the_l_row;
			}

			$posts[$c] = $the_l_row;
			$c++;
		}
		$pagedata['title'] = "Your Cart";
		$pagedata['posts'] = $trueCart;

		$cartCount = count($trueCart);
		$pagedata['cartCount'] = $cartCount;

		$photo_credits = $this->photo->get_users_photo_credits($uid);

		if ($photo_credits == null)
		{
			$credits_total = 0;
		}
		else
		{
			$credits_total = $photo_credits->credits;
		}

		$pagedata['photoCredits'] = $credits_total;

		if (($cartCount - $credits_total) <= 0)
		{
			$subtotal = 0;
		}
		else {
			$subtotal = PHOTOGRAPHY_PRICE_PER_IMAGE * ($cartCount - $credits_total);
		}
		$pagedata['subtotal'] = $subtotal;		

		$pagedata['title'] = SITE_NAME;
		$state_sales_tax_total = $subtotal * STATE_TAX_RATE;
		$pagedata['state_sales_tax_total'] = $state_sales_tax_total;
		$overall_total = $state_sales_tax_total + $subtotal;

		$pagedata['overall_total'] = $overall_total;

		$this->load->view('photo_checkout_view', $pagedata);
	}

}

public function photo_checkout_process()
{
	$post_total = $_POST['total'];

	$this->load->helper('user');
	$uid = get_user_id_via_current_login();
	$trueCart = array();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/myphotos'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login to account to view photos");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		$q0 = "SELECT * FROM photos WHERE customers_id = ? ORDER BY created_at ASC LIMIT 500";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->thumbnail_name;
			$photo_title = $row->photo_title;
			$created_date =  $row->created_at;
			$file_name =  $row->file_name;

			$the_l_row = array();
			$the_l_row['post_id'] = $post_id;
			
			if ($post_title == "")
			{
				$post_title = "posted on " . $created_date;
			}
			$the_l_row['post_title'] = $post_title;
			$the_l_row['photo_title'] = $photo_title;
			$the_l_row['file_name'] = $file_name;

			$this->load->model('photo');

			$isInCart = $this->photo->isThisPhotoInThisUsersCart($post_id, $uid);

			$c2 = 0;
			foreach ($isInCart->result() as $row)
			{
				$c2++;
			}
			if ($c2 > 0) {
				$photo_state = "carted";
			}
			else
			{
				$photo_state = "clean";
			}

			$isOwned = $this->photo->isThisPhotoOwnedByThisUser($post_id, $uid);

			$c2 = 0;
			foreach ($isOwned->result() as $row)
			{
				$c2++;
			}
			if ($c2 > 0) {
				$photo_state = "owned";
			}
			else if ($photo_state !== "carted")
			{
				$photo_state = "clean";
			} 
			
			$the_l_row['photo_state'] = $photo_state;

			if ($photo_state === "carted")
			{
				$trueCart[$c] = $the_l_row;
			}

			$posts[$c] = $the_l_row;
			$c++;
		}
		$pagedata['title'] = "Your Cart";
		$pagedata['posts'] = $trueCart;

		$cartCount = count($trueCart);
		$pagedata['cartCount'] = $cartCount;

		$photo_credits = $this->photo->get_users_photo_credits($uid);

		if ($photo_credits == null)
		{
			$credits_total = 0;
		}
		else
		{
			$credits_total = $photo_credits->credits;
		}

		$pagedata['photoCredits'] = $credits_total;

		if (($cartCount - $credits_total) <= 0)
		{
			$subtotal = 0;
			$credits_used = $cartCount - $credits_total;
		}
		else {
			$subtotal = PHOTOGRAPHY_PRICE_PER_IMAGE * ($cartCount - $credits_total);
			$credits_used = $credits_total;
		}
		$pagedata['subtotal'] = $subtotal;		

		$pagedata['title'] = SITE_NAME;
		$state_sales_tax_total = $subtotal * STATE_TAX_RATE;
		$pagedata['state_sales_tax_total'] = $state_sales_tax_total;
		$overall_total = $state_sales_tax_total + $subtotal;

		$pagedata['overall_total'] = $overall_total;

		if ($overall_total === 0) 
		{
			$finalizePhotoPurchase = $this->photo->processPhotoPurchaseItems($uid, $credits_used);

			if ($finalizePayPurchase == TRUE)
			{
				//	the transaction worked
				$this->session->set_flashdata('info', 'free photo purchase transaction completed');
				$this->load->helper('url');
				redirect('/myphotos', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'error processing photo transaction');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else if (floatval($post_total) === $overall_total)
		{
			require_once(APPPATH.'libraries/stripe/init.php');

			\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_API_KEY);

			// Get the credit card details submitted by the form
			$token = $_POST['stripeToken'];
			$total100 = $overall_total;

			$nearTotal = number_format((float)$total100, 2, '.', '');
			$total = $nearTotal * 100; 	//	this makes it in cents as Stripe expects

			$sitedec = SITE_NAME . " photos store";

			// Create the charge on Stripe's servers - this will charge the user's card
			try 
			{
			  $charge = \Stripe\Charge::create(array(
			    "amount" => $total, // amount in cents: adjusted above from the post data
			    "currency" => "usd",
			    "source" => $token,
			    "description" => $sitedec
			    ));
			} catch(\Stripe\Error\Card $e) {
				
			  // The card has been declined
				$this->session->set_flashdata('info', 'card declined by Stripe');
				$this->load->helper('url');
				redirect('/cart', 'refresh');
			}

			//	if the program runs past the error catch above, that should mean that the charge went through
			$finalizePhotoPurchase = $this->photo->processPhotoPurchaseItems($uid, $credits_used);

			$orderData = array();
			$orderData['users_id'] = $uid;
			$orderData['subtotal'] = $subtotal;
			$orderData['tax'] = $state_sales_tax_total;
			$orderData['total'] = $overall_total;
			//	add created_at and updated_at

			$addPhotosOrders = $this->photo->processPhotosOrder($orderData);

			if ($finalizePhotoPurchase == TRUE)
			{
				//	the transaction worked
				$this->session->set_flashdata('info', 'photo purchase transaction completed');
				$this->load->helper('url');
				redirect('/myphotos', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'error processing transaction');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error computing transaction');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
}

public function free_photo_checkout_process()
{
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();
	$trueCart = array();

	if (($uid == FALSE) || ($uid == null))
	{
		$intent = array(
	       		'page' => '/myphotos'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "login to account to view photos");
		$this->load->helper('url');
		redirect("/account", "refresh");
	}
	else
	{
		$this->load->database();

		$q0 = "SELECT * FROM photos WHERE customers_id = ? ORDER BY created_at ASC LIMIT 500";
		$query0 = $this->db->query($q0, array($uid));

		$posts = array();
		$c = 0;
		foreach ($query0->result() as $row)
		{
			$post_id = $row->id;
			$post_title = $row->thumbnail_name;
			$photo_title = $row->photo_title;
			$created_date =  $row->created_at;
			$file_name =  $row->file_name;

			$the_l_row = array();
			$the_l_row['post_id'] = $post_id;
			
			if ($post_title == "")
			{
				$post_title = "posted on " . $created_date;
			}
			$the_l_row['post_title'] = $post_title;
			$the_l_row['photo_title'] = $photo_title;
			$the_l_row['file_name'] = $file_name;

			$this->load->model('photo');

			$isInCart = $this->photo->isThisPhotoInThisUsersCart($post_id, $uid);

		
			$c2 = 0;
			foreach ($isInCart->result() as $row)
			{
				$c2++;
			}
			if ($c2 > 0) {
				$photo_state = "carted";
			}
			else
			{
				$photo_state = "clean";
			}

			$isOwned = $this->photo->isThisPhotoOwnedByThisUser($post_id, $uid);

			$c2 = 0;
			foreach ($isOwned->result() as $row)
			{
				$c2++;
			}
			if ($c2 > 0) {
				$photo_state = "owned";
			}
			else if ($photo_state !== "carted")
			{
				$photo_state = "clean";
			} 
			
			$the_l_row['photo_state'] = $photo_state;

			if ($photo_state === "carted")
			{
				$trueCart[$c] = $the_l_row;
			}

			$posts[$c] = $the_l_row;
			$c++;
		}

		$pagedata['title'] = "Your Cart";
		$pagedata['posts'] = $trueCart;

		$cartCount = count($trueCart);
		$pagedata['cartCount'] = $cartCount;

		$photo_credits = $this->photo->get_users_photo_credits($uid);

		if ($photo_credits == null)
		{
			$credits_total = 0;
		}
		else
		{
			$credits_total = $photo_credits->credits;
		}

		$pagedata['photoCredits'] = $credits_total;

		if (($cartCount - $credits_total) <= 0)
		{
			$subtotal = 0;
			$credits_used = $cartCount;
		}
		else {
			$subtotal = PHOTOGRAPHY_PRICE_PER_IMAGE * ($cartCount - $credits_total);
			$credits_used = $credits_total;
		}
		$pagedata['subtotal'] = $subtotal;		

		$pagedata['title'] = SITE_NAME;
		$state_sales_tax_total = $subtotal * STATE_TAX_RATE;
		$pagedata['state_sales_tax_total'] = $state_sales_tax_total;
		$overall_total = $state_sales_tax_total + $subtotal;

		$pagedata['overall_total'] = $overall_total;

		if ($overall_total == 0) 
		{
			$credits_left = $credits_total - $cartCount;
			$finalizePhotoPurchase = $this->photo->processPhotoPurchaseItems($uid, $credits_used);

			$orderData = array();
			$orderData['users_id'] = $uid;
			$orderData['subtotal'] = $subtotal;
			$orderData['tax'] = $state_sales_tax_total;
			$orderData['total'] = $overall_total;
			//	todo: add created_at and updated_at

			$addPhotosOrders = $this->photo->processPhotosOrder($orderData);

			if ($finalizePhotoPurchase == TRUE)
			{
				//	the transaction worked
				$this->session->set_flashdata('info', 'free photo purchase transaction completed');
				$this->load->helper('url');
				redirect('/myphotos', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'error processing photo transaction');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error computing free photo transaction');
			$this->load->helper('url');
			redirect('/store', 'refresh');
		}
	}
}

public function photos_front() 
{
	$pagedata['title'] = SITE_NAME;
	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('j_photos_front', $pagedata);
	$this->load->view('site_footer');
}

public function book_appointment()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT) 
			{
				$this->load->model('photo');

				$newAppointments = $this->photo->get_available_appointments();

				$pagedata['appointments'] = $newAppointments;

				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = SITE_NAME . " booking page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('book_appointment_view', $pagedata);
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
	       		'page' => '/book'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "you need to be logged in to an account to book");
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function list_appointments()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$this->load->model('photo');

				$newAppointments = $this->photo->get_all_appointments();

				$pagedata['posts'] = $newAppointments;

				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = SITE_NAME . " appointments list";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('photos_booking_edit_list_view', $pagedata);
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
	       		'page' => '/book'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "you need to be logged in to an account to book");
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function create_appointment()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{
				$pagedata['title'] = "djmblog.com blog post creation page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view');
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('photos_appointment_create_view', $pagedata);
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

public function process_appointment()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('start', 'Start', 'required');
				$this->form_validation->set_rules('end', 'End', 'required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('info', 'appointment data not valid');
					$this->load->helper('url');
					redirect('/', 'refresh');
				}
				else
				{
					$postdata = $_POST;
					
					$this->load->model('photo');
					$WriteNewCartRow = $this->photo->addNewAppointment($postdata);
				}
			}
				
			if ($WriteNewCartRow === TRUE)
			{
				$this->session->set_flashdata('info', 'new appointment created');
				$this->load->helper('url');
				redirect('/appointments/edit', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'error adding appointment');
				$this->load->helper('url');
				redirect('/appointments/edit', 'refresh');
			}
		}
	}
}

public function process_delete_appointment($del_id) 
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{	//	delete appointment with id $del_id

				$this->load->model('photo');

				$kill_apt = $this->photo->deleteAppointment($del_id);
				
				if ($kill_apt === TRUE)
				{
					$this->session->set_flashdata('info', 'appointment deleted');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error deleting appointment');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function process_booking_request()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
			{	
				$newRequest = $_POST;

				$req_id = $newRequest['bookingchoice'];
			
				$this->load->model('photo');

				$appointment_available = $this->photo->isAppointmentAvailable($req_id);
				
				if ($appointment_available === TRUE)
				{
					$this->session->set_flashdata('info', 'appointment is available');
					$this->load->helper('url');
					redirect('/myphotos/signup/cart/' . $uid . '/' . $req_id, 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error finding appointment');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function list_packages()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$this->load->model('photo');

				$newAppointments = $this->photo->get_all_packages();

				$pagedata['posts'] = $newAppointments;

				$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
				$pagedata['title'] = "Packages List";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('photos_packages_edit_list_view', $pagedata);
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
	       		'page' => '/book'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata("info", "you need to be logged in to an account to book");
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function create_package()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{
				$pagedata['title'] = "djmblog.com blog post creation page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view');
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('photos_package_create_view', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
			}
			else
			{
				$this->session->set_flashdata('info', 'account cannot create photo packages');
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

public function process_package()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('prints', 'Prints', 'required');
				$this->form_validation->set_rules('price', 'Price', 'required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('info', 'package data not valid--must include price and number of prints');
					$this->load->helper('url');
					redirect('/photos/packages', 'refresh');
				}
				else
				{
					$postdata = $_POST;
					$this->load->model('photo');
					$WriteNewCartRow = $this->photo->addNewPackage($postdata);
				}
			}
				
			if ($WriteNewCartRow === TRUE)
			{
				$this->session->set_flashdata('info', 'new packages created');
				$this->load->helper('url');
				redirect('/photos/packages', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'error adding appointment');
				$this->load->helper('url');
				redirect('/photos/packages', 'refresh');
			}
		}
	}
}

public function photos_signup_cart($user_id, $appointments_id)
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
			{	
				$newRequest = $_POST;
			
				$this->load->model('photo');

				$appointment_available = $this->photo->isAppointmentAvailable($appointments_id);
				
				if (($appointment_available === TRUE) && ($uid === $user_id))
				{
					//	First, note the appointment's id in the session cart
					$cartdata['bookingsCart'] = $appointments_id;
					$this->session->set_userdata($cartdata);

					//	Then, load the cart page
					$newAppointments = $this->photo->get_all_packages();
					$pagedata['posts'] = $newAppointments;
					$footerdata['footerBrand'] = "<a href='/account'><button class='button btn btn-secondary'>Account</button></a>";
					$pagedata['title'] = "Pick Photo Package";
					$this->load->view('site_head_foundation', $pagedata);
					$this->load->view('header_link_flash_view', $pagedata);
					$this->load->view('photos_booking_cart_view', $pagedata);
					$this->load->view('site_footer', $footerdata);
				}
				else
				{
					$this->session->set_flashdata('info', 'error');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function photos_cart_process()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
			{	
				$postdata = $_POST;

				$package_requested = $postdata['packagechoice'];

				$cartdata['packageCart'] = $package_requested;
				$this->session->set_userdata($cartdata);

				$this->session->set_flashdata('info', 'Ok!  Ready to book!');
				$this->load->helper('url');
				redirect('photos/package/checkout', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function photos_signup_checkout()
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
			{
				$this->load->model('photo');

				$appointment_requested = $this->session->userdata('bookingsCart');
						//	This is the appointment that user requested that was placed in the session

				$package_requested = $this->session->userdata('packageCart');

				$appointment_available = $this->photo->isAppointmentAvailable($appointment_requested);

				$package_price = $this->photo->get_price_of_package($package_requested);

				$package_info = $this->photo->get_package_info($package_requested);
				
				if ($appointment_available === TRUE)
				{
					$pagedata['appointment_requested'] = $appointment_requested;
					$pagedata['package_price'] = $package_price;
					$pagedata['package_info'] = $package_info;
					$pagedata['package_requested'] = $package_requested;
					$footerdata['footerBrand'] = "<a href='/account'><button class='button warning btn btn-warning'>cancel</button></a>";
					$pagedata['title'] = "Pick Photo Package";

					$this->load->view('photos_booking_checkout_view', $pagedata);
				}
				else
				{
					$this->session->set_flashdata('info', 'error: appointment appears to not be available currently');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}

			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function process_delete_package($del_id) 
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
			}

		if (isset($uid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{	//	delete appointment with id $del_id

				$this->load->model('photo');

				$kill_apt = $this->photo->deletePackage($del_id);
				
				if ($kill_apt === TRUE)
				{
					$this->session->set_flashdata('info', 'package deleted');
					$this->load->helper('url');
					redirect('/photos/packages', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error deleting appointment');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function process_appointment_checkout()
{
			
	$postdata = $_POST;
	$post_total = $postdata['total'];

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

			if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
			{
				$this->load->model('photo');

				$appointment_requested = $this->session->userdata('bookingsCart');
						//	This is the appointment that user requested that was placed in the session

				$package_requested = $this->session->userdata('packageCart');

				$appointment_available = $this->photo->isAppointmentAvailable($appointment_requested);

				$package_price = $this->photo->get_price_of_package($package_requested);

				$package_info = $this->photo->get_package_info($package_requested);
				$appointment_info = $this->photo->get_appointment_info($appointment_requested);
				
				if (($appointment_available === TRUE) && ($package_price === $post_total))
				{	//	Hurdles cleared; now time to try the credit card

					require_once(APPPATH.'libraries/stripe/init.php');

					\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_API_KEY);

					// Get the credit card details submitted by the form
					$token = $_POST['stripeToken'];
					$total100 = $package_price;

					$nearTotal = number_format((float)$total100, 2, '.', '');
					$total = $nearTotal * 100; 	//	this makes it in cents as Stripe expects

					$sitedec = SITE_NAME . " photos appointment";

					// Create the charge on Stripe's servers - this will charge the user's card
					try 
					{
					  $charge = \Stripe\Charge::create(array(
					    "amount" => $total, // amount in cents: adjusted above from the post data
					    "currency" => "usd",
					    "source" => $token,
					    "description" => $sitedec
					    ));
					} catch(\Stripe\Error\Card $e) {
						
					  // The card has been declined
						$this->session->set_flashdata('info', 'card declined by Stripe');
						$this->load->helper('url');
						redirect('/cart', 'refresh');
					}

					//	if the program runs past the error catch above, that should mean that the charge went through

					//	make entry in the bookings table
					$bookingData = array();
					$bookingData['payment'] = $nearTotal;
					$bookingData['users_id'] = $uid;
					$bookingData['appointments_id'] = $appointment_requested;
					$bookingData['packages_id'] = $package_requested;
 
					$newBookingWrite = $this->photo->writeBooking($bookingData);

					//	make entry in the photos_credits table
					$this->load->database();

					$q0 = "SELECT * FROM photos_credits WHERE users_id=?";
					$query01 = $this->db->query($q0, array($uid));

					$counter = 0;
					$retVal = array();

					foreach ($query01->result_array() as $row)
					{
						$retVal[$counter] = $row;
						$counter++;
					}

					$new_postdata['users_id'] = $uid;
					$new_postdata['credits'] = $package_info['prints'];

					if ($counter === 0)
					{
						//	write a new record
						$didcreditsupdate = $this->db->insert('photos_credits', $new_postdata);
					}
					else if ($counter > 0)
					{
						//	update existing record
						$this->db->where('users_id', $uid);
						$new_postdata['credits'] = $new_postdata['credits'] + $package_info['prints'];
						$didcreditsupdate = $this->db->update('photos_credits', $new_postdata);
					}

					//	make entry in the users_chats table
					$timeFor = $appointment_info['start'];
					$defaultMessage = "I'm looking forward to seeing you for your photo appointment on " . $timeFor;

					$posted['users_from_id'] = PHOTOGRAPHER_ID;
	       			$posted['users_to_id'] = $uid;
	       			$posted['chat'] = $defaultMessage;

	       			$this->load->model('chat');

	       			$writeMessage = $this->chat->doTheEvolution($posted);

	
					if ($newBookingWrite === TRUE)
					{
						$this->session->set_flashdata('info', 'Appointment booked--see you soon!');
						$this->load->helper('url');
						redirect('/account', 'refresh');
					}			
					else
					{
						$this->session->set_flashdata('info', 'Appointment is on, but system error in finalizing');
						$this->load->helper('url');
						redirect('/myphotos', 'refresh');
					}		


					if ($finalizePhotoPurchase == TRUE)
					{
						//	the transaction worked
						$this->session->set_flashdata('info', 'photo purchase transaction completed');
						$this->load->helper('url');
						redirect('/myphotos', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('info', 'error processing transaction');
						$this->load->helper('url');
						redirect('/account', 'refresh');
					}

			
				}
				else
				{
					$this->session->set_flashdata('info', 'error: inconsistent parameter--transaction failed');
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}

			else
			{
				$this->session->set_flashdata('info', 'access error');
				$this->load->helper('url');
				redirect('/account', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'error');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}

}

}	// end of Gallerys controller
