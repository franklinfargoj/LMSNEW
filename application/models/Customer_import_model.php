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
	// $query = $this->db->query("SELECT count(*) as Total FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NOT NULL");
	$wherecondition1=array('hrms_id'=>$id,'call_date IS NOT NULL');
	$this->db->select("count(*) as Total");
	$this->db->from('customer_retention');
	$this->db->where($wherecondition1);
	$results1=$this->db->get()->result_array();

	// $query1 = $this->db->query("SELECT count(*) as Pending FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NULL");
	$wherecondition2=array('hrms_id'=>$id,'call_date IS NULL');
	$this->db->select("count(*) as Total");
	$this->db->from('customer_retention');
	$results2=$this->db->get()->result_array();

	$result = array_merge($results1,$results2);
	return $result;
}
function get_customer_retention_list($para)
{
	$list=$para['list'];
	if($list=='pending')
	{
		$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number'");
		$this->db->from('customer_retention');
		$this->db->where('call_date IS NULL');
		$this->db->order_by("current_balance", "desc");
		// $query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	}
	else if($list=='called')
	{
		$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number'");
		$this->db->from('customer_retention');
		$this->db->where('call_date IS NOT NULL');
		$this->db->order_by("current_balance", "desc");
		// $query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number'  FROM customer_retention WHERE call_date IS NOT NULL ORDER BY current_balance desc");
	}
	$result = $this->db->get()->result_array();
	return $result;
}
function get_customer_retention_detail($para)
{
	$this->db->select('cr.customer_name,cr.contact_no,cd.*');
    $this->db->from('customer_retention_details cd');
    $this->db->join('customer_retention cr','cd.customer_id=cr.id');
    $this->db->where($para);
    $result= $this->db->get()->result_array();
	return $result;
}
function update_customer_retention_remark($para)
{

	$array=array('remarks'=>$para['remark']);
	$this->db->where('customer_id',$para['customer_id']);
	$res=$this->db->update('customer_retention_details', $array);
	if($res)
	{
		$this->db->select('cr.customer_name,cr.contact_no,cd.*');
	    $this->db->from('customer_retention_details cd');
	    $this->db->join('customer_retention cr','cd.customer_id=cr.id');
	    $this->db->where('customer_id',$para['customer_id']);
	    $result = $this->db->get()->result_array();
		return $result;
	}
}
}
