<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Csv_import_model extends CI_Model
{

function insert($data,$hrms_id)
{
	foreach ($hrms_id as $value) 
	$array[] = $value->hrms_id;

	foreach ($data as $key=> $value)
	{	
		if(in_array($value['hrms_id'], $array))
		{
			$this->db->like('hrms_id',$value['hrms_id'],'both');
		    $res=$this->db->update('employee_dump', $value);
		    unset($data[$key]);
		}
 	}
 	$res=$this->db->insert_batch('employee_dump', $data);

 	return true;
}
function get_hrmsid()
{
    $data = array();
    $this->db->select('hrms_id');
    $query = $this->db->get('employee_dump');
    $res   = $query->result();        
    return $res;
}
}