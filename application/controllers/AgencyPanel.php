<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyPanel extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
    date_default_timezone_set("Asia/Calcutta");
		$this->load->model('admin/Admin_model');
		$this->load->model('admin/Common_model');

	}

  public function index(){
    if($this->input->post()){
			$this->form_validation->set_rules('agencyCode', 'Agency Code', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required',
					array('required' => 'You must provide a %s.')
			);
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('agencyPanel/adminPages/login');
			}
			else{
        $agencyCode = $this->input->post('agencyCode');
        $passowrd = md5($this->input->post('password'));
				$result = $this->db->query("select * from agencyDetails where agencyCode = '$agencyCode' and password = '$passowrd' and status = '1'")->row_array();
				if(!empty($result)){
					$sess_array = array(
					 'admin_id' => $result['id'],
					 'email' => $result['email'],
			   	);
			    $this->session->set_userdata('agency_details', $sess_array);
				  redirect(site_url().'/AgencyPanel/dashboard');
				}
				else{
					$this->session->set_flashdata('error', ' Invalid Login Details, Please Try Again!');
					redirect(site_url().'/AgencyPanel');
				}
			}
		}
		else{
			$this->load->view('agencyPanel/adminPages/login');
		}
  }



	public function report(){
		if(!$this->session->userdata('agency_details')){
			redirect( site_url() . "/AgencyPanel");
			exit;
		}
		$admin_details = $this->session->userdata('agency_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$agencyId = $admin_details['admin_id'];
		$data['active'] = 'agencyReport';
		$data['title'] = 'Manage Talent Report';
		$agencyUserIds = $this->db->query("SELECT userId FROM `agencyUsers` where agencyId = $agencyId")->result_array();
		if(!empty($agencyUserIds)){
			foreach($agencyUserIds as $agencyUserId){
				$userIds[] = $agencyUserId['userId'];
			}
			$finalIds = implode(',',$userIds);
			$getCreatedDates = $this->db->query("SELECT created FROM `userLive` where userId in ($finalIds) group by DATE_FORMAT(created ,'%Y-%m') ORDER BY DATE_FORMAT(created ,'%Y-%m') desc")->result_array();
			if(!empty($getCreatedDates)){
				foreach($getCreatedDates as $getCreatedDate){
					$date=date_create($getCreatedDate['created']);
					$todaySearch =  date_format($date,"Y-m");
					$getCreatedDate['cureentMonthTalents'] = $this->db->query("SELECT * FROM `agencyUsers` where status = '1' and agencyId = $agencyId and DATE_FORMAT(created ,'%Y-%m') = '$todaySearch'")->num_rows();
					$totalGems = $this->db->query("select sum(userGiftHistory.coin) as totalGems from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.giftUserId where DATE_FORMAT(userGiftHistory.created ,'%Y-%m') = '$todaySearch' and agencyUsers.agencyId = $agencyId")->row_array();
					if(!empty($totalGems)){
						$getCreatedDate['totalGems'] = $totalGems['totalGems'];
					}
					else{
						$getCreatedDate['totalGems'] = '';
					}
					$getCreatedDate['activeTalents'] = $this->db->query("SELECT *,(TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 as totalActiveuser FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where (TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 >= 60 and agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch' group by userLive.userId")->num_rows();
					$liveDuration = $this->db->query("SELECT sum((TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created)))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch'")->row_array();
					if(!empty($liveDuration)){
						$getCreatedDate['liveDuration'] = $liveDuration['spendTime'];
					}
					else{
						$getCreatedDate['liveDuration'] = '';
					}
					$getCreatedDate['totalTalents'] = $this->db->query("select * from agencyUsers where  status = '1' and agencyId = $agencyId and DATE_FORMAT(created ,'%Y-%m') <=  '$todaySearch'")->num_rows();
					$data['details'][] = $getCreatedDate;
				}
			}
			else{
				$data['details'] = [];
			}
		}
		else{
				$data['details'] = [];
		}
	
		$this->load->view('agencyPanel/includes/header',$data);
		$this->load->view('agencyPanel/talent/agencyReport');
		$this->load->view('agencyPanel/includes/footer');
	}

    public function dashboard(){
			if(!$this->session->userdata('agency_details'))
			{
				redirect( site_url() . "/AgencyPanel");
				exit;
			}
			$admin_details = $this->session->userdata('agency_details');
			$data['admin'] = $this->Common_model->get_data_by_id('agencyDetails','id',$admin_details['admin_id']);
			$data['active'] = 'dashboard';
			$data['title'] = 'Admin Portal';
      $agencyId = $admin_details['admin_id'];
      $data['todayDateTime']  = date('Y/m/d');
      $todaySearch = date('Y-m');
      $data['cureentMonthTalents'] = $this->db->query("SELECT * FROM `agencyUsers` where status = '1' and agencyId = $agencyId and DATE_FORMAT(created ,'%Y-%m') = '$todaySearch'")->num_rows();
      $data['totalGems'] = $this->db->query("select sum(userGiftHistory.coin) as totalGems from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.giftUserId where DATE_FORMAT(userGiftHistory.created ,'%Y-%m') = '$todaySearch' and agencyUsers.agencyId = $agencyId")->row_array();
      $data['liveDuration'] = $this->db->query("SELECT sum((TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created)))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch'")->row_array();
			$data['activeTalents'] = $this->db->query("SELECT *,(TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 as totalActiveuser FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where (TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 >= 60 and agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch' group by userLive.userId")->num_rows();
      $data['totalTalents'] = $this->db->query("select * from agencyUsers where  status = '1' and agencyId = $agencyId")->num_rows();
      $data['pending_host'] = $this->db->query("SELECT * FROM userLiveRequest where host_status = '1'")->num_rows();
			$data['approved_host'] = $this->db->query("SELECT * FROM userLiveRequest where host_status = '2'")->num_rows();
			$data['rejected_host'] = $this->db->query("SELECT * FROM userLiveRequest where host_status = '3'")->num_rows();
			$this->load->view('agencyPanel/includes/header',$data);
			$this->load->view('agencyPanel/adminPages/dashboard');
			$this->load->view('agencyPanel/includes/footer2');
	}

  public function searhAgencyPortalWithDate(){
		$admin_details = $this->session->userdata('agency_details');
		$agencyId = $admin_details['admin_id'];
		$date = date_create($this->input->post('searchDate'));
		$todaySearch =  date_format($date,"Y-m");
		$data['cureentMonthTalents'] = $this->db->query("SELECT * FROM `agencyUsers` where status = '1' and agencyId = $agencyId and DATE_FORMAT(created ,'%Y-%m') = '$todaySearch'")->num_rows();
		$data['totalGems'] = $this->db->query("select sum(userGiftHistory.coin) as totalGems from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.giftUserId where DATE_FORMAT(userGiftHistory.created ,'%Y-%m') = '$todaySearch' and agencyUsers.agencyId = $agencyId")->row_array();
		$data['liveDuration'] = $this->db->query("SELECT sum((TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created)))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch'")->row_array();
		$data['totalTalents'] = $this->db->query("select * from agencyUsers where  status = '1' and agencyId = $agencyId")->num_rows();
		$data['activeTalents'] = $this->db->query("SELECT *,(TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where (TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 >= 60 and agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch' group by userLive.userId")->num_rows();



		$this->load->view('agencyPanel/adminPages/searchDateTemplate',$data);
  }







	public function login(){
		if($this->input->post()){
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required',
					array('required' => 'You must provide a %s.')
			);
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/adminPages/login');
			}
			else{
				$result = $this->Admin_model->login();
				if(!empty($result)){
					$sess_array = array(
					 'admin_id' => $result['id'],
					 'email' => $result['email'],
			   	);
			    $this->session->set_userdata('admin_details', $sess_array);

					if($result['assignRole'] == 'ACCOUNTS MANAGEMENT'){
						redirect(site_url().'/User/manage');
					}
					if($result['assignRole'] == 'CROWNS & GIFT'){
						redirect(site_url().'/Badges');
					}
					if($result['assignRole'] == 'VIDEO MANAGEMENT'){
						redirect(site_url().'/Videos/pending');
					}
					if($result['assignRole'] == 'REPORTS MANAGEMENT'){
						redirect(site_url().'/Report/streamReport');
					}
					if($result['assignRole'] == 'PAYMENT MANAGEMENT'){
						redirect(site_url().'/Payment/manage');
					}


				  redirect(site_url().'/admin/dashboard');
				}
				else{
					$this->session->set_flashdata('error', ' Invalid Login Details, Please Try Again!');
					redirect(site_url().'/admin/login');
				}
			}
		}
		else{
			$this->load->view('admin/adminPages/login');
		}
	}

	public function edit_profile(){
    if(!$this->session->userdata('agency_details'))
    {
      redirect( site_url() . "/AgencyPanel");
      exit;
    }
		$admin_details = $this->session->userdata('agency_details');
		$data['admin'] = $this->Common_model->get_data_by_id('agencyDetails','id',$admin_details['admin_id']);
		$data['active'] = 'edit_profile';
		$data['title'] = 'Edit Profile';
		if($this->input->post()){
			if($this->input->post('type') =='profile'){
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				$this->form_validation->set_rules('designation', 'Designation', 'required');
				$this->form_validation->set_rules('education', 'Education', 'required');
				$this->form_validation->set_rules('location', 'Location', 'required');
				if($this->form_validation->run() == FALSE){
					$data['activeTab'] = 'profile';
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/adminPages/profile');
					$this->load->view('admin/includes/footer');
				}
				else{
					$details['name'] = $this->input->post('name');
					$details['email'] = $this->input->post('email');
					$details['phone'] = $this->input->post('phone');
					$details['designation'] = $this->input->post('designation');
					$details['education'] = $this->input->post('education');
					$details['address'] = $this->input->post('location');
					if(!empty($_FILES["image"]["name"])){
						$name= time().'_'.$_FILES["image"]["name"];
						$liciense_tmp_name=$_FILES["image"]["tmp_name"];
						$error=$_FILES["image"]["error"];
						$liciense_path='uploads/admin/'.$name;
						move_uploaded_file($liciense_tmp_name,$liciense_path);
						$details['image']=$liciense_path;
					}
					$update = $this->Common_model->update('admin',$details,'id',$admin_details['admin_id']);
					if($update){
						$this->session->set_flashdata('success', 'Profile Update Successfully');
						redirect(site_url().'/admin/edit_profile');
					}
				}
			}
			else{
				$this->form_validation->set_rules('oldPassword', 'Old Password', 'required');
				$this->form_validation->set_rules('newPassword', 'New Password', 'required');
				$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]');
				if($this->form_validation->run() == FALSE){
					$data['activeTab'] = 'changePass';
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/adminPages/profile');
					$this->load->view('admin/includes/footer');
				}
				else{
					$checkPassword = $this->db->get_where('admin',array('id' => $admin_details['admin_id'],'password' => md5($this->input->post('oldPassword'))))->row_array();
					if(!empty($checkPassword)){
						$pass['password'] = md5($this->input->post('newPassword'));
						$update = $this->Common_model->update('admin',$pass,'id',$admin_details['admin_id']);
						if($update){
							$this->session->set_flashdata('passSuccess', 'Profile Update Successfully');
							redirect(site_url().'/admin/edit_profile');
						}
					}
					else{
						$this->session->set_flashdata('oldPass', 'Old Password Does Not Match');
						redirect(site_url().'/admin/edit_profile');
					}
				}
			}
		}
		else{
			$data['activeTab'] = 'profile';
			$this->load->view('agencyPanel/includes/header',$data);
			$this->load->view('agencyPanel/adminPages/profile');
			$this->load->view('agencyPanel/includes/footer');
		}
	}
	public function change_password(){
		if(!$this->session->userdata('admin_details')){
			redirect(site_url('admin'));
			exit;
		}
		$admin_details = $this->session->userdata('admin_details');
		$admin_name = $admin_details['username'];
		$user_id = $admin_details['admin_id'];
		if($this->input->post()){

		$old_password=$this->input->post('old_password');
		$new_password=$this->input->post('new_password');

		$admin_info=$this->Admin_model->chngpass($admin_name,$old_password,$user_id);
		if(empty($admin_info)){
			$this->session->set_flashdata("error", "Old Password Does't Match");
			redirect( site_url() . "admin/admin/change_password" );
		}else{
			$result=$this->Admin_model->chng_pass($admin_name,$new_password);

		 	if ($result) {
				$this->session->set_flashdata("message", "Password Change Successfully");
			}else {
				$this->session->set_flashdata("error", "Password Can't Change ");
			}
			redirect( site_url() . "admin/admin/change_password" );
		}
		}
		else{
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'change_password';
		$data['title'] = 'Change Password';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/admin_pages/change_password');
		$this->load->view('admin/includes/footer');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url().'/AgencyPanel');
	}

	public function testing(){
		if($this->input->post()){
			echo "<pre>";
			print_r($this->input->post());
			die;
		}
		else{
			$this->load->view('admin/adminPages/testing');
		}
	}
	
	public function manageHosts(){
	    
	$config["base_url"] = site_url()."/AgencyPanel/manage";
    if($this->uri->segment(3) == 1){
      $coutData = $this->db->get_where('userLiveRequest', array('host_status' => '1'))->num_rows();
    }
    elseif($this->uri->segment(3) == 2){
      $coutData = $this->db->get_where('userLiveRequest', array('host_status' => '2'))->num_rows();
    }
    else{
		  $coutData = $this->db->get_where('userLiveRequest', array('host_status' => '3'))->num_rows();
    }
	    $config["total_rows"] = $coutData;
	    $config["per_page"] = 10;
	    $config["uri_segment"] = 4;
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
	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
	    $npage =  ($page-1)*10;
	    $data["links"] = $this->pagination->create_links();
	    $p = $config["per_page"];
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

    if($this->uri->segment(3) == 1){
        $data['details'] = $this->db->query("select agencyDetails.agencyCode,userLiveRequest.*,users.username,users.email,users.name,users.phone from userLiveRequest left join agencyDetails on agencyDetails.id = userLiveRequest.agencyId left join users on users.id = userLiveRequest.userId where userLiveRequest.host_status = '1' AND users.userBanStatus != '1' order by id desc limit $npage,$p")->result_array();
  		$data['active'] = 'managePendingHostRequest';
  		$data['title'] = 'Manage Pending Host Request';
    }
    elseif($this->uri->segment(3) == 2){
        $data['details'] = $this->db->query("select agencyDetails.agencyCode,userLiveRequest.*,users.username,users.email,users.name,users.phone from userLiveRequest left join agencyDetails on agencyDetails.id = userLiveRequest.agencyId left join users on users.id = userLiveRequest.userId where userLiveRequest.host_status = '2' AND users.userBanStatus != '1' order by id desc limit $npage,$p")->result_array();
  		$data['active'] = 'approvedHostRequest';
  		$data['title'] = 'Manage Approved Host Request';
    }
    else{
      $data['details'] = $this->db->query("select agencyDetails.agencyCode,userLiveRequest.*,users.username,users.email,users.name,users.phone from userLiveRequest left join agencyDetails on agencyDetails.id = userLiveRequest.agencyId  left join users on users.id = userLiveRequest.userId where userLiveRequest.host_status = '3' AND users.userBanStatus != '1' order by id desc limit $npage,$p")->result_array();
      $data['active'] = 'rejectedHostRequest';
      $data['title'] = 'Manage Rejected Host Request';
    }

		$this->load->view('agencyPanel/includes/header',$data);
// 		$this->load->view('admin/userVerification/manage');
        $this->load->view('admin/agency/manage');
		$this->load->view('agencyPanel/includes/footer');
	}
	
	
	public function ViewHosts(){
    $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
    //$data['details'] = $this->db->get_where('registerUserInfo',array('id' => $this->uri->segment(3)))->row_array();
		$mainId  = $this->uri->segment(3);
// 		$data['details'] = $this->db->query("select agencyDetails.agencyCode,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.id = $mainId order by id desc")->row_array();
		$data['details'] = $this->db->query("select agencyDetails.agencyCode,userLiveRequest.*,users.username,users.name,users.phone,users.email from userLiveRequest left join agencyDetails on agencyDetails.id = userLiveRequest.agencyId left join users on users.id = userLiveRequest.userId where userLiveRequest.id = $mainId order by id desc")->row_array();
    if($this->uri->segment(4) == 1){
      $data['active'] = 'managePendingHostRequest';
		  $data['title'] = 'View Host Information';
      $data['backTitle'] = 'Manage Pending Host Request';
     $data['backFunction'] = '/AgencyPanel/manageHosts/1';
    }
    elseif($this->uri->segment(4) == 2){
      $data['active'] = 'approvedHostRequest';
		  $data['title'] = 'View Host Information';
      $data['backTitle'] = 'Manage Approved Host Request';
      $data['backFunction'] = '/AgencyPanel/manageHosts/2';
    }
    else{
      $data['active'] = 'rejectedHostRequest';
		  $data['title'] = 'View Host Information';
      $data['backTitle'] = 'Manage Rejected Host Request';
    $data['backFunction'] = '/AgencyPanel/manageHosts/3';
    }
		$data['formSegment'] = $this->uri->segment(4);
    $this->load->view('agencyPanel/includes/header',$data);
		$this->load->view('admin/agency/view');
 		$this->load->view('agencyPanel/includes/footer');
  }
  
  public function Delete(){
    $info = $this->db->get_where('registerUserInfo',array('id' => $this->uri->segment(3)))->row_array();
		$agencyId = $this->db->get_where('agencyDetails',array('id' => $info['agencyCode']))->row_array();
    $delete = $this->db->delete('registerUserInfo',array('id' => $this->uri->segment(3)));
    if(!empty($delete)){
        $this->db->delete('agencyUsers',array('userId' => $info['userId'],'agencyId' => $agencyId['id']));
        $this->session->set_flashdata('success', "User Verifaction Information Deleted successfully");
  		  redirect(site_url().'/AgencyPanel/manageHosts/'.$this->uri->segment(4));
    }
  }
}
