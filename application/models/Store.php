<?php 
class Store extends CI_Model  
//	This file should be named Store.php (first letter capitalized)
{
	//	Store model for djmblog.com by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->
	function add_new_product_supplier($supplierdata)
	{
		if ((isset($supplierdata['suppliers_id'])) && (isset($supplierdata['products_id'])))
		{
			$this->db->insert('products_suppliers', $supplierdata);
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}

	function add_new_supplier($postdata)
	{
		//	the authorization and validation will be handled in the controller
		$this->load->database();

		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata['created_at'] = $z;	
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		if (isset($postdata['supplier']))
		{
			$attempt = $this->db->insert('suppliers', $postdata);
			return $attempt;
		}
		else 
		{
			return FALSE;
		}
	}

	function add_new_card_provider_process($postdata)
	{
		//	the authorization and validation will be handled in the controller
		$this->load->database();

		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata['created_at'] = $z;	
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		if (isset($postdata['name']))
		{
			$attempt = $this->db->insert('card_providers', $postdata);
			return $attempt;
		}
		else 
		{
			return FALSE;
		}
	}

	function get_suppliers()
	{
		$this->load->database();
		$q1 = "SELECT * FROM suppliers";

		$query = $this->db->query($q1);

		$allstrains = array();
		$counter = 0;

		foreach ($query->result_array() as $row)
		{
			$temp = array();
			$temp = $row;
		   	$allstrains[$counter] = $temp;
		   	$counter++;
		}
		return $allstrains;
	}

	function get_suppliers_id_via_name($s_name)
	{
		$this->load->database();

		$q1 = "SELECT * FROM suppliers WHERE supplier = ?";
		$query = $this->db->query($q1, array($s_name));

		foreach ($query->result_array() as $row)
		{
			$suppliersID = $row['id'];
		}
		return $suppliersID;
	}

	function add_payment($postdata)
	{
		//	the authorization and validation will be handled in the controller
		$this->load->database();

		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata['created_at'] = $z;	
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		unset($postdata['cvv']);	//	the cvv can be checked but not stored

		if ((isset($postdata['card'])) && (isset($postdata['card_providers_id'])) && ((isset($postdata['expiration'])) || (isset($postdata['expires_at']))))
		{
			$attempt = $this->db->insert('card_providers', $postdata);
			return $attempt;
		}
		else 
		{
			return FALSE;
		}
	}

	function add_new_product($productdata, $supplierdata)	//	this function is deprecated
	{
		$postdata = $productdata;
		//	the authorization and validation will be handled in the controller
		$this->load->database();

		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata['created_at'] = $z;	
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		if (isset($postdata['product']))
		{
			$this->db->insert('products', $postdata);
		}
		else 
		{
			return FALSE;
		}

		$products_id = $this->db->insert_id();
		$supplierdata['products_id'] = $products_id;

		if (isset($supplierdata['suppliers_id']))
		{
			$this->db->insert('products_suppliers', $postdata);
			return TRUE;
		}
		else 
		{
			return null;
		}
	}

	function get_card_providers()
	{
		$this->load->database();
		$q1 = "SELECT * FROM card_providers";

		$query = $this->db->query($q1);

		$allstrains = array();
		$counter = 0;

		foreach ($query->result_array() as $row)
		{
			$temp = array();
			$temp = $row;
		   	$allstrains[$counter] = $temp;
		   	$counter++;
		}
		return $allstrains;
	}

	function edit_a_product($postdata)
	{
		$this->load->database();
		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
	
		$z = date("Y-m-d H:i:s");

		$postdata['updated_at'] = $z;
		$postdata['updated_at_epoch'] = $newdate;

		$p_id = $postdata['id'];
		unset($postdata['id']);

		if (isset($postdata['product'])) {
			$this->db->update('products', $postdata, array('id' => $p_id));
			return TRUE; 
		}
		else {
			return FALSE;
		}
	}

	function add_item_to_cart($cartdata)
	{
		$this->load->helper('date');
		$newdate = now('America/Los_Angeles');
		$z = date("Y-m-d H:i:s");

		$postdata = $cartdata;

		$postdata['created_at'] = $z;	
		$postdata['updated_at'] = $z;

		$postdata['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
		$postdata['updated_at_epoch'] = $newdate;

		if ((isset($cartdata['users_id'])) && (isset($cartdata['products_id'])))
		{
			$this->load->database();

			$db_array = array($cartdata['users_id'], $cartdata['products_id']);
			$q1 = "SELECT * FROM cart WHERE users_id = ? AND products_id = ?";
			$query = $this->db->query($q1, $db_array);

			foreach ($query->result() as $row)
			{
				$users_id = $row->users_id;
				$quantity = $row->quantity;
				$products_id = $row->products_id;
			}
			if (isset($row))
			{
				//		Eventually users should be able to add more items to their cart but for now 1 at at time
				return FALSE;
			}
			else 
			{
				$this->db->insert('cart', $postdata);
				$products_id = $this->db->insert_id();
				return TRUE;
			}
		}
		else 
		{
			return null;
		}
		
		return $products_id;
	}

	function get_tax_rate()
	{
		$this->load->database();
		$q1 = "SELECT * FROM tax_rate ORDER BY created_at DESC LIMIT 1";

		$query = $this->db->query($q1);

		$the_row = $query->row_array();

		return $the_row['rate'];
	}

	function get_payment_methods()
	{
		$this->load->database();
		$q1 = "SELECT * FROM payment_methods ORDER BY created_at DESC";

		$query = $this->db->query($q1);

		return $query;
	}

	function get_user_payment_methods($uid)
	{
		$this->load->database();

		$q1 = "SELECT * FROM payment_methods WHERE users_id = ? ORDER BY created_at DESC";
		$query = $this->db->query($q1, array($uid));

		return $query;
	}

	function processPurchaseItems($cartData, $order, $cash)
	{
		if ($cash['total'] == 0)
		{
			//	populate orders table and get the id from it
			$this->db->insert('orders', $order);
			$orders_id = $this->db->insert_id();

			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			$this->load->helper('user');
			$uid = get_user_id_via_current_login();

			foreach ($cartData as $value) 
			{
				$sale = array();
				$sale['orders_id'] = $orders_id;
				$sale['users_id'] = $uid;
				$sale['products_id'] = $value['products_id'];
				$sale_products_id = $value['products_id'];
				$sale['price'] = $value['price'];
				$sale['quantity'] = $value['quantity'];

				$sale['created_at'] = $z;	
				$sale['created_at_epoch'] = $newdate;	//	this is the backup date mechanism
				
				$this->db->insert('sales', $sale);

				//		now this item should be removed from the cart
				$killArray = array('users_id' => $uid, 'products_id' => $sale_products_id);

				$this->db->where($killArray); 

				$this->db->delete('cart');
			}
			return TRUE;
		}
		elseif ($cash['total'] > 0.01) 
		{
			$this->load->helper('date');
			$newdate = now('America/Los_Angeles');
			$z = date("Y-m-d H:i:s");

			$this->load->helper('user');
			$uid = get_user_id_via_current_login();

			//	populate orders table and get the id from it
			$this->db->insert('orders', $order);
			$orders_id = $this->db->insert_id();

			//	already done: run the payment info; now make a record in the users_payments table
			$subtotal = $cash['subTotal'];
			$tax_rate = $cash['tax_rate'];
			$total = $cash['total'];
			$token = $_POST['stripeToken'];

			$user_payment = array(
	        	'users_id' => $uid,
	       		'subtotal' => $subtotal,
	       		'total' => $total,
	       		'tax_rate' => $tax_rate,
	       		'created_at' => $z,
	       		'hash' => $token,
	       		'orders_id' => $orders_id
				);

			$this->db->insert('users_payments', $user_payment);

			//	use the orders table entry id as orders_id and make a sales table item from each item purchased
			foreach ($cartData as $value) 
			{
				$sale = array();
				$sale['orders_id'] = $orders_id;
				$sale['users_id'] = $uid;
				$sale['products_id'] = $value['products_id'];
				$sale_products_id = $value['products_id'];
				$sale['price'] = $value['price'];
				$sale['quantity'] = $value['quantity'];

				$sale['created_at'] = $z;	
				$sale['created_at_epoch'] = $newdate;	//	this is the backup date mechanism

				$this->db->insert('sales', $sale);

				//		now this item should be removed from the cart
				$killArray = array('users_id' => $uid, 'products_id' => $sale_products_id);

				$this->db->where($killArray); 
				$this->db->delete('cart');
			}
			return TRUE;
		}
		else
		{
			//	no reason to run negative or weird-decimal transactons esp. since the app rounds in the checkout flow
			return null;
		}
	}

	function check_item_for_cart($products_id, $uid)
	{
		$this->load->database();

		$q1 = "SELECT * FROM sales WHERE users_id = ? AND products_id = ? ORDER BY created_at DESC LIMIT 1";
		$query = $this->db->query($q1, array($uid, $products_id));

		$the_row = $query->row_array();

		if ($the_row != null)
		{
			// $q2 = "SELECT * FROM products WHERE id='" . $products_id . "' ORDER BY created_at DESC LIMIT 1";
			// $query2 = $this->db->query($q2);
			$q2 = "SELECT * FROM products WHERE id = ? ORDER BY created_at DESC LIMIT 1";
			$query2 = $this->db->query($q2, array($products_id));
			$next_row = $query2->row_array();
			if ($next_row['digital_bool'] == 'TRUE')
			{
				return TRUE;
			}
			else 
			{
				return FALSE; 	// because it is a physical good
			}
		}
		else
		{
			return FALSE;
		}
	}

	function get_a_product_($posts_id)
	{
		$this->load->database();
		$q1 = "SELECT * FROM products WHERE id = ?";
		$query = $this->db->query($q1, array($posts_id));
		return $query;
	}

	function get_user_purchase_list($uid, $posts_id)
	{
		$this->load->database();
		$q10 = "SELECT * FROM sales INNER JOIN products ON sales.products_id=products.id WHERE sales.users_id = ? AND sales.products_id = ?";
		$query0 = $this->db->query($q10, array($uid, $posts_id));
		return $query0;
	}

	function get_all_products_desc()
	{
		$this->load->database();
		$q0 = "SELECT * FROM products ORDER BY id DESC";
		$query0 = $this->db->query($q0);
		return $query0;
	}

	function get_all_products_updated_desc()
	{
		$this->load->database();
		$q0 = "SELECT * FROM products ORDER BY updated_at DESC LIMIT 75";
		$query0 = $this->db->query($q0);
		return $query0;
	}

	function get_cart_of_user($uid)
	{
		$this->load->database();
		$q01 = "SELECT * FROM cart LEFT JOIN products on cart.products_id=products.id WHERE cart.users_id = ?";
		$query01 = $this->db->query($q01, array($uid));
		return $query01;
	}

	function get_a_certain_product($products_id)
	{
		$this->load->database();
		$q2 = "SELECT * FROM products WHERE id = ?";
		$query02 = $this->db->query($q2, array($products_id));
		return $query02;
	}

	function get_cart_data($uid)
	{
		$this->load->database();
		$q01 = "SELECT * FROM cart LEFT JOIN products on cart.products_id=products.id WHERE cart.users_id = ?";
		$query01 = $this->db->query($q01, array($uid));
		return $query01;
	}

	function get_checkout_page_cart_data($uid)	//	same as get_cart_data so should be deprecated
	{
		$this->load->database();
		$q01 = "SELECT * FROM cart LEFT JOIN products on cart.products_id=products.id WHERE cart.users_id = ?";
		$query01 = $this->db->query($q01, array($uid));
		return $query01;
	}

	function get_the_sales_data($uid)
	{
		$this->load->database();
		$q01 = "SELECT * FROM sales LEFT JOIN products on sales.products_id=products.id WHERE sales.users_id = ? ORDER BY sales.id DESC";
		$query01 = $this->db->query($q01, array($uid));
		return $query01;
	}

}
