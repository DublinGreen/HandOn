<?php
defined('BASEPATH') OR exit('No direct script access allowed');
USE Kreait\Firebase\Configuration;
USE Kreait\Firebase\Firebase;
USE Kreait\Firebase\Database;
class Agency extends CI_Controller {

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
		$config["base_url"] = site_url()."/Agency/manageAgency";
    if($this->uri->segment(3) == 1){
      $coutData = $this->db->get_where('agencyDetails', array('status' => '1'))->num_rows();
    }
    elseif($this->uri->segment(3) == 2){
      $coutData = $this->db->get_where('agencyDetails', array('status' => '2'))->num_rows();
    }
    else{
		   $coutData = $this->db->get_where('agencyDetails', array('status' => '0'))->num_rows();
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
      $data['details'] = $this->db->query("select * from agencyDetails where status = '1' order by id desc limit $npage,$p")->result_array();
  		$data['active'] = 'agency';
  		$data['title'] = 'Manage Approved Agency';
    }
    elseif($this->uri->segment(3) == 2){
      $data['details'] = $this->db->query("select * from agencyDetails where status = '2' order by id desc limit $npage,$p")->result_array();
  		$data['active'] = 'rejectedAgency';
  		$data['title'] = 'Manage Rejected Agency';
    }
    else{
      $data['details'] = $this->db->query("select * from agencyDetails where status = '0' order by id desc limit $npage,$p")->result_array();
      $data['active'] = 'penidngAgency';
      $data['title'] = 'Manage Pending Agency';
    }

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/agency/manageAgency');
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
    $delete = $this->db->delete('agencyDetails',array('id' => $this->uri->segment(3)));
    if(!empty($delete)){
        $this->session->set_flashdata('success', "Status Updated Successfully");
  		  redirect(site_url().'/Agency/manage/'.$this->uri->segment(4));
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


  public function View(){
    $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
    $data['details'] = $this->db->get_where('agencyDetails',array('id' => $this->uri->segment(3)))->row_array();
    if($this->uri->segment(4) == 1){
      $data['active'] = 'agency';
		  $data['title'] = 'View Agency';
      $data['backTitle'] = 'Manage Approved Agency';
      $data['backFunction'] = '/Agency/manage/1';
    }
    elseif($this->uri->segment(4) == 2){
      $data['active'] = 'rejectedAgency';
		  $data['title'] = 'View Agency';
      $data['backTitle'] = 'Manage Rejected Agency';
      $data['backFunction'] = '/Agency/manage/2';
    }
    else{
      $data['active'] = 'penidngAgency';
		  $data['title'] = 'View Agency';
      $data['backTitle'] = 'Manage Pending Agency';
      $data['backFunction'] = '/Agency/manage/3';
    }
    $this->load->view('admin/includes/header',$data);
		$this->load->view('admin/agency/view');
		$this->load->view('admin/includes/footer');
  }


}
