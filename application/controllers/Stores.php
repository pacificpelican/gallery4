<?php
class Stores extends CI_Controller
{
	//	Stores controller for djmblog.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function product_page($posts_id)
{
	$this->load->database();

	$this->load->model('store');

	$query = $this->store->get_a_product_($posts_id);

	$the_row = $query->row_array();

	if ($the_row != null)
	{
		foreach ($query->result() as $row)
		{
			$title = $row->product;	
			$post = $row->description;
			$created0 = $row->created_at;
			$created = "Added: " . $created0;
			$createdUTC = $created . " UTC";
			$dig = $row->digital_bool;
			$url = $row->URL;
			$price = $row->price;
			$img = $row->photo_url;

			$this->load->helper('user');
			$uid = get_user_id_via_current_login();

			if ($uid != FALSE)	//	make sure that the user is logged in otherwise the query below is unnecessary and error-prone anyway in those cases
			{
				$query0 = $this->store->get_user_purchase_list($uid, $posts_id); //	this should return an object containing all user purchases

				$purchases = $query0->row_array();
			}

			if ((isset($purchases)) && ($purchases != null))
			{
				$purchase_status = TRUE;
			}
			else
			{
				$purchase_status = FALSE;
			}
		}
		if (!(isset($post))) 
		{
			$title = "404";
			$post = "NOT FOUND";
			$created = null;
			$createdUTC = $created;
			$dig = null;
			$url = null;
			$img = null;
		}
		if (!(isset($title))) 
		{
			$title = "";
		}
	}
	else 
	{
		$title = "404";
		$post = "NOT FOUND";
		$created = null;
		$createdUTC = $created;
		$purchase_status = FALSE;
		$dig = null;
		$url = null;
		$img = null;
		$price = null;
	}

	if (!(isset($users_id))) 
	{
		$users_id = null;
	}

	$pagedata = array(
	       		'title' => $title,
	            'post' => $post,
	            'post_date' => $createdUTC,
	            'post_id' => $posts_id,
	            'purchase_status' => $purchase_status,
	            'virt' => $dig,
	            'url' => $url,
	            'img' => $img,
	            'price' => $price
	        );
	
	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('product_item_view', $pagedata);
	$this->load->view('store_sidebar_view', $pagedata);
	$this->load->view('site_footer', $pagedata);
}

public function add_supplier()
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

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$pagedata['title'] = "add supplier page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('store_admin_add_suppliers', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
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

public function process_new_supplier()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->database();

		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();
				
		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
		{
			$postdata = $this->input->post();
			$loginOG = $this->session->userdata('login');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('supplier', 'Supplier', 'required|min_length[2]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'supplier data not valid');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->load->database();
				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
				$postdata['updated_at_epoch'] = $newdate;

				$WriteNewSupplier = $this->db->insert('suppliers', $postdata); 

				$this->session->set_flashdata('info', 'supplier added');
				$this->load->helper('url');
				redirect("/account", "refresh");
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
		redirect("/account", "refresh");
	}
}

public function add_new_product()
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

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$this->load->model('store');
				$allsuppliers = $this->store->get_suppliers();
				$pagedata['title'] = "add product page";
				$pagedata['suppliers'] = $allsuppliers;

				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('store_admin_add_products', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
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

public function process_new_product()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->database();

		$this->load->model('user');
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();
				
		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
		{
			$postdata = $this->input->post();
			$loginOG = $this->session->userdata('login');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('supplier', 'Supplier', 'required|min_length[2]');
			$this->form_validation->set_rules('product', 'Product', 'required|min_length[2]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'product data not valid');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->load->database();
				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
				$postdata['updated_at_epoch'] = $newdate;

				$supplier = $postdata['supplier'];
				unset($postdata['supplier']);

				$WriteNewProduct = $this->db->insert('products', $postdata); 
				$products_id = $this->db->insert_id();

				$this->load->model('store');
				$suppliers_id = $this->store->get_suppliers_id_via_name($supplier);

				$products_suppliers_data =  array(
		       		'suppliers_id' => $suppliers_id,
		            'products_id' => $products_id,
		            'created_at'=> $z,
		            'updated_at'=> $z,
		            'created_at_epoch' => $newdate,
		            'updated_at_epoch' => $newdate
	        	);

				$WriteNewProduct_Supplier = $this->store->add_new_product_supplier($products_suppliers_data);

				$this->session->set_flashdata('info', 'product added');
				$this->load->helper('url');
				redirect("/account", "refresh");
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

public function admin_new_card_provider()
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

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$pagedata['title'] = "add supplier page";
				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('store_admin_add_card_provider', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
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

public function process_new_card_provider()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->database();

		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();
				
		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
		{
			$postdata = $this->input->post();
			$loginOG = $this->session->userdata('login');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'payment provider name missing');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->load->database();
				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['created_at_epoch'] = $newdate;	
				$postdata['updated_at_epoch'] = $newdate;

				$WriteNewCardProvider = $this->db->insert('card_providers', $postdata); 

				$this->session->set_flashdata('info', 'payment provider added');
				$this->load->helper('url');
				redirect("/account", "refresh");
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

public function add_new_card()
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

			if ($the_l_row['level'] >= USER_LEVEL_STORE) 
			{
				$this->load->model('store');
				$allsuppliers = $this->store->get_card_providers();
				$pagedata['title'] = "add card";
				$pagedata['suppliers'] = $allsuppliers;

				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('store_add_card_view', $pagedata);
				$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
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

public function process_new_card()
{
	$loggedStatus = $this->session->userdata('logged');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();

		$this->load->database();

		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();
				
		if ($the_l_row['level'] >= USER_LEVEL_STORE) 
		{
			$postdata = $this->input->post();
			$loginOG = $this->session->userdata('login');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('card', 'Card', 'required|min_length[16]');
			$this->form_validation->set_rules('expiration_month', 'Expiration_month', 'required|min_length[1]');
			$this->form_validation->set_rules('expiration_year', 'Expiration_year', 'required|min_length[4]');
			$this->form_validation->set_rules('address_1', 'Address_1', 'required|min_length[10]');
			$this->form_validation->set_rules('city', 'City', 'required|min_length[2]');
			$this->form_validation->set_rules('first_name', 'First_name', 'required|min_length[1]');
			$this->form_validation->set_rules('last_name', 'Last_name', 'required|min_length[2]');
			$this->form_validation->set_rules('state', 'State', 'required|min_length[2]');
			$this->form_validation->set_rules('ZIP', 'ZIP', 'required|min_length[2]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('info', 'card data not valid');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
			else
			{
				$this->load->database();

				$this->load->helper('user');
				$dates = djm_date();
				$z = $dates[1];
				$newdate = $dates[0];

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['users_id'] = $uid;

				$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
				$postdata['updated_at_epoch'] = $newdate;

				$providers_id = $postdata['provider'];
				unset($postdata['provider']);

				$postdata['card_providers_id'] = $providers_id;

				$truecard00 = $postdata['card'];
				$truecard0 = str_replace("-","",$truecard00);
				$truecard = str_replace(" ","",$truecard0);

				$users_id = $postdata['users_id'];
				$newCard = encrypt_card($truecard);
				$postdata['card'] = $newCard;

				//	there should optimally be a 3rd party verfication step using the cvv here
				if (isset($postdata['cvv']))
				{
					unset($postdata['cvv']);		//	should not be stored in DB
				}

				$WriteNewPaymentMethod = $this->db->insert('payment_methods', $postdata);

				$this->session->set_flashdata("info", "payment method added");
				$this->load->helper('url');
				redirect("/account", "refresh");
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

public function admin_edit_product($products_id)
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
			
			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$this->load->model('store');
				$query02 = $this->store->get_a_certain_product($products_id);

				$the_q_row = $query02->row_array();

				foreach ($query02->result() as $row)
				{
					$product = $row->product;
				   	$description = $row->description;	
				   	$url = $row->URL;
				   	$inventory = $row->inventory;
				   	$price = $row->price;
				   	$d_1_b = $row->digital_bool;
				}

				$pagedata = array(
	           			'product' => $product,
				   		'description' => $description,
				   		'url' => $url,
				   		'inventory' => $inventory,
				   		'price' => $price,
				   		'products_id' => $products_id,
				   		'digital_bool' => $d_1_b,
				   		'photo_url' => $row->photo_url
	        		);

				$pagedata['title'] = "djmblog.com edit product page";

				$this->load->view('site_head_foundation', $pagedata);
				$this->load->view('nav_foundation_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('store_admin_edit_product_view', $pagedata);
				$this->load->view('site_footer', $pagedata);
			}
			else 
			{
				$this->session->set_flashdata('info', 'Account access error');
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}
	}
	else
	{	
		$this->session->set_flashdata('info', 'Log In or Create Account.');
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
}

public function process_edit_product()
{
	$loggedOG = $this->session->userdata('logged');

	$this->load->library('form_validation');
	$this->form_validation->set_rules('product', 'Product', 'required|min_length[4]');

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'error changing product info');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
	else
	{
		$p = $this->input->post();

		if ($loggedOG == 1)		
		{		
			$this->load->helper('user');
			$uid = get_user_id_via_current_login();

			$this->load->model('user');

			$query0 = return_users_levels_row_via_id($uid);
			
			$the_l_row = $query0->row_array();
			
			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN) 
			{
				$this->load->model('store');
				$productEdited = $this->store->edit_a_product($p);

				$this->session->set_flashdata('info', 'product edited');
				$this->load->helper('url');
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
			$this->session->set_flashdata('info', 'login required');
			$this->load->helper('url');
			redirect('/login', 'refresh');
		}

		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function admin_list_products()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();

		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
		{
			$this->load->model('store');
			$query0 = $this->store->get_all_products_desc();

			$posts = array();
			$c = 0;
			foreach ($query0->result() as $row)
			{
				$products_id = $row->id;
				$product = $row->product;
				$updated_at = $row->updated_at;

				$the_n_row = array();
				$the_n_row['products_id'] = $products_id;
				$the_n_row['product'] = $product;

				$posts[$c] = $the_n_row;
				$c++;
			}

			$pagedata['title'] = "List of Products";
			$pagedata['posts'] = $posts;

			$this->load->view('site_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('store_admin_product_list_view', $pagedata);
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
		$this->session->set_flashdata('info', 'log in to edit products');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function delete_product_process($kill_product_id)
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
		{
				$this->db->where('id', $kill_product_id);
				$this->db->delete('products');

				$this->session->set_flashdata('info', 'product deleted');
				$this->load->helper('url');
				redirect('/', 'refresh');
		}
		else 
		{
			$this->session->set_flashdata('info', 'did not delete product: account access error');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'log in to delete products');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}

public function store_admin()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
		{
			$pagedata['title'] = "store admin page";

			$this->load->view('site_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('store_admin_view', $pagedata);
			$this->load->view('site_footer', $pagedata);
		}
		else
		{
			$this->session->set_flashdata('info', 'Account Access Error.');
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	else
		{
			$this->session->set_flashdata('info', 'Not Logged In.');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
}

public function add_to_cart_process($products_id, $amount)										
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$dbdata = array(
	           			'products_id' => $products_id,
				   		'quantity' => $amount,
				   		'users_id' => $uid
	        		);
			$this->load->model('store');
			$checkoff = $this->store->check_item_for_cart($dbdata['products_id'], $dbdata['users_id']);
			if ($checkoff == TRUE)
			{
				$this->session->set_flashdata('info', 'Item already purchased');
				$this->load->helper('url');
				redirect('/purchases', 'refresh');
			}
			$cartAdded = $this->store->add_item_to_cart($dbdata);

			if ($cartAdded == TRUE)
			{
				$this->session->set_flashdata('info', 'Item added to cart');
				$this->load->helper('url');
				redirect('/cart', 'refresh');
			}
			else if ($cartAdded == FALSE)
			{
				$this->session->set_flashdata('info', 'Item already in cart');
				$this->load->helper('url');
				redirect('/cart', 'refresh');
			}
			else if ($cartAdded == null)
			{
				$this->session->set_flashdata('info', 'Item could not be added to cart');
				$this->load->helper('url');
				redirect('/store', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('info', 'ERROR');
				$this->load->helper('url');
				redirect('/store', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'Account Access Error');
			$this->load->helper('url');
			redirect('/store', 'refresh');
		}
	}
	else
	{
		$intent = array(
	       		'page' => '/add/cart/' . $products_id . '/' . $amount
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata('info', 'Not Logged In');
			$this->load->helper('url');
			redirect('/account', 'refresh');
	}
}

public function stores_index()
{
	$this->load->database();

	$this->load->model('store');
	$query0 = $this->store->get_all_products_updated_desc();

	$posts = array();
	$c = 0;
	foreach ($query0->result() as $row)
	{
		$post_id = $row->id;
		$post_title = $row->product;
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

	$pagedata['title'] = SITE_NAME . " Digital Products";
	$pagedata['title_on_page'] = "Digital Products";
	$pagedata['posts'] = $posts;

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('store_index_view', $pagedata);
	$this->load->view('store_sidebar_view', $pagedata);
	$this->load->view('site_footer');
}

public function cart_page()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$this->load->model('store');
			$query01 = $this->store->get_cart_data($uid);

			$the_l1_row = $query01->row_array();
			
			$cartData = array();
			$cartCount = 0;

			foreach ($query01->result() as $row)
			{
				$cartItem = array();

				$cartItem['product'] = $row->product;
				$cartItem['products_id'] = $row->products_id;
			   	$cartItem['quantity'] = $row->quantity;	
			   	$cartItem['price'] = $row->price;

				$cartItem['itemSubtotal'] = $cartItem['quantity'] * $cartItem['price'];

				$this->load->model('store');
				$query01 = $this->store->get_cart_of_user($uid);
				$the_l1_row = $query01->row_array();

			   	$cartData[$cartCount] = $cartItem;
			   	$cartCount++;
			}

			$pagedata = array(
	       		'title' => "<a href='/store'>Store </a> Shopping Cart",
	       		'cartData' => $cartData
	        );

	        $pagedata0 = array(
	       		'title' => SITE_NAME . " Store Shopping Cart",
	       		'cartData' => $cartData
	        );
	
			$this->load->view('site_head_foundation', $pagedata0);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('cart_view', $pagedata);
			$this->load->view('store_sidebar_view', $pagedata);
			$this->load->view('site_footer', $pagedata);
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
		$intent = array(
	       		'page' => '/cart'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function kill_cart_data($products_id, $quantity)
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
	
		$this->load->model('user');
		$query0 = $this->user->get_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$killArray = array('users_id' => $uid, 'products_id' => $products_id);

			$this->db->where($killArray); 
			$this->db->delete('cart');

			$this->session->set_flashdata('info', 'item removed');
			$this->load->helper('url');
			redirect('/cart', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('info', 'account access error');
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

public function checkout_page()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
	
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$this->load->model('store');
			$query01 = $this->store->get_checkout_page_cart_data($uid);

			$the_l1_row = $query01->row_array();
			
			$cartData = array();
			$cartCount = 0;
			$grandTotal = 0;
			$itemCount = 0;

			foreach ($query01->result() as $row)
			{
				$cartItem = array();

				$cartItem['product'] = $row->product;
				$cartItem['products_id'] = $row->products_id;
			   	$cartItem['quantity'] = $row->quantity;	

			   	//	Time to figure out the price per item and subtotal
			   	$cartItem['price'] = $row->price;

				$cartItem['itemSubtotal'] = $cartItem['quantity'] * $cartItem['price'];
				$grandTotal = $grandTotal + $cartItem['itemSubtotal'];
			   	
			   	$cartData[$cartCount] = $cartItem;
			   	$cartCount++;

			   	$itemCount = $itemCount + $cartItem['quantity'];
			}
			
			$this->load->model('store');
			$tax_rate = $this->store->get_tax_rate();

			$Ztax = ($grandTotal * $tax_rate);
			$tax = number_format((float)$Ztax, 2, '.', '');
			$megaTotal = $grandTotal + $tax;

			$payment_methods = $this->store->get_user_payment_methods($uid);

			$pagedata = array(
	       		'title' => 'Checkout',
	       		'cartData' => $cartData,
	       		'subTotal' => $grandTotal,
	       		'tax_rate' => $tax_rate,
	       		'total' => $megaTotal,
	       		'payment_methods' => $payment_methods,
	       		'itemCount' => $itemCount
	        );
	
			$this->load->view('checkout_stripe_wa_head_foundation', $pagedata);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('checkout_stripe_wa_view_foundation', $pagedata);
			$this->load->view('site_terms_footer', $pagedata);
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
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function buy_process()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$this->load->model('store');
			$query01 = $this->store->get_cart_data($uid);

			$the_l1_row = $query01->row_array();
			
			$cartData = array();
			$cartCount = 0;
			$grandTotal = 0;

			foreach ($query01->result() as $row)
			{
				$cartItem = array();

				$cartItem['product'] = $row->product;
				$cartItem['products_id'] = $row->products_id;
			   	$cartItem['quantity'] = $row->quantity;	

			   	//	Time to figure out the price per item and subtotal
			   	$cartItem['price'] = $row->price;

				$cartItem['itemSubtotal'] = $cartItem['quantity'] * $cartItem['price'];
				$grandTotal = $grandTotal + $cartItem['itemSubtotal'];
			   	$cartData[$cartCount] = $cartItem;
			   	$cartCount++;
			}
			
			$this->load->model('store');

			$postdata = $this->input->post();

			$tax_rate = $postdata['tax_rate'];	//	this respects the user's declaration of whether they are in WA or not in the wa_view

			$Ztax = ($grandTotal * $tax_rate);
			$tax = number_format((float)$Ztax, 2, '.', '');
			$megaTotal = $grandTotal + $tax;

			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			$order['created_at'] = $z;
			$postdata['updated_at'] = $z;

			$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
			$postdata['updated_at_epoch'] = $newdate;

			$order = array(
	        	'users_id' => $uid,
	       		'created_at' => $z,
	       		'updated_at' => $z,
	       		'created_at_epoch' => $newdate,
	       		'updated_at_epoch' => $newdate
				);

			$cash = array(
	        	'subTotal' => $grandTotal,
	       		'tax_rate' => $tax_rate,
	       		'total' => $megaTotal
				);

			if ($grandTotal == 0)
			{
				//	Time to process the free purchase and send the user to the thank you page

				$finalizeFreePurchase = $this->store->processPurchaseItems($cartData, $order, $cash);

				if ($finalizeFreePurchase == TRUE)
				{
					//	the transaction worked
					$this->session->set_flashdata('info', 'free transaction completed');
					$this->load->helper('url');
					redirect('/purchases', 'refresh');
				}
				elseif ($finalizeFreePurchase == null) {
					$this->session->set_flashdata('info', 'improper transaction amount');
					$this->load->helper('url');
					redirect('/purchases', 'refresh');
				}
				else
				{
					//	an error occurred
					$this->session->set_flashdata('info', 'error processing purchase');
					$this->load->helper('url');
					redirect('/cart', 'refresh');
				}
			}
			else
			{
				require_once(APPPATH.'libraries/stripe/init.php');

				\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_API_KEY);

				// Get the credit card details submitted by the form
				$token = $_POST['stripeToken'];
				$total100 = $megaTotal;
				$nearTotal = number_format((float)$total100, 2, '.', '');
				$total = $nearTotal * 100; 	//	this makes it in cents as Stripe expects

				$sitedec = SITE_NAME . " store charge";

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
				$finalizePayPurchase = $this->store->processPurchaseItems($cartData, $order, $cash);

				if ($finalizePayPurchase == TRUE)
				{
					//	the transaction worked
					$this->session->set_flashdata('info', 'purchase transaction completed');
					$this->load->helper('url');
					redirect('/purchases', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('info', 'error processing transaction');
					$this->load->helper('url');
					redirect('/store', 'refresh');
				}
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
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function purchases_list()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
		$this->load->database();
		
		$query0 = return_users_levels_row_via_id($uid);

		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{	
			$this->load->model('store');
			$query01 = $this->store->get_the_sales_data($uid);

			$purchaseData = array();
			$cartCount = 0;

			foreach ($query01->result() as $row)
			{
				$pDataUnit = array();
				$pDataUnit['product'] = $row->product;
				$pDataUnit['products_id'] = $row->products_id;
				$purchaseData[$cartCount] = $pDataUnit;
				
				$cartCount++;
			}
			$pagedata = array();

			$pagedata['title'] = "Digital <a href='/store/'>Store</a> Purchases";
			$pagedata['posts'] = $purchaseData;

			$pagedata0 = array(
	       		'title' => SITE_NAME . " Store Purchases"
	        );

			$this->load->view('site_head_foundation', $pagedata0);
			$this->load->view('nav_foundation_view', $pagedata);
			$this->load->view('header_link_flash_view', $pagedata);
			$this->load->view('store_purchases_view', $pagedata);
			$this->load->view('store_sidebar_view', $pagedata);
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
		$intent = array(
	       		'page' => '/purchases'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function buy_process_free()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');
	$this->load->helper('user');
	$uid = get_user_id_via_current_login();

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->database();
	
		$query0 = return_users_levels_row_via_id($uid);
		$the_l_row = $query0->row_array();

		if ($the_l_row['level'] >= USER_LEVEL_STORE)
		{
			$this->load->model('store');
			$query01 = $this->store->get_cart_data($uid);

			$the_l1_row = $query01->row_array();
			
			$cartData = array();
			$cartCount = 0;
			$grandTotal = 0;

			foreach ($query01->result() as $row)
			{
				$cartItem = array();

				$cartItem['product'] = $row->product;
				$cartItem['products_id'] = $row->products_id;
			   	$cartItem['quantity'] = $row->quantity;	

			   	//	Time to figure out the price per item and subtotal
			   	$cartItem['price'] = $row->price;

				$cartItem['itemSubtotal'] = $cartItem['quantity'] * $cartItem['price'];
				$grandTotal = $grandTotal + $cartItem['itemSubtotal'];
			   	$cartData[$cartCount] = $cartItem;
			   	$cartCount++;
			}
			
			$this->load->model('store');

			$postdata = $this->input->post();

			$tax_rate = 0;	//	for free purchases

			$Ztax = ($grandTotal * $tax_rate);
			$tax = number_format((float)$Ztax, 2, '.', '');
			$megaTotal = $grandTotal + $tax;

			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			$order['created_at'] = $z;
			$postdata['updated_at'] = $z;

			$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
			$postdata['updated_at_epoch'] = $newdate;

			$order = array(
	        	'users_id' => $uid,
	       		'created_at' => $z,
	       		'updated_at' => $z,
	       		'created_at_epoch' => $newdate,
	       		'updated_at_epoch' => $newdate
				);

			$cash = array(
	        	'subTotal' => $grandTotal,
	       		'tax_rate' => $tax_rate,
	       		'total' => $megaTotal
				);

			if ($grandTotal == 0)
			{
				//	echo "this is a free purchase";
				//	Time to process the purchase and send the user to the thank you page

				$finalizeFreePurchase = $this->store->processPurchaseItems($cartData, $order, $cash);

				if ($finalizeFreePurchase == TRUE)
				{
					//	the transaction worked
					$this->session->set_flashdata('info', 'free transaction completed');
					$this->load->helper('url');
					redirect('/purchases', 'refresh');
				}
				elseif ($finalizeFreePurchase == null) {
					$this->session->set_flashdata('info', 'improper transaction amount');
					$this->load->helper('url');
					redirect('/purchases', 'refresh');
				}
				else
				{
					//	an error occurred
					$this->session->set_flashdata('info', 'error processing purchase');
					$this->load->helper('url');
					redirect('/cart', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'ITEMS ARE NOT FREE.');
				$this->load->helper('url');
				redirect('/cart', 'refresh');
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
		$this->session->set_flashdata('info', 'login required');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

}