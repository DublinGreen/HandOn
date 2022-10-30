<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Report extends CI_Controller {



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
		$config["base_url"] = site_url()."/Report/manage";
		$coutData = $this->db->from("report")->count_all_results();
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

		$data['details'] = $this->db->query("select * from report order by id desc limit $npage,$p")->result_array();

		$data['active'] = 'report';

		$data['title'] = 'Manage Report';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/report/manage');

		$this->load->view('admin/includes/footer');

	}

	public function getResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("SELECT * from report where created between '$start' and '$end' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("SELECT * from report where created between '$start' and '$end' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("SELECT * from report where created = '$start' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("SELECT * from report where created = '$end' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("SELECT * from report where created = '$start' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT * from report where created = '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("SELECT * from report where title like'%$pname%' order by id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT * from report order by id desc")->result_array();
            exit(json_encode($data));
        }
    }

	public function add(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'report';

		$data['title'] = "Add Report";

		if($this->input->post()){

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/report/add');

				$this->load->view('admin/includes/footer');

			}else{

				$details['title'] = $this->input->post('title');

				$details['created'] = date('Y-m-d H:i:s');

				$insert = $this->Common_model->insert_data($details,'report');

				if($insert){

					$this->session->set_flashdata('success', "Report added Successfully");

					redirect(site_url().'/Report/manage');

				}

			}

		}else{

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/report/add');

			$this->load->view('admin/includes/footer');

		}

	}

	

	

	public function edit(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'report';

		$data['title'] = "Edit Report";

		if($this->input->post()){

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('report',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/report/edit');

				$this->load->view('admin/includes/footer');

			}else{

				$details1['title'] = $this->input->post('title');

				$details1['updated'] = date('Y-m-d H:i:s');

				$update = $this->Common_model->update('report',$details1,'id',$this->input->post('id'));

				if($update){

					$this->session->set_flashdata('success', "Report Updated Successfully");

					redirect(site_url().'/Report/manage');

				}

			}

		}else{

			$data['details'] = $this->db->get_where('report',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/report/edit');

			$this->load->view('admin/includes/footer');

		}

	}

	

	public function delete(){

		$delete = $this->Common_model->delete('report','id',$this->uri->segment(3));

		redirect(site_url().'/Report/manage');

	}

	

	

	public function streamReport(){
		$config["base_url"] = site_url()."/Report/streamReport";
		$coutData = $this->db->from("reportUser")->count_all_results();
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

		$data['details'] = $this->db->query("select reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId order by reportUser.id desc limit $npage,$p")->result_array();

		$data['active'] = 'streamReport';

		$data['title'] = 'Manage User Report';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/report/manageStream');

		$this->load->view('admin/includes/footer');

	}

	public function getstreamResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created between '$start' and '$end' and u.name like '%$pname%' or u.id like '%$pname%' or r.name like '%$pname%' or r.id like '%$pname%' or reportUser.report like '%$pname%' order by reportUser.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created between '$start' and '$end' order by reportUser.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created = '$start' and u.name like '%$pname%' or u.id like '%$pname%' or r.name like '%$pname%' or r.id like '%$pname%' or reportUser.report like '%$pname%' order by reportUser.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created = '$end' and u.name like '%$pname%' or u.id like '%$pname%' or r.name like '%$pname%' or r.id like '%$pname%' or reportUser.report like '%$pname%' order by reportUser.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created = '$start' order by reportUser.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where reportUser.created = '$end' order by reportUser.id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId where u.name like '%$pname%' or u.id like '%$pname%' or r.name like '%$pname%' or r.id like '%$pname%' or reportUser.report like '%$pname%' order by reportUser.id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT reportUser.*,u.id as uid,u.name as uname,r.id as rid,r.name as rname from reportUser left join users as u on u.id=reportUser.userId left join users as r on r.id=reportUser.reportUserId order by reportUser.id desc")->result_array();
            exit(json_encode($data));
        }
    }

	public function problemReport(){
		$config["base_url"] = site_url()."/Report/problemReport";
		$coutData = $this->db->from("problemReport")->count_all_results();
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

		$data['details'] = $this->db->query("select * from problemReport order by id desc limit $npage,$p")->result_array();

		$data['active'] = 'problemReport';

		$data['title'] = 'Manage Problem Report';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/report/problem');

		$this->load->view('admin/includes/footer');

	}

	public function getprobResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("SELECT * from problemReport where created between '$start' and '$end' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("SELECT * from problemReport where created between '$start' and '$end' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("SELECT * from problemReport where created = '$start' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("SELECT * from problemReport where created = '$end' and title like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("SELECT * from problemReport where created = '$start' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT * from problemReport where created = '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("SELECT * from problemReport where title like'%$pname%' order by id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT * from problemReport order by id desc")->result_array();
            exit(json_encode($data));
        }
    }

	public function addProblem(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'problemReport';

		$data['title'] = "Add Problem Report";

		if($this->input->post()){

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/report/addprob');

				$this->load->view('admin/includes/footer');

			}else{

				$details['title'] = $this->input->post('title');

				//$details['created'] = date('Y-m-d H:i:s');

				$insert = $this->db->insert('problemReport',$details);

				if($insert){

					$this->session->set_flashdata('success', "Problem Report added Successfully");

					redirect(site_url().'/Report/problemReport');

				}

			}

		}else{

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/report/addprob');

			$this->load->view('admin/includes/footer');

		}

	}

	public function editProblem(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'problemReport';

		$data['title'] = "Edit Problem Report";

		if($this->input->post()){

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('report',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/report/editprob');

				$this->load->view('admin/includes/footer');

			}else{

				$details1['title'] = $this->input->post('title');

				//$details1['updated'] = date('Y-m-d H:i:s');

				$update = $this->Common_model->update('problemReport',$details1,'id',$this->input->post('id'));

				if($update){

					$this->session->set_flashdata('success', "Problem Report Updated Successfully");

					redirect(site_url().'/Report/problemReport');

				}

			}

		}else{

			$data['details'] = $this->db->get_where('problemReport',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/report/editprob');

			$this->load->view('admin/includes/footer');

		}

	}

	public function deleteProblem(){

		$delete = $this->Common_model->delete('problemReport','id',$this->uri->segment(3));

		if($delete){

			$this->session->set_flashdata('success', "Problem Report Deleted Successfully");

			redirect(site_url().'/Report/problemReport');

		}

	}

	public function userProblem(){
		$config["base_url"] = site_url()."/Report/userProblem";
		$coutData = $this->db->from("userReportVideo")->count_all_results();
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

		$data['details'] = $this->db->query("select users.username as uname, (select users.username from users where users.id = userReportVideo.reportUserId) as rname, userVideos.videoPath, userReportVideo.* from userReportVideo left join userVideos on userReportVideo.reportVideoId = userVideos.id left join users on userReportVideo.userId = users.id limit $npage,$p")->result_array();
		
		$data['active'] = 'userReport';

		$data['title'] = 'User Problem Report';
		$data['offset'] = $npage;

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/report/userProblem');

		$this->load->view('admin/includes/footer');

	}

	public function getuserResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("select problemReportUser.*,users.name,users.email,users.phone,problemReport.title as report1 from problemReportUser left join users on problemReportUser.userId = users.id left join problemReport on problemReportUser.report = problemReport.id where problemReportUser.created between '$start' and '$end' and users.name like '%$pname%' or problemReportUser.report like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' order problemReportUser.by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("SELECT * from users where created between '$start' and '$end' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("SELECT * from users where created = '$start' and username like '%$pname%' or name like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("SELECT * from users where created = '$end' and username like '%$pname%' or name like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("SELECT * from users where created = '$start' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT * from users where created = '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("select problemReportUser.*,users.name,users.email,users.phone,problemReport.title as report1 from problemReportUser left join users on problemReportUser.userId = users.id left join problemReport on problemReportUser.report = problemReport.id where users.name like'%$pname%' or problemReportUser.report like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' order by problemReportUser.id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT * from users order by id desc")->result_array();
            exit(json_encode($data));
        }
    }

	public function deleteuserProblem($id){

		//$delete = $this->Common_model->delete('problemReportUser','id',$this->uri->segment(3));
		$delete = $this->db->delete('userReportVideo',array('id'=>$id));
		if($delete){

			$this->session->set_flashdata('success', "User Problem Report Deleted Successfully");

			redirect(site_url().'/Report/userProblem');

		}

	}

	public function deleteStream(){

		$delete = $this->Common_model->delete('reportUser','id',$this->uri->segment(3));

		if($delete){

			$this->session->set_flashdata('success', "User Report Deleted Successfully");

			redirect(site_url().'/Report/streamReport');

		}

	}

}

