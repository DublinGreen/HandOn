<?php
defined('BASEPATH') OR exit('No direct script access allowed');
USE Kreait\Firebase\Configuration;
USE Kreait\Firebase\Firebase;
USE Kreait\Firebase\Database;
class UserVerification extends CI_Controller {

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

// 	public function manage(){
// 		$config["base_url"] = site_url()."/UserVerification/manage";
//     if($this->uri->segment(3) == 1){
//       $coutData = $this->db->get_where('registerUserInfo', array('status' => '1'))->num_rows();
//     }
//     elseif($this->uri->segment(3) == 2){
//       $coutData = $this->db->get_where('registerUserInfo', array('status' => '2'))->num_rows();
//     }
//     else{
// 		   $coutData = $this->db->get_where('registerUserInfo', array('status' => '0'))->num_rows();
//     }
// 	    $config["total_rows"] = $coutData;
// 	    $config["per_page"] = 10;
// 	    $config["uri_segment"] = 4;
// 	    $config['num_links'] = 2;
// 	    $config['use_page_numbers'] = TRUE;
// 	    $config['reuse_query_string'] = TRUE;
// 	    $config['full_tag_open'] = "<ul class='pagination pull-right'>";
// 	    $config['full_tag_close'] = '</ul>';
// 	    $config['num_tag_open'] = '<li>';
// 	    $config['num_tag_close'] = '</li>';
// 	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
// 	    $config['cur_tag_close'] = '</a></li>';
// 	    $config['prev_tag_open'] = '<li>';
// 	    $config['prev_tag_close'] = '</li>';
// 	    $config['first_tag_open'] = '<li>';
// 	    $config['first_tag_close'] = '</li>';
// 	    $config['last_tag_open'] = '<li>';
// 	    $config['last_tag_close'] = '</li>';
// 	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous';
// 	    $config['prev_tag_open'] = '<li>';
// 	    $config['prev_tag_close'] = '</li>';
// 	    $config['next_link'] = 'Next <i class="fa fa-long-arrow-right"></i>';
// 	    $config['next_tag_open'] = '<li>';
// 	    $config['next_tag_close'] = '</li>';
// 	    $this->pagination->initialize($config);
// 	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
// 	    $npage =  ($page-1)*10;
// 	    $data["links"] = $this->pagination->create_links();
// 	    $p = $config["per_page"];
// 		$admin_details = $this->session->userdata('admin_details');
// 		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

//     if($this->uri->segment(3) == 1){
//       $data['details'] = $this->db->query("select agencyDetails.agencyCode as agencyId,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.status = '1' order by id desc limit $npage,$p")->result_array();
//   		$data['active'] = 'userVerification';
//   		$data['title'] = 'Manage Approved Users Verifications';
//     }
//     elseif($this->uri->segment(3) == 2){
//       $data['details'] = $this->db->query("select agencyDetails.agencyCode as agencyId,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.status = '2' order by id desc limit $npage,$p")->result_array();
//   		$data['active'] = 'rejectedUserVerification';
//   		$data['title'] = 'Manage Rejected Users Verifications';
//     }
//     else{
//       $data['details'] = $this->db->query("select agencyDetails.agencyCode as agencyId,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.status = '0' order by id desc limit $npage,$p")->result_array();
//       $data['active'] = 'penidngUserVerification';
//       $data['title'] = 'Manage Pending Users Verifications';
//     }

// 		$this->load->view('admin/includes/header',$data);
// 		$this->load->view('admin/userVerification/manage');
// 		$this->load->view('admin/includes/footer');
// 	}
	
	
	public function manageHost(){
		$config["base_url"] = site_url()."/UserVerification/manage";
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

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/userVerification/manage');
		$this->load->view('admin/includes/footer');
	}

