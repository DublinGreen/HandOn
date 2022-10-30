<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('admin/Admin_model');
		$this->load->model('admin/Common_model');
		if(!$this->session->userdata('admin_details')){
			redirect( site_url() . "/admin/login");
			exit;
		}

	}

	public function manage(){
		$config["base_url"] = site_url()."/Payment/manage";
		 // $coutData = $this->db->from("userCoinHistory",array('type' => 1))->count_all_results();
		 $coutData = $this->db->get_where("userCoinHistory")->num_rows();

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
		$data['details'] = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId  order by userCoinHistory.id desc  limit $npage,$p")->result_array();
		$data['active'] = 'payment1';
		$data['title'] = 'Manage Coin History';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/Payment/Payment');
		$this->load->view('admin/includes/footer');
	}

   public function viewWallet(){

  	 $admin_details = $this->session->userdata('admin_details');
		 $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		 $subadminId = $data['admin']['id'];
		 $data['details'] = $this->db->query("select sum(subAdminCoins.coins) as totalCoins from subAdminCoins where subadminId = $subadminId")->row_array();
		 $data['details2'] = $this->db->query("select admin.totalCoins as balance from admin where id = $subadminId")->row_array();
		 $data['details1'] = $this->db->query("select sum(userCoinHistory.coin) as spentCoins from userCoinHistory where subminId = $subadminId")->row_array();

		 // $data['details'] = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId  order by userCoinHistory.id desc  limit $npage,$p")->result_array();
		 $data['active'] = 'viewWallet';
		 $data['title'] = 'Sub Admin Wallet';
		 $this->load->view('admin/includes/header',$data);
		 $this->load->view('admin/Payment/viewWallet');
		 $this->load->view('admin/includes/footer');
	 }

			public function subAdminCoinsHistory(){
					$admin_details = $this->session->userdata('admin_details');
					$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
					$subadminId = $data['admin']['id'];
					$config["base_url"] = site_url()."/Payment/subAdminCoinsHistory";
					$adminType = $this->uri->segment(3);
				  if($adminType == 1){

							$coutData = $this->db->get_where("userCoinHistory",array('subminId' => $subadminId))->num_rows();
					}
					else{

						$coutData = $this->db->get_where("userCoinHistory",array('type' => 1))->num_rows();

					}

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

				  if($adminType == 1){

						$data['details'] = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,admin.id as adminId, admin.name as adminName,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId left join admin on admin.id = userCoinHistory.subminId where userCoinHistory.type = 1 and userCoinHistory.subminId = $subadminId order by userCoinHistory.id DESC  limit $npage,$p")->result_array();

					}
					else{

						$data['details'] = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,admin.id as adminId, admin.name as adminName,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId left join admin on admin.id = userCoinHistory.subminId where userCoinHistory.type = 1 order by userCoinHistory.id DESC  limit $npage,$p")->result_array();

					}
					$data['active'] = 'subAdminCoinsHistory';
					$data['title'] = 'Offline Recharge History';
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/Payment/subadminPamentHistory');
					$this->load->view('admin/includes/footer');
			}


			public function getSubdminPayment(){
	 		 if ($this->input->post()){

	 						 $search_data = array(
	 								 'start'=>$this->input->post('sdate'),
	 								 'end'=>$this->input->post('edate'),
	 								 'name'=>$this->input->post('pname')
	 						 );
	 						 $this->session->set_userdata($search_data);
	 				 }
				 $start = $this->session->userdata('start');
 				 $end = $this->session->userdata('end');
 				 $pname = $this->session->userdata('name');
				 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
				 $offset =  ($page-1)*10;
				 $Urifunction = $this->uri->segment(2);
				 $result = $this->Common_model->searchCoinsHistory($end, $pname, $start, $Urifunction, $offset);
				 $data['details'] = $result[0];
				 $count = $result[1];
					$config["base_url"] = site_url()."/Payment/getSubdminPayment";
 					$coutData = $this->db->from("userCoinHistory",array('type' => 1))->count_all_results();
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
 					//$data['details'] = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,admin.id as adminId, admin.name as adminName,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId left join admin on admin.id = userCoinHistory.subminId where userCoinHistory.type = 1 order by userCoinHistory.id DESC  limit $npage,$p")->result_array();
 					$data['active'] = 'subAdminCoinsHistory';
 					$data['title'] = 'Manage Sub Admin Coin History';
 					$this->load->view('admin/includes/header',$data);
 					$this->load->view('admin/Payment/subadminPamentHistory');
 					$this->load->view('admin/includes/footer');
	 	 }


	public function ppvpayment(){
		$config["base_url"] = site_url()."/Payment/ppvpayment";
		//$coutData = $this->db->from("testing")->count_all_results();
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
		//$data['details'] = $this->db->query("select * from testing order by id desc limit $npage,$p")->result_array();
		$data['active'] = 'ppvpayment';
		$data['title'] = 'Manage PPV Payment';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/Payment/ppvpayment');
		$this->load->view('admin/includes/footer');
	}

	public function revenue(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('testing')->result_array();
		$data['active'] = 'revenue';
		$data['title'] = 'Manage Revenue System';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/Payment/revenue');
		$this->load->view('admin/includes/footer');
	}

	public function add(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'addGems';
		$data['title'] = "Add Gems";
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('count', 'Gems Count', 'trim|required');
			$this->form_validation->set_rules('price', 'Gems Price', 'trim|required');
			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
				$this->form_validation->set_rules('image', 'Picture', 'required');
			}
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/Gems/add');
				$this->load->view('admin/includes/footer');
			}else{
				$details['title'] = $this->input->post('title');
				$details['price'] = $this->input->post('price');
				$details['count'] = $this->input->post('count');
				$details['status'] = "Approved";
				$details['created'] = date('Y-m-d H:i:s');
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/users/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']= $liciense_path;
				}
				$insert = $this->Common_model->insert_data($details,'Gems');
				if($insert){
					$this->session->set_flashdata('success', "Gems added Successfully");
					redirect(site_url().'/Gems/manage');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/Gems/add');
			$this->load->view('admin/includes/footer');
		}
	}

	  public function addCoins(){
			$admin_details = $this->session->userdata('admin_details');
			$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
      $subminId =  $data['admin']['id'];
			$data['active'] = 'addCoins1';
			$data['title'] = "Add Coins";
			$checkCoinsBalance = $this->db->query("SELECT admin.totalCoins from admin where id = $subminId")->row_array();
		  $totalCoins = $checkCoinsBalance['totalCoins'];

			if($totalCoins == 0){
				$this->session->set_flashdata('error', "You don't have enough balance");
				redirect(site_url().'/admin/dashboard');
			}
			else{

			if($this->input->post()){

				if($totalCoins < $this->input->post('coin')){
					$this->session->set_flashdata('error', "You don't have enough balance");
					redirect(site_url().'/Payment/addCoins');

				}
				else{
				$userData = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
				if($userData){
				   	$this->form_validation->set_rules('username', 'username', 'trim|required');
						$this->form_validation->set_rules('coin', 'Coins', 'trim|required');
						$this->form_validation->set_rules('price', 'Price', 'trim|required');
						$this->form_validation->set_rules('transactionId', 'Transaction Id', 'trim|required');
						$this->form_validation->set_rules('orderId', 'Order Id', 'trim|required');
						$this->form_validation->set_rules('paymentType', 'Payment Type', 'trim|required');
				 }
					 else{
							$this->form_validation->set_rules('username', 'username', 'trim|required|matches[users.username]');
							$this->form_validation->set_rules('coin', 'Coins', 'trim|required');
							$this->form_validation->set_rules('price', 'Price', 'trim|required');
							$this->form_validation->set_rules('transactionId', 'Transaction Id', 'trim|required');
							$this->form_validation->set_rules('orderId', 'Order Id', 'trim|required');
							$this->form_validation->set_rules('paymentType', 'Payment Type', 'trim|required');
					 }

				if($this->form_validation->run() == FALSE){
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/Payment/addCoins');
					$this->load->view('admin/includes/footer');
				}else{
					$userDetails = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
				  $userId = $userDetails['id'];
					$details['userId'] = $userId;
					$details['subminId'] = $subminId;
					$details['type'] = 1;
					$details['coin'] = $this->input->post('coin');
					$details['coinPrice'] = $this->input->post('price');
					$details['transactionId'] = $this->input->post('transactionId');
					$details['paymentType'] = $this->input->post('paymentType');
					$details['created'] = date('Y-m-d H:i:s');

					$deductedCoins['totalCoins'] = $totalCoins - $this->input->post('coin');
					$subadminCoins = $this->db->update('admin',$deductedCoins,array('id' => $subminId));

					$coinDetails = $this->db->select('users.purchasedCoin')->get_where('users',array('id' => $userId))->row_array();
					$deatails1['purchasedCoin'] = $coinDetails['purchasedCoin'] + $this->input->post('coin');
				  $userCoinUpdate = $this->db->update('users',$deatails1,array('id' => $userId));

				  $insert = $this->Common_model->insert_data($details,'userCoinHistory');
					if($insert){
						$data1['coinId'] = $this->db->insert_id();
						$data1['coins'] = $this->input->post('coin');
						$data1['created'] = date('Y-m-d H:i:s');
						$insertCoinsHistory = $this->db->insert('subAdminCoinHistory',$data1);
						$this->session->set_flashdata('success', "Coins added Successfully");
						redirect(site_url().'/Payment/subAdminCoinsHistory/1');
					}
				}
			}
		}else{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/Payment/addCoins');
				$this->load->view('admin/includes/footer');
			}
		}

		}


				public function resetCoins(){
		      $id = $this->input->post('id');
					$userDetails = $this->db->get_where('userCoinHistory',array('id' => $id))->row_array();
					// echo $this->db->last_query();
					$userId =  $userDetails['userId'];
					$coins = $userDetails['coin'];
					$userData = $this->db->get_where('users',array('id' => $userId))->row_array();

					$data['purchasedCoin'] =  $userData['purchasedCoin'] - $coins;

					$userCoinsDeduct = $this->db->update('users',$data,array('id' => $userId));
					$delete = $this->db->delete('userCoinHistory',array('id' => $id));
					if($delete){
						  echo "Coins deducted successully";
					}
					else{
						echo "something went wrong";
					}

				}


	public function edit(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'Gems';
		$data['title'] = "Edit Gems";
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('count', 'Gems Count', 'trim|required');
			$this->form_validation->set_rules('price', 'Gems Price', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$data['details'] = $this->db->get_where('Gems',array('id' => $this->uri->segment(3)))->row_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/Gems/edit');
				$this->load->view('admin/includes/footer');
			}else{
				$details1['title'] = $this->input->post('title');
				$details1['count'] = $this->input->post('count');
				$details1['price'] = $this->input->post('price');
				$details1['updated'] = date('Y-m-d H:i:s');
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/users/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details1['image']= $liciense_path;
				}
				$update = $this->Common_model->update('Gems',$details1,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', "Gems Updated Successfully");
					redirect(site_url().'/Gems/manage');
				}
			}
		}else{
			$data['details'] = $this->db->get_where('Gems',array('id' => $this->uri->segment(3)))->row_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/Gems/edit');
			$this->load->view('admin/includes/footer');
		}
	}

	public function delete(){
		$delete = $this->Common_model->delete('Gems','id',$this->uri->segment(3));
		redirect(site_url().'/Gems/manage');
	}

	 // public function checkUserName(){
		//    $username = $this->input->post('username');
		// 	 $userDetails = $this->db->get_where('users',array('username' => $username))->row_array();
		// 	 if(!empty($userDetails)){
		// 		   echo '0';
		// 	 }
		// 	 else {
		// 	 	  '1';
		// 	 }
	 // }


	public function status(){
		$details = $this->db->get_where('Gems',array('id' => $this->uri->segment(3)))->row_array();
		if($details['status'] == 'Approved'){
			$data['status'] = 'Pending';
		}
		else{
			$data['status'] = 'Approved';
		}
		$update = $this->Common_model->update('Gems',$data,'id',$this->uri->segment(3));
		if($update){
			//$this->session->set_flashdata('success', "User Updated Successfully");
			redirect(site_url().'/Gems/manage');
		}
	}

}
