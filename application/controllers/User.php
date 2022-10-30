<?php
defined('BASEPATH') OR exit('No direct script access allowed');
USE Kreait\Firebase\Configuration;
USE Kreait\Firebase\Firebase;
USE Kreait\Firebase\Database;
class User extends CI_Controller {

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
		$config["base_url"] = site_url()."/User/manage";
		$coutData = $this->db->from("users")->count_all_results();
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
		$data['details'] = $this->db->query("select * from users order by id desc limit $npage,$p")->result_array();
		$segMent = $this->uri->segment(3);
		if(!empty($segMent)){
			$multiPly = ($segMent * 10) - 9;
			$data['segmentCount'] = $multiPly;
		}
		else{
			$data['segmentCount'] = 1;
		}
		$data['active'] = 'user';
		$data['title'] = 'Manage User';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/manage');
		$this->load->view('admin/includes/footer');
	}


	public function hotListUser(){
	$config["base_url"] = site_url()."/User/hotListUser";
  $coutData = $this->db->get_where('users',array('hotlist' => '1'))->num_rows();

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
		$data['details'] = $this->db->query("select * from users where hotlist = '1'  order by id desc limit $npage,$p")->result_array();
		$data['active'] = 'hotlist';
		$data['title'] = 'HotList User';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/hotListUser');
		$this->load->view('admin/includes/footer');
	}


	public function liveUser(){
		$config["base_url"] = site_url()."/User/liveUser";
		$coutData = $this->db->from("userLive")->count_all_results();
    $config["total_rows"] = $coutData;
    $config["per_page"] = 25;
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
    $npage =  ($page-1)*25;
    $data["links"] = $this->pagination->create_links();
    $p = $config["per_page"];
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->query("select users.name,users.username,users.email,users.image,users.phone,userLive.* from userLive left join users on users.id = userLive.userId order by userLive.status DESC,userLive.created desc limit $npage,$p")->result_array();
		$data['active'] = 'liveuser';
		$data['title'] = 'Manage Live User';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/LiveUser');
		$this->load->view('admin/includes/footer');
	}


	public function archivedLiveUser(){
		$userLiveInfo = $this->db->get_where('userLive',array('id' => $this->uri->segment(3)))->row_array();
		$userInfo = $this->db->get_where('users',array('id' => $userLiveInfo['userId']))->row_array();
		$up['status'] = 'archived';
		$up['archivedDate'] = date('Y-m-d H:i:s');
		$update = $this->db->update('userLive',$up,array('id'=>$this->uri->segment(3)));

		require APPPATH.'/libraries/firebase/vendor/autoload.php';
		$config = new Configuration();
		$config->setFirebaseSecret('xZSLXu4HtKyNd2MVMofuuV2tRxrAtjKzm3OId0SX');
		$firebase = new Firebase('https://talvido-7f0bc.firebaseio.com/', $config);
		$userId = $userInfo['username'];
		$firebase->set([
				'liveStatus' => false,
				'statusLive' => "0",
		], 'users/'.$userId);
		$this->session->set_flashdata('success', "Status Updated Successfully");
		redirect(site_url().'/User/liveUser');
	}

	public function getResult(){
    	$start = $this->input->post('s');
    	$end = $this->input->post('e');
    	$pname = $this->input->post('p');
    	$admin_details = $this->session->userdata('admin_details');
		$admin = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin = $admin_details['admin_id'];
		if(!empty($end) && !empty($pname) && !empty($start)){
           	$data=$this->db->query("SELECT * from users where created between '$start' and '$end' and username like '%$pname%' or name like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
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
            $data=$this->db->query("SELECT * from users where username like'%$pname%' or name like '%$pname%' or email like '%$pname%' or phone like '%$pname%' order by id desc")->result_array();
              exit(json_encode($data));
        }else{
        	$data=$this->db->query("SELECT * from users order by id desc")->result_array();
            exit(json_encode($data));
        }
    }

    public function addHotList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'addHotUser';
		$data['title'] = "Add Hotlist User";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/user/addHotList');
				$this->load->view('admin/includes/footer');
			}else{
				$checkuser = $this->db->get_where('users',array('username' => $this->input->post('username')))->row_array();
				if(!empty($checkuser)){
					$upStatus['hotlist'] = '1';
					$update = $this->db->update('users',$upStatus,array('id'=>$checkuser['id']));
					if($update){
						$this->session->set_flashdata('success', "Hotlist added Successfully");
						redirect(site_url().'/User/hotListUser');
					}
				}
				else{
					$this->session->set_flashdata('success', "Please enter valid Username");
					redirect(site_url().'/User/addHotList');
				}
			}
		}else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/user/addHotList');
			$this->load->view('admin/includes/footer');
		}
	}

	public function updateHotListStatus(){
		$userId = $this->input->post('userId');
		$upStatus['hotlist'] = $this->input->post('status');
		$this->db->update('users',$upStatus,array('id'=>$userId));
		echo 1;

	}


	public function updateLiveHotlistStatus(){
		$userId = $this->input->post('userId');
		$upStatus['liveHotlist'] = $this->input->post('status');
		$upStatus['liveHostListDateTime'] = date('Y-m-d H:i:s');
		$this->db->update('users',$upStatus,array('id'=>$userId));
		echo 1;

	}

	public function graphResult($date){

			if (!empty($date)){
					$results['details']=$this->db->query("SELECT users.*, count(userVideos.id) as totalVideos,sum(userVideos.likeCount) as totalLikeCount, sum(userVideos.commentCount) as totalCommentCount, sum(userVideos.viewCount) as totalViewCount FROM `users` LEFT JOIN userVideos ON userVideos.userId = users.id where date(users.created) = '$date' group by users.id ORDER BY users.id DESC")->result_array();
					$admin_details = $this->session->userdata('admin_details');
					$results['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

					$results['active'] = 'user';
					$results['title'] = 'Manage User';

					$this->load->view('admin/includes/header',$results);
					$this->load->view('admin/user/manage');
					$this->load->view('admin/includes/footer');

			}
	}

	public function followGraph($username){
			if (!empty($username)){
					$added = substr_replace($username,'@',0,0);
					$user_id = $this->db->query("select id from users where username = '$added'")->row_array();
					$id = $user_id['id'];
					$results['details'] = $this->db->query("select users.*,count(userVideos.id) as totalVideos,sum(userVideos.likeCount) as totalLikeCount, sum(userVideos.commentCount) as totalCommentCount, sum(userVideos.viewCount) as totalViewCount from userFollow left join users on userFollow.userId = users.id left join userVideos on userVideos.userId = users.id where userFollow.followingUserId = $id and userFollow.status = '1' group by users.id")->result_array();

					$admin_details = $this->session->userdata('admin_details');
					$results['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

					$results['active'] = 'user';
					$results['title'] = 'Manage User';

					$this->load->view('admin/includes/header',$results);
					$this->load->view('admin/user/manage');
					$this->load->view('admin/includes/footer');

			}

	}

	public function blockGraph($username){

			if (!empty($username)){
					$added = substr_replace($username,'@',0,0);
					$user_id = $this->db->query("select id from users where username = '$added'")->row_array();
					$id = $user_id['id'];
					$results['details'] = $this->db->query("select users.* from blockUser left join users on blockUser.userId = users.id where blockUser.blockUserId = $id")->result_array();

					$admin_details = $this->session->userdata('admin_details');
					$results['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

					$results['active'] = 'user';
					$results['title'] = 'Manage User';

					$this->load->view('admin/includes/header',$results);
					$this->load->view('admin/user/manage');
					$this->load->view('admin/includes/footer');

			}

	}

// 	public function addUser(){
// 		$admin_details = $this->session->userdata('admin_details');
// 		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
// 		$data['active'] = 'addUser';
// 		$data['title'] = "Add User";
// 		if($this->input->post()){
// 			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
// 			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
// 			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_unique[users.phone]');
// 			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');
// 			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
// 			if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
// 				$this->form_validation->set_rules('image', 'Picture', 'required');
// 			}
// 			if($this->form_validation->run() == FALSE){
// 				$this->load->view('admin/includes/header',$data);
// 				$this->load->view('admin/user/add');
// 				$this->load->view('admin/includes/footer');
// 			}else{
// 				$details['username'] = $this->input->post('username');
// 				$details['email'] = $this->input->post('email');
// 				$details['phone'] = $this->input->post('phone');
// 				$details['password'] = md5($this->input->post('password'));
// 				$details['status'] = "Approved";
// 				$details['created'] = date('Y-m-d H:i:s');
// 				if(!empty($_FILES["image"]["name"])){
// 					$name= time().'_'.$_FILES["image"]["name"];
// 					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
// 					$error=$_FILES["image"]["error"];
// 					$liciense_path='uploads/users/'.$name;
// 					move_uploaded_file($liciense_tmp_name,$liciense_path);
// 					$details['image']= $liciense_path;
// 				}
// 				$insert = $this->Common_model->insert_data($details,'users');
// 				if($insert){
// 					$this->session->set_flashdata('success', "User added Successfully");
// 					redirect(site_url().'/User/manage');
// 				}
// 			}
// 		}else{
// 			$this->load->view('admin/includes/header',$data);
// 			$this->load->view('admin/user/add');
// 			$this->load->view('admin/includes/footer');
// 		}
// 	}


	public function view(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "View User";
		$data['details'] = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
		$data['followingList'] = $this->db->get_where('userFollow',array('userId' => $this->uri->segment(3),'status' => '1'))->num_rows();
		$data['followList'] = $this->db->get_where('userFollow',array('followingUserId' => $this->uri->segment(3),'status' => '1'))->num_rows();
		$data['info'] = $this->db->get_where('userProfileInformation',array('userId' => $this->uri->segment(3)))->row_array();
		$data['countVideoComLike'] = $this->Common_model->countVideoComLike($this->uri->segment(3));
		$userId = $this->uri->segment(3);
		$checkDeviceStatus = $this->db->get_where('blockDeviceId',array('deviceId' => $data['details']['deviceId']))->row_array();
		if(!empty($checkDeviceStatus)){
			$data['deviceBlockStatus'] = 1;
		}
		else{
			$data['deviceBlockStatus'] = 0;
		}
		$data['blockUserCount'] = $this->db->query("SELECT count(id) as blockUserCount FROM blockUser where userId = $userId and blockUserId != $userId")->row_array();
		$data['hastTagCount'] = $this->db->query("SELECT count(id) as idCount FROM favouriteHashTagList where userId = $userId and status = '1'")->row_array();
		$data['soundCount'] = $this->db->query("SELECT count(id) as idCount FROM favouriteSoundList where userId = $userId and status = '1'")->row_array();
		$data['badgesList'] = $this->db->get_where('badges')->result_array();
		$data['corwnList'] = $this->db->get_where('crown')->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/view');
		$this->load->view('admin/includes/footer');;
	}

	public function removeDp(){
		 $userId = $this->uri->segment(3);
		 $data['image'] = '';
		 $userDetails = $this->db->get_where('users',array('id' => $userId))->row_array();
		 if(!empty($userDetails['image'])){

			 $removeDp = $this->db->update('users',$data,array('id' => $userId));
			 if(!empty($removeDp)){
				 $details['userId'] = $userId;
				 $details['startTime'] = date('Y-m-d H:i:s');
				 $strtTime = $details['startTime'];
				 $details['endTime'] = date('Y-m-d', strtotime($strtTime. ' + 10 days'));
				 $insert = $this->db->insert('dpRemove',$details);
				 if($insert){
					 $this->session->set_flashdata('success', "User Dp Removed Successfully");
					 redirect(site_url().'/User/view/'.$this->uri->segment(3));
				 }

		 }
	 }
	 else{
		 $this->session->set_flashdata('error', "Dp already removed");
			redirect(site_url().'/User/view/'.$this->uri->segment(3));
	 }
	}

	public function favHashTag(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Favourite Hastag List";
		$data['mainId'] = $this->uri->segment(3);
		$userId = $this->uri->segment(3);
		$data['details'] = $this->db->query("select hashtag.hashtag,hashtag.id as hashtagId,favouriteHashTagList.created as hashtagCreated from hashtag left join favouriteHashTagList on favouriteHashTagList.hashtagId = hashtag.id where favouriteHashTagList.userId = $userId and favouriteHashTagList.status = '1'")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/favHashtag');
		$this->load->view('admin/includes/footer');
	}

	public function favSound(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Favourite Sound List";
		$data['mainId'] = $this->uri->segment(3);
		$userId = $this->uri->segment(3);
		$data['details'] = $this->db->query("SELECT sounds.*,favouriteSoundList.created as soundCreated from sounds left join favouriteSoundList on favouriteSoundList.soundId = sounds.id where favouriteSoundList.userId = $userId and favouriteSoundList.status = '1'")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/favSound');
		$this->load->view('admin/includes/footer');
	}

	public function blockUserList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Block User List";
		$data['mainId'] = $this->uri->segment(3);
		$userId = $this->uri->segment(3);
		$data['details'] = $this->db->query("select users.username,users.name,users.email,users.image,users.phone,blockUser.blockUserId,blockUser.created as blockCreated FROM users left join blockUser on blockUser.blockUserId = users.id where blockUser.userId = $userId and blockUser.blockUserId != $userId")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/blockUserList');
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

	public function videoList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Video List";
		$data['mainId'] = $this->uri->segment(3);
		$userId = $this->uri->segment(3);
		$videoList = $this->db->query("SELECT sounds.title as soundTitle,sounds.id as soundId, sounds.sound as soundFile,userVideos.id, userVideos.userId, userVideos.hashtag, userVideos.description, userVideos.videoPath, userVideos.allowComment, userVideos.allowDownloads, userVideos.viewVideo, userVideos.viewCount, userVideos.likeCount, userVideos.commentCount FROM `userVideos` left join sounds on sounds.id = userVideos.soundId  where userVideos.userId = $userId ORDER BY userVideos.viewCount desc,userVideos.likeCount desc,userVideos.commentCount desc")->result_array();

		if(!empty($videoList)){
			foreach($videoList as $lists){
				if(!empty($lists['hashtag'])){
					$lists['hashtagTitle'] = $this->hashTagName($lists['hashtag']);
				}
				else{
					$lists['hashtagTitle'] = '';
				}
				$data['list'][] = $lists;
			}
		}
		else{
			$data['list'] = ' ';
		}
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/videoList');
		$this->load->view('admin/includes/footer');
	}

	public function likeList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Like List";
		$data['mainId'] = $this->uri->segment(3);
		$data['videoId'] = $this->uri->segment(4);
		$videoId = $this->uri->segment(4);
		$data['details'] = $this->db->query("SELECT users.username,users.image,users.name,users.email,users.phone,videoLikeOrUnlike.created as likeCreated from users left join videoLikeOrUnlike on videoLikeOrUnlike.userId = users.id where videoLikeOrUnlike.videoId = $videoId and videoLikeOrUnlike.status = '1'")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/likeUserList');
		$this->load->view('admin/includes/footer');
	}

	public function commentList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Comment List";
		$data['mainId'] = $this->uri->segment(3);
		$data['videoId'] = $this->uri->segment(4);
		$videoId = $this->uri->segment(4);
		$data['details'] = $this->db->query("SELECT users.username,users.image,users.name,users.email,users.phone,videoComments.comment,videoComments.created as commentCreated from users left join videoComments on videoComments.userId = users.id where videoComments.videoId = $videoId")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/commentUserList');
		$this->load->view('admin/includes/footer');
	}



	public function follwoList(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$userId = $this->uri->segment(3);
		if($this->uri->segment(4) == 'follower'){
			$data['title'] = "Follower List";
			$data['details'] = $this->db->query("SELECT users.id,users.username,users.name,users.email,users.image,users.phone from users left join userFollow on userFollow.userId = users.id where userFollow.followingUserId = $userId and userFollow.status = '1'")->result_array();
		}
		else{
			$data['title'] = "Following List";
			$data['details'] = $this->db->query("SELECT users.id,users.username,users.name,users.email,users.image,users.phone from users left join userFollow on userFollow.followingUserId = users.id where userFollow.userId = $userId and userFollow.status = '1'")->result_array();
		}
		$data['mainId'] = $userId;
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/followAndFollwerList');
		$this->load->view('admin/includes/footer');
	}


	public function updateUserIdBanUnbanStatus(){
		$id = $this->input->post('userId');
		$status = $this->input->post('status');
		$data['host_status'] = $status;
		$upd = $this->db->update('userLiveRequest',$data,array('id'=>$id));
		if(!empty($upd))
		{
		 echo 1;
		}
		else{
		 echo 0;
		}
	}
	
