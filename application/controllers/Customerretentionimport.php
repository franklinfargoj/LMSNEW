<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CustomerRetentionImport extends CI_Controller {
 function index()
 {
    $admin = ucwords(strtolower($this->session->userdata('admin_type')));
    if ($admin != 'Super Admin')
    {
        redirect('dashboard');
    }
              /*Create Breadcumb*/
    $this->make_bread->add('Upload', '', 0);
    $arrData['breadcrumb'] = $this->make_bread->output();
          /*Create Breadcumb*/
           return load_view("customer_retention_import",$arrData);
      // $this->load->view('empimport');
 }

function import()
{

  $this->load->model('customer_import_model');
  $this->load->library('excel');
  

  if(isset($_FILES["file"]["name"]))
  {
   $accountid=$this->customer_import_model->get_accountid();
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $hrms_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $account_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $email_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
     $contact_no = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

     $current_balance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
     $max_balance_in_last_one_year = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
     $transaction_in_3_months = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
     $products_availed = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
     $IB_MB = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
     $debit_card_active_usage = $worksheet->getCellByColumnAndRow(10, $row)->getValue();


     $data[] = array(
              'customer_name'=>$customer_name,
              'hrms_id'=>$hrms_id,
              'account_id'=>$account_id,
              'email_id'=>$email_id,
              'contact_no'=>$contact_no,
              'current_balance'=>$current_balance,
              'max_balance_in_last_one_year'=>$max_balance_in_last_one_year,
              'transaction_in_3_months'=>$transaction_in_3_months,
              'products_availed'=>$products_availed,
              'IB_MB'=>$IB_MB,
              'debit_card_active_usage'=>$debit_card_active_usage,
     );
    }
   }
    $res=$this->customer_import_model->insert($data,$accountid);
   } 
   else
        {
          $this->session->set_flashdata('error', 'Please Select File!!');
          redirect ('/customerretentionimport');
        }
      if($res)
      {
        $this->session->set_flashdata('success', 'File Uploaded Successfully');
        redirect ('/customerretentionimport');
      }
      else
      {
        $this->session->set_flashdata('error', 'Somthing worng. Error!!');
        redirect ('/customerretentionimport');
      }
     } 

}