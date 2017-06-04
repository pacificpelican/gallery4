<?php
class Searchs extends CI_Controller
{
	//	Searchs controller for lovebirdsconsulting.com web app by Dan McKeown http://danmckeown.info -->
	//	copyright 2016  -->
public function store_search_index()
{
	$pagedata = array(
	       		'title' => SITE_NAME . " store search",
	            'site' => SITE_NAME
	        );
	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view');
	$this->load->view('header_link_flash_view');
	$this->load->view('stores_search_view');
	$this->load->view('store_sidebar_view');
	$this->load->view('site_footer');
}
public function process_search()
{
	$postdata = $this->input->post();
	$s_query = $postdata['store_search'];

	if ($s_query === "")
	{
		$this->session->set_flashdata("info", "a search for nothing is like a search for everything &#x1F426");
		$this->load->helper('url');
		redirect("/store", "refresh");
	}

	$this->load->database();

	// $q1 = "select * from products WHERE product LIKE '%" . $s_query  . "%' or description LIKE '%" . $s_query  . "%'";
	// $query = $this->db->query($q1);

	$query = $this->db->select('*')->from('products')
	    ->like('product', $s_query)
	    ->or_like('description', $s_query)
	    ->get();

	$resultSet = array();
	$c = 0;

	foreach ($query->result() as $row)
	{
		$product = array();
		$product['name'] = $row->product;
		$product['id']= $row->id;
		$resultSet[$c] = $product;
 		$c++;
	}

	$pagedata = array(
	       		'title' => SITE_NAME . " store search results",
	            'resultSet' => $resultSet
	        );

	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view');
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('stores_search_results_view', $pagedata);
	$this->load->view('store_sidebar_view');
	$this->load->view('site_footer', $pagedata);
}

public function blog_search_index()
{
	$pagedata = array(
	       		'title' => SITE_NAME . " blog search",
	            'site' => SITE_NAME
	        );
	$this->load->view('site_head_foundation', $pagedata);
	$this->load->view('nav_foundation_view');
	$this->load->view('header_link_flash_view');
	$this->load->view('blogs_search_view');
	$this->load->view('store_sidebar_view');
	$this->load->view('site_footer');
}
public function process_blog_search()
{
	$postdata = $this->input->post();
	$s_query = $postdata['blog_search'];

	if ($s_query === "")
	{
		$this->session->set_flashdata("info", "a search for nothing is like a search for everything &#x1f439;");
		$this->load->helper('url');
		redirect("/blog", "refresh");
	}

	$this->load->database();

	// $q1 = "select * from users_posts INNER JOIN posts on users_posts.posts_id=posts.id WHERE title LIKE '%" . $s_query  . "%' or post LIKE '%" . $s_query  . "%'";
	// $query = $this->db->query($q1);

	$query = $this->db->select('*')->from('users_posts')
		->join('posts', 'users_posts.posts_id = posts.id', 'inner')
	    ->like('title', $s_query)
	    ->or_like('post', $s_query)
	    ->get();

	$resultSet = array();
	$c = 0;

	foreach ($query->result() as $row)
	{
	//	var_dump($row);
		$product = array();
		$product['name'] = $row->title;
		$product['id']= $row->id;
		$resultSet[$c] = $product;
 		$c++;
	}

	$pagedata = array(
	       		'title' => SITE_NAME . " blog search results",
	            'resultSet' => $resultSet
	        );

	$this->load->view('site_head', $pagedata);
	$this->load->view('nav_bootstrap_view', $pagedata);
	$this->load->view('header_link_flash_view', $pagedata);
	$this->load->view('blog_search_results_view', $pagedata);
	$this->load->view('store_sidebar_view');
	$this->load->view('site_footer', $pagedata);
}

}
