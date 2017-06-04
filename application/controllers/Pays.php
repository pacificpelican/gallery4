<?php
class Pays extends CI_Controller
{
	//	Pays controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function pay_page()
{
	$pagedata = array(
	       		'title' => SITE_NAME . "/pay",
	       		'name1' => "/pay"
	        	);
	
	$this->load->view('checkout_pay_stripe_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('pay_form_view', $pagedata);
	$this->load->view('store_sidebar_view', $pagedata);
	$this->load->view('site_footer', $pagedata);
}

public function buy_process()
{
	$loggedStatus = $this->session->userdata('logged');
	$loginOG = $this->session->userdata('login');

	if ((isset($loggedStatus)) && ($loggedStatus == 1))
	{
		$this->load->helper('user');
		$uid = get_user_id_via_current_login();
	}
	else 
	{
		$uid = null;
	}
			
	$this->load->helper('date');
	$newdate = now('America/Los_Angeles');
	$z = date("Y-m-d H:i:s");

	$order['created_at'] = $z;
	$postdata['updated_at'] = $z;

	$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
	$postdata['updated_at_epoch'] = $newdate;

	$postdata = $this->input->post();
	$megaTotal = $postdata['total'];
	if ($megaTotal > 0.60)
	{
		$cash = array(
	       		'total' => $megaTotal
				);
	}
	else
	{
		$this->session->set_flashdata('info', 'amount too low to be processed by Stripe');
		$this->load->helper('url');
		redirect('/pay', 'refresh');
	}
			
	require_once(APPPATH.'libraries/stripe/init.php');

	\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_API_KEY);

	// Get the credit card details submitted by the form
	$token = $_POST['stripeToken'];
	$total100 = $megaTotal;
	$nearTotal = number_format((float)$total100, 2, '.', '');
	$total = $nearTotal * 100; 	//	this makes it in cents as Stripe expects

	$sitedec = SITE_NAME . " pay charge";
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
		redirect('/pay', 'refresh');
	}

	$this->load->model('pay');
		//	if the program runs past the error catch above, that should mean that the charge went through
	$finalizePayPurchase = $this->pay->processPurchaseItems($cash, $uid);

	if ($finalizePayPurchase == TRUE)
	{
		//	the transaction worked
		$this->session->set_flashdata('info', 'Payment completed.  Thank you.');
		$this->load->helper('url');
		redirect('/', 'refresh');
	}
	else
	{
		$this->session->set_flashdata('info', 'error processing pay transaction');
		$this->load->helper('url');
		redirect('/pay', 'refresh');
	}
}

public function to_buy_process()
{
	$this->load->helper('url');
	redirect('/pay', 'refresh');
}

}