<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talent extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
    date_default_timezone_set("Asia/Calcutta");
		$this->load->model('admin/Admin_model');
		$this->load->model('admin/Common_model');
    if(!$this->session->userdata('agency_details'))
    {
      redirect( site_url() . "/AgencyPanel");
      exit;
    }

	}


  public function manage(){
		$admin_details = $this->session->userdata('agency_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$agencyId = $admin_details['admin_id'];
		$data['active'] = 'talentList';
		$data['title'] = 'Manage Talent List';
    $config["base_url"] = site_url()."/Talent/manage";
		$data['todayDateTime']  = date('Y/m/d');
		$todaySearch = date('Y-m');
		$coutData = $this->db->query("select sum(userGiftHistory.coin) as totalCoin, users.username, users.name,users.image,users.id as userId from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.userId left join users on users.id = agencyUsers.userId where DATE_FORMAT(userGiftHistory.created ,'%Y-%m') = '$todaySearch' and agencyUsers.agencyId = $agencyId group by agencyUsers.userId ;")->num_rows();
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
		$data['agencyId'] = $admin_details['admin_id'];
		$data['todaySearch'] = $todaySearch;
		// $data['details'] = $this->db->query("select sum(userGiftHistory.coin) as totalCoin, users.username, users.name,users.image,users.id as userId from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.userId left join users on users.id = agencyUsers.userId where agencyUsers.agencyId = $agencyId group by agencyUsers.userId order by sum(userGiftHistory.coin) desc limit $npage,$p")->result_array();
  // print_r($data['details']);
	// die;
	 $data['details'] = $this->db->query("select sum(userGiftHistory.coin) as totalCoin, users.username, users.name,users.image,users.id as userId from userGiftHistory left join agencyUsers on agencyUsers.userId = userGiftHistory.userId left join users on users.id = agencyUsers.userId where DATE_FORMAT(userGiftHistory.created ,'%Y-%m') = '$todaySearch' and agencyUsers.agencyId = $agencyId group by agencyUsers.userId order by sum(userGiftHistory.coin) desc limit $npage,$p")->result_array();
   // echo $this->db->last_query();
	 // die;
		$this->load->view('agencyPanel/includes/header',$data);
		$this->load->view('agencyPanel/talent/manage');
		$this->load->view('agencyPanel/includes/footer');
  }


	public function viewTalent(){
		$admin_details = $this->session->userdata('agency_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$agencyId = $admin_details['admin_id'];
		$data['active'] = 'talentList';
		$data['title'] = 'Manage Month Wise Talent Details';
		$userId = $this->uri->segment(3);
		$firstLiveDate = $this->db->query("SELECT created FROM `userLive` where userId = $userId group by DATE_FORMAT(created ,'%Y-%m') ORDER BY DATE_FORMAT(created ,'%Y-%m') desc")->result_array();
		foreach($firstLiveDate as $firstLiveDates){
				$date=date_create($firstLiveDates['created']);
				$searchDate =  date_format($date,"Y-m");
				$liveDuration = $this->db->query("SELECT sum((TO_SECONDS(archivedDate ) - TO_SECONDS(created)))/60 as spendTime FROM `userLive`  where  DATE_FORMAT(created ,'%Y-%m') = '$searchDate' and archivedDate != '' and userId = $userId ")->row_array();
				$validDays = $this->db->query("SELECT (TO_SECONDS(archivedDate ) - TO_SECONDS(created))/60 as spendTime FROM `userLive`  where (TO_SECONDS(archivedDate ) - TO_SECONDS(created))/60 >= 60  and DATE_FORMAT(created ,'%Y-%m') = '$searchDate' and userId = $userId ")->num_rows();
				$earnings = $this->db->query("SELECT sum(coin) as recivingCoin FROM `userGiftHistory` where userId = $userId and DATE_FORMAT(created ,'%Y-%m') = '$searchDate' ")->row_array();
				$firstLiveDates['liveDuration'] = $liveDuration['spendTime'];
				if(!empty($validDays)){
					$firstLiveDates['validDays'] = $validDays;
				}
				else{
					$firstLiveDates['validDays'] = '0';
				}
				if(!empty($earnings['recivingCoin'])){
					$firstLiveDates['recivedCoin'] = $earnings['recivingCoin'];
				}
				else{
					$firstLiveDates['recivedCoin'] = '0';
				}
				$finalList[] = 	$firstLiveDates;
		}
		if(!empty($finalList)){
			$data['finalList'] = $finalList;
		}
		else{
			$data['finalList'] = [];
		}
		$this->load->view('agencyPanel/includes/header',$data);
		$this->load->view('agencyPanel/talent/monthWiseResult');
		$this->load->view('agencyPanel/includes/footer');

	}

	public function Info(){
		$admin_details = $this->session->userdata('agency_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$agencyId = $admin_details['admin_id'];
		$data['active'] = 'talentList';
		$data['title'] = 'Talent Info';
		$userId = $this->uri->segment(3);
		$data['details'] = $this->db->query("select agencyDetails.agencyCode,agencyUsers.created as joinAgencyDate,users.id as userId,users.gender,users.username,users.name,users.image,users.created as talentJoinDate,users.country from users left join agencyUsers on agencyUsers.userId = users.id left join agencyDetails on agencyDetails.id = agencyUsers.agencyId where users.id = $userId")->row_array();
		$lastArichveDate = $this->db->query("SELECT archivedDate FROM `userLive` where userId = $userId order by id desc limit 11")->row_array();
		if(!empty($lastArichveDate)){
			$data['details']['lastLoinDate'] = $lastArichveDate['archivedDate'];
		}
		else{
			$data['details']['lastLoinDate'] = '';
		}
		$lastLoginDate = $this->db->query("SELECT archivedDate,(TO_SECONDS(archivedDate ) - TO_SECONDS(created))/60 as spendTime FROM `userLive` where (TO_SECONDS(archivedDate ) - TO_SECONDS(created))/60 > 60 and userId = $userId order by archivedDate desc limit 1")->row_array();
		if(!empty($lastLoginDate)){
			$data['details']['activeDate'] = $lastLoginDate['archivedDate'];
		}
		else{
			$data['details']['activeDate'] = '';
		}
		$this->load->view('agencyPanel/includes/header',$data);
		$this->load->view('agencyPanel/talent/userInfo');
		$this->load->view('agencyPanel/includes/footer');
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
}
