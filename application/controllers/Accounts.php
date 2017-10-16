<?php
class Accounts extends CI_Controller
{
	//	Accounts controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2015-2016  -->
public function edit()
{	//	This method launches the 'edit account' page for logged-in users with form to change login, email, etc.
	$this->load->model('user');

	if ($this->user->check_session_login())
	{
		$login = $this->session->userdata('login');

		$query = $this->user->get_users_row_via_login($login);

		foreach ($query->result() as $row)
		{
		   $login = $row->login;
		   $email0 = $row->email;
		   $uid = $row->id;
		   $name0 = $row->name;
		   $url1 = $row->URL;
		}

		$pagedata = array(
               'login1' => $login,
               'email1'=> $email0,
               'name1' => $name0,
               'url1' => $url1
            );

		if (TRUE)
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			$pagedata['loggedinfo'] = "";
			$listText = "<h2 id='list_of_Features'>Features</h2><ul>";
			$listText = $listText . "<li><a href='/photostream'>Photostream</a></li>";

			if ($the_l_row['level'] >= 1)
			{
				if ($the_l_row['level'] >= USER_LEVEL_PHOTO_CLIENT)
				{
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . "<h2 class='content_heading'>Manage Content</h2>";
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . "<a href='/album' id='turndark'><button class='button secondary btn btn-primary cart_button' id='random_light_background_button2'>My Photos</button></a> ";
				}
				if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
				{
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='/gallerys/upload'><button class='btn btn-secondary secondary hollow button' id='uploadClientPhotos'>Upload Photos</button></a>";
				}
		
				if ($the_l_row['level'] >= USER_LEVEL_BLOG_POSTING)
				{
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='/blogs/write'><button id='manage_files_button' class='files_manage button btn btn-info'>Create Blog Post</button></a> ";
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='edit/posts'><button class='button btn btn-info'>Edit Posts</button></a>";
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='/pages/create'><button class='button btn btn-info'>Create Page</button></a>";
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='/pages/edit'><button class='button btn btn-info'>Edit Pages</button></a>";
					$listText = $listText . "<li><a href='/blog'>Blog</a></li><li><a href='/pages/edit'>Page Builder</a></li>";
				}
				if ($the_l_row['level'] >= USER_LEVEL_FILE_UPLOADING)
				{
					$listText = $listText . "<li><a href='/files'>File Uploader</a></li>";
					$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . " <a href='/files'><button id='manage_files_button' class='files_manage button btn btn-secondary secondary button'>Manage Files</button></a>";
				}
				$listText = $listText . "</ul>";
				$pagedata['loggedinfo'] = $pagedata['loggedinfo'] . $listText;
			}
			else
			{
				$pagedata['loggedinfo'] = FALSE;
			}
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'Log In or Create Account.');
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}

	$pagedata['title'] = "account page";

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('edit_account_view', $pagedata);
	$this->load->view('site_terms_footer', $pagedata);
}

