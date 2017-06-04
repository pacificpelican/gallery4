<?php
class Tests extends CI_Controller
{
	//	Tests controller for djmblog.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function credit_card_rebuilder_test($stored_number)
{	//	This function accepts a parameter of a stored credit card number and should output a valid one.
	$this->load->helper('user');
	$recoveredCard = decrypt_card($stored_number);

	echo "recovered number is: " . $recoveredCard;
}

public function en_test($h)
{
	$this->load->helper('user');
	en_test_h($h);
}

public function showProfiler()
{
	$this->output->enable_profiler(TRUE);
}

public function stripe()
{
	$pagedata = null;
	$this->load->view('checkout_stripe_view', $pagedata);
}

public function ex1()
{
	$full_url = SITE_URL . "/";
// $config['base_url'] = $full_url;
	echo $full_url;
}

public function hashes_list()
{
	print_r(hash_algos());
}

function verify_nonduplicate_login($login)
{
	$this->load->helper('user');
	$news = verify_nonduplicate_login($login);
	var_dump($news);

}

public function canYouGetFive() {
	$five = '5';
}

}