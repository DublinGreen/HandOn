<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beans extends Ci_Controller{

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

    public function beansExchangePackages(){
        $config["base_url"] = site_url()."/Beans/beansExchangePackages";
        $coutData = $this->db->from("beansExchange")->count_all_results();
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

        $data['details'] = $this->db->query("select * from beansExchange order by id desc limit $npage,$p")->result_array();

        $data['active'] = 'beanschange';

        $data['title'] = 'Beans Exchange Packages';

        $this->load->view('admin/includes/header',$data);

        $this->load->view('admin/beans/beansExchangePackages');

        $this->load->view('admin/includes/footer');

    }

    public function add(){

        $admin_details = $this->session->userdata('admin_details');
        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
        $data['active'] = 'beansexchangepackages';
        $data['title'] = "Add Beans Exchange";
        if($this->input->post()){
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('beans', 'Beans', 'trim|required');
            $this->form_validation->set_rules('diamond', 'Diamond', 'trim|required');
            if(empty($_FILES["image"]["name"]) || $_FILES["image"]["name"] == ""){
                $this->form_validation->set_rules('image', 'Icon', 'required');
            }
            if($this->form_validation->run() == FALSE){
                $this->load->view('admin/includes/header',$data);
                $this->load->view('admin/beans/add');
                $this->load->view('admin/includes/footer');
            }else{
                $details['title'] = $this->input->post('title');
                $details['beans'] = $this->input->post('beans');
                $details['diamond'] = $this->input->post('diamond');
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
                $insert = $this->Common_model->insert_data($details,'beansExchange');
                if($insert){
                    $this->session->set_flashdata('success', "Beans Exchanged Packages added Successfully");
                    redirect(site_url().'/beans/beansExchangePackages');
                }
            }
        }else{
            $this->load->view('admin/includes/header',$data);
            $this->load->view('admin/beans/add');
            $this->load->view('admin/includes/footer');
        }
    }

    public function dollarExchange(){

        $admin_details = $this->session->userdata('admin_details');

        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

        $data['active'] = 'dollarexchange';

        $data['title'] = "Dollar Exchange";

        if($this->input->post()){


            $this->form_validation->set_rules('beans', 'Beans', 'trim|required');
            $this->form_validation->set_rules('dollar', 'Dollar', 'trim|required');
            $this->form_validation->set_rules('minimumBeans','Minimum Beans','trim|required');

            if($this->form_validation->run() == FALSE){

                $data['details'] = $this->db->get_where('beansExchangeToDollar',array('id' => '1'))->row_array();

                $this->load->view('admin/includes/header',$data);

                $this->load->view('admin/beans/editdollar');

                $this->load->view('admin/includes/footer');

            }else{

                $details1['beans'] = $this->input->post('beans');
                $details1['dollar'] = $this->input->post('dollar');
                $details1['minimumBeans'] = $this->input->post('minimumBeans');

                $update = $this->Common_model->update('beansExchangeToDollar',$details1,'id','1');

                if($update){

                    $this->session->set_flashdata('success', "Beans Exchanged Dollar Updated Successfully");

                    redirect(site_url().'/Beans/dollarExchange');

                }

            }

        }else{

            $data['details'] = $this->db->get_where('beansExchangeToDollar',array('id' => '1'))->row_array();

            $this->load->view('admin/includes/header',$data);

            $this->load->view('admin/beans/editdollar');

            $this->load->view('admin/includes/footer');

        }

    }




            public function delete(){

    $delete = $this->Common_model->delete('beansExchange','id',$this->uri->segment(3));

    if($delete){

        $this->session->set_flashdata('success',"Beans Exchanged Packages Deleted Successfully");
        redirect(site_url().'/Beans/beansExchangePackages');

    }

}

    public function status(){

        $details = $this->db->get_where('beansExchange',array('id' => $this->uri->segment(3)))->row_array();

        if($details['status'] == '1'){

            $data['status'] = '0';

        }

        else{

            $data['status'] = '1';

        }

        $update = $this->Common_model->update('beansExchange',$data,'id',$this->uri->segment(3));

        if($update){

            $this->session->set_flashdata('success', "Beans Exchanged Status Updated Successfully");

            redirect(site_url().'/Beans/beansExchangePackages');

        }

    }



    public function edit(){

        $admin_details = $this->session->userdata('admin_details');

        $data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);

        $data['active'] = 'beansexchangepackages';

        $data['title'] = "Edit Beans Exchange Packages";

        if($this->input->post()){

            $this->form_validation->set_rules('title', 'Title', 'trim|required');

            $this->form_validation->set_rules('beans', 'Beans', 'trim|required');
            $this->form_validation->set_rules('diamond', 'Diamond', 'trim|required');

            if($this->form_validation->run() == FALSE){

                $data['details'] = $this->db->get_where('beansExchange',array('id' => $this->uri->segment(3)))->row_array();

                $this->load->view('admin/includes/header',$data);

                $this->load->view('admin/beans/edit');

                $this->load->view('admin/includes/footer');

            }else{

                $details1['title'] = $this->input->post('title');

                $details1['beans'] = $this->input->post('beans');
                $details1['diamond'] = $this->input->post('diamond');

                $details1['updated'] = date('Y-m-d H:i:s');

                if(!empty($_FILES["image"]["name"])){

                    $name= time().'_'.$_FILES["image"]["name"];

                    $liciense_tmp_name=$_FILES["image"]["tmp_name"];

                    $error=$_FILES["image"]["error"];

                    $liciense_path='uploads/users/'.$name;

                    move_uploaded_file($liciense_tmp_name,$liciense_path);

                    $details1['image']= $liciense_path;

                }

                $update = $this->Common_model->update('beansExchange',$details1,'id',$this->input->post('id'));
            
                if($update){

                    $this->session->set_flashdata('success', "Beans Exchanged Packages Updated Successfully");

                    redirect(site_url().'/Beans/beansExchangePackages');

                }

            }

        }else{

            $data['details'] = $this->db->get_where('beansExchange',array('id' => $this->uri->segment(3)))->row_array();

            $this->load->view('admin/includes/header',$data);

            $this->load->view('admin/beans/edit');

            $this->load->view('admin/includes/footer');

        }

    }



}




?>