public function check_acct_change_input()
{	//	This method processes the post data from form for login, email, name and URL editing
	$loginOG = $this->session->userdata('login');

	$this->load->library('form_validation');
	$this->form_validation->set_rules('login', 'Username', 'trim|required|min_length[2]|max_length[32]');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'account change data not valid');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
	else
	{
		$p = $this->input->post();
		unset($p['cpassword']);
		$this->load->model('user');
		$usr1 = $p['login'];

		if (($usr1 == $loginOG) || ($this->user->check_dup($usr1)))		//	this should ensure users can't duplicate logins
		{																//	but can change email while keeping login
			$newacctcreated = $this->user->edit_a_user($p);

			if ($newacctcreated == FALSE)
			{
				$this->session->set_flashdata('info', 'account not edited');
			}
			else
			{
				$this->session->set_flashdata('info', 'account edited');
			}
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
			$this->session->set_flashdata('info', 'desired new login is duplicate');
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function edit_pw()
{	//	This method processes the post data from form for password editing
	$loggedOG = $this->session->userdata('logged');

	$this->load->library('form_validation');
	$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]|min_length[7]');
	$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->session->set_flashdata('info', 'new password not valid');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
	else
	{
		$p = $this->input->post();
		unset($p['cpassword']);

		$this->load->model('user');

		if ($loggedOG == 1)
		{
			$newacctcreated = $this->user->edit_a_user_pw($p);	//	this needs to be change to update the user info instead

			$this->session->set_flashdata('info', 'account password edited');
			$this->load->helper('url');
		}
		else
		{
			$this->session->set_flashdata('info', 'registration data is duplicate');
			$this->load->helper('url');
			redirect('/login', 'refresh');
		}

		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function privacy_policy_view()
{	//	This launches the privacy policy view
	$pagedata['title'] = SITE_NAME . " privacy policy page";
	$termspage['name1'] = OWNER_NAME;

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('privacy_policy_view', $termspage);
	$this->load->view('site_terms_footer', $pagedata);
}

public function terms()
{	//	This launches the terms and conditions view
	$pagedata['title'] = SITE_NAME . " terms and conditions page";
	$termspage['name1'] = OWNER_NAME;

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('terms_view', $termspage);
	$this->load->view('site_terms_footer', $pagedata);
}

public function help_page()
{	//	This launches the /help view
	$pagedata['title'] = SITE_NAME . " help";
	$termspage['name1'] = OWNER_NAME;

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('help_view', $termspage);
	$this->load->view('site_terms_footer', $pagedata);
}

public function reset_password($login)
{	//	This method accepts a login as a parameter and resets the login for that user, sends an email with new password
	$this->load->model('user');

	if ($this->user->check_session_login())
	{
		$logon = $this->session->userdata('login');

	    $query = $this->user->get_users_row_via_login($login);

			foreach ($query->result() as $row)
			{
				$uid = $row->id;
			   	$login = $row->login;
			   	$email0 = $row->email;
			   	$password0 = $row->password;
			}

			$this->load->helper('user');
			$udid = get_users_id_via_login($logon);

		if (isset($udid))
		{
		    $query0 = $this->user->get_users_levels_row_via_id($uid);

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_STORE_ADMIN)
			{
				$temp_password_0 = rand(5, 15);
				$temp_password_00 = $temp_password_0 . $password0;
				$alg = PW_ALGORITHM;
				$temp_password = hash($alg, $temp_password_00);
				$newdata['password'] = $temp_password;

				$newdata['id'] = $uid;

				$email_subject = "djmblog.com account: password reset";
				$email_message = "Hello from <a href='http://djmblog.com'>djmblog.com</a>.  Our servers have received a request to reset your password.  Your new password is:<br /> " . $temp_password . "<br />Please log in at <a href='https://djmblog.com/account'>djmblog.com/account</a> and change your password to a new one as soon as possible.  If you have any questions you can email help@djmblog.com.";
				$email_recipient = $email0;

				$email_sender = "help@djmblog.com";
				$email_sender_name = "djmblog.com";

				$edit_sucess = $this->user->edit_a_user_pw_reset($newdata);

				if ($edit_sucess == TRUE)
				{
					$this->load->library('email');
					$this->email->from($email_sender, $email_sender_name);
					$this->email->to($email_recipient);
					$this->email->subject($email_subject);
					$this->email->message($email_message);

					$this->email->send();

					$this->session->set_flashdata('info', 'password updated for ' . $login . ' and email sent to ' . $email_recipient . " with new password " . $newdata['password']);
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
				else
				{
						//	error in editing account
					$this->session->set_flashdata('info', 'ERROR in editing account password for ' . $login);
					$this->load->helper('url');
					redirect('/account', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('info', 'ERROR in access: password not reset for ' . $login);
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'ACCOUNT ERROR: password not reset for ' . $login);
			$this->load->helper('url');
			redirect('/account', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('info', 'LOGIN ERROR: password not reset for ' . $login);
		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
}

}
