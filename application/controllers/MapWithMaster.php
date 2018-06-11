<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapWithMaster extends CI_Controller
{

    function __construct()
    {
        parent::__construct(); // Initialization of class
        is_logged_in();     //check login
        $admin = ucwords(strtolower($this->session->userdata('admin_type')));
        if ($admin != 'Super Admin') {
            redirect('dashboard');
        }
        $this->load->model('Master_model', 'master');
    }


    public function index()
    {
        /*Create Breadcumb*/
        $this->make_bread->add('MapWithMaster', '', 0);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/

        $arrData['maplist'] = $this->master->view_record_master_map();

      //  pe($arrData['maplist']);die;
        return load_view("MasterMap/view",$arrData);
    }

    public function add()
    {
        /*Create Breadcumb*/
        $this->make_bread->add('MapWithMaster', 'MapWithMaster', 0);
        $this->make_bread->add('Add', '', 1);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/

        if($this->input->post()){

            $this->form_validation->set_rules('title','Title', 'trim|required|is_unique['."db_map_with_master".'.title]');
            $this->form_validation->set_rules('description_text','Description', 'trim|required');
            $this->form_validation->set_message('is_unique', '%s is already taken');

            if ($this->form_validation->run() == FALSE)
            {
                $arrData['has_error'] = 'has-error';
                return load_view("MasterMap/add",$arrData);
            }else{
                $insert = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description_text'),
                    'status' => strtolower($this->input->post('status')),
                    'created_by' => loginUserId()
                );

                $response = $this->master->add_record_map($insert);

                if($response['status'] == 'error'){
                    $this->session->set_flashdata('error','Failed to add MapWithMaster');
                    redirect('MapWithMaster/add');
                }else{
                    $this->session->set_flashdata('success','MapWithMaster Information added successfully.');
                    redirect('MapWithMaster');
                }
            }
        }else{
            return load_view("MasterMap/add",$arrData);
        }
    }


    public function delete($id)
    {
        if(!$id){
            $this->session->set_flashdata('error','Invalid access');
            redirect('MapWithMaster');
        }
        $id = decode_id($id);

        $soft_deleted = $this->master->delete_record($id);
        if($soft_deleted > 0){
            $this->session->set_flashdata('success','MapWithMaster information deleted successfully.');
        }else{
            $this->session->set_flashdata('eroor','Failed to delete MapWithMaster');
        }
        redirect('MapWithMaster');
    }


    public function edit($id)
    {
        if(!$id){
            $this->session->set_flashdata('error','Invalid access');
            redirect('MapWithMaster');
        }
        $id = decode_id($id);
        /*Create Breadcumb*/
        $this->make_bread->add('Tickers', 'ticker', 0);
        $this->make_bread->add('Edit', '', 1);
        $arrData['breadcrumb'] = $this->make_bread->output();
        /*Create Breadcumb*/

        $arrData['mapDetail'] = $this->master->view_record($id);


        if(count($arrData['mapDetail']) > 1){
            $this->session->set_flashdata('error','Invalid access');
            redirect('MapWithMaster');
        }
        if($this->input->post()){
            if($this->input->post('title') != $arrData['mapDetail'][0]['title']){
                $is_unique = '|is_unique['."db_map_with_master".'.title]';
                $this->form_validation->set_message('is_unique', '%s is already taken');
            }else{
                $is_unique = '';
            }
            $this->form_validation->set_rules('title','Title', 'trim|required'.$is_unique);
            $this->form_validation->set_rules('description_text','Description', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $arrData['has_error'] = 'has-error';
                return load_view("MasterMap/edit",$arrData);
            }else{
                $update = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description_text'),
                    'status' => strtolower($this->input->post('status')),
                    'modified_by' => loginUserId(),
                    'modified_on' => date('y-m-d H:i:s')
                );
                $response = $this->master->edit_record($id,$update);
                if($response['status'] == 'error'){
                    $this->session->set_flashdata('error','Failed to edit MapWithMaster information');
                    redirect('MasterMap/edit/'.encode_id($id));
                }else{
                    $this->session->set_flashdata('success','MapWithMaster information updated successfully.');
                    redirect('MapWithMaster');
                }
            }
        }else{
            return load_view("MasterMap/edit",$arrData);
        }
    }

}
?>