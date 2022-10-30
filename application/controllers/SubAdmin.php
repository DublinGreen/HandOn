<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class SubAdmin extends CI_Controller {



	public function __construct(){

		parent::__construct();

		error_reporting(0);

		$this->load->model('admin/Admin_model');

		$this->load->model('admin/Common_model');
		date_default_timezone_set('Asia/Kolkata');
		if(!$this->session->userdata('admin_details')){

			redirect( site_url() . "/admin/login");

			exit;

		}

	}


	public function manage(){
		$config["base_url"] = site_url()."/SubAdmin/manage";
		//$coutData = $this->db->from("subAdmin")->count_all_results();
		$coutData = $this->db->get_where("admin",array('role' => 1))->num_rows();
	    $config["total_rows"] = $coutData;
	    $config["per_page"] = 10;
	    $config["uri_segment"] = 3;
	    $config['num_links'] = 2;
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	    $config['full_tag_open'] = "<ul class='pagination pull-right'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next <i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $this->pagination->initialize($config);
	    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
	    $npage =  ($page-1)*10;
	    $data["links"] = $this->pagination->create_links();
	    $p = $config["per_page"];

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		// $data['details'] = $this->db->query("select subAdminCoins.coins , admin.* from admin left join subAdminCoins on subAdminCoins.subadminId = admin.id where admin.role = 1 order by id desc limit $npage,$p")->result_array();
        // $data['details'] = $this->db->query("select * from admin where role = 1 order by id desc")->result_array();
        $data['details'] = $this->db->query("select * from admin where assignRole = 'SUBADMIN' order by id desc")->result_array();

		$data['active'] = 'subAdmin';

		$data['title'] = 'Manage Sub Admin';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/subAdmin/manage');

		$this->load->view('admin/includes/footer');

	}


	public function coinsHistory(){
		$config["base_url"] = site_url()."/SubAdmin/coinsHistory";
		//$coutData = $this->db->from("subAdmin")->count_all_results();
		$coutData = $this->db->get_where('subAdminCoins')->num_rows();
			$config["total_rows"] = $coutData;
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = "<ul class='pagination pull-right'>";
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next <i class="fa fa-long-arrow-right"></i>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
			$npage =  ($page-1)*10;
			$data["links"] = $this->pagination->create_links();
			$p = $config["per_page"];

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		// $data['details'] = $this->db->query("select subAdminCoins.coins , admin.* from admin left join subAdminCoins on subAdminCoins.subadminId = admin.id where admin.role = 1 order by id desc limit $npage,$p")->result_array();
		$data['details'] = $this->db->query("select admin.name , subAdminCoins.* from subAdminCoins left join admin on subAdminCoins.subadminId = admin.id  order by id desc")->result_array();

		$data['active'] = 'subAdminCoinHistory';

		$data['title'] = 'Sub Admin Coin History';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/subAdmin/coinsHistory');

		$this->load->view('admin/includes/footer');

	}



	public function sendCoinsSubadmin(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
	  $data['admin1'] = $this->db->get_where('admin',array('role' => 1, 'assignRole' => 'OFFLINE PAYMENT MANAGEMENT'))->result_array();
		$data['active'] = 'addSubadminCoins';
		$data['title'] = "Send Coins";
		if($this->input->post()){

				if($this->input->post('subadmin12') == 1){
					 $this->form_validation->set_rules('subadmin','Sub Admin','trim|required');
					 $this->form_validation->set_rules('coins','Coins','trim|required');

					 if($this->form_validation->run() == FALSE){
						 $this->load->view('admin/includes/header',$data);
							$this->load->view('admin/subAdmin/sendCoins');
							$this->load->view('admin/includes/footer');
					 }
         else{
						$details['subadminId'] = $this->input->post('subadmin');
						$subAdminCoins = $this->db->select('admin.totalCoins')->get_where('admin',array('id' => $this->input->post('subadmin')))->row_array();
						$data12['totalCoins'] = $subAdminCoins['totalCoins'] + $this->input->post('coins');
						$updateSubadminCoins = $this->db->update('admin',$data12 ,array('id' => $this->input->post('subadmin')));

						$details['coins'] = $this->input->post('coins');
						$details['created'] = date('Y-m-d H:i:s');
						$insert = $this->Common_model->insert_data($details,'subAdminCoins');

						if($insert){
							$this->session->set_flashdata('success', "Coins  added Successfully");
							redirect(site_url().'/subAdmin/coinsHistory');
						  }
						}
					}
					else{
						$this->form_validation->set_rules('username','Username','trim|required');
						$this->form_validation->set_rules('price','Price','trim|required');
 					  $this->form_validation->set_rules('coins1','Coins','trim|required');
						$this->form_validation->set_rules('transactionId','Transaction Id','trim|required');
						$this->form_validation->set_rules('orderId','Order Id ','trim|required');
						$this->form_validation->set_rules('paymentType','Payment Type','trim|required');
						if($this->form_validation->run() == FALSE){
							 $this->load->view('admin/includes/header',$data);
							 $this->load->view('admin/subAdmin/sendCoins');
							 $this->load->view('admin/includes/footer');
						}
						else{

								$userDetails = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
						    $userId =	$userDetails['id'];
							  $data1['userId'] = $userDetails['id'];
								$data1['coinPrice'] = $this->input->post('price');
								$data1['type'] = 1;
								$data1['transactionId'] = $this->input->post('transactionId');
								$data1['orderId'] = $this->input->post('orderId');
								$data1['paymentType'] = $this->input->post('paymentType');
								$data1['coin'] = $this->input->post('coins1');
		            $data1['created'] = date('Y-m-d H:i:s');
								$coinDetails = $this->db->select('users.purchasedCoin')->get_where('users',array('id' => $userId))->row_array();

								if($coinDetails['purchasedCoin'] != 0){

			 					$deatails1['purchasedCoin'] = $coinDetails['purchasedCoin'] + $this->input->post('coins1');

			 				 }
			 				 else{
			 					  $deatails1['purchasedCoin'] = $this->input->post('coins1');
			 				 }

								$userCoinUpdate = $this->db->update('users',$deatails1,array('id' => $userId));
		            $insert1 = $this->db->insert('userCoinHistory',$data1);

								if($insert1){
									$this->session->set_flashdata('success', "Coins  added Successfully");
									redirect(site_url().'/Payment/subAdminCoinsHistory');
									}
						}
					}

		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/subAdmin/sendCoins');
			$this->load->view('admin/includes/footer');
		}
	}


	public function getResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
			$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
			$admin = $admin_details['admin_id'];
			if(!empty($end) && !empty($pname) && !empty($start)){
	           	$data=$this->db->query("SELECT * from subAdmin where created between '$start' and '$end' and username like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
	           	exit(json_encode($data));
	        }elseif(!empty($start) && !empty($end)){
	           	$data=$this->db->query("SELECT * from subAdmin where created between '$start' and '$end' order by id desc")->result_array();
	           	exit(json_encode($data));
	        }elseif(!empty($start) && !empty($pname)){
	           	$data=$this->db->query("SELECT * from subAdmin where created = '$start' and username like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
	           	exit(json_encode($data));
	        }elseif(!empty($end) && !empty($pname)){
	           	$data=$this->db->query("SELECT * from subAdmin where created = '$end' and username like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
	           	exit(json_encode($data));
	        }elseif(!empty($start)){
	           	$data=$this->db->query("SELECT * from subAdmin where created = '$start' order by id desc")->result_array();
	           	exit(json_encode($data));
	        }elseif(!empty($end)){
	            $data=$this->db->query("SELECT * from subAdmin where created = '$end' order by id desc")->result_array();
	            exit(json_encode($data));
	        }elseif(!empty($pname)){
	            $data=$this->db->query("SELECT * from subAdmin where username like'%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
	              exit(json_encode($data));
	        }else{
	        	$data=$this->db->query("SELECT * from subAdmin order by id desc")->result_array();
	            exit(json_encode($data));
	        }
    }

	public function addSubAdmin(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'addSubAdmin';

		$data['title'] = "Add Sub Admin";

		if($this->input->post()){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]');

			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_unique[admin.phone]');

			$this->form_validation->set_rules('assignRole', 'Assign Role', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');

			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){

				$this->form_validation->set_rules('image', 'Picture', 'required');

			}

			if($this->form_validation->run() == FALSE){

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/subAdmin/add');

				$this->load->view('admin/includes/footer');

			}else{

				$details['name'] = $this->input->post('username');

				$details['email'] = $this->input->post('email');

				$details['phone'] = $this->input->post('phone');

				$details['assignRole'] = $this->input->post('assignRole');

				$details['role'] = 1;

				$details['password'] = md5($this->input->post('password'));

				$details['status'] = "Approved";

				$details['created'] = date('Y-m-d H:i:s');
                $details['updated'] = date('Y-m-d H:i:s');

				if(!empty($_FILES["image"]["name"])){

					$name= time().'_'.$_FILES["image"]["name"];

					$liciense_tmp_name=$_FILES["image"]["tmp_name"];

					$error=$_FILES["image"]["error"];

					$liciense_path='uploads/users/'.$name;

					move_uploaded_file($liciense_tmp_name,$liciense_path);

					$details['image']= $liciense_path;

				}

				$insert = $this->Common_model->insert_data($details,'admin');
				
				$up = $this->db->insert($details,'admin');

				if($insert){

					$this->session->set_flashdata('success', "Sub Admin added Successfully");

					redirect(site_url().'/SubAdmin/manage');

				}

			}

		}else{

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/subAdmin/add');

			$this->load->view('admin/includes/footer');

		}

	}
	
	public function addAgency(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'addAgency';

		$data['title'] = "Add Agency";

		if($this->input->post()){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			
			$this->form_validation->set_rules('special_approval_name', 'SpecialApprovalName', 'trim|required');
			
			$this->form_validation->set_rules('deposit_amount', 'DepositAmount', 'trim|required');
			
			$this->form_validation->set_rules('bank_name', 'BankName', 'trim|required');
			
			$this->form_validation->set_rules('account_num', 'AccountNumber', 'trim|required');
			
			$this->form_validation->set_rules('IFCS_code', 'IFCSCode', 'trim|required');
			
			$this->form_validation->set_rules('payment_method', 'PaymentMethod', 'trim|required');
			
			$this->form_validation->set_rules('agencyCode', 'AgencyCode', 'trim|required');
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]');

			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_unique[admin.phone]');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');

			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){

				$this->form_validation->set_rules('image', 'Image', 'required');

			}
			
			if(empty($_FILES["aadharCardFront"]["name"]) || $_FILES["aadharCardFront"]["name"] == ""){

				$this->form_validation->set_rules('aadharCardFront', 'AadharCardFront', 'required');

			}
			
			if(empty($_FILES["panCardFrontPhoto"]["name"]) || $_FILES["panCardFrontPhoto"]["name"] == ""){

				$this->form_validation->set_rules('panCardFrontPhoto', 'PanCardFrontPhoto', 'required');

			}
			
			if(empty($_FILES["aadharCardBack"]["name"]) || $_FILES["aadharCardBack"]["name"] == ""){

				$this->form_validation->set_rules('aadharCardBack', 'AadharCardBack', 'required');

			}
			
			if(empty($_FILES["govt_photoId_proof"]["name"]) || $_FILES["govt_photoId_proof"]["name"] == ""){

				$this->form_validation->set_rules('govt_photoId_proof', 'Govt_photoId_proof', 'required');

			}

			if($this->form_validation->run() == FALSE){

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/subAdmin/addAgency');

				$this->load->view('admin/includes/footer');

			}else{

				$details['username'] = $this->input->post('username');

				$details['special_approval_name'] = $this->input->post('special_approval_name');

				$details['deposit_amount'] = $this->input->post('deposit_amount');
				
				$details['bank_name'] = $this->input->post('bank_name');
				
				$details['account_num'] = $this->input->post('account_num');
				
				$details['IFCS_code'] = $this->input->post('IFCS_code');
				
				$details['payment_method'] = $this->input->post('payment_method');
				
				$details['agencyCode'] = $this->input->post('agencyCode');
				
				$details['email'] = $this->input->post('email');
				
				$details['phone'] = $this->input->post('phone');

				$details['status'] = '0';

				$details['password'] = md5($this->input->post('password'));

				$details['created'] = date('Y-m-d H:i:s');
                $details['updated'] = date('Y-m-d H:i:s');

            	if(!empty($_FILES['aadharCardFront']['name'])){
                        $name1 = time().'_'.$_FILES["aadharCardFront"]["name"];
                        $name= str_replace(' ', '_', $name1);
                        $liciense_tmp_name=$_FILES["aadharCardFront"]["tmp_name"];
                        $error=$_FILES["aadharCardFront"]["error"];
                        $liciense_path='uploads/products/'.$name;
                        move_uploaded_file($liciense_tmp_name,$liciense_path);
                        $details['aadharCardFront']= $liciense_path;
                }
                  if(!empty($_FILES['panCardFrontPhoto']['name'])){
                        $name1 = time().'_'.$_FILES["panCardFrontPhoto"]["name"];
                        $name= str_replace(' ', '_', $name1);
                        $liciense_tmp_name=$_FILES["panCardFrontPhoto"]["tmp_name"];
                        $error=$_FILES["panCardFrontPhoto"]["error"];
                        $liciense_path='uploads/products/'.$name;
                        move_uploaded_file($liciense_tmp_name,$liciense_path);
                        $details['panCardFrontPhoto']= $liciense_path;
                  }
                  if(!empty($_FILES['aadharCardBack']['name'])){
                        $name1 = time().'_'.$_FILES["aadharCardBack"]["name"];
                        $name= str_replace(' ', '_', $name1);
                        $liciense_tmp_name=$_FILES["aadharCardBack"]["tmp_name"];
                        $error=$_FILES["aadharCardBack"]["error"];
                        $liciense_path='uploads/products/'.$name;
                        move_uploaded_file($liciense_tmp_name,$liciense_path);
                        $details['aadharCardBack']= $liciense_path;
                  }
                  if(!empty($_FILES['govt_photoId_proof']['name'])){
                        $name1 = time().'_'.$_FILES["govt_photoId_proof"]["name"];
                        $name= str_replace(' ', '_', $name1);
                        $liciense_tmp_name=$_FILES["govt_photoId_proof"]["tmp_name"];
                        $error=$_FILES["govt_photoId_proof"]["error"];
                        $liciense_path='uploads/products/'.$name;
                        move_uploaded_file($liciense_tmp_name,$liciense_path);
                        $details['govt_photoId_proof']= $liciense_path;
                  }
                  if(!empty($_FILES['image']['name'])){
                        $name1 = time().'_'.$_FILES["image"]["name"];
                        $name= str_replace(' ', '_', $name1);
                        $liciense_tmp_name=$_FILES["image"]["tmp_name"];
                        $error=$_FILES["image"]["error"];
                        $liciense_path='uploads/products/'.$name;
                        move_uploaded_file($liciense_tmp_name,$liciense_path);
                        $details['image']= $liciense_path;
                  }

				$insert = $this->Common_model->insert_data($details,'agencyDetails');

				if($insert){

					$this->session->set_flashdata('success', "Agency added Successfully");

				// 	redirect(site_url().'/SubAdmin/manage');
					redirect(site_url().'/SubAdmin/addAgency');

				}

			}

		}else{

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/subAdmin/addAgency');

			$this->load->view('admin/includes/footer');

		}

	}



	public function view(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'subAdmin';

		$data['title'] = "View Sub Admin";

		$data['details'] = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/subAdmin/view');

		$this->load->view('admin/includes/footer');

	}

	public function updatePassword(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'subAdmin';

		$data['title'] = "Update Sub Admin Password";

		if($this->input->post()){


			$this->form_validation->set_rules('pswd', 'New Password', 'trim|required|min_length[6]|max_length[15]');

			$this->form_validation->set_rules('cpswd', 'Confirm Password', 'trim|required|min_length[6]|max_length[15]|matches[pswd]');


			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/subAdmin/updatePassword');

				$this->load->view('admin/includes/footer');

			}else{


				$details1['password'] = md5($this->input->post('pswd'));


				$details1['updated'] = date('Y-m-d H:i:s');


				$update = $this->Common_model->update('admin',$details1,'id',$this->input->post('id'));

				if($update){

					$this->session->set_flashdata('success', "Sub Admin Password  Updated Successfully");

					redirect(site_url().'/SubAdmin/manage');

				}

			}

		}else{

			$data['details'] = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/subAdmin/updatePassword');

			$this->load->view('admin/includes/footer');

		}

	}




	public function edit(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'subAdmin';

		$data['title'] = "Edit Sub Admin";

		if($this->input->post()){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required');

			$this->form_validation->set_rules('assignRole', 'Assign Role', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/subAdmin/edit');

				$this->load->view('admin/includes/footer');

			}else{

				$details1['name'] = $this->input->post('username');

				$details1['email'] = $this->input->post('email');

				$details1['phone'] = $this->input->post('phone');

				$details1['assignRole'] = $this->input->post('assignRole');

				$details1['updated'] = date('Y-m-d H:i:s');

				if(!empty($_FILES["image"]["name"])){

					$name= time().'_'.$_FILES["image"]["name"];

					$liciense_tmp_name=$_FILES["image"]["tmp_name"];

					$error=$_FILES["image"]["error"];

					$liciense_path='uploads/users/'.$name;

					move_uploaded_file($liciense_tmp_name,$liciense_path);

					$details1['image']= $liciense_path;

				}

				$update = $this->Common_model->update('admin',$details1,'id',$this->input->post('id'));

				if($update){

					$this->session->set_flashdata('success', "Sub Admin Updated Successfully");

					redirect(site_url().'/SubAdmin/manage');

				}

			}

		}else{

			$data['details'] = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/subAdmin/edit');

			$this->load->view('admin/includes/footer');

		}

	}



	public function delete(){
		$delete = $this->Common_model->delete('admin','id',$this->uri->segment(3));
		redirect(site_url().'/SubAdmin/manage');
	}



	public function status(){

		$details = $this->db->get_where('admin',array('id' => $this->uri->segment(3)))->row_array();

		if($details['status'] == 'Approved'){

			$data['status'] = 'Pending';

		}

		else{

			$data['status'] = 'Approved';

		}

		$update = $this->Common_model->update('admin',$data,'id',$this->uri->segment(3));

		if($update){

			//$this->session->set_flashdata('success', "User Updated Successfully");

			redirect(site_url().'/SubAdmin/manage');

		}

	}





}
