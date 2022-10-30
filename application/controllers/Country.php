<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Country extends CI_Controller {



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
        $config["base_url"] = site_url()."/Country/manage";
        $coutData = $this->db->from("getCountryFlags")->count_all_results();
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

        $data['details'] = $this->db->query("select * from getCountryFlags order by id desc limit $npage,$p")->result_array();

        $data['active'] = 'GetCountry';

        $data['title'] = 'Manage Country Flags';

        $this->load->view('admin/includes/header',$data);

        $this->load->view('admin/Country/manage');

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
            $data=$this->db->query("SELECT * from Gems where created between '$start' and '$end' and title like '%$pname%' or count like '%$pname%' or price like '%$pname%' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($start) && !empty($end)){
            $data=$this->db->query("SELECT * from Gems where created between '$start' and '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($start) && !empty($pname)){
            $data=$this->db->query("SELECT * from Gems where created = '$start' and title like '%$pname%' or count like '%$pname%' or price like '%$pname%' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($end) && !empty($pname)){
            $data=$this->db->query("SELECT * from Gems where created = '$end' and title like '%$pname%' or conut like '%$pname%' or price like '%$pname%' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($start)){
            $data=$this->db->query("SELECT * from Gems where created = '$start' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($end)){
            $data=$this->db->query("SELECT * from Gems where created = '$end' order by id desc")->result_array();
            exit(json_encode($data));
        }elseif(!empty($pname)){
            $data=$this->db->query("SELECT * from Gems where title like'%$pname%' or count like '%$pname%' or price like '%$pname%' order by id desc")->result_array();
            exit(json_encode($data));
        }else{
            $data=$this->db->query("SELECT * from Gems order by id desc")->result_array();
            exit(json_encode($data));
        }
    }

    public function add(){

        $admin_details = $this->session->userdata('admin_details');

        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

        $data['country'] = $this->db->query("select * from countries")->result_array();


        $data['active'] = 'addCountry';

        $data['title'] = "Add New Country Flag";


        if($this->input->post()){

            $this->form_validation->set_rules('countryname', 'Country Name', 'trim|required');

            if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
                $this->form_validation->set_rules('image', 'Picture', 'required');
            }

            if($this->form_validation->run() == FALSE){

                $this->load->view('admin/includes/header',$data);

                $this->load->view('admin/Country/add');

                $this->load->view('admin/includes/footer');

            }else{
                $id = $this->input->post(countryname);

                $country1 = $this->db->query("select * from countries where id='$id'")->row_array();

                $details['countryCode'] = '+'.$country1['phonecode'];

                $details['countryName'] = $country1['name'];


                if(!empty($_FILES["image"]["name"])){

                    $name= time().'_'.$_FILES["image"]["name"];

                    $liciense_tmp_name=$_FILES["image"]["tmp_name"];

                    $error=$_FILES["image"]["error"];

                    $liciense_path='uploads/users/'.$name;

                    move_uploaded_file($liciense_tmp_name,$liciense_path);

                    $details['image']= $liciense_path;

                }

                $insert = $this->Common_model->insert_data($details,'getCountryFlags');

                if($insert){

                    $this->session->set_flashdata('success', "Country Flag added Successfully");

                    redirect(site_url().'/Country/manage');

                }

            }

        }else{

            $this->load->view('admin/includes/header',$data);

            $this->load->view('admin/Country/add');

            $this->load->view('admin/includes/footer');

        }

    }





    public function edit(){

        $admin_details = $this->session->userdata('admin_details');

        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

        $data['active'] = 'GetCountry';

        $data['title'] = "Edit Country Flag";

        $data['country11'] = $this->db->query("select * from countries")->result_array();


        if($this->input->post()){

            $this->form_validation->set_rules('countryname', 'Country Name', 'trim|required');

            if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
                $this->form_validation->set_rules('image', 'Picture', 'required');
            }

            if($this->form_validation->run() == FALSE){

                $this->load->view('admin/includes/header',$data);

                $this->load->view('admin/Country/edit');

                $this->load->view('admin/includes/footer');

            }else{
                $id = $this->input->post(countryname);

                $country1 = $this->db->query("select * from countries where id='$id'")->row_array();

                $details1['countryCode'] = '+'.$country1['phonecode'];

                $details1['countryName'] = $country1['name'];


                if(!empty($_FILES["image"]["name"])){

                    $name= time().'_'.$_FILES["image"]["name"];

                    $liciense_tmp_name=$_FILES["image"]["tmp_name"];

                    $error=$_FILES["image"]["error"];

                    $liciense_path='uploads/users/'.$name;

                    move_uploaded_file($liciense_tmp_name,$liciense_path);

                    $details1['image']= $liciense_path;

                }
                $update = $this->Common_model->update('getCountryFlags',$details1,'id',$this->input->post('id'));

                if($update){

                    $this->session->set_flashdata('success', "Country Flag Updated Successfully");

                    redirect(site_url().'/Country/manage');

                }

            }

        }else{

            $data['details'] = $this->db->get_where('getCountryFlags',array('id' => $this->uri->segment(3)))->row_array();

            $this->load->view('admin/includes/header',$data);

            $this->load->view('admin/Country/edit');

            $this->load->view('admin/includes/footer');

        }

    }



    public function delete(){

        $delete = $this->Common_model->delete('getCountryFlags','id',$this->uri->segment(3));
        if($delete){
            $this->session->set_flashdata('success', "Country Flag Deleted Successfully");

            redirect(site_url().'/Country/manage');

        }



    }



    public function status(){

        $details = $this->db->get_where('Gems',array('id' => $this->uri->segment(3)))->row_array();

        if($details['status'] == 'Approved'){

            $data['status'] = 'Pending';

        }

        else{

            $data['status'] = 'Approved';

        }

        $update = $this->Common_model->update('Gems',$data,'id',$this->uri->segment(3));

        if($update){

            //$this->session->set_flashdata('success', "User Updated Successfully");

            redirect(site_url().'/Gems/manage');

        }

    }



}
