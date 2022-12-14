<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Gift extends CI_Controller {



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



	public function liveGiftCategory(){
		$config["base_url"] = site_url()."/Gift/liveGiftCategory";
		$coutData = $this->db->from("liveGiftCategory")->count_all_results();
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

			$data['details'] = $this->db->query("SELECT * FROM `liveGiftCategory`  order by id desc limit $npage,$p")->result_array();
			$data['active'] = 'liveGiftCategory';

			$data['title'] = 'Manage Live Gift Category';

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/gift/manageLiveGiftCategory');

			$this->load->view('admin/includes/footer');
	}

	public function addliveGiftCategory(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'liveGiftCategory';
		$data['title'] = "Add Live Gift Category";
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/gift/addliveGiftCategory');
				$this->load->view('admin/includes/footer');
			}else{
				$details['title'] = $this->input->post('title');
				$details['status'] = 'Approved';
				$details['created'] = date('Y-m-d H:i:s');
				$insert = $this->Common_model->insert_data($details,'liveGiftCategory');
				if($insert){
					$this->session->set_flashdata('success', "Live Gift Category added Successfully");
					redirect(site_url().'/Gift/liveGiftCategory');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/gift/addliveGiftCategory');
			$this->load->view('admin/includes/footer');
		}
	}


	public function editLiveGiftCategory(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'liveGiftCategory';
		$data['title'] = "Edit Live Gift Category";
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/gift/editliveGiftCategory');
				$this->load->view('admin/includes/footer');
			}else{
				$details['title'] = $this->input->post('title');
				$insert = $this->Common_model->update('liveGiftCategory',$details,'id',$this->input->post('id'));
				if($insert){
					$this->session->set_flashdata('success', "Live Gift Category added Successfully");
					redirect(site_url().'/Gift/liveGiftCategory');
				}
			}
		}else{
			$data['details'] = $this->db->get_where('liveGiftCategory',array('id' => $this->uri->segment(3)))->row_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/gift/editliveGiftCategory');
			$this->load->view('admin/includes/footer');
		}
	}

	public function liveGiftCategorystatus(){
		$details = $this->db->get_where('liveGiftCategory',array('id' => $this->uri->segment(3)))->row_array();
		if($details['status'] == 'Approved'){
			$data['status'] = 'Pending';
		}
		else{
			$data['status'] = 'Approved';
		}
		$update = $this->Common_model->update('liveGiftCategory',$data,'id',$this->uri->segment(3));
		if($update){
			$this->session->set_flashdata('success', "Status Updated Successfully");
			redirect(site_url().'/Gift/liveGiftCategory');
		}
	}

	public function liveGift(){
		$config["base_url"] = site_url()."/Gift/liveGift";
		$coutData = $this->db->from("livegift")->count_all_results();
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

		$data['details'] = $this->db->query("SELECT liveGiftCategory.title,livegift.* FROM `livegift` left join liveGiftCategory on liveGiftCategory.id = livegift.giftCategoryId order by livegift.id desc limit $npage,$p")->result_array();
		$data['active'] = 'liveGift';

		$data['title'] = 'Manage Live Gift';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/gift/manageLiveGift');

		$this->load->view('admin/includes/footer');
	}



	public function manage(){
		$config["base_url"] = site_url()."/Gift/manage";
		$coutData = $this->db->from("gift")->count_all_results();
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

		$data['details'] = $this->db->query("select * from gift order by id desc limit $npage,$p")->result_array();
		$data['active'] = 'gift';

		$data['title'] = 'Manage Gift';

		$this->load->view('admin/includes/header',$data);

		$this->load->view('admin/gift/manage');

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
           	$data=$this->db->query("SELECT * from gift where created between '$start' and '$end' and title like '%$pname%' or primeAccount like '%$pname%' or nonPrimeAccount like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("SELECT * from gift where created between '$start' and '$end' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("SELECT * from gift where created = '$start' and title like '%$pname%' or primeAccount like '%$pname%' or nonPrimeAccount like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("SELECT * from gift where created = '$end' and title like '%$pname%' or primeAccount like '%$pname%' or nonPrimeAccount like '%$pname%' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("SELECT * from gift where created = '$start' order by id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT * from gift where created = '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("SELECT * from gift where title like'%$pname%' or primeAccount like '%$pname%' or nonPrimeAccount like '%$pname%' order by id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT * from gift order by id desc")->result_array();
            exit(json_encode($data));
        }
    }



		public function addliveGift(){
			$admin_details = $this->session->userdata('admin_details');
			$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
			$data['active'] = 'addliveGift';
			$data['title'] = "Add Live Gift";
			if($this->input->post()){
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('categoryId', 'Category Id', 'trim|required');
				$this->form_validation->set_rules('primeAccount', 'Prime Account', 'trim|required');
      
				if(empty($_FILES["thumbnail"]["name"]) || $_FILES["thumbnail"]["name"] == ""){
            $this->form_validation->set_rules('thumbnail', 'Thumbnail', 'required');
        }
				if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
					$this->form_validation->set_rules('image', 'Picture', 'required');
				}
				if($this->form_validation->run() == FALSE){
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/gift/addLiveGift');
					$this->load->view('admin/includes/footer');
				}else{
					$details['title'] = $this->input->post('title');
					$details['primeAccount'] = $this->input->post('primeAccount');
					$details['giftCategoryId'] = $this->input->post('categoryId');
					$details['status'] = "Approved";
          if(!empty($_FILES["thumbnail"]["name"])){
              $name= time().'_'.$_FILES["thumbnail"]["name"];
              $liciense_tmp_name=$_FILES["thumbnail"]["tmp_name"];
              $error=$_FILES["thumbnail"]["error"];
              $liciense_path='uploads/users/'.$name;
              move_uploaded_file($liciense_tmp_name,$liciense_path);
              $details['thumbnail']= $liciense_path;
          }
					if(!empty($_FILES["sound"]["name"])){
              $name= time().'_'.$_FILES["sound"]["name"];
              $liciense_tmp_name=$_FILES["sound"]["tmp_name"];
              $error=$_FILES["sound"]["error"];
              $liciense_path='uploads/users/'.$name;
              move_uploaded_file($liciense_tmp_name,$liciense_path);
              $details['sound']= $liciense_path;
          }
					$details['created'] = date('Y-m-d H:i:s');
					if(!empty($_FILES["image"]["name"])){
						$name= time().'_'.$_FILES["image"]["name"];
						$liciense_tmp_name=$_FILES["image"]["tmp_name"];
						$error=$_FILES["image"]["error"];
						$liciense_path='uploads/users/'.$name;
						move_uploaded_file($liciense_tmp_name,$liciense_path);
						$details['image']= $liciense_path;
					}
					$insert = $this->Common_model->insert_data($details,'livegift');
					if($insert){
						$this->session->set_flashdata('success', "Live Gift added Successfully");
						redirect(site_url().'/Gift/liveGift');
					}
				}
			}else{
				$data['categoryDetails'] = $this->db->order_by('title','desc')->get_where('liveGiftCategory')->result_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/gift/addLiveGift');
				$this->load->view('admin/includes/footer');
			}
		}

	public function add(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'addGift';
		$data['title'] = "Add Gift";
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('primeAccount', 'Prime Account', 'trim|required');
			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
				$this->form_validation->set_rules('image', 'Picture', 'required');
			}
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/gift/add');
				$this->load->view('admin/includes/footer');
			}else{
				$details['title'] = $this->input->post('title');
				$details['primeAccount'] = $this->input->post('primeAccount');
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
				$insert = $this->Common_model->insert_data($details,'gift');
				if($insert){
					$this->session->set_flashdata('success', "Gift added Successfully");
					redirect(site_url().'/Gift/manage');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/gift/add');
			$this->load->view('admin/includes/footer');
		}
	}



	public function editLiveGift(){
		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'liveGift';

		$data['title'] = "Edit Live Gift";

		if($this->input->post()){
			$this->form_validation->set_rules('categoryId', 'Category Id', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			$this->form_validation->set_rules('primeAccount', 'Prime Account', 'trim|required');



			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('livegift',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/gift/editLiveGift');

				$this->load->view('admin/includes/footer');

			}else{

				$details1['title'] = $this->input->post('title');

				$details1['primeAccount'] = $this->input->post('primeAccount');
				$details1['giftCategoryId'] = $this->input->post('categoryId');

				$details1['updated'] = date('Y-m-d H:i:s');

				if(!empty($_FILES["image"]["name"])){

					$name= time().'_'.$_FILES["image"]["name"];

					$liciense_tmp_name=$_FILES["image"]["tmp_name"];

					$error=$_FILES["image"]["error"];

					$liciense_path='uploads/users/'.$name;

					move_uploaded_file($liciense_tmp_name,$liciense_path);

					$details1['image']= $liciense_path;

				}

				if(!empty($_FILES["thumbnail"]["name"])){
						$name= time().'_'.$_FILES["thumbnail"]["name"];
						$liciense_tmp_name=$_FILES["thumbnail"]["tmp_name"];
						$error=$_FILES["thumbnail"]["error"];
						$liciense_path='uploads/users/'.$name;
						move_uploaded_file($liciense_tmp_name,$liciense_path);
						$details1['thumbnail']= $liciense_path;
				}

                if(!empty($_FILES["sound"]["name"])){
                    $name= time().'_'.$_FILES["sound"]["name"];
                    $liciense_tmp_name=$_FILES["sound"]["tmp_name"];
                    $error=$_FILES["sound"]["error"];
                    $liciense_path='uploads/users/'.$name;
                    move_uploaded_file($liciense_tmp_name,$liciense_path);
                    $details1['sound']= $liciense_path;
                }

				$update = $this->Common_model->update('livegift',$details1,'id',$this->input->post('id'));


				if($update){

					$this->session->set_flashdata('success', "Gift Updated Successfully");

					redirect(site_url().'/Gift/liveGift');

				}

			}

		}else{
				$data['categoryDetails'] = $this->db->order_by('title','desc')->get_where('liveGiftCategory')->result_array();
			$data['details'] = $this->db->get_where('livegift',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/gift/editLiveGift');

			$this->load->view('admin/includes/footer');

		}

	}


	public function edit(){

		$admin_details = $this->session->userdata('admin_details');

		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$data['active'] = 'gift';

		$data['title'] = "Edit Gift";

		if($this->input->post()){

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			$this->form_validation->set_rules('primeAccount', 'Prime Account', 'trim|required');

			if($this->form_validation->run() == FALSE){

				$data['details'] = $this->db->get_where('gift',array('id' => $this->uri->segment(3)))->row_array();

				$this->load->view('admin/includes/header',$data);

				$this->load->view('admin/gift/edit');

				$this->load->view('admin/includes/footer');

			}else{

				$details1['title'] = $this->input->post('title');

				$details1['primeAccount'] = $this->input->post('primeAccount');

				$details1['updated'] = date('Y-m-d H:i:s');

				if(!empty($_FILES["image"]["name"])){

					$name= time().'_'.$_FILES["image"]["name"];

					$liciense_tmp_name=$_FILES["image"]["tmp_name"];

					$error=$_FILES["image"]["error"];

					$liciense_path='uploads/users/'.$name;

					move_uploaded_file($liciense_tmp_name,$liciense_path);

					$details1['image']= $liciense_path;

				}

				$update = $this->Common_model->update('gift',$details1,'id',$this->input->post('id'));

				if($update){

					$this->session->set_flashdata('success', "Gift Updated Successfully");

					redirect(site_url().'/Gift/manage');

				}

			}

		}else{

			$data['details'] = $this->db->get_where('gift',array('id' => $this->uri->segment(3)))->row_array();

			$this->load->view('admin/includes/header',$data);

			$this->load->view('admin/gift/edit');

			$this->load->view('admin/includes/footer');

		}

	}



	public function delete(){

		$delete = $this->Common_model->delete('gift','id',$this->uri->segment(3));

		redirect(site_url().'/Gift/manage');

	}

	public function deleteLiveGift(){
		$delete = $this->Common_model->delete('livegift','id',$this->uri->segment(3));

		redirect(site_url().'/Gift/liveGift');
	}



	public function status(){

		$details = $this->db->get_where('gift',array('id' => $this->uri->segment(3)))->row_array();

		if($details['status'] == 'Approved'){

			$data['status'] = 'Pending';

		}

		else{

			$data['status'] = 'Approved';

		}

		$update = $this->Common_model->update('gift',$data,'id',$this->uri->segment(3));

		if($update){

			//$this->session->set_flashdata('success', "User Updated Successfully");

			redirect(site_url().'/Gift/manage');

		}

	}


	public function liveGiftstatus(){
		$details = $this->db->get_where('livegift',array('id' => $this->uri->segment(3)))->row_array();

		if($details['status'] == 'Approved'){

			$data['status'] = 'Pending';

		}

		else{

			$data['status'] = 'Approved';

		}

		$update = $this->Common_model->update('livegift',$data,'id',$this->uri->segment(3));

		if($update){

			//$this->session->set_flashdata('success', "User Updated Successfully");

			redirect(site_url().'/Gift/liveGift');

		}
	}



}
