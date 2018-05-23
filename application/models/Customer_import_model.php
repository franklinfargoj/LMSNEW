<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_import_model extends CI_Model
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
		    $res=$this->db->update('customer_retention', $value);
		    unset($data[$key]);
		}
 	}
 	$res=$this->db->insert_batch('customer_retention', $data);

 	return true;
}
function get_hrmsid()
{
    $data = array();
    $this->db->select('hrms_id');
    $query = $this->db->get('customer_retention');
    $res   = $query->result();        
    return $res;
}
function get_hrms_id($hrmsid)
{
	$id=$hrmsid['hrms_id'];
	$query = $this->db->query("SELECT count(*) as Total FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NOT NULL");
	$query1 = $this->db->query("SELECT count(*) as Pending FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NULL");
	$results1 = $query->result_array();
	$results2 = $query1->result_array();
	$result = array_merge($results1,$results2);
	return $result;
}
function get_customer_retention_list($para)
{
	$list=$para['list'];
	if($list=='pending')
	{
		$query = $this->db->query("SELECT customer_name as 'Customer Name',current_balance as '%Balance Drop' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	}
	else if($list=='called')
	{
		$query = $this->db->query("SELECT customer_name as 'Customer Name',current_balance as '%Balance Drop' FROM customer_retention WHERE call_date IS NOT NULL ORDER BY current_balance desc");
	}
	$result = $query->result_array();
	return $result;
}
}
