<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends Ci_Controller{

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

    public function manageLevels(){
        $config["base_url"] = site_url()."/Level/manageLevels";
        $coutData = $this->db->from("leval")->count_all_results();
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

        $data['details'] = $this->db->query("select * from leval order by id desc limit $npage,$p")->result_array();

        $data['active'] = 'viewlevel';

        $data['title'] = 'View Levels';

        $this->load->view('admin/includes/header',$data);

        $this->load->view('admin/Level/managelevel');


        $this->load->view('admin/includes/footer');

    }


    public function addLevel(){

        $admin_details = $this->session->userdata('admin_details');
        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
        $data['active'] = 'addlevel';
        $data['title'] = "Add Level";
        if($this->input->post()){

            $this->form_validation->set_rules('level', 'Level', 'trim|required');
            $this->form_validation->set_rules('expCount', 'ExpCount', 'trim|required');
            $this->form_validation->set_rules('color', 'Color', 'trim|required');

            if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
                $this->form_validation->set_rules('image', 'Icon', 'required');
            }

            if(empty($_FILES["sound"]["name"]) || $_FILES["sound"]["name"] == ""){
                $this->form_validation->set_rules('sound', 'Icon', 'required');
            }
            if($this->form_validation->run() == FALSE){
                $this->load->view('admin/includes/header',$data);
                $this->load->view('admin/Level/addlevel');
                $this->load->view('admin/includes/footer');
            }else{

                $details['leval'] = $this->input->post('level');
                $details['expCount'] = $this->input->post('expCount');
                $details['color'] = $this->input->post('color');
               // $details['created'] = date('Y-m-d H:i:s');
                if(!empty($_FILES["image"]["name"])){
                    $name= time().'_'.$_FILES["image"]["name"];
                    $liciense_tmp_name=$_FILES["image"]["tmp_name"];
                    $error=$_FILES["image"]["error"];
                    $liciense_path='uploads/users/'.$name;
                    move_uploaded_file($liciense_tmp_name,$liciense_path);
                    $details['image']= $liciense_path;
                }

                if(!empty($_FILES["sound"]["name"])){
                    $name= time().'_'.$_FILES["sound"]["name"];
                    $liciense_tmp_name=$_FILES["sound"]["tmp_name"];
                    $error=$_FILES["sound"]["error"];
                    $liciense_path='uploads/users/'.$name;
                    move_uploaded_file($liciense_tmp_name,$liciense_path);
                    $details['sound']= $liciense_path;
                }
                $insert = $this->Common_model->insert_data($details,'leval');
                if($insert){

                    $this->session->set_flashdata('success', "Level added Successfully");

                    redirect(site_url().'/Level/managelevels');

                }
            }
        }else{
            $this->load->view('admin/includes/header',$data);
            $this->load->view('admin/Level/addlevel');
            $this->load->view('admin/includes/footer');
        }
    }

    public function editLevel(){

        $admin_details = $this->session->userdata('admin_details');

        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

        $data['active'] = 'viewlevel';

        $data['title'] = "Edit Level";

        if($this->input->post()){



            $this->form_validation->set_rules('level', 'Level', 'trim|required');
            $this->form_validation->set_rules('expCount', 'ExpCount', 'trim|required');
            $this->form_validation->set_rules('color', 'Color', 'trim|required');

            // if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
            //     $this->form_validation->set_rules('image', 'Icon', 'required');
            // }
            //
            // if(empty($_FILES["sound"]["name"]) || $_FILES["sound"]["name"] == ""){
            //     $this->form_validation->set_rules('sound', 'Icon', 'required');
            // }

            if($this->form_validation->run() == FALSE){

                $data['details'] = $this->db->get_where('leval',array('id' => $this->uri->segment(3)))->row_array();

                $this->load->view('admin/includes/header',$data);

                $this->load->view('admin/Level/editlevel');

                $this->load->view('admin/includes/footer');

            }else{

                $details1['leval'] = $this->input->post('level');
                $details1['expCount'] = $this->input->post('expCount');
                $details1['color'] = $this->input->post('color');
                // $details['created'] = date('Y-m-d H:i:s');
                if(!empty($_FILES["image"]["name"])){
                    $name= time().'_'.$_FILES["image"]["name"];
                    $liciense_tmp_name=$_FILES["image"]["tmp_name"];
                    $error=$_FILES["image"]["error"];
                    $liciense_path='uploads/users/'.$name;
                    move_uploaded_file($liciense_tmp_name,$liciense_path);
                    $details1['image']= $liciense_path;
                }

                if(!empty($_FILES["sound"]["name"])){
                    $name= time().'_'.$_FILES["sound"]["name"];
                    $liciense_tmp_name=$_FILES["sound"]["tmp_name"];
                    $error=$_FILES["sound"]["error"];
                    $liciense_path='uploads/users/'.$name;
                    move_uploaded_file($liciense_tmp_name,$liciense_path);
                    $details1['sound']= $liciense_path;
                }

                $update = $this->Common_model->update('leval',$details1,'id',$this->input->post('id'));

                if($update){

                    $this->session->set_flashdata('success', "Level Updated Successfully");

                    redirect(site_url().'/Level/managelevels');

                }

            }

        }else{

            $data['details'] = $this->db->get_where('leval',array('id' => $this->uri->segment(3)))->row_array();

            $this->load->view('admin/includes/header',$data);

            $this->load->view('admin/Level/editlevel');

            $this->load->view('admin/includes/footer');

        }

    }

    public function delete(){

        $delete = $this->Common_model->delete('leval','id',$this->uri->segment(3));

        if($delete){

            $this->session->set_flashdata('success',"Level Deleted Successfully");
            redirect(site_url().'/Level/managelevels');

        }

    }

    public function status(){

        $details = $this->db->get_where('leval',array('id' => $this->uri->segment(3)))->row_array();

        if($details['status'] == '1'){

            $data['status'] = '0';

        }

        else{

            $data['status'] = '1';

        }

        $update = $this->Common_model->update('leval',$data,'id',$this->uri->segment(3));

        if($update){

            $this->session->set_flashdata('success', "Level Status Updated Successfully");

            redirect(site_url().'/Level/managelevels');

        }

    }





}




?>
