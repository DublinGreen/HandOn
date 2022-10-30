<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

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

	public function updateAdminVideoStatus(){
		$checkStatus = $this->db->get_where('adminVideos',array('id' => $this->uri->segment(3)))->row_array();
		if($checkStatus['status'] == 'Approved'){
			$up['status'] = 'Pending';
		}
		else{
			$up['status'] = 'Approved';
		}
		$insert = $this->db->update('adminVideos',$up, array('id' => $this->uri->segment(3)));
		if($insert){
			//$this->session->set_flashdata('success', "Videos Updated Successfully");
			redirect(site_url().'/Videos/adminVideo');
		}
	}

	public function adminVideo(){
		$config["base_url"] = site_url()."/Videos/longPendingVideo";
		$coutData = $this->db->get_where('adminVideos')->num_rows();
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
		$data['active'] = 'adminVideo';
		$data['title'] = 'Manage Admin Video';
		$data['details'] = $this->db->order_by('id','desc')->get_where('adminVideos')->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/video/admin/manage');
		$this->load->view('admin/includes/footer');
	}


	public function addAdminVideo(){
		require APPPATH.'/libraries/vendor/autoload.php';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'addAdminVideo';
		$data['title'] = "Add Admin Video";
		if($this->input->post()){
			$this->form_validation->set_rules('videoTitle', 'Video Title', 'trim|required');
		//	$this->form_validation->set_rules('videoUrl', 'Video Url', 'trim|required');
		//	$this->form_validation->set_rules('buttonName', 'User Name', 'trim|required');
			$this->form_validation->set_rules('viewCount', 'View Count', 'trim|required');
			if(empty($_FILES["videoPath"]["name"]) || $_FILES["videoPath"]["name"] == ""){
				$this->form_validation->set_rules('videoPath', 'Video', 'required');
			}
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/admin/add');
				$this->load->view('admin/includes/footer');
			}else{
				$details['videoTitle'] = $this->input->post('videoTitle');
				//$details['videoUrl'] = $this->input->post('videoUrl');
				//$details['buttonName'] = $this->input->post('buttonName');
				$details['viewCount'] = $this->input->post('viewCount');
				$details['status'] = "Approved";
				$details['created'] = date('Y-m-d H:i:s');
				if(!empty($_FILES["videoPath"]["name"])){
					$s3 = new Aws\S3\S3Client([
							'version' => 'latest',
							'region'  => 'ap-south-1',
							'credentials' => [
									'key'    => 'AKIA3L2TB5JIUEWHXL3L',
									'secret' => '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'
							]
					]);
					$bucket = 'zebovideos';
					$upload = $s3->upload($bucket, $_FILES['videoPath']['name'], fopen($_FILES['videoPath']['tmp_name'], 'rb'), 'public-read');
					$url = $upload->get('ObjectURL');
					if(!empty($url)){
						$details['videoPath'] = 'http://d29vf2dbcha7zq.cloudfront.net/'.$_FILES['videoPath']['name'];;
					}
					else{
						$details['videoPath'] = '';
					}
				}
				$insert = $this->Common_model->insert_data($details,'adminVideos');
				if($insert){
					$this->session->set_flashdata('success', "Videos added Successfully");
					redirect(site_url().'/Videos/adminVideo');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/video/admin/add');
			$this->load->view('admin/includes/footer');
		}
	}





	public function editAdminVideo(){
		require APPPATH.'/libraries/vendor/autoload.php';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'adminVideo';
		$data['title'] = "Update Admin Video";
		if($this->input->post()){
			$this->form_validation->set_rules('videoTitle', 'Video Title', 'trim|required');
		//	$this->form_validation->set_rules('videoUrl', 'Video Url', 'trim|required');
			//$this->form_validation->set_rules('buttonName', 'User Name', 'trim|required');
			$this->form_validation->set_rules('viewCount', 'View Count', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$data['list'] = $this->db->get_where('adminVideos',array('id' => $this->uri->segment(3)))->row_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/admin/edit');
				$this->load->view('admin/includes/footer');
			}else{
				$details['videoTitle'] = $this->input->post('videoTitle');
				//$details['videoUrl'] = $this->input->post('videoUrl');
				//$details['buttonName'] = $this->input->post('buttonName');
				$details['viewCount'] = $this->input->post('viewCount');
				$details['created'] = date('Y-m-d H:i:s');
				if(!empty($_FILES["videoPath"]["name"])){
					$s3 = new Aws\S3\S3Client([
							'version' => 'latest',
							'region'  => 'ap-south-1',
							'credentials' => [
									'key'    => 'AKIA3L2TB5JIUEWHXL3L',
									'secret' => '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'
							]
					]);
					$bucket = 'zebovideos';
					$upload = $s3->upload($bucket, $_FILES['videoPath']['name'], fopen($_FILES['videoPath']['tmp_name'], 'rb'), 'public-read');
					$url = $upload->get('ObjectURL');
					if(!empty($url)){
						$details['videoPath'] = 'http://d29vf2dbcha7zq.cloudfront.net/'.$_FILES['videoPath']['name'];;
					}
					else{
						$details['videoPath'] = '';
					}
				}
				$insert = $this->db->update('adminVideos',$details, array('id' => $this->input->post('id')));
				if($insert){
					$this->session->set_flashdata('success', "Videos Updated Successfully");
					redirect(site_url().'/Videos/adminVideo');
				}
			}
		}else{
			$data['list'] = $this->db->get_where('adminVideos',array('id' => $this->uri->segment(3)))->row_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/video/admin/edit');
			$this->load->view('admin/includes/footer');
		}
	}

	public function deleteAdminVideo(){
		$delete = $this->db->delete('adminVideos',array('id' => $this->uri->segment(3)));
		$this->session->set_flashdata('success', "Videos Deleted Successfully");
		redirect(site_url().'/Videos/adminVideo');
	}

	public function pages($total_rows,$url){
		 $config["base_url"] = site_url()."/videos/".$url;
		 $config["total_rows"] = $total_rows;
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

		 return $this->pagination->create_links();

 }

	public function index(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('users')->result_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage User';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/manage');
		$this->load->view('admin/includes/footer');
	}

	public function getNonViewed(){
		if ($this->input->post()){
						$search_data = array(
								'start'=>$this->input->post('sdate'),
								'end'=>$this->input->post('edate'),
								'name'=>$this->input->post('pname'),
							 'name'=>$this->input->post('pname'),
							 'sort'=>$this->input->post('sort'),
							 'videoId' =>$this->input->post('videoId')
						);
						$this->session->set_userdata($search_data);
				}
				$start = $this->session->userdata('start');
				$end = $this->session->userdata('end');
				$pname = $this->session->userdata('name');
				$sort = $this->session->userdata('sort');
			 $videoId = $this->session->userdata('videoId');
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
				$offset =  ($page-1)*10;
				$Urifunction = $this->uri->segment(2);
				$result = $this->Common_model->searchResult($end, $pname, $start, $Urifunction, $offset,$sort,$videoId);
				$data['details'] = $result[0];
				$count = $result[1];
				$config["base_url"] = site_url()."/Videos/getNonViewed";
				$config["total_rows"] = $count;
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
				$data['links'] = $this->pagination->create_links();

				$admin_details = $this->session->userdata('admin_details');
				$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
				 $data['active'] = 'nonViewedVideo';
     	 $data['title'] = 'Manage Short Non Viewed Videos';

				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/nonViewed');
				$this->load->view('admin/includes/footer');
		}

		public function nonViewed(){
			if($this->input->post()){
				$search_data = array(
						'per_page'=>$this->input->post('perPage')
				);
				$this->session->set_userdata($search_data);
			}
			$per_page = $this->session->userdata('per_page');
			$config["base_url"] = site_url()."/Videos/nonViewed";
			$this->db->from("userVideos")->where("status","3")->count_all_results();
			$coutData = $this->db->get_where('userVideos',array('status' => '3'))->num_rows();
		    $config["total_rows"] = $coutData;
				if(!empty($per_page)){
					$config["per_page"] = $per_page;
				}
				else{
					$config["per_page"] = 10;
				}
		    //$config["per_page"] = 10;
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
			$status = '0' ;
			$data['lists'] = $this->Common_model->getVideos($status);
			$data['active'] = 'nonViewedVideo';
			$data['title'] = 'Manage Non Viewed Videos';
			$datas = $this->db->query("select userVideos.*, users.username, users.reg_id, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '3' order by userVideos.id desc limit $npage,$p")->result_array();

			foreach($datas as $deta){
				$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
				$dd[] = $deta;
			}
			$data['details'] = $dd;
			$segMent = $this->uri->segment(3);
	 	 if(!empty($segMent)){
	 		 $multiPly = ($segMent * 10) - 9;
	 		 $data['segmentCount'] = $multiPly;
	 	 }
	 	 else{
	 		 $data['segmentCount'] = 1;
	 	 }
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/video/nonViewed');
			$this->load->view('admin/includes/footer');
		}



			public function pending(){
				if($this->input->post()){
					$search_data = array(
							'per_page'=>$this->input->post('perPage')
					);
					$this->session->set_userdata($search_data);
				}
				$per_page = $this->session->userdata('per_page');
				$config["base_url"] = site_url()."/Videos/pending";
				$coutData = $this->db->get_where('userVideos',array('status' => '0'))->num_rows();
			    $config["total_rows"] = $coutData;
					if(!empty($per_page)){
						$config["per_page"] = $per_page;
					}
					else{
						$config["per_page"] = 10;
					}
					$data['per_page']  = $per_page;
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
				$status = '0' ;
				$data['lists'] = $this->Common_model->getVideos($status);
				$data['active'] = 'pendingVideo';
				$data['title'] = 'Manage Viewed Videos';
				$datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '0'  order by userVideos.id desc limit $npage,$p")->result_array();
				foreach($datas as $deta){
					$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
					$dd[] = $deta;
				}
				$data['details'] = $dd;
				$segMent = $this->uri->segment(3);
				if(!empty($segMent)){
					$multiPly = ($segMent * 10) - 9;
					$data['segmentCount'] = $multiPly;
				}
				else{
					$data['segmentCount'] = 1;
				}

				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/pending');
				$this->load->view('admin/includes/footer');

		}

		public function viewedStatus(){

		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$id = $_POST['id'];
		$Time = date('Y-m-d H:i:s');
	       $update = $this->db->query("UPDATE userVideos set status = '0'  where id in ($id)");

		if($update){
			echo "video viewed Successfully";
		}
		else{
			echo "Please try again later";
		}
}

		public function nonViewedStatus(){


		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$id = $_POST['id'];

		//$Time = date('Y-m-d H:i:s');
		$update = $this->db->query("UPDATE userVideos set status = '3'  where id in ($id)");
		//echo $this->db->last_query();
			if($update){
					echo "video added in Viewed Successfully";
			}
			else{
				 echo "Please try again later";
			}
}

	public function longPendingVideo(){
		$config["base_url"] = site_url()."/Videos/longPendingVideo";
	//	$this->db->from("userVideos")->where("status","0")->count_all_results();
		$coutData = $this->db->get_where('userVideos',array('status' => '0','videoType' => 1))->num_rows();
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
		$status = '0' ;
		$data['lists'] = $this->Common_model->getVideos($status);
		$data['active'] = 'longPendingVideo';
		$data['title'] = 'Manage Long Approved Videos';
		$datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '0' and userVideos.videoType = 1 order by userVideos.id desc limit $npage,$p")->result_array();
		foreach($datas as $deta){
			$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
			$dd[] = $deta;
		}
		$data['details'] = $dd;

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/video/longPending');
		$this->load->view('admin/includes/footer');
	}

	public function viewPerPage(){
		$config["base_url"] = site_url()."/Videos/pending";

 //	$this->db->from("userVideos")->where("status","0")->count_all_results();
	 $coutData = $this->db->get_where('userVideos',array('status' => '0'))->num_rows();
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
	 $status = '0' ;
	 $data['lists'] = $this->Common_model->getVideos($status);
	 $data['active'] = 'pendingVideo';
	 $data['title'] = 'Manage Approved Videos';
	 $datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '0'  order by userVideos.id desc limit $npage,$p")->result_array();
	 foreach($datas as $deta){
		 $deta['hashtags'] = $this->hashTagName($deta['hashTag']);
		 $dd[] = $deta;
	 }
	 $data['details'] = $dd;
	 $segMent = $this->uri->segment(3);
	 if(!empty($segMent)){
		 $multiPly = ($segMent * 10) - 9;
		 $data['segmentCount'] = $multiPly;
	 }
	 else{
		 $data['segmentCount'] = 1;
	 }

	 $this->load->view('admin/includes/header',$data);
	 $this->load->view('admin/video/pending');
	 $this->load->view('admin/includes/footer');

	}


	public function hashTagName($ids){
		$exp = explode(',',$ids);
		foreach($exp as $exps){
			$hashTitile = $this->db->get_where('hashtag',array('id' => $exps))->row_array();
			$hashTati[] = $hashTitile['hashtag'];
		}
		return $finalTitle = implode(',',$hashTati);
	}

	public function rejectStatus(){
		$id = $_POST['id'];
		//$data['status'] = '2';
		$rejectTime = date('Y-m-d H:i:s');
		$comment = "Video must not contain content that asserts or implies personal attributes. This includes direct or indirect assertions or implications about a person’s race, ethnic origin, religion, beliefs, age, sexual orientation or practices, gender identity, disability, medical condition (including physical or mental health), financial status, voting status, membership in a trade union, criminal record, or name.";
		$update = $this->db->query("UPDATE userVideos set adminComment = '$comment' , status = '2' , rejectVideoTime = '$rejectTime' where id in ($id)");

		if($update){
			echo "video rejected Successfully";
		}
		else{
			echo "Please try again later";
		}
	}

	public function trendingStatus(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$id = $_POST['id'];
		// $Time = date('Y-m-d H:i:s');
	  $update = $this->db->query("UPDATE userVideos set status = '1' where id in ($id)");

		if($update){
			echo "video added in trending Successfully";
		}
		else{
			echo "Please try again later";
		}
}

	 public function approveStatus(){
		 $id = $_POST['id'];
		 //$data['status'] = '2';
		 $update = $this->db->query("update `userVideos` set status = '0' where id In ($id)");

		 if($update){
			 echo "video Approved Successfully";
		 }
		 else{
			 echo "Please try again later";
		 }
 }

	 public function deleteStatus(){
		 $id = $_POST['id'];
		 $delete = $this->db->query("delete FROM `userVideos` where id In ($id)");
		 if($delete){
			 echo "User video deleted Successfully";
		 }
		 else{
			 echo "Please try again later";
		 }
	 }


	public function getpendResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
			$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
			$admin = $admin_details['admin_id'];
			if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '0' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and userVideos.status = '0' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '0' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '0' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and userVideos.status = '0' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and userVideos.status = '0' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '0' order by userVideos.id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '0' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }
    }


		public function trending(){
			if($this->input->post()){
				$search_data = array(
						'per_page'=>$this->input->post('perPage')
				);
				$this->session->set_userdata($search_data);
			}
		 $per_page = $this->session->userdata('per_page');
		 $config["base_url"] = site_url()."/Videos/trending";
		 $coutData = $this->db->from("userVideos")->where("userVideos.status","1")->count_all_results();
	    $config["total_rows"] = $coutData;
			if(!empty($per_page)){
				$config["per_page"] = $per_page;
			}
			else{
				$config["per_page"] = 10;
			}

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
		$status = 1;
		$data['lists'] = $this->Common_model->getVideos($status);
		$data['active'] = 'trendingVideo';
		$data['title'] = 'Manage Trending Videos';
		$datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '1' order by userVideos.id desc limit $npage,$p")->result_array();
		foreach($datas as $deta){
			$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
			$dd[] = $deta;
		}
		$data['details'] = $dd;

		$segMent = $this->uri->segment(3);
		if(!empty($segMent)){
			$multiPly = ($segMent * 10) - 9;
			$data['segmentCount'] = $multiPly;
		}
		else{
			$data['segmentCount'] = 1;
		}

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/video/approved');
		$this->load->view('admin/includes/footer');
	}

	public function approveTrending(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

		$id = $_POST['id'];
		$update = $this->db->query("update `userVideos` set status = '0' where id In ($id)");

		if($update){
			echo "video Approved Successfully";
		}
		else{
			echo "Please try again later";
		}
	}

	public function getapprResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '1' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and userVideos.status = '1' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '1' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '1' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and userVideos.status = '1' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and userVideos.status = '1' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '1' order by userVideos.id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '1' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }
    }


		public function getApproved(){
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
					$result = $this->Common_model->searchResult($end, $pname, $start, $Urifunction, $offset);
					$data['details'] = $result[0];
					$count = $result[1];
					$config["base_url"] = site_url()."/Videos/getApproved";
					$config["total_rows"] = $count;
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
					$data['links'] = $this->pagination->create_links();
					$admin_details = $this->session->userdata('admin_details');
					$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
					$data['active'] = 'pendingVideo';
					$data['title'] = 'Manage Approved Videos';
					$this->load->view('admin/includes/header',$data);
					$this->load->view('admin/video/pending');
					$this->load->view('admin/includes/footer');
			}


			public function getTrending(){
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
	 				 $result = $this->Common_model->searchResult($end, $pname, $start, $Urifunction, $offset);
	 				 $data['details'] = $result[0];
	 				 $count = $result[1];
	 				 $config["base_url"] = site_url()."/Videos/getTrending";
	 				 $config["total_rows"] = $count;
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
	 				 $data['links'] = $this->pagination->create_links();
	 				 $admin_details = $this->session->userdata('admin_details');
	 				 $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
	 				 $data['active'] = 'apporveVideo';
	 				 $data['title'] = 'Manage Trenidng Videos';
	 				 $this->load->view('admin/includes/header',$data);
	 				 $this->load->view('admin/video/pending');
	 				 $this->load->view('admin/includes/footer');
	 		 }



  public function longRejectVideo(){
  		$config["base_url"] = site_url()."/Videos/rejected";
			//$coutData = $this->db->from("userVideos")->where("userVideos.status","2")->count_all_results();
		$coutData = $this->db->get_where('userVideos',array('status' => '2','videoType' => 1))->num_rows();
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
		$status = 2;
		$data['lists'] = $this->Common_model->getVideos($status);
		$data['active'] = 'longRejectVideo';
		$data['title'] = 'Manage Long Rejected Videos';
		$datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '2' and userVideos.videoType = 1 limit $npage,$p")->result_array();
		foreach($datas as $deta){
			$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
			$dd[] = $deta;
		}
		$data['details'] = $dd;
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/video/longReject');
		$this->load->view('admin/includes/footer');
	}
