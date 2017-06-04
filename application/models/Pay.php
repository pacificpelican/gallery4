<?php 
class Pay extends CI_Model  
//	This file should be named Pay.php (first letter capitalized)
{
	//	Pay model originally for djmblog.com by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->

	function processPurchaseItems($cash, $uid)
	{
		if ($cash['total'] == 0)
		{
			return FALSE;
		}
		elseif ($cash['total'] > 0.01) 
		{
			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			//	already done: run the payment info; now make a record in the users_payments table
			$subtotal = $cash['total'];
			$tax_rate = 0;
			$total = $cash['total'];
			$token = $_POST['stripeToken'];

			$user_payment = array(
	        	'users_id' => $uid,
	       		'subtotal' => $subtotal,
	       		'total' => $total,
	       		'tax_rate' => $tax_rate,
	       		'created_at' => $z,
	       		'hash' => $token,
	       		'orders_id' => null
				);

			$this->load->database();
			$this->db->insert('users_payments', $user_payment);
			
			return TRUE;
		}
		else
		{
			//	no reason to run negative or weird-decimal transactons esp. since the app rounds in the checkout flow
			return null;
		}
	}

}