<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_import_model extends CI_Model
{

function insert($data,$accountid)
{
	foreach ($accountid as $value) 
	$array[] = $value->account_id;

	foreach ($data as $key=> $value)
	{	
		if(in_array($value['account_id'], $array))
		{
			$this->db->where('account_id',$value['account_id']);
		    $res=$this->db->update('customer_retention', $value);
		    unset($data[$key]);
		}
 	}
 	$res=$this->db->insert_batch('customer_retention', $data);

 	return true;
}
function insert_customer_detail($data,$customerid)
{

	foreach ($customerid as $value) 
	$array[] = $value->account_id;

	foreach ($data as $key=> $value)
	{	
		if(in_array($value['customer_id'], $array))
		{

			$this->db->where('customer_id',$value['customer_id']);
		    $res=$this->db->update('customer_retention_detatils', $value);
		    unset($data[$key]);
		}
 	}

 	$res=$this->db->insert_batch('customer_retention_detatils', $data);

 	return true;
}

function get_accountid()
{
    $data = array();
    $this->db->select('account_id');
    $query = $this->db->get('customer_retention');
    $res   = $query->result();        
    return $res;
}
function get_customerid()
{
    $data = array();
    $this->db->select('customer_id');
    $query = $this->db->get('customer_retention_detatils');
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
