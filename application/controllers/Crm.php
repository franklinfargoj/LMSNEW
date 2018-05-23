<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm extends CI_Controller {

    /*
     * construct
     * constructor method
     * @author Sumit
	 * @access private
     * @param none
     * @return void
     *
     */
    function __construct()
    {
        parent::__construct(); // Initialization of class
        is_logged_in();     //check login
        $admin = ucwords(strtolower($this->session->userdata('admin_type')));
        if ($admin != 'Super Admin'){
            redirect('dashboard');
        }
        $this->load->model('Master_model','master');
    }
    /*
     * index
     * Index Page for this controller.
     * @author Sumit Desai
	 * @access public
     * @param none
     * @return void
     */
    public function index()
    {
        /*Create Breadcumb*/
        $this->make_bread->add('CRM', '', 0);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/
        $arrData['crmlist'] = $this->master->view_crm();
       /* print_r($arrData);
        exit;*/
        return load_view("CRM/view",$arrData);
    }

    /*
     * add
     * Display Category Insert form and functionality for Insert.
     * @author Sumit Desai
     * @access public
     * @param none
     * @return void
     */
    public function add()
    {
        /*Create Breadcumb*/
        $this->make_bread->add('CRM', 'CRM', 0);
        $this->make_bread->add('Add', '', 1);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/

        if($this->input->post()){
            $this->form_validation->set_rules('title','CRM name','trim|required');
            if ($this->form_validation->run() == FALSE)
            {    $arrData['has_error'] = 'has-error';
                return load_view("CRM/add",$arrData);
            }else{
                $title = ucwords(strtolower($this->input->post('title')));
                $title_1 = str_replace(' ', '_', $title);
                $insert = array(
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'content' => ucwords(strtolower($this->input->post('content'))),
                    'slug'   => $title_1
                );
                $response = $this->master->add_crm($insert);
                if($response['status'] == 'error'){
                    $this->session->set_flashdata('error','Failed to add CRM');
                    redirect('crm/add');
                }else{
                    $this->session->set_flashdata('success','CRM added successfully.');
                    redirect('crm');
                }
            }
        }else{
            return load_view("CRM/add",$arrData);
        }
    }

    /*
     * edit
     * Display Category Edit form and functionality for Update.
     * @author Sumit Desai
     * @access public
     * @param none
     * @return void
     */
    public function edit($id)
    {
        if(!$id){
            $this->session->set_flashdata('error','Invalid access');
            redirect('crm');
        }

        $id = decode_id($id);
        /*Create Breadcumb*/
        $this->make_bread->add('CRM', 'crm', 0);
        $this->make_bread->add('Edit', '', 1);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/

        $arrData['crmDetail'] = $this->master->view_crm($id);

//        echo "<pre>";
//        print_r($arrData);die;
        if(count($arrData['crmDetail']) == 0){
            $this->session->set_flashdata('error','Invalid access');
            redirect('crm');
        }
        if($this->input->post()){

            $this->form_validation->set_rules('title','CRM name','trim|required');
            if ($this->form_validation->run() == FALSE){
                $arrData['has_error'] = 'has-error';
                return load_view("CRM/edit",$arrData);
            }else{
                $update = array(
                    'title' => ucwords(strtolower($this->input->post('title'))),
                    'content' => ucwords(strtolower($this->input->post('content'))),
                    'modify_date' => date('y-m-d H:i:s')
                );
                $response = $this->master->edit_crm($id,$update);
                if($response['status'] == 'error'){
                    $this->session->set_flashdata('error','Failed to edit CRM');
                    redirect('crm/edit/'.encode_id($id));
                }else{
                    $this->session->set_flashdata('success','CRM updated successfully.');
                    redirect('crm');
                }

            }
        }else{
            return load_view("CRM/edit",$arrData);
        }
    }
}