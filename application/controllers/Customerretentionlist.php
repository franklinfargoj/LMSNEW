<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CustomerRetentionList extends CI_Controller {

 function index()
 {
    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin != 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
               $this->load->model('customer_import_model');
    $this->make_bread->add('Upload', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerlist'] = $this->customer_import_model->view_customer();
          /*Create Breadcumb*/
           return load_view("customer_retention_list",$arrData);
      // $this->load->view('empimport');
 }
 function view($id)
 {

    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin != 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
               $this->load->model('customer_import_model');
    $this->make_bread->add('Upload', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerinfo'] = $this->customer_import_model->view_customer_info($id);
          /*Create Breadcumb*/
    return load_view("customer_information",$arrData);
      // $this->load->view('empimport');
 }
}