  public function Reject(){
    $userId = $this->uri->segment(3);
    $upStatus['status'] = '2';
    $update = $this->db->update('agencyDetails',$upStatus,array('id'=>$userId));
    if(!empty($update)){
        $this->session->set_flashdata('success', "Status Updated Successfully");
  		  redirect(site_url().'/Agency/manage/'.$this->uri->segment(4));
    }

  }

	public function rejectAgency(){
		 $agencyId = $this->input->post('agencyId');
		 $upStatus['status'] = '2';
     $update = $this->db->update('agencyDetails',$upStatus,array('id'=>$agencyId));

     if(!empty($update)){

				echo "Agency Rejected Successfully";

     }
	}

	 // public function deletAgency(){
		//   $agencyId = $this->input->post('agencyId');
		// 	$delete = $this->db->delete('agencyDetails',array('id' => $agencyId));
		// 	if(!empty($delete)){
		// 		 echo "Agency deleted Successfully"
		// 	}
	 // }

  public function Delete(){
    $info = $this->db->get_where('registerUserInfo',array('id' => $this->uri->segment(3)))->row_array();
		$agencyId = $this->db->get_where('agencyDetails',array('id' => $info['agencyCode']))->row_array();
    $delete = $this->db->delete('registerUserInfo',array('id' => $this->uri->segment(3)));
    if(!empty($delete)){
        $this->db->delete('agencyUsers',array('userId' => $info['userId'],'agencyId' => $agencyId['id']));
        $this->session->set_flashdata('success', "User Verifaction Information Deleted successfully");
  		  redirect(site_url().'/UserVerification/manage/'.$this->uri->segment(4));
    }
  }


  public function Approve(){
    $userId = $this->uri->segment(3);
    $upStatus['status'] = '1';
    $update = $this->db->update('agencyDetails',$upStatus,array('id'=>$userId));
    if(!empty($update)){
        $this->session->set_flashdata('success', "Status Updated Successfully");
  		  redirect(site_url().'/Agency/manage/'.$this->uri->segment(4));
    }
  }

	 public function agencyCodeAssign(){
			  $data['agencyCode'] = $this->input->post('agencyCode');
				$data['password'] = md5($this->input->post('password'));
				$data['viewPassword'] = $this->input->post('password');
				$data['status'] = '1';
				$agencyId = $this->input->post('agencyId');
			$update = $this->db->update('agencyDetails',$data,array('id' => $agencyId));
		  if(!empty($update)){
				$this->session->set_flashdata('success', "Agency Approved Successfully");
				redirect(site_url().'/Agency/manage/'.$this->uri->segment(4));
			}


	 }


//   public function View(){
//     $admin_details = $this->session->userdata('admin_details');
// 		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
//     //$data['details'] = $this->db->get_where('registerUserInfo',array('id' => $this->uri->segment(3)))->row_array();
// 		$mainId  = $this->uri->segment(3);
// 		$data['details'] = $this->db->query("select agencyDetails.agencyCode as agencyId,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.id = $mainId order by id desc")->row_array();
//     if($this->uri->segment(4) == 1){
//       $data['active'] = 'userVerification';
// 		  $data['title'] = 'View User Information';
//       $data['backTitle'] = 'Manage Approved User Verification';
//       $data['backFunction'] = '/UserVerification/manage/1';
//     }
//     elseif($this->uri->segment(4) == 2){
//       $data['active'] = 'rejectedUserVerification';
// 		  $data['title'] = 'View User Information';
//       $data['backTitle'] = 'Manage Rejected User Verification';
//       $data['backFunction'] = '/UserVerification/manage/2';
//     }
//     else{
//       $data['active'] = 'penidngUserVerification';
// 		  $data['title'] = 'View User Information';
//       $data['backTitle'] = 'Manage Pending User Verification';
//       $data['backFunction'] = '/UserVerification/manage/3';
//     }
// 		$data['formSegment'] = $this->uri->segment(4);
//     $this->load->view('admin/includes/header',$data);
// 		$this->load->view('admin/userVerification/view');
// 		$this->load->view('admin/includes/footer');
//   }
  
