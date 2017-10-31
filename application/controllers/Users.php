<?php
class Users extends CI_Controller
{
	//	lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function front_look()
{
	$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$pagedata = array(
               'loggedinfo' => "Logged in [<a href='/logout'>logout</a>]</li><li id='addnewlink'><a href='/add/dish'>Add New Dish</a>",
               'userid' => $login
            );
	}
	else
	{	
		$pagedata = array(
        	'loggedinfo' => "Not logged in [<a href='/login'>register/login</a>]"
            );
	}

	$pagedata['title'] = SITE_NAME;

	$this->load->view('site_header', $pagedata);
	$this->load->view('front_view', $pagedata);
	$this->load->view('site_footer', $pagedata);
}

public function log_out_session()	//	This controller calls the end_session() function to log the user out
{
	$this->load->model('user');
	$this->user->end_session();
	$this->session->set_flashdata('info', 'Logged Out.');
	$this->load->helper('url');
	redirect('/', 'refresh');
}

public function login_look()	//	This loads the /login page, unless the user is logged in then they go to /account
{
	$this->load->model('user');
	if ($this->user->check_session_login()) 
	{
		$this->session->set_flashdata('info', 'Already Logged In.');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
	else
	{	
		$site = "djmblog.com login/registration";

		$pagedata = array(
		           'title' => $site,
		           'logged' => FALSE
		        );

		$this->load->view('site_head_foundation', $pagedata);
		$this->load->view('nav_foundation_view', $pagedata);
		$this->load->view('header_link_flash_view', $pagedata);
		$this->load->view('login_view', $pagedata);
		$this->load->view('site_terms_footer', $pagedata);
	}
}

public function check_reg_input()	//	This controller accepts registration post data from the /login form
{
	if (defined('INTL_IDNA_VARIANT_UTS46'))
	{
		//	this validation set is more thorough but causes errors on some shared hosts
		//	thus the simplified validations are used by default
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'Username', 'trim|required|min_length[2]|max_length[32]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]|min_length[7]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	}
	else
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
	}

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'registration data not valid');
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
	else
	{
		$p = $this->input->post();
		unset($p['cpassword']);

		$this->load->model('user');

		$usr1 = $p['login'];

		if ($this->user->check_dup($usr1))
		{
			$newacctcreated = $this->user->add_new_user($p);

			$this->session->set_flashdata('info', 'account created');
			$this->load->helper('url');
			$logon = $p['login'];

			$logondata = array(
	           'login' => $logon,
	           'logged' => TRUE
	        );

			$session_set = $this->user->start_session($logondata);
		}
		else
		{
			$this->session->set_flashdata('info', 'registration data is duplicate');
			$this->load->helper('url');
			redirect('/login', 'refresh');
		}

		$pageOG = $this->session->userdata('page');

		$this->load->helper('url');

		if (isset($pageOG))
		{
			$this->session->unset_userdata('page');
			redirect($pageOG, 'refresh');
		}
		else
		{
			redirect('/', 'refresh');
		}
	}
}

public function check_login_input()	//	This controller accepts login post data from the /login form
{
	$this->load->library('form_validation');
	$this->form_validation->set_rules('login', 'Username', 'trim|required');
	$this->form_validation->set_rules('password', 'Password', 'trim|required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'login data not valid');
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
	else
	{
		$p = $this->input->post();
		$this->load->model('user');

		if ($this->user->check_user_login($p))
		{
			$logon = $p['login'];

			$logondata = array(
               'login' => $logon,
               'logged' => TRUE
            );
			//	If the user has a valid login then their info is put in the session for future login checks
			$session_set = $this->user->start_session($logondata);
			$this->session->set_flashdata('info', 'logged in');

			$pageOG = $this->session->userdata('page');

			$this->load->helper('url');
			if (isset($pageOG))
			{
				$this->session->unset_userdata('page');
				redirect($pageOG, 'refresh');
			}
			else
			{
			
				redirect('/', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'login failed');
			$this->load->helper('url');
			redirect('/login', 'refresh');
		}
	}
}

}
