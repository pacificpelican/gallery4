<?php
class Games extends CI_Controller
{
	//	Games controller for djmblog.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function blackjack_game()
{
$this->load->model('user');

	if ($this->user->check_session_login()) 
	{
		$login = $this->session->userdata('login');
		$this->load->database();

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
			$query0 = $this->db->select('*')->from('users_levels')
		    ->where('users_id', $uid)
		    ->get();

			$the_l_row = $query0->row_array();

			if ($the_l_row['level'] >= USER_LEVEL_GAMES) 
			{
				$this->load->model('store');
				$allsuppliers = $this->store->get_suppliers();
				$pagedata['title'] = "add product page";
				$pagedata['suppliers'] = $allsuppliers;
				$pagedata['login'] = $login;
				$pagedata['gametype'] = "blackjack";

				$this->load->view('games_head_view', $pagedata);
				$this->load->view('nav_bootstrap_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('games_blackjack_view', $pagedata);
				$this->load->view('store_sidebar_view', $pagedata);
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
		$intent = array(
	       		'page' => '/blackjack'
	        );
		$this->session->set_userdata($intent);
		$this->session->set_flashdata('info', 'not logged in');
		$this->load->helper('url');
		redirect('/account', 'refresh');
	}
}

public function draw_card()
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

			if ($the_l_row['level'] >= USER_LEVEL_GAMES) 
			{
				$this->load->model('store');
				$allsuppliers = $this->store->get_suppliers();
				$pagedata['title'] = "add product page";
				$pagedata['suppliers'] = $allsuppliers;
				$pagedata['login'] = $login;
				$pagedata['gametype'] = "draw a [random??] card";

				$this->load->view('games_head_view', $pagedata);
				$this->load->view('nav_bootstrap_view', $pagedata);
				$this->load->view('header_link_flash_view', $pagedata);
				$this->load->view('games_draw_card_view', $pagedata);
				$this->load->view('store_sidebar_view', $pagedata);
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

}