  public function ViewHost(){
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
     $data['backFunction'] = '/UserVerification/manageHost/1';
    }
    elseif($this->uri->segment(4) == 2){
      $data['active'] = 'approvedHostRequest';
		  $data['title'] = 'View Host Information';
      $data['backTitle'] = 'Manage Approved Host Request';
      $data['backFunction'] = '/UserVerification/manageHost/2';
    }
    else{
      $data['active'] = 'rejectedHostRequest';
		  $data['title'] = 'View Host Information';
      $data['backTitle'] = 'Manage Rejected Host Request';
    $data['backFunction'] = '/UserVerification/manageHost/3';
    }
		$data['formSegment'] = $this->uri->segment(4);
    $this->load->view('admin/includes/header',$data);
		$this->load->view('admin/userVerification/view');
		$this->load->view('admin/includes/footer');
  }


	public function approveRejectUser(){
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if($this->input->post('status') == '2'){
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
		}
		if($this->form_validation->run() == FALSE){
			$mainId  = $this->uri->segment(3);
			$data['details'] = $this->db->query("select agencyDetails.agencyCode as agencyId,registerUserInfo.* from registerUserInfo left join agencyDetails on agencyDetails.id = registerUserInfo.agencyCode where registerUserInfo.id = $mainId order by id desc")->row_array();
			if($this->uri->segment(4) == 1){
				$data['active'] = 'userVerification';
				$data['title'] = 'View User Information';
				$data['backTitle'] = 'Manage Approved User Verification';
				$data['backFunction'] = '/UserVerification/manage/1';
			}
			elseif($this->uri->segment(4) == 2){
				$data['active'] = 'rejectedUserVerification';
				$data['title'] = 'View User Information';
				$data['backTitle'] = 'Manage Rejected User Verification';
				$data['backFunction'] = '/UserVerification/manage/2';
			}
			else{
				$data['active'] = 'penidngUserVerification';
				$data['title'] = 'View User Information';
				$data['backTitle'] = 'Manage Pending User Verification';
				$data['backFunction'] = '/UserVerification/manage/3';
			}
			$data['formSegment'] = $this->uri->segment(4);
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/userVerification/view');
			$this->load->view('admin/includes/footer');
		}
		else{
			$mainId = $this->uri->segment(3);
			$data['status'] = $this->input->post('status');
			if(!empty($this->input->post('reason'))){
				$data['reason'] = $this->input->post('reason');
			}
			$update = $this->db->update('registerUserInfo',$data,array('id'=>$mainId));
			if(!empty($update)){
				$userVerificaitonINfo = $this->db->get_where('registerUserInfo',array('id' => $mainId))->row_array();
				$agencyId = $this->db->get_where('agencyDetails',array('id' => $userVerificaitonINfo['agencyCode']))->row_array();
				if($this->input->post('status') == '1'){
					$mainData['agencyId'] = $agencyId['id'];
					$mainData['userId'] = $userVerificaitonINfo['userId'];
					$mainData['status'] = '1';
					$mainData['created'] = date('Y-m-d H:i:s');
					$insert = $this->db->insert('agencyUsers',$mainData);
					$this->session->set_flashdata('success', "User Information  Approved Successfully");
				}
				elseif($this->input->post('status') == '2'){
					$this->db->delete('agencyUsers',array('agencyId' => $agencyId['id'],'userId' => $userVerificaitonINfo['userId']));
					$this->session->set_flashdata('success', "User Information Rejected Successfully");
				}
				else{
					$this->db->delete('registerUserInfo',array('id' => $mainId));
					$delete = $this->db->delete('agencyUsers',array('agencyId' => $agencyId['id'],'userId' => $userVerificaitonINfo['userId']));
					$this->session->set_flashdata('success', "User Information Deleted Successfully");
				}

				redirect(site_url().'/UserVerification/manage/'.$this->uri->segment(4));
			}
		}
	}


}
