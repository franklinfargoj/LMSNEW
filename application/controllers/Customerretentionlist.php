<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CustomerRetentionList extends CI_Controller {

 function index()
 {
    $arrData['breadcrumb'] = '';

    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin == 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->load->model('customer_import_model');
    $arrData['totallead'] = $this->customer_import_model->total_lead();

    // $this->make_bread->add('Customer Retention List', '', 0);
    
    // $arrData['breadcrumb'] = $this->make_bread->output();
    // $arrData['customerlist'] = $this->customer_import_model->view_customer();
    //       /*Create Breadcumb*/
    //        return load_view("customer_retention_list",$arrData);
    return load_view("view_customer_lead",$arrData);
 }
 function customerlist()
 {

    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin == 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->load->model('customer_import_model');
    
    $this->make_bread->add('Customer Retention List', '', 0);
    
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerlist'] = $this->customer_import_model->view_customer();
    //       /*Create Breadcumb*/
    return load_view("customer_retention_list",$arrData);

 }
 function view($id)
 {

    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin == 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->load->model('customer_import_model');
    $this->make_bread->add('Customer Retention Information', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerinfo'] = $this->customer_import_model->view_customer_info($id);
          /*Create Breadcumb*/
    return load_view("customer_information",$arrData);
      // $this->load->view('empimport');
 }
 function update()
{ 
  $this->load->model('customer_import_model');
  $para['remark']=$_POST['remark'];
  $para['customer_id']=$_POST['custmid'];
  $res=$this->customer_import_model->update_customer_retention_remark($para);
  if($res)
  {
    $this->session->set_flashdata('success','Remark updated Successfully..!!!');
    redirect ('/customerretentionlist/view/'.$_POST['custmid']);
  }
}
function called()
{

  $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin == 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->load->model('customer_import_model');
    $this->make_bread->add('Customer Retention List', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerlist'] = $this->customer_import_model->calledlist();
          /*Create Breadcumb*/
    return load_view("customer_retention_list",$arrData);
}
function notcalled()
{

  $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin == 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->load->model('customer_import_model');
    $this->make_bread->add('Customer Retention List', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
    $arrData['customerlist'] = $this->customer_import_model->notcalllist();
          /*Create Breadcumb*/
    return load_view("customer_retention_list",$arrData);
}
}