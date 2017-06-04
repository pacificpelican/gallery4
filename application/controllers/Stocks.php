<?php
class Stocks extends CI_Controller
{
	//	Stocks controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->

public function quote()
{
$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$this->load->database();

		// $q1 = "SELECT * FROM users WHERE login='" . $login . "'";
		// $query = $this->db->query($q1);

		$q1 = "SELECT * FROM users WHERE login = ?";
		$query = $this->db->query($q1, array($login));

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

			if ($the_l_row['level'] >= USER_LEVEL_STOCKS_TOOL) 
			{
				$this->load->model('store');
				$allsuppliers = $this->store->get_suppliers();
				$pagedata['title'] = "add product page";
				$pagedata['suppliers'] = $allsuppliers;

				$this->load->view('site_head', $pagedata);
				$this->load->view('nav_bootstrap_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('stocks_quote_view', $pagedata);
			//	$this->load->view('blog_sidebar_view', $pagedata);
				$this->load->view('site_terms_footer', $pagedata);
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

}