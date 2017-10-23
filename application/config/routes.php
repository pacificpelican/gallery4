<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//	$route['default_controller'] = 'users/front_look';
$route['default_controller'] = 'flickrs/photostream_index';
$route['status'] = 'welcome/status';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'users/login_look';
$route['process/login'] = 'users/check_login_input';
$route['process/register'] = 'users/check_reg_input';
$route['logout'] = 'users/log_out_session';
$route['account'] = 'accounts/edit';
$route['process/editlogin'] = 'accounts/check_acct_change_input';
$route['process/editpass'] = 'accounts/edit_pw';
$route['process/blog/post'] = 'blogs/process_blog_post';
$route['blogs/write'] = 'blogs/create_blog_post';
$route['write'] = 'blogs/create_blog_post';
$route['blogs/create'] = 'blogs/create_blog_post';
$route['blogs/(:num)'] = 'blogs/blog_post/$1';
$route['post/(:any)'] = 'blogs/blog_post/$1';
$route['blog/(:num)'] = 'blogs/blog_post/$1';
$route['post/(:num)/edit'] = 'blogs/edit_blog_post/$1';
$route['blogs/post/(:num)'] = 'blogs/blog_post/$1';
$route['blogs/edit/(:num)'] = 'blogs/edit_blog_post/$1';
$route['blogs/(:num)/edit'] = 'blogs/edit_blog_post/$1';
$route['blogs/post/(:num)/edit'] = 'blogs/edit_blog_post/$1';
$route['process/blog/edit'] = 'blogs/edit_blog_process';
$route['blogs'] = 'blogs/blogs_index';
$route['post'] = 'blogs/blogs_index';
$route['blog'] = 'blogs/blogs_index';
$route['posts'] = 'blogs/blogs_index';
$route['edit/posts'] = 'blogs/user_edit_page';
$route['edit/process/post/delete/(:num)'] = 'blogs/delete_post_process/$1';
$route['feed'] = 'blogs/blogs_rss';		//	WordPress style RSS link
$route['rss'] = 'blogs/blogs_rss';		//	Tumblr style RSS link
$route['rss2'] = 'blogs/blogs_rss';		//	WordPress style #2 RSS link
$route['rss.xml'] = 'blogs/blogs_rss';
$route['.rss'] = 'blogs/blogs_rss';		//	Reddit style RSS link
$route['blog/feed'] = 'blogs/blogs_rss';
$route['blog/rss'] = 'blogs/blogs_rss';
$route['blog/rss2'] = 'blogs/blogs_rss';
$route['blog/rss.xml'] = 'blogs/blogs_rss';
$route['blog/.rss'] = 'blogs/blogs_rss';
$route['privacy'] = 'accounts/privacy_policy_view';
$route['terms'] = 'accounts/terms';
$route['files/upload'] = 'dropboxs/add_file';
$route['upload'] = 'dropboxs/add_file';
$route['process/upload'] = 'dropboxs/process_upload';
$route['files'] = 'dropboxs/files_index';
$route['blog/edit'] = 'blogs/user_edit_page';
$route['blog/admin'] = 'blogs/user_edit_page';
$route['account/admin'] = 'accounts/edit';
$route['admin/account'] = 'accounts/edit';
$route['account/edit'] = 'accounts/edit';
$route['kill/file/(:any)'] = 'dropboxs/kill_file/$1';
$route['support'] = 'pays/to_buy_process';
$route['front'] = 'pages/front_page';
$route['public_timeline'] = 'chats/chats_timeline';
$route['help'] = 'accounts/help_page';
$route['timeline/manage'] = 'chats/user_edit_timeline_page';
$route['process/public/user/chat/kill/(:num)'] = 'chats/kill_public_chat_of_user/$1';
$route['blog/search'] = 'searchs/blog_search_index';
$route['process/blog/search'] = 'searchs/process_blog_search';
$route['404_override'] = 'pages/four_o_four_page';
$route['timeline/post/(:num)'] = 'chats/post_view/$1';
$route['process/page/post'] = 'pages/process_blog_post';
$route['pages/create'] = 'pages/create_new_page';
$route['page/create'] = 'pages/create_new_page';
$route['create/page'] = 'pages/create_new_page';
$route['create/pages'] = 'pages/create_new_page';
$route['write/pages'] = 'pages/create_new_page';
$route['write/page'] = 'pages/create_new_page';
$route['page/(:any)'] = 'pages/blog_post/$1';
$route['edit/pages'] = 'pages/user_edit_page';
$route['pages/edit'] = 'pages/user_edit_page';
$route['process/page/delete/(:num)'] = 'pages/delete_post_process/$1';
$route['page/(:any)/edit'] = 'pages/edit_blog_post/$1';
$route['process/page/edit'] = 'pages/edit_blog_process';
$route['write/post'] = 'blogs/create_blog_post';
$route['gallerys/files/upload'] = 'gallerys/add_file';
$route['gallerys/upload'] = 'gallerys/add_file';
$route['process/gallerys/upload'] = 'gallerys/process_upload';
$route['gallerys/files'] = 'gallerys/files_index';
$route['gallerys/kill/file/(:any)'] = 'gallerys/kill_file/$1';
$route['blindfire/files/upload'] = 'flickrs/add_file';
$route['blindfire/upload'] = 'flickrs/add_file';
$route['process/flickrs/upload'] = 'flickrs/process_upload';
$route['blindfire/files'] = 'flickrs/files_index';
$route['flickrs/kill/file/(:any)'] = 'flickrs/kill_file/$1';
$route['flickr'] = 'flickrs/add_file';
$route['album'] = 'flickrs/files_index';
$route['image/(:any)'] = 'flickrs/image_view/$1';
$route['image/(:any)/JSON'] = 'flickrs/image_view_json/$1';
$route['add/photocart/(:num)'] = 'gallerys/add_to_cart_process/$1';
$route['myphotos'] = 'gallerys/myphotos';
$route['remove/photocart/(:num)'] = 'gallerys/remove_from_cart_process/$1';
$route['myphotos/cart'] = 'gallerys/view_photo_cart';
$route['photocart'] = 'gallerys/view_photo_cart';
$route['photocheckout'] = 'gallerys/photo_checkout';
$route['process/buyphoto'] = 'gallerys/photo_checkout_process';
$route['process/freephotos'] = 'gallerys/free_photo_checkout_process';
$route['process/gallerys/booking'] = 'gallerys/process_booking_request';
$route['photos/packages/create'] = 'gallerys/create_package';
$route['photos/packages'] = 'gallerys/list_packages';
$route['packages/create'] = 'gallerys/create_package';
$route['packages'] = 'gallerys/list_packages';
$route['process/packages/create'] = 'gallerys/process_package';
$route['myphotos/signup/cart/(:num)/(:num)'] = 'gallerys/photos_signup_cart/$1/$2';
$route['process/gallerys/cart'] = 'gallerys/photos_cart_process';
$route['photos/package/checkout'] = 'gallerys/photos_signup_checkout';
$route['process/package/checkout'] = 'gallerys/process_appointment_checkout';
$route['process/packages/delete/(:num)'] = 'gallerys/process_delete_package/$1';
$route['photostream'] = 'flickrs/photostream_index';
$route['gallery4'] = 'gallerys/photos_front';
$route['admin'] = 'accounts/edit';
