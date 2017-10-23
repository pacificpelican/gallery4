<?php 
class Photo extends CI_Model  
//	This file should be named Photo.php (first letter capitalized)
{
	//	Photo model for LoveBird created by Dan McKeown http://danmckeown.info -->
	//	copyright 2016 -->

function uploadGalleryImage($value, $eachCount, $eXT, $newGalleryName, $uid, $customer, $messageTo, $g_id)
	{	//	This method uploads a photo and creates a DB entry, it was created to service the Gallerys controller
		$postdata = array();
		if ($value['type'] === 'image/jpeg')
			{
				$eXT = ".jpg";
			}
			elseif ($value['type'] === 'image/png') {
				$eXT = ".png";
			}
			elseif ($value['type'] === 'image/gif') {
				$eXT = ".gif";
			}
			elseif ($value['type'] === 'image/webp') {
				$eXT = ".webp";
			}
			else
			{
				// do nothing
			}

			if ($eXT !== null)
			{
				$new_rand = mt_rand(1, 10000);
			//	$double_rand = password_hash($new_rand, PASSWORD_BCRYPT);
				$double_rand = "-";	//	This disables the adding of an arbitrary long hash to the full size image
				if ($eachCount > 0)
				{
					$realCount = $eachCount + 1;
					$value['name'] = $newGalleryName . $realCount . $double_rand . $eXT;
					$value['thumbnail_name'] = $newGalleryName . $realCount . $eXT;
				}
				else
				{
					$value['name'] = $newGalleryName . $double_rand . $eXT;
					$value['thumbnail_name'] = $newGalleryName . $eXT;
				}
			}
			
			$eachCount++;

			$_FILES['userfiles'] = $value;

			if ($this->upload->do_upload('userfiles')) 
			{
            	$data = array('upload_data' => $this->upload->data());

            	if (!(isset($g_id)))
            	{
            		$g_id = 0;
            	}

				$file_name = $data['upload_data']['file_name'];
				$file_url = $data['upload_data']['full_path'];
				$image_status = $data['upload_data']['is_image'];
				$file_ext = $data['upload_data']['file_ext'];
				$file_type = $data['upload_data']['file_type'];

				$this->load->helper('date');
				$newdate = now('America/Los_Angeles');
				$z = date("Y-m-d H:i:s");

				$postdata['created_at'] = $z;
				$postdata['updated_at'] = $z;

				$postdata['file_url'] = $file_url;
				$postdata['file_name'] = $file_name;
				$postdata['is_image'] = $image_status;
				$postdata['extension'] = $file_ext;
				$postdata['file_type'] = $file_ext;

				$postdata['thumbnail_name'] = $value['thumbnail_name'];

				$postdata['users_id'] = $uid;
				$postdata['customers_id'] = $customer;
				$postdata['gallerys_id'] = $g_id;

				if ($eachCount === 1) 
				{
					$postdata['photo_title'] = $newGalleryName;
				}
				else
				{
					$postdata['photo_title'] = $newGalleryName . " " . $eachCount;
				}

				$this->load->database();
				$WriteNewUserFile = $this->db->insert('photos', $postdata);

				$base_url = GALLERYS_FILE_URL . $file_name;
				$super_file_url = "<a href='" . $base_url . "'>" . $file_url . "</a>";

				$configURL = "." . $base_url;

				$messageTo = $messageTo . "<br /> FILE UPLOADED TO $super_file_url";
        	}
        	else 
        	{
        		$error = array('error' => $this->upload->display_errors());
		
				$elError = $error['error'];
				$this->session->set_flashdata("info", "ERROR: $elError");
				$this->load->helper('url');
				redirect('/gallerys/upload', 'refresh');
       		}
    return $messageTo;
}

function uploadPreviewImage($value, $eachCount, $eXT, $newGalleryName, $uid, $customer, $messageTo)
{	//	This method uploads a watermarked minified photo, it was created to service the Gallerys controller
	$postdata = array();
	if ($value['type'] === 'image/jpeg')
		{
			$eXT = ".jpg";
		}
		elseif ($value['type'] === 'image/png') {
			$eXT = ".png";
		}
		elseif ($value['type'] === 'image/gif') {
			$eXT = ".gif";
		}
		elseif ($value['type'] === 'image/webp') {
			$eXT = ".webp";
		}
		else
		{
			// do nothing
		}

		if ($eXT !== null)
		{
			if ($eachCount > 0)
			{
				$realCount = $eachCount + 1;
				$value['name'] = $newGalleryName . $realCount . $eXT;
			}
			else
			{
				$value['name'] = $newGalleryName . $eXT;
			}

			$file_name = $value['name'];
		}
		
		$eachCount++;

		$_FILES['userfiles'] = $value;

		if ($this->upload->do_upload('userfiles')) 
		{
			$data = array('upload_data' => $this->upload->data());

			 $base_url = GALLERYS_FILE_URL . $file_name;
			 $super_file_url = "<a href='" . $base_url . "'>" . $file_name . "</a>";

			 $configURL = "." . $base_url;

        	$the_thumbnail_name = $value['name'];

			// $config['source_image'] = $configURL;
			// $config['maintain_ratio'] = TRUE;
			// // $config['width'] = 600;	//	These images should be full-size, w/watermark, w/this disabled
			// // $config['height']= 400;
			// $this->load->library('image_lib');
			// $this->image_lib->initialize($config);
			// $this->image_lib->resize();

			// $resizeErrors = $this->image_lib->display_errors();
			// $messageTo = $messageTo . " <span>$resizeErrors</span>";

			if (file_exists(WATERMARK_IMAGE_URL))
			{	//   This is for the watermarking
				$config['source_image'] = $configURL;

				$config['wm_type'] = 'overlay';

				$config['wm_overlay_path'] = WATERMARK_IMAGE_URL;
				$config['wm_vrt_alignment'] = WATERMARK_POSITION_VERTICAL;
				$config['wm_hor_alignment'] = WATERMARK_POSITION_HORIZONTAL;

				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->watermark();

				$waterErrors = $this->image_lib->display_errors();
				$messageTo = $messageTo . " <span>$waterErrors</span>";

				$messageTo = $messageTo . "<br /> Watermarked version UPLOADED: $the_thumbnail_name";
			}
    	} 
    	else 
    	{
    		$error = array('error' => $this->upload->display_errors());
	
			$elError = $error['error'];
			$this->session->set_flashdata("info", "ERROR: $elError");
			$this->load->helper('url');
			redirect('/gallerys/upload', 'refresh');
   		}
    return $messageTo;
}

function getPhotoData($id_photo)
{
	$this->load->database();

	$q0 = "SELECT * FROM photos WHERE id = ?";
	$query01 = $this->db->query($q0, array($id_photo));

	return $query01;
}

function isThisPhotoOwnedByThisUser($photos_id, $users_id) 
{
	$this->load->database();
	$q0 = "SELECT * FROM photos_purchases INNER JOIN photos on photos_purchases.users_id=photos.customers_id WHERE photos_purchases.photos_id= ? AND photos.customers_id= ?";
	$query01 = $this->db->query($q0, array($photos_id, $users_id));

	return $query01;
}

function isThisPhotoInThisUsersCart($photos_id, $users_id)
{
	$this->load->database();

	$q0 = "SELECT * FROM photos_cart INNER JOIN photos on photos_cart.users_id=photos.customers_id WHERE photos_cart.photos_id= ? AND photos.customers_id= ?";
	$query01 = $this->db->query($q0, array($photos_id, $users_id));

	return $query01;
}

function addNewPhotoToPhotoCart($postdata)
{
	$this->load->database();
	//	todo: add created_at and updated_at to $postdata here
	$WriteNewUserFile = $this->db->insert('photos_cart', $postdata);

	if (($WriteNewUserFile !== FALSE) && ($WriteNewUserFile !== null))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function removePhotoFromPhotoCart($postdata)
{
	$this->load->database();
	//	todo: add created_at and updated_at to $postdata here
	$RemoveUserFile = $this->db->delete('photos_cart', $postdata);

	if (($RemoveUserFile !== FALSE) && ($RemoveUserFile !== null))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function makeStringURL_safe_ish($gallery_name)
{
	$newGalleryName0 = str_replace(" ", "-", $gallery_name);
	$newGalleryName = str_replace(",", "-", $newGalleryName0);
	$newGalleryName = str_replace("?", "-", $newGalleryName);
	$newGalleryName = str_replace("@", "-", $newGalleryName);
	$newGalleryName = str_replace("$", "-", $newGalleryName);
	$newGalleryName = str_replace(":", "-", $newGalleryName);
	$newGalleryName = str_replace("/", "-", $newGalleryName);
	$newGalleryName = str_replace("=", "-", $newGalleryName);
	$newGalleryName = str_replace("+", "-", $newGalleryName);
	$newGalleryName = str_replace(";", "-", $newGalleryName);
	$newGalleryName = str_replace("&", "-", $newGalleryName);
	$newGalleryName = str_replace("*", "-", $newGalleryName);
	$newGalleryName = str_replace("%", "-", $newGalleryName);

	return $newGalleryName;
}

function get_users_photo_credits($users_id)
{
	$this->load->database();
	$q0 = "SELECT * FROM photos_credits WHERE users_id= ?";
	$query01 = $this->db->query($q0, array($users_id));

	foreach ($query01->result() as $row)
	{
		$retVal = $row;
	}
	if (!(isset($retVal)))
	{
		$retVal = null;
	}

	return $retVal;
}

function processPhotoPurchaseItems($uid, $credits_used)
{
	$this->load->database();

	$q1 = "SELECT * FROM photos_credits WHERE users_id= ?";
	$query02 = $this->db->query($q1, array($uid));
	foreach ($query02->result() as $row)
	{
		$old_credits = $row->credits;
		$new_credits = $old_credits - $credits_used;
		$row->credits = $new_credits;
		
		$r_id = $row->id;
	
		$this->db->where('users_id', $uid);
		$this->db->update('photos_credits', $row);
	}

	$q0 = "SELECT * FROM photos_cart WHERE users_id= ?";
	$query01 = $this->db->query($q0, array($uid));

	foreach ($query01->result() as $row)
	{
		$retVal = $row;
		$WriteNewUserPurchase = $this->db->insert('photos_purchases', $retVal);
		$del_id = $retVal->id;
		$RemoveCartRow = $this->db->delete('photos_cart', array('id' => $del_id));
	}

	if (!(isset($retVal)))
	{
		$retVal = null;
		return $retVal;
	}
	else
	{
		if (($WriteNewUserPurchase !== null) && ($RemoveCartRow !== null))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

function processPhotosOrder($orderData) {
	$didItInsert = $this->db->insert('photos_orders', $orderData);
	if (($didItInsert != null) && ($didItInsert != FALSE))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function get_available_appointments()
{
	$this->load->database();
	$q0 = "SELECT * FROM appointments";
	$query01 = $this->db->query($q0);

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;

		$the_id = $row['id'];
		$q00 = "SELECT * FROM appointments INNER JOIN bookings ON appointments.id=bookings.appointments_id WHERE appointments.id= ?";
		$query00 = $this->db->query($q00, array($the_id));

		$innerCounter = 0;

		foreach ($query00->result_array() as $rowrow)
		{
			$pass = $counter + 1;

			$row_val = intval($rowrow['appointments_id']);
			$id_val = intval($the_id);

			$counter--;
			unset($retVal[$counter]);
		}
	}

	return $retVal;
}

function get_all_appointments()
{
	$this->load->database();
	$q0 = "SELECT * FROM appointments";
	$query01 = $this->db->query($q0);

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	return $retVal;
}

function addNewAppointment($postdata)
{
	$didItInsert = $this->db->insert('appointments', $postdata);
	if (($didItInsert != null) && ($didItInsert != FALSE))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function deleteAppointment($del_id)
{
	$this->load->database();
	//	todo: add created_at and updated_at to $postdata here
	$RemoveUserFile = $this->db->delete('appointments', array('id' => $del_id));

	if (($RemoveUserFile !== FALSE) && ($RemoveUserFile !== null))
	{
		return TRUE;
	}
	else
	{
		return NULL;
	}

}

function isAppointmentAvailable($req_id)
{
	$this->load->database();

	$q0 = "SELECT * FROM appointments WHERE id=?";
	$query01 = $this->db->query($q0, array($req_id));

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	if (empty($retVal))
	{
		return NULL;
	}
	else
	{
		return TRUE;
	}
}

function get_all_packages()
{
	$this->load->database();
	$q0 = "SELECT * FROM photos_packages";
	$query01 = $this->db->query($q0);

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	return $retVal;
}

function addNewPackage($postdata)
{
	$didItInsert = $this->db->insert('photos_packages', $postdata);
	if (($didItInsert != null) && ($didItInsert != FALSE))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function get_price_of_package($package_requested)
{
	$this->load->database();

	$q0 = "SELECT price FROM photos_packages WHERE id=?";
	$query01 = $this->db->query($q0, array($package_requested));

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	$retValFinal = $retVal[0]['price'];

	return $retValFinal;
}

function get_package_info($package_requested)
{
	$this->load->database();

	$q0 = "SELECT * FROM photos_packages WHERE id=?";
	$query01 = $this->db->query($q0, array($package_requested));

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	$retValFinal = $retVal[0];

	return $retValFinal;
}

function deletePackage($del_id)
{
	$this->load->database();
	$Removepack = $this->db->delete('photos_packages', array('id' => $del_id));

	if (($Removepack !== FALSE) && ($Removepack !== null))
	{
		return TRUE;
	}
	else
	{
		return NULL;
	}
}

function writeBooking($bookingData)
{
	$this->load->database();
	
	$didItInsert = $this->db->insert('bookings', $bookingData);
	if (($didItInsert != null) && ($didItInsert != FALSE))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function get_appointment_info($package_requested)
{
	$this->load->database();

	$q0 = "SELECT * FROM appointments WHERE id=?";
	$query01 = $this->db->query($q0, array($package_requested));

	$counter = 0;
	$retVal = array();

	foreach ($query01->result_array() as $row)
	{
		$retVal[$counter] = $row;
		$counter++;
	}

	$retValFinal = $retVal[0];

	return $retValFinal;
}

}