////////--------------reject vidoes-----------/////////


  public function rejected(){
		if($this->input->post()){
			$search_data = array(
					'per_page'=>$this->input->post('perPage')
			);
			$this->session->set_userdata($search_data);
		}

  		$config["base_url"] = site_url()."/Videos/rejected";
		//$coutData = $this->db->from("userVideos")->where("userVideos.status","2")->count_all_results();
		$coutData = $this->db->get_where('userVideos',array('status' => '2'))->num_rows();
	    $config["total_rows"] = $coutData;
			if(!empty($per_page)){
				$config["per_page"] = $per_page;
			}
			else{
				$config["per_page"] = 10;
			}

	   // $config["per_page"] = 10;
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
		$status = 2;
		$data['lists'] = $this->Common_model->getVideos($status);
		$data['active'] = 'rejectVideo';
		$data['title'] = 'Manage Rejected Videos';
		$datas = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '2'  limit $npage,$p")->result_array();
		foreach($datas as $deta){
			$deta['hashtags'] = $this->hashTagName($deta['hashTag']);
			$dd[] = $deta;
		}
		$data['details'] = $dd;
		$segMent = $this->uri->segment(3);
		if(!empty($segMent)){
			$multiPly = ($segMent * 10) - 9;
			$data['segmentCount'] = $multiPly;
		}
		else{
			$data['segmentCount'] = 1;
		}
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/video/rejected');
		$this->load->view('admin/includes/footer');
	}

	public function getrejectResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '2' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created between '$start' and '$end' and userVideos.status = '2' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '2' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '2' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($start)){
           	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$start' and userVideos.status = '2' order by userVideos.id desc")->result_array();
           	exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.created = '$end' and userVideos.status = '2' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '2' order by userVideos.id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where userVideos.status = '2' order by userVideos.id desc")->result_array();
            exit(json_encode($data));
        }
    }




			public function getRejected(){
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
						$result = $this->Common_model->searchResult($end, $pname, $start, $Urifunction, $offset);
						$data['details'] = $result[0];
						$count = $result[1];
						$config["base_url"] = site_url()."/Videos/getRejected";
						$config["total_rows"] = $count;
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
						$data['links'] = $this->pagination->create_links();
						$admin_details = $this->session->userdata('admin_details');
						$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
						$data['active'] = 'rejectVideo';
						$data['title'] = 'Manage Rejected Videos';
						$this->load->view('admin/includes/header',$data);
						$this->load->view('admin/video/rejected');
						$this->load->view('admin/includes/footer');
				}



	public function videoStatus(){
        $id = $_POST['id'];
        $userId = $_POST['userId'];
  		$details1['status'] = $this->input->post('status');
		if($_POST['status']==0){
			$update = $this->db->update('userVideos',$details1, array('id' => $id));
			if($update){

				redirect(site_url()."/Videos/pendingView");
				$this->session->set_flashdata('success', "Video approved Successfully!");
		      }
			}

		 else{

		 	   $delete = $this->db->delete('userVideos',array('id' => $id));
		 	   $deleteCom = $this->db->delete('videoComments',array('videoId ' => $id));
		 	   $delLike = $this->db->delete('videoLikeOrUnlike',array('videoId ' => $id));
		 	   $delSubCom = $this->db->delete('videoSubComment',array('videoId' => $id));
		 	   $delUserNoti = $this->db->delete('userNotification',array('videoId' => $id));
               $slctInfo = $this->db->get_where('userProfileInformation',array('id'=>$userId))->row_array();
			   $videoCount['videoCount'] = $slctInfo['videoCount'] - 1;
			   $updateCount = $this->db->update('userProfileInformation',$videoCount, array('id' => $userId ));
			   if($updateCount){
			   	    // redirect(site_url().'/Videos/longPendingVideo');
		              echo "video deleted";
		       }
			 }

		}




	public function pendingView(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->uri->segment(4) == 4){
			$data['active'] = 'trendingVideo';
			$data['title'] = 'Trending Videos';
			$data['backFunction'] = 'trending';
		}
		elseif($this->uri->segment(4) == 2){
			$data['active'] = 'rejectVideo';
			$data['title'] = 'Rejected Videos';
			$data['backFunction'] = 'rejected';
		}
		elseif($this->uri->segment(4) == 3){
			$data['active'] = 'nonViewedVideo';
			$data['title'] = 'Non Viewed Video';
			$data['backFunction'] = 'nonViewed';
		}
		else{
			$data['active'] = 'pendingVideo';
			$data['title'] = 'Viewed Videos';
			$data['backFunction'] = 'pending';
		}
		$data['matchStatus'] = $this->uri->segment(4);
		$vidid = $this->uri->segment(3);
		$datas = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId where userVideos.id = $vidid")->row_array();
		//echo $this->db->last_query();die;
		//foreach($datas as $deta){
			$datas['hashtags'] = $this->hashTagName($datas['hashTag']);

		$data['details'] = $datas;
	  	$this->load->view('admin/includes/header',$data);
	  	$this->load->view('admin/video/pendingview');
	  	$this->load->view('admin/includes/footer');
	}


		//	code for most viewed video graph

		public function video_views_graph($id){
				$admin_details = $this->session->userdata('admin_details');
				$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

				$datas = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId where userVideos.id = $id")->row_array();
				$datas['hashtags'] = $this->hashTagName($datas['hashTag']);
				$data['details'] = $datas;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/pendingview');
				$this->load->view('admin/includes/footer');

		}


		//	code for most liked video graph



		public function video_likes_graph($id){
				$admin_details = $this->session->userdata('admin_details');
				$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

				$datas = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId where userVideos.id = $id")->row_array();
				$datas['hashtags'] = $this->hashTagName($datas['hashTag']);
				$data['details'] = $datas;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/pendingview');
				$this->load->view('admin/includes/footer');

		}

	//    most commented video

		public function video_comment_graph($id){
				$admin_details = $this->session->userdata('admin_details');
				$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
				$datas = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId where userVideos.id = $id")->row_array();
				$datas['hashtags'] = $this->hashTagName($datas['hashTag']);
				$data['details'] = $datas;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/pendingview');
				$this->load->view('admin/includes/footer');

		}



		public function video_upload_graph($slice){
				$admin_details = $this->session->userdata('admin_details');
				$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
				$username = substr_replace($slice,'@',0,0);
				$user_id = $this->db->select('id')->get_where('users',array('username'=>$username))->row_array();
				$id = $user_id['id'];
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
				$start =  ($page-1)*10;
				$data['segmentCount'] = ($page * 10) - 9;

				$datas = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId where userVideos.userId = $id limit $start,9")->result_array();

				$total_rows = $this->db->query("select users.username, users.email,users.phone ,users.image ,userVideos.*,hashtag.id as di,hashtag.hashtag as hash,sounds.sound from userVideos left join users on userVideos.userId=users.id left join hashtag on hashtag.id = userVideos.hashTag left join sounds on sounds.id = userVideos.soundId  limit $start,9")->num_rows();
				$datas['hashtags'] = $this->hashTagName($datas['hashTag']);
				$data['details'] = $datas;
				$data['title'] = 'list of videos uploaded by '.$datas[0]['username'];
				$url = "video_upload_graph/".$slice;
				$data['links'] = $this->pages($total_rows,$url);
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/video/pending');
				$this->load->view('admin/includes/footer');

		}


	public function Likes()
    {
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
    	if($this->uri->segment(4) == 1){
			$data['active'] = 'apporveVideo';
			$data['title'] = 'Likes List';
			//$data['backFunction'] = 'approved';
		}
		elseif($this->uri->segment(4) == 2){
			$data['active'] = 'rejectVideo';
			$data['title'] = 'Likes List';
			//$data['backFunction'] = 'rejected';
		}
		else{
			$data['active'] = 'pendingVideo';
			$data['title'] = 'Likes List';
			//$data['backFunction'] = 'pending';
		}
		$vidid = $this->uri->segment(3);
		$config["base_url"] = site_url()."/Videos/Likes/".$vidid;
		$coutData = $this->db->from("videoLikeOrUnlike")->where("videoLikeOrUnlike.videoId",$vidid)->count_all_results();
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
    	$data['mainId'] = $vidid;
    	$data['details'] = $this->db->query("select videoLikeOrUnlike.*,users.name,users.username,users.email,users.phone,users.image from videoLikeOrUnlike left join users on users.id = videoLikeOrUnlike.userId where videoLikeOrUnlike.videoId = $vidid order by videoLikeOrUnlike.id desc limit $npage,$p")->result_array();
    	$this->load->view('admin/includes/header',$data);
	  	$this->load->view('admin/video/videoLikes');
	  	$this->load->view('admin/includes/footer');
    }

    public function rejVideos(){
    	$videoId = $this->uri->segment(3);
        $details['adminComment'] = $this->input->post('comment');
       // echo $this->input->post('comment');

        $details['status'] = '2';
        $update = $this->db->update('userVideos',$details,array('id'=>$videoId));
        if($update){
			$this->session->set_flashdata('success', "Video rejected Successfully");
			redirect(site_url()."/Videos/pendingView/$videoId");
		}
    }

	public function Views()
    {
    	$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
    	if($this->uri->segment(4) == 1){
			$data['active'] = 'apporveVideo';
			$data['title'] = 'Views List';
			//$data['backFunction'] = 'approved';
		}
		elseif($this->uri->segment(4) == 2){
			$data['active'] = 'rejectVideo';
			$data['title'] = 'Views List';
			//$data['backFunction'] = 'rejected';
		}
		else{
			$data['active'] = 'pendingVideo';
			$data['title'] = 'Views List';
			//$data['backFunction'] = 'pending';
		}
		$vidid = $this->uri->segment(3);
    	$config["base_url"] = site_url()."/Videos/Views/".$vidid;
		$coutData = $this->db->from("viewVideo")->where("viewVideo.videoId",$vidid)->count_all_results();
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
    	$data['mainId'] = $vidid;
    	$data['details'] = $this->db->query("select viewVideo.*,users.name,users.username,users.email,users.phone,users.image from viewVideo left join users on users.id = viewVideo.userId where viewVideo.videoId = $vidid order by viewVideo.id desc limit $npage,$p")->result_array();
    	//echo $this->db->last_query();die;
    	$this->load->view('admin/includes/header',$data);
	  	$this->load->view('admin/video/videoViews');
	  	$this->load->view('admin/includes/footer');
    }

	public function Comments()
    {
    	$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
    	if($this->uri->segment(4) == 1){
			$data['active'] = 'apporveVideo';
			$data['title'] = 'Comments List';
			//$data['backFunction'] = 'approved';
		}
		elseif($this->uri->segment(4) == 2){
			$data['active'] = 'rejectVideo';
			$data['title'] = 'Comments List';
			//$data['backFunction'] = 'rejected';
		}
		else{
			$data['active'] = 'pendingVideo';
			$data['title'] = 'Comments List';
			//$data['backFunction'] = 'pending';
		}
		$vidid = $this->uri->segment(3);
    	$config["base_url"] = site_url()."/Videos/Comments/".$vidid;
		$coutData = $this->db->from("videoComments")->where("videoComments.videoId",$vidid)->count_all_results();
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
    	$data['mainId'] = $vidid;
    	$data['details'] = $this->db->query("select videoComments.*,users.name,users.username,users.email,users.phone,users.image from videoComments left join users on users.id = videoComments.userId where videoComments.videoId = $vidid order by videoComments.id desc limit $npage,$p")->result_array();
    	//echo $this->db->last_query();die;
    	$this->load->view('admin/includes/header',$data);
	  	$this->load->view('admin/video/videoComments');
	  	$this->load->view('admin/includes/footer');
    }

	public function addUser(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'addUser';
		$data['title'] = "Add User";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_unique[users.phone]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
				$this->form_validation->set_rules('image', 'Picture', 'required');
			}
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/user/add');
				$this->load->view('admin/includes/footer');
			}else{
				$details['username'] = $this->input->post('username');
				$details['email'] = $this->input->post('email');
				$details['phone'] = $this->input->post('phone');
				$details['password'] = md5($this->input->post('password'));
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
				$insert = $this->Common_model->insert_data($details,'users');
				if($insert){
					$this->session->set_flashdata('success', "User added Successfully");
					redirect(site_url().'/User');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/user/add');
			$this->load->view('admin/includes/footer');
		}
	}

	public function view(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "View User";
		$data['details'] = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/view');
		$this->load->view('admin/includes/footer');
	}

	public function edit(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Edit User";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$data['details'] = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/user/edit');
				$this->load->view('admin/includes/footer');
			}else{
				$details1['username'] = $this->input->post('username');
				$details1['email'] = $this->input->post('email');
				$details1['phone'] = $this->input->post('phone');
				$details1['updated'] = date('Y-m-d H:i:s');
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/users/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details1['image']= $liciense_path;
				}
				$update = $this->Common_model->update('users',$details1,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', "User Updated Successfully");
					redirect(site_url().'/User');
				}
			}
		}else{
			$data['details'] = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/user/edit');
			$this->load->view('admin/includes/footer');
		}
	}

	public function delete(){
		$delete = $this->Common_model->delete('users','id',$this->uri->segment(3));
		redirect(site_url().'/User');
	}

	public function status(){
		$details = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
		if($details['status'] == 'Approved'){
			$data['status'] = 'Pending';
		}
		else{
			$data['status'] = 'Approved';
		}
		$update = $this->Common_model->update('users',$data,'id',$this->uri->segment(3));
		if($update){
			//$this->session->set_flashdata('success', "User Updated Successfully");
			redirect(site_url().'/User');
		}
	}

	public function getexcel()
	{
	    $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('users')->result_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage User';
		$data['details'] = $this->db->get('users')->result_array();
// 		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/template/getexcel',$data);
// 		$this->load->view('admin/includes/footer');

	}





	public function getpdf()
	{
	     $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('users')->result_array();

        $this->load->library('Pdf');
        $this->load->view('admin/user/template/getpdf',$data);

	}

}
