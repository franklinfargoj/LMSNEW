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
  $this->load->model('csv_import_model');

  if(isset($_FILES["file"]["name"]))
  {
   $accountid=$this->customer_import_model->get_accountid();
   $customerid=$this->customer_import_model->get_customerid();

   $hrmsid=$this->csv_import_model->get_hrmsid();
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
     $previous_balance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
     $current_balance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
     $max_balance_in_last_one_year = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
     $transaction_in_3_months = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
     $products_availed = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
     $IB_MB = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
     $debit_card_active_usage = $worksheet->getCellByColumnAndRow(11, $row)->getValue();



     $internet_banking = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
     $mobile_banking = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
     $debit_card = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
     $neft_rtgs = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
     $moving_money_dena_to_non_dena = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
     $three_months_internet_transaction = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
     $three_months_mobile_transaction = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
     $transaction_debit_card_POS = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
     $remarks = $worksheet->getCellByColumnAndRow(20, $row)->getValue();


     $data[] = array(
              'customer_name'=>$customer_name,
              'hrms_id'=>$hrms_id,
              'account_id'=>$account_id,
              'email_id'=>$email_id,
              'contact_no'=>$contact_no,
              'previous_balance'=>$previous_balance,
              'current_balance'=>$current_balance,
              'max_balance_in_last_one_year'=>$max_balance_in_last_one_year,
              'transaction_in_3_months'=>$transaction_in_3_months,
              'products_availed'=>$products_availed,
              'IB_MB'=>$IB_MB,
              'debit_card_active_usage'=>$debit_card_active_usage,
            );


     if($internet_banking=='YES' || $internet_banking=='Yes' || $internet_banking=='yes')
     {
        $internet_banking=1;
     }
     else if($internet_banking=='NO' || $internet_banking=='No' || $internet_banking=='no')
     {
        $internet_banking=0;
     }

     if($mobile_banking=='YES' || $mobile_banking=='Yes' || $mobile_banking=='yes')
     {
        $mobile_banking=1;
     }
     else if($mobile_banking=='NO' || $mobile_banking=='No' || $mobile_banking=='no')
     {
        $mobile_banking=0;
     }

     if($debit_card=='YES' || $debit_card=='Yes' || $debit_card=='yes')
     {
        $debit_card=1;
     }
     else if($debit_card=='NO' || $debit_card=='No' || $debit_card=='no')
     {
        $debit_card=0;
     }

     if($neft_rtgs=='YES' || $neft_rtgs=='Yes' || $neft_rtgs=='yes')
     {
        $neft_rtgs=1;
     }
     else if($neft_rtgs=='NO' || $neft_rtgs=='No' || $neft_rtgs=='no')
     {
        $neft_rtgs=0;
     }

     if($moving_money_dena_to_non_dena=='YES' || $moving_money_dena_to_non_dena=='Yes' || $moving_money_dena_to_non_dena=='yes')
     {
        $moving_money_dena_to_non_dena=1;
     }
     else if($moving_money_dena_to_non_dena=='NO' || $moving_money_dena_to_non_dena=='No' || $moving_money_dena_to_non_dena=='no')
     {
        $moving_money_dena_to_non_dena=0;
     }
     $data1[] = array(
              'hrms_id'=>$hrms_id,
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
    $res=$this->customer_import_model->insert($data,$accountid,$hrmsid);
    if($res)
    {

       $res=$this->customer_import_model->insert_customer_detail($data1,$customerid,$hrmsid,$res);
   
    }

   } 
   else
    {
      $this->session->set_flashdata('error', 'Please Select File!!');
      redirect ('/customerretentionimport');
    }
 
      if(!isset($res[0]))
      {
         $this->session->set_flashdata('success','File uploaded successfully..!!!');
        redirect ('/customerretentionimport');
             }
      else
      {
        for($i=0;$i<count($res);$i++)
        {
          $msg.='row number '.$res[$i].' not having correct hrms id so not uploaded <br>';
        }
        $msg.='Remaining data uploaded successfully..!!!';
        $this->session->set_flashdata('error',$msg);
        redirect ('/customerretentionimport');
      }
     } 

}