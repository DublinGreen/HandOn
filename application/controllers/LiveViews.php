<?php
defined('BASEPATH') OR exit('No direct script access allowed');
USE Kreait\Firebase\Configuration;
USE Kreait\Firebase\Firebase;
USE Kreait\Firebase\Database;
class LiveViews extends CI_Controller {

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

	public function dummyView(){
		$config["base_url"] = site_url()."/LiveViews/dummyView/";
		$coutData = $this->db->get_where('liveFakeViewUser')->num_rows();
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
		$data['details'] = $this->db->query("select users.username,users.image,users.name,users.leval,liveFakeViewUser.* from liveFakeViewUser left join users on users.id = liveFakeViewUser.userId order by liveFakeViewUser.id desc limit $npage,$p")->result_array();
		$data['active'] = 'dummyView';
		$data['title'] = 'Manage Dummy View';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/LiveViews/manage');
		$this->load->view('admin/includes/footer');
	}

	public function addDummyView(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'dummyView';
		$data['title'] = "Add Dummy View";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/LiveViews/add');
				$this->load->view('admin/includes/footer');
			}
			else{
				$userInfo = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
				if(!empty($userInfo)){
					require APPPATH.'/libraries/firebase/vendor/autoload.php';
					$config = new Configuration();
			    $config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
					$firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
					$userId =	$userInfo['id'];
					$leval =	$userInfo['leval'];
					$username =	$userInfo['username'];
					$name =	$userInfo['name'];
					if(!empty($userInfo['image'])){
						$image = $userInfo['image'];
					}
					else{
						$image = base_url().'uploads/no_image_available.png';
					}
					$firebase->set([
							'image' => $image,
							'level' => $leval,
							'username' => $username,
							'name' => $name,
							'userId' => (string)$userId,
					], 'fakeView/'.$userId);

					$ins['userId'] = $userInfo['id'];
					$ins['created'] = date('Y-m-d H:i:s');
					$insert = $this->db->insert('liveFakeViewUser',$ins);
					$this->session->set_flashdata('success', "Dummy View added successfully");
					redirect(site_url().'/LiveViews/dummyView');
				}
				else{
					$this->session->set_flashdata('error', "Username not found in database");
					redirect(site_url().'/LiveViews/addDummyView');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/LiveViews/add');
			$this->load->view('admin/includes/footer');
		}
	}

	public function deleteDummyView(){
		$id = $this->uri->segment(3);
		$delete = $this->db->delete('liveFakeViewUser',array('id' => $id));
		$userId = $this->uri->segment(4);
		require APPPATH.'/libraries/firebase/vendor/autoload.php';
		$config = new Configuration();
		$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		 $firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
		 $firebase->set([
 				null
 		], 'fakeView/'.$userId);

		$this->session->set_flashdata('success', "Dummy View deleted successfully");
		redirect(site_url().'/LiveViews/dummyView');

	}

	public function defaultViewCounts(){
		require APPPATH.'/libraries/firebase/vendor/autoload.php';
		$config = new Configuration();

		// $config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		// $firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);



		$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		$firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
		$result = $firebase->get('fakeViewCountTest/defaultFakeCounts/defaultFakeCounts');
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'defaultViewCounts';
		$data['title'] = "Add Default Views Count";
		$data['countValue'] = $result;
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/LiveViews/defaultViewCounts');
		$this->load->view('admin/includes/footer');
	}

	public function addDefaultViewCount(){
		if(!empty($this->input->post('defaultViewCounts'))){
				$count = $this->input->post('defaultViewCounts');
		}
		else{
			$count = 0;
		}
		require APPPATH.'/libraries/firebase/vendor/autoload.php';
		$config = new Configuration();
		$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		$firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
		$firebase->set([
				defaultFakeCounts => (int)$count
		], 'fakeViewCountTest/defaultFakeCounts');
		$this->session->set_flashdata('success', "Default View Count added successfully");
		redirect(site_url().'/LiveViews/defaultViewCounts');
	}


	public function dummyUserView(){
		$config["base_url"] = site_url()."/LiveViews/dummyView/";
		$coutData = $this->db->get_where('liveFakeViewUser')->num_rows();
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
		$data['details'] = $this->db->query("select users.username,users.image,users.name,users.leval,liveSingleUserFakeView.* from liveSingleUserFakeView left join users on users.id = liveSingleUserFakeView.userId order by liveSingleUserFakeView.id desc limit $npage,$p")->result_array();
		$data['active'] = 'dummyUserView';
		$data['title'] = 'Manage User Dummy View';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/LiveViews/manageDummyUserView');
		$this->load->view('admin/includes/footer');
	}


	public function addUserDummyView(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'dummyUserView';
		$data['title'] = "Add User Dummy View";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('viewCount', 'View Count', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/LiveViews/addUserDummyView');
				$this->load->view('admin/includes/footer');
			}
			else{
				$userInfo = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
				if(!empty($userInfo)){
					require APPPATH.'/libraries/firebase/vendor/autoload.php';
					$config = new Configuration();
					$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
					$firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
					$userId =	$userInfo['username'];
					$viewCount =	$this->input->post('viewCount');
					$firebase->set([
							$userId => (int)$viewCount,
					], 'fakeViewCountTest/'.$userId);

					$ins['userId'] = $userInfo['id'];
					$ins['viewCount'] = $this->input->post('viewCount');
					$ins['created'] = date('Y-m-d H:i:s');
					$insert = $this->db->insert('liveSingleUserFakeView',$ins);
					$this->session->set_flashdata('success', "Dummy View added successfully");
					redirect(site_url().'/LiveViews/dummyUserView');
				}
				else{
					$this->session->set_flashdata('error', "Username not found in database");
					redirect(site_url().'/LiveViews/addUserDummyView');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/LiveViews/addUserDummyView');
			$this->load->view('admin/includes/footer');
		}
	}

	public function deleteUserDummyView(){
		$getUsername = $this->db->get_where('users',array('id' => $this->uri->segment(4)))->row_array();
		$id = $this->uri->segment(3);
		$delete = $this->db->delete('liveSingleUserFakeView',array('id' => $id));
		$userId = $getUsername['username'];
		require APPPATH.'/libraries/firebase/vendor/autoload.php';
		$config = new Configuration();
		$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		 $firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
		 $firebase->set([
 				null
 		], 'fakeViewCountTest/'.$userId);

		$this->session->set_flashdata('success', "Dummy View deleted successfully");
		redirect(site_url().'/LiveViews/dummyUserView');
	}






}
