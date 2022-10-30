<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Razorpay\Api\Api;
USE Aws\S3\S3Client;
USE Twilio\Rest\Client;
require APPPATH . '/libraries/razorpayli/autoload.php';

class HandOn extends CI_Controller {
 public function __construct(){
	 parent::__construct();
	 error_reporting(0);
	 $this->load->model('api/Common_Model');
	 $this->load->model('api/User_model');
	 date_default_timezone_set('Asia/Kolkata');

 }

 public function loginPhone()
  {
    $this->db->delete('user_otp', array('phone' => $this->input->post('phone')));
    $data['phone'] = $this->input->post('phone');
    $otp = rand(1000,9999);
    $data['loginOtp'] = $otp;
    $insert = $this->db->insert('user_otp', $data);
    if (!empty($insert)) {
      $message['success'] = '1';
      $message['message'] = 'OTP sent on your phone number';
      $message['otp'] = (string)$otp;
    } else {
      $message['success'] = '0';
      $message['message'] = 'Please try after some time';
    }
    echo json_encode($message);
  }


  public function loginRegisterUser()
  {
    $checkOTP = $this->db->get_where('user_otp', array('phone' => $this->input->post('phone'), 'loginOtp' => $this->input->post('otp')))->row_array();
    if (!empty($checkOTP)) {
      $checkUser = $this->db->get_where('users', array('phone' => $this->input->post('phone')))->row_array();
      if (!empty($checkUser)) {
        $message['success'] = '1';
        $message['message'] = 'User login successully';
        $message['details'] = $checkUser;
      } else {
             $data['deviceId'] = $this->input->post('deviceId') ?? "";
             $data['phone'] = $this->input->post('phone');
             $data['reg_id'] = $this->input->post('reg_id') ?? "";
             $data['username'] = '@'.rand(100000000,999999999);
             $data['device_type'] = $this->input->post('device_type') ?? "";
             $data['created'] = date('Y-m-d H:i:s');
            $insert = $this->db->insert('users', $data);
        if (!empty($insert)) {
          $lastId = $this->db->insert_id();
          $userInfo = $this->db->get_where('users', array('id' => $lastId))->row_array();
          $message['success'] = '1';
          $message['message'] = 'User login successully';
          $message['details'] = $userInfo;
        } else {
          $message['success'] = '0';
          $message['message'] = 'Please try after some time';
        }
      }
    } else {
      $message['success'] = '0';
      $message['message'] = 'Invalid OTP, Please enter valid OTP';
    }
    echo json_encode($message);
  }

  public function usersLogout(){
      if($this->input->post()){
        $data['reg_id'] = '';
    	  $update = $this->db->update('users', $data, array('id' => $this->input->post('userId')));
    		if(!empty($update)){
    			 $message = array(
    			 'success' => '1',
    			 'message' => 'user logout successfully'
                    );
    		}
    		}else{
    			$message = array(
    				'success' => '0',
    				'message' => 'Please enter parameters'
    			);
    		}
    				 echo json_encode($message);
    	}


    public function updateUserProfile()
	{
		if ($this->input->post()) {
		    $userId = $this->input->post('id');

		    $checkId = $this->db->get_where("users",['id' =>$userId])->row_array();
		    if(!!$checkId){

			if (!empty($this->input->post('name'))) {
                $data['name'] = $this->input->post('name');
            }
            if (!empty($this->input->post('gender'))) {
                $data['gender'] = $this->input->post('gender');
            }
            if (!empty($this->input->post('dob'))) {
                $data['dob'] = $this->input->post('dob');
            }
            if (!empty($this->input->post('latitude'))) {
                $data['latitude'] = $this->input->post('latitude');
            }
            if (!empty($this->input->post('longitude'))) {
                $data['longitude'] = $this->input->post('longitude');
            }
			$data['updated'] = date("Y-m-d H:i:s");

			if (!empty($_FILES["image"]["name"])) {
				$name1= time().'_'.$_FILES["image"]["name"];
				$name= str_replace(' ', '_', $name1);
				$liciense_tmp_name=$_FILES["image"]["tmp_name"];
				$error=$_FILES["image"]["error"];
				$liciense_path='uploads/products/'.$name;
				move_uploaded_file($liciense_tmp_name,$liciense_path);
				$data['image'] = $liciense_path;
			}

			$update = $this->db->update('users', $data,array('id' => $userId));

			if (!empty($update)) {

				$details = $this->db->get_where('users', array('id' => $userId))->row_array();
				if (!empty($details['image'])) {
					$details['image'] = base_url().$details['image'];
				}
				$message = array(
					'success' => '1',
					'message' => 'Profile updated succssfully!',
					'details' => $details
				);
			}
		    }
		    else {
			$message = array(
				'success' => '0',
				'message' => 'Please enter valid id!',
			);
		}
		} else {
			$message = array(
				'success' => '0',
				'message' => 'Please enter valid parameters!',
			);
		}
		echo json_encode($message);
	}


  









}
