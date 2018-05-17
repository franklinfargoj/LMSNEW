<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class Csvimport extends CI_Controller {
 


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
           return load_view("empimport",$arrData);
      // $this->load->view('empimport');
 }

function import()
{

  $this->load->model('csv_import_model');
  $hrmsid=$this->csv_import_model->get_hrmsid();
   if(isset($_POST["Import"])){

    $filename=$_FILES["file"]["tmp_name"];    
 
    $count = 0;
    $csv_mimetypes = array(
    'text/csv',
    'application/csv',
      );

    if (!in_array($_FILES['file']['type'], $csv_mimetypes)) 
    {
        $this->session->set_flashdata('error', 'Please Upload CSV File Only');
        redirect ('/csvimport');
    }

    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        fgetcsv($handle);
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $check=1;
            $count++;
            if ($count == 1) { continue; }
            $data[]=array(
              'hrms_id'=>$getData[0],
              'name'=>$getData[1],
              'designation_id'=>$getData[2],
              // 'designation'=>$getData[0],
              'email_id'=>$getData[3],
              'contact_no'=>$getData[4],
              'branch_id'=>$getData[5],
              // 'branch_name'=>$getData[0],
              'district_id'=>$getData[6],
              'state_id'=>$getData[7],
              'zone_id'=>$getData[8],
              // 'zone_name'=>$getData[0],
              'dept_type_id'=>$getData[9],
              'dept_type_name'=>$getData[10],
              'supervisor_id'=>$getData[11],
              // 'is_old'=>$getData[0],

              );
          }
          $res=$this->csv_import_model->insert($data,$hrmsid);
        }
        else
        {
          $this->session->set_flashdata('error', 'Please Select File!!');
          redirect ('/csvimport');
        }

      }
      if($res)
      {
        $this->session->set_flashdata('success', 'File Uploaded Successfully');
        redirect ('/csvimport');
      }
      else
      {
        $this->session->set_flashdata('error', 'Somthing worng. Error!!');
        redirect ('/csvimport');
      }
    }
 } 

