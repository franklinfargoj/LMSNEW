<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CustomerRetentionDetailImport extends CI_Controller {
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
           return load_view("customer_retention_detail_import",$arrData);
      // $this->load->view('empimport');
 }

function import()
{

  $this->load->model('customer_import_model');
  $this->load->library('excel');
  

  if(isset($_FILES["file"]["name"]))
  {
   $customerid=$this->customer_import_model->get_customerid();

   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $customer_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $internet_banking = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $mobile_banking = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $debit_card = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
     $neft_rtgs = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

     $moving_money_dena_to_non_dena = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
     $three_months_internet_transaction = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
     $three_months_mobile_transaction = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
     $transaction_debit_card_POS = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
     $remarks = $worksheet->getCellByColumnAndRow(9, $row)->getValue();


     $data[] = array(
              'customer_id'=>$customer_id,
              'internet_banking'=>$internet_banking,
              'mobile_banking'=>$mobile_banking,
              'debit_card'=>$debit_card,
              'neft_rtgs'=>$neft_rtgs,
              'moving_money_dena_to_non_dena'=>$moving_money_dena_to_non_dena,
              'remarks'=>$remarks,
              'three_months_internet_transaction'=>$three_months_internet_transaction,
              'three_months_mobile_transaction'=>$three_months_mobile_transaction,
              'transaction_debit_card_POS'=>$transaction_debit_card_POS,
     );
    }
   }
    $res=$this->customer_import_model->insert_customer_detail($data,$customerid);
   } 
   else
        {
          $this->session->set_flashdata('error', 'Please Select File!!');
          redirect ('/customerretentiondetailimport');
        }
      if($res)
      {
        $this->session->set_flashdata('success', 'File Uploaded Successfully');
        redirect ('/customerretentiondetailimport');
      }
      else
      {
        $this->session->set_flashdata('error', 'Somthing worng. Error!!');
        redirect ('/customerretentiondetailimport');
      }
     } 

}