// 	public function active_status(){
// 		$check_status = $this->Common_model->get_data_by_id($this->input->post('table'),'id',$this->input->post('id'));
// 		if($check_status['host_status']=='1'){
// 			$data = array('active_status'=>'2');
// 		  }else{
// 		     	$data = array('active_status'=>'1');
// 		     }
// 	      	$update = $this->Common_model->update($this->input->post('table'),$data,'id',$this->input->post('id'));
// 	    	if($update){
// 			echo $data['active_status'];
// 		}
// 	}


	public function banDeviceId(){
		if($this->input->post('status') == 1){
			if(!empty($this->input->post('deviceId'))){
					$userInfo = $this->db->get_where('users',array('id' => $this->input->post('userId')))->row_array();
			    $registrationIds =  array($userInfo['reg_id']);
			    define('API_ACCESS_KEY', 'AAAA0WgbM-c:APA91bGsdT5rx9u_QmaG9cjyapHiAY6NrzMw_WbMXgEuQi0f7ZbZ6-GCQZUDU6PvHY52KBBYwqC_Dxc9a22la0ad84p1tblRcK2evrYM2ONKU-Oa0xuL9d9jgkMrTynDadMO2OL1VIJz');
			     $msg = array(
			       'message' 	=> 'Your Account is Blocked by Admin',
			       'title'		=> 'Talvido',
			       'type'		=> 'deviceBan',
			       'subtitle'	=> 'deviceBan',
			       'vibrate'	=> 1,
			       'sound'		=> 1,
			       'largeIcon'	=> 'large_icon',
			       'smallIcon'	=> 'small_icon',
			     );
			     $fields = array(
			       'registration_ids' 	=> $registrationIds,
			       'data'			=> $msg
			     );
			     $headers = array(
			       'Authorization: key=' . API_ACCESS_KEY,
			       'Content-Type: application/json'
			     );
			     $curl = curl_init();

			     curl_setopt_array($curl, array(
			       CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
			       CURLOPT_RETURNTRANSFER => true,
			       CURLOPT_CUSTOMREQUEST => "POST",
			       CURLOPT_POSTFIELDS => json_encode($fields),
			       CURLOPT_HTTPHEADER => $headers

			     ));

			     $response = curl_exec($curl);

					 // print_r($response);
					 // die;


			     $err = curl_error($curl);
			     curl_close($curl);



			     $notiMess['userId'] = $this->input->post('userId');
			     $notiMess['message'] = 'Your Account is Blocked by Admin';
			     $notiMess['type'] = 'deviceBan';
			     $notiMess['notiDate'] = date('Y-m-d');
			     $notiMess['created'] = date('Y-m-d H:i:s');
			     $this->db->insert('userNotification',$notiMess);


					 $data['deviceId'] = $this->input->post('deviceId');
 					$insert = $this->db->insert('blockDeviceId',$data);
				  echo 1;
				}
				else{
					echo 0;
				}
			}

		else{
			$delete = $this->db->delete('blockDeviceId',array('deviceId' => $this->input->post('deviceId')));
			if(!empty($delete))
			{
			 echo 1;
			}
			else{
			 echo 0;
			}
		}
	}

	public function userStatus(){

		 $id = $this->input->post('userId');
		 $status = $this->input->post('status');
		 $data['badge'] = $status;
		 $upd = $this->db->update('users',$data,array('id'=>$id));
		 if(!empty($upd))
		 {
			echo 1;
		 }
		 else{
						 echo 0;
		 }

	}

	public function crownStatusUpdate(){
		$id = $this->input->post('userId');
		$status = $this->input->post('status');
		$data['crown'] = $status;
		$upd = $this->db->update('users',$data,array('id'=>$id));
		if(!empty($upd))
		{
		 echo 1;
		}
		else{
						echo 0;
		}
	}

    public function userCondition(){

        $id = $this->input->post('userId');
        $status = $this->input->post('status');
        $data['liveStatus'] = $status;

        $upd = $this->db->update('users',$data,array('id'=>$id));

        if(!empty($upd))
        {
            echo 1;
        }
        else{
            echo 0;
        }

    }

	public function edit(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'user';
		$data['title'] = "Edit User";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$data['details'] = $this->db->get_where('users',array('id' => $this->uri->segment(3)))->row_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/user/edit');
				$this->load->view('admin/includes/footer');
			}else{
				$details1['username'] = $this->input->post('username');
				$details1['email'] = $this->input->post('email');
				$details1['phone'] = $this->input->post('phone');
				$details1['purchasedCoin'] = $this->input->post('purchasedCoin');
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
					redirect(site_url().'/User/manage');
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
		redirect(site_url().'/User/manage');
	}

	public function deletehotList(){
		$delete = $this->Common_model->delete('users','id',$this->uri->segment(3));
		redirect(site_url().'/User/hotListUser');
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
			redirect(site_url().'/User/manage');
		}
	}

	public function getexcel()
	{
	    $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('users')->result_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage User';
		// $data['details'] = $this->db->get('users')->result_array();
		$this->load->view('admin/user/template/getexcel',$data);

	}

    public function get_live_excel()
    {

			$config["base_url"] = site_url()."/User/get_live_excel";
			$coutData = $this->db->from("userLive")->count_all_results();
			$config["total_rows"] = $coutData;
			$config["per_page"] = 25;
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
			$npage =  ($page-1)*25;
			$data["links"] = $this->pagination->create_links();
			$p = $config["per_page"];
			$admin_details = $this->session->userdata('admin_details');
			$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
			$dates = explode('d',$this->uri->segment(4));
			$s_date = $dates['0'];
			$e_date = $dates['1'];

			if (!empty($s_date) and !empty($e_date)){
                $data['details'] = $this->db->query("select users.name,users.username,users.email,users.image,users.phone,userLive.* from userLive left join users on users.id = userLive.userId where date(userLive.created) between '$s_date' and '$e_date' order by userLive.status DESC,userLive.created desc")->result_array();

            }else {
                $data['details'] = $this->db->query("select users.name,users.username,users.email,users.image,users.phone,userLive.* from userLive left join users on users.id = userLive.userId order by userLive.status DESC,userLive.created desc limit $npage,$p")->result_array();
            }
			$this->load->view('admin/user/template/live_excel',$data);


    }

    public function get_excel()
    {
        $admin_details = $this->session->userdata('admin_details');
        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
        $data['details'] = $this->db->order_by('id','desc')->get('registerUserInfo')->result_array();
        $data['active'] = 'user';
        $data['title'] = 'Manage User';
       $data['details'] = $this->db->get('registerUserInfo')->result_array();
// 		$this->load->view('admin/includes/header',$data);
        $this->load->view('admin/user/template/verify_form_request',$data);
// 		$this->load->view('admin/includes/footer');

    }


	public function getpdf()
	{
		require APPPATH.'/libraries/tcpdf/tcpdf.php';
	    $admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->db->order_by('id','desc')->get_where('users')->result_array();

        $this->load->library('Pdf');
        $this->load->view('admin/user/template/getpdf',$data);

	}
	// public function getpdf()
	// {
	//     $admin_details = $this->session->userdata('admin_details');
	// 	$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
	// 	$data= $this->db->order_by('id','desc')->get_where('users')->result_array();
 //      	require APPPATH.'/libraries/tcpdf/tcpdf.php';
 //      	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 //      	$obj_pdf->SetCreator(PDF_CREATOR);
 //      	$obj_pdf->SetTitle("Zebolive");
 //      	$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
 //      	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
 //      	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 //      	$obj_pdf->SetDefaultMonospacedFont('helvetica');
 //      	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 //      	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
 //      	$obj_pdf->setPrintHeader(false);
 //      	$obj_pdf->setPrintFooter(false);
 //      	$obj_pdf->SetAutoPageBreak(TRUE, 10);
 //      	$obj_pdf->SetFont('helvetica', '', 11);
 //      	$obj_pdf->AddPage();
 //      	$content = '';
 //      	$content .= '
 //      	<table border="" cellspacing="0" cellpadding="3" style="font-size:8px;font-weight:bold">
 //      		<tr align="center">
 //        		<td><img src="'.base_url("uploads/logo/logo.png").'" style="width:100px;"></td>
 //      		</tr>
 //      	</table>
 //      	<h4 align="center">Restaurant List</h4><br />
 //      	<table border="" cellspacing="0" cellpadding="3" style="font-size:10px;font-weight:bold">
 //      		<tr align="right">
 //        		<td>Date :'.date('Y-m-d').'</td>
 //      		</tr>
 //      	</table>
 //      	<table border="1" cellspacing="0" cellpadding="3">
	//         <tr>
	//         	<th>Sr.</th>
	// 			<th>Username</th>
	// 			<th>Email</th>
	// 			<th>Phone</th>
 //            </tr>';
 //            $i = 1;
	//        	foreach($data as $datas){
 //           	$content .= '
 //            <tr>
 //                <td>'.$i.'</td>
	// 			<td> '.$data['username'].'</td>
	// 			<td> '.$data['email'].'</td>
	// 			<td>'.$data['phone'].'</td></tr>
 //            </tr>';
 //            $i++;
 //        }

 //      	$content .= '</table>';
 //      	$obj_pdf->writeHTML($content);
 //      	$obj_pdf->Output(date("Y-m-d H:i:s")."_report".'.pdf', 'I');

	// }


  public function userReport(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$todayDate = date('Y-m-d 00:00:00');
		$data['details'] = $this->db->order_by('id','desc')->get_where('users',array('created >=' => $todayDate))->result_array();
		$data['active'] = 'userreport';
		$data['title'] = 'Manage Report';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/report');
		$this->load->view('admin/includes/footer2');
	}

	public function search(){
		if ($this->input->post()){
					 $search_data = array(
							 'start'=>$this->input->post('startdate'),
							 'end'=>$this->input->post('enddate'),
							 'status'=>$this->input->post('status'),
							 'search' => $this->input->post('search')
					 );
					 $this->session->set_userdata($search_data);

			 }
		$todatDate = date('Y-m-d');
		$data['list'] = $this->Common_model->serchList($this->input->post('startdate'),$this->input->post('enddate'),$this->input->post('status'),$this->input->post('search'),$todatDate);
// 		echo $this->db->last_query(); die;
		$this->load->view('admin/user/template/report_search',$data);
	}



	public function getReportpdf()
	{
			$start = $this->session->userdata('start');
			$end = $this->session->userdata('end');
			$status = $this->session->userdata('status');
			$search = $this->session->userdata('search');
			$todatDate = date('Y-m-d');
 			$data['list'] = $this->Common_model->serchList($start,$end,$status,$search ,$todatDate);
		// $data['list'] = $this->Common_model->serchList($this->input->post('startdate'),$this->input->post('enddate'),$this->input->post('status'),$this->input->post('search'),$todatDate);
			// echo $this->db->last_query(); die;
        $this->load->library('Pdf');
        $this->load->view('admin/user/template/report_pdf',$data);

	}
	public function getReportexcel()
	{

		$start = $this->session->userdata('start');
		$end = $this->session->userdata('end');
		$status = $this->session->userdata('status');
		$search = $this->session->userdata('search');
		$todatDate = date('Y-m-d');
	  $data['list'] = $this->Common_model->serchList($start,$end,$status,$search ,$todatDate);
		// $data['list'] = $this->Common_model->serchList($this->input->post('startdate'),$this->input->post('enddate'),$this->input->post('status'),$this->input->post('search'),$todatDate);

		$this->load->view('admin/user/template/getexcel',$data);

	}

  public function emailTesting(){
		$this->load->library('Phpmailer_lib');
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
       $mail->Username = 'nitish.infosif@gmail.com';
        $mail->Password = 'infosif123456';
        $mail->SMTPSecure = 'tls';
		$mail->Port = 587;
        $mail->setfrom('nitish.infosif@gmail.com', 'Email Testing');
        //$mail->addreplyto('info@example.com', 'CodexWorld');
        // Add a recipient
        $mail->addAddress('nitish.infosif@gmail.com');
        // Add cc or bcc
        // $mail->addcc('cc@example.com');
        // $mail->addbcc('bcc@example.com');
        // Email subject
        $mail->Subject = 'Response regarding your query';
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = '<h1>Response:</h1>
            <p>Hello Team</p>';
        $mail->Body = $mailContent;
        // Send email
        if(!$mail->send()){
             echo 'Message could not be sent.';
						 echo "<br>";
             echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
	}

	public function message(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'sendmessage';
		$data['title'] = "Send Message";
	 if($this->input->post()){
		 $this->form_validation->set_rules('usertype', 'User type', 'required');
		 $this->form_validation->set_rules('message', 'Message', 'trim|required');
		 if($this->form_validation->run() == FALSE){
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/user/message');
			$this->load->view('admin/includes/footer');
		}
		else{
			$details['user_type'] = $this->input->post('usertype');
			$details['user_name'] = $this->input->post('username');
			$details['message'] = $this->input->post('message');
			$details['created'] = date('Y-m-d H:i:s');

			if($this->input->post('usertype') == 1){
				$userData= $this->db->get('users')->result_array();
				foreach ($userData as $userDatas) {
					$registrationIds[] = $userDatas['reg_id'];
				}

				define('API_ACCESS_KEY', 'AAAA0WgbM-c:APA91bGsdT5rx9u_QmaG9cjyapHiAY6NrzMw_WbMXgEuQi0f7ZbZ6-GCQZUDU6PvHY52KBBYwqC_Dxc9a22la0ad84p1tblRcK2evrYM2ONKU-Oa0xuL9d9jgkMrTynDadMO2OL1VIJz');

				$msg = array
				(
					'message' 	=> $this->input->post('message'),
					'title'		=> 'Talvido',
					'subtitle'	=> 'Talvido',
					'vibrate'	=> 1,
					'sound'		=> 1,
					'largeIcon'	=> 'large_icon',
					'smallIcon'	=> 'small_icon',
					'type' => 'video'
				);

				$fields = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);

				$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);

				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				// echo '<pre>';
				// 	print_r($result);
				// 	die;
				curl_close( $ch );

				$this->Common_model->insert_data($details,'pushMessage');

				foreach ($userData as $userDatass) {
					$notiDetails['userId'] = $userDatass['id'];
					$notiDetails['adminId'] = $data['admin']['id'];
					$notiDetails['message'] = $this->input->post('message');
					$notiDetails['type'] = 'pushNotification';
					$notiDetails['notiDate'] = date('Y-m-d');
					$notiDetails['created'] = date('Y-m-d H:i:s');
					$insert = $this->Common_model->insert_data($notiDetails,'userNotification');
				}
				if($insert){
					   $this->session->set_flashdata('success',"notification sent succssfully");
				}

			}
			else{
				$userData= $this->db->get_where('users',array('username'=>$this->input->post('username')))->row_array();
				if(!empty($userData)){
					$registrationIds = array($userData['reg_id']);


//pushNotification



						define('API_ACCESS_KEY', 'AAAA0WgbM-c:APA91bGsdT5rx9u_QmaG9cjyapHiAY6NrzMw_WbMXgEuQi0f7ZbZ6-GCQZUDU6PvHY52KBBYwqC_Dxc9a22la0ad84p1tblRcK2evrYM2ONKU-Oa0xuL9d9jgkMrTynDadMO2OL1VIJz');
					$msg = array
					(
						'message' 	=> $this->input->post('message'),
						'title'		=> 'Talvido',
						'subtitle'	=> 'Talvido',
						'vibrate'	=> 1,
						'sound'		=> 1,
						'largeIcon'	=> 'large_icon',
						'smallIcon'	=> 'small_icon',
						'type' => 'video'

					);

					$fields = array
					(
						'registration_ids' 	=> $registrationIds,
						'data'			=> $msg
					);

					$headers = array
					(
						'Authorization: key=' . API_ACCESS_KEY,
						'Content-Type: application/json'
					);

					$ch = curl_init();
					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
					curl_setopt( $ch,CURLOPT_POST, true );
					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
					$result = curl_exec($ch );

					curl_close( $ch );

					$this->Common_model->insert_data($details,'pushMessage');
					$notiDetails['userId'] = $userData['id'];
					$notiDetails['adminId'] = $data['admin']['id'];
					$notiDetails['message'] = $this->input->post('message');
					$notiDetails['type'] = 'pushNotification';
					$notiDetails['notiDate'] = date('Y-m-d');
					$notiDetails['created'] = date('Y-m-d H:i:s');
					$insert = $this->Common_model->insert_data($notiDetails,'userNotification');
					if($insert){
							 $this->session->set_flashdata('success',"notification sent succssfully");
					}
				}
				else{
					$this->session->set_flashdata('error', "Please enter valid Username");
					redirect(site_url().'/User/message');
				}
			}
			if($insert){
				$this->session->set_flashdata('success', "Message sent Successfully");
				redirect(site_url().'/User/message');
			}
		}
	 }
	 else{
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/message');
		$this->load->view('admin/includes/footer');
	 }

}



	public function verifyAccount(){
		$config["base_url"] = site_url()."/User/verifyAccount";
		$coutData = $this->db->from("registerUserInfo")->count_all_results();
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
		$data['details'] = $this->db->query("select * from registerUserInfo order by id desc limit $npage,$p")->result_array();
		$data['active'] = 'verifyUser';
		$data['title'] = 'Manage Verify User';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/verifyAccount');
		$this->load->view('admin/includes/footer');
	}

	public function viewVerify(){
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['active'] = 'verifyUser';
		$data['title'] = "View Verify User Details";
		$verifyInfo = $this->db->get_where('registerUserInfo',array('id' => $this->uri->segment(3)))->row_array();
		$data['details'] = $verifyInfo;
		$data['userInfo'] = $this->db->get_where('users',array('id' => $verifyInfo['userId']))->row_array();
		$userId = $this->uri->segment(3);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/viewVerify');
		$this->load->view('admin/includes/footer');
	}

	public function sendGiftHistory(){
		$userId = $this->uri->segment(3);
		$config["base_url"] = site_url()."/User/sendGiftHistory/".$this->uri->segment(3);
		$coutData = $this->db->get_where("userGiftHistory",array('userId' => $userId))->num_rows();
		$data['countList'] = $coutData;
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
		$data['details'] = $this->db->query("select users.username,users.name,users.image,gift.title as giftTitle,gift.image as giftImage,userGiftHistory.* from userGiftHistory left join users on users.id = userGiftHistory.giftUserId left join gift on gift.id = userGiftHistory.giftId where userGiftHistory.userId = $userId  order by userGiftHistory.id desc limit $npage,$p")->result_array();
		$data['totalCoin'] = $this->db->query("select sum(coin) as totalCoin from userGiftHistory where userId = $userId")->row_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage Send Gift History';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/manageSendGiftHistory');
		$this->load->view('admin/includes/footer');
	}

	public function giftHistory(){
		$userId = $this->uri->segment(3);
		$config["base_url"] = site_url()."/User/giftHistory/".$this->uri->segment(3);
		$coutData = $this->db->get_where("userGiftHistory",array('giftUserId' => $userId))->num_rows();
		$data['countList'] = $coutData;
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
		$data['details'] = $this->db->query("select users.username,users.name,users.image,gift.title as giftTitle,gift.image as giftImage,userGiftHistory.* from userGiftHistory left join users on users.id = userGiftHistory.userId left join gift on gift.id = userGiftHistory.giftId where userGiftHistory.giftUserId = $userId  order by userGiftHistory.id desc limit $npage,$p")->result_array();
		$data['totalCoin'] = $this->db->query("select sum(coin) as totalCoin from userGiftHistory where giftUserId = $userId")->row_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage Recived Gift History';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/manageGiftHistory');
		$this->load->view('admin/includes/footer');
	}

	public function purchaseCoinHistory(){
		$userId = $this->uri->segment(3);
		$config["base_url"] = site_url()."/User/purchaseCoinHistory/".$this->uri->segment(3);
		$coutData = $this->db->get_where("userCoinHistory",array('userId' => $userId))->num_rows();
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
		$data['details'] = $this->db->query("select * from userCoinHistory where userId = $userId order by id desc limit $npage,$p")->result_array();
		$data['totalCoin'] = $this->db->query("select sum(coin) as totalCoin,sum(coinPrice) as totalCoinPrice from userCoinHistory where userId = $userId")->row_array();
		$data['active'] = 'user';
		$data['title'] = 'Manage Purchased Coin History';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/managePurchaseCoinHistory');
		$this->load->view('admin/includes/footer');
	}

	public function UserLiveHistory(){
        $id = $this->uri->segment(3);
        $config["base_url"] = site_url()."/User/UserLiveHistory/$id";
        $coutData = $this->db->from("userLive")->where("userLive.userId = $id")->count_all_results();
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
        $id = $this->uri->segment(3);
        $data['details'] = $this->db->query("select * from userLive where userId ='$id' limit $npage,$p")->result_array();
        //echo $this->db->last_query();die;
        $data['active'] = 'user';
        $data['title'] = 'Manage Live User';
        $this->load->view('admin/includes/header',$data);
        $this->load->view('admin/user/Userlivehistory');
        $this->load->view('admin/includes/footer');
    }



	public function viewWheel(){
		$data['active'] = 'viewWheel';
		$data['title'] = 'Wheel History';
		$config["base_url"] = site_url()."/User/viewWheel";
		$coutData = $this->db->get_where("wheelHistory")->num_rows();
		$data['countList'] = $coutData;
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
		$data['details'] = $this->db->query("select users.name, users.email, users.username, wheelHistory.* from wheelHistory left join users on users.id = wheelHistory.userId limit $npage,$p")->result_array();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/wheelHistory/viewWheel');
		$this->load->view('admin/includes/footer');

	}


	public function liveRequest(){
		$config["base_url"] = site_url()."/User/liveRequest";
		$coutData = $this->db->from("userLiveRequest")->count_all_results();
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
		$data['details'] = $this->db->query("SELECT users.username,users.name,users.phone,users.image,userLiveRequest.* FROM `userLiveRequest` left join users on users.id = userLiveRequest.userId order by userLiveRequest.id desc limit $npage,$p")->result_array();
		$segMent = $this->uri->segment(3);
		if(!empty($segMent)){
			$multiPly = ($segMent * 10) - 9;
			$data['segmentCount'] = $multiPly;
		}
		else{
			$data['segmentCount'] = 1;
		}
		$data['active'] = 'liveRequest';
		$data['title'] = 'Manage Live Request';
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/liveRequest');
		$this->load->view('admin/includes/footer');
	}


	public function approveLiveRequest(){
		$data['liveStatus'] = '1';
		$update = $this->db->update('users',$data,array('id'=>$this->uri->segment(3)));
		$this->db->delete('userLiveRequest',array('userId' => $this->uri->segment(3)));
		$this->session->set_flashdata('success', "Live Request Approved Successfully");
		redirect(site_url().'/User/liveRequest');
	}

	public function rejectLiveRequest(){
		$this->db->delete('userLiveRequest',array('userId' => $this->uri->segment(3)));
		$this->session->set_flashdata('success', "Live Request Rejected Successfully");
		redirect(site_url().'/User/liveRequest');
	}


}
