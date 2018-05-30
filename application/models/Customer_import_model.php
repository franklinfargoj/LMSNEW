<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_import_model extends CI_Model
{

function insert($data,$accountid,$hrmsid)
{
	foreach ($accountid as $value) 
	$array[] = $value->account_id;

	foreach ($hrmsid as $value) 
	$array1[] = $value->hrms_id;

	

	$customeridupdated = array();
	foreach ($data as $key=> $value)
	{	
		if(in_array($value['hrms_id'], $array1))
		{
			if(in_array($value['account_id'], $array))
			{
				$this->db->where('account_id',$value['account_id']);
			    $res=$this->db->update('customer_retention', $value);

			    $this->db->select('id');
			    $this->db->where('account_id',$value['account_id']);
			    $query = $this->db->get('customer_retention');
			 	$res   = $query->result(); 
				foreach ($res as $value1) 
				{
	    			$customeridaffected[]['update'] = $value1->id;
	    		}
			    unset($data[$key]);
			    
			}
		}
		else
		{
			unset($data[$key]);
		}

 	}

 	$this->db->insert_batch('customer_retention', $data);
 	$customeridaffected['insert'] = $this->db->insert_id();
 	return $customeridaffected;


}
function insert_customer_detail($data,$customerid,$hrmsid,$idvalue)
{

	foreach ($customerid as $value) 
	$array[] = $value->customer_id;


	foreach ($hrmsid as $value) 
	$array1[] = $value->hrms_id;
	
	$hrmsidno=2;
	$j=0;
	$i=0;
	$newid=$idvalue['insert'];
	foreach ($data as $key=> $value)
	{	
		if(in_array($value['hrms_id'], $array1))
		{
			unset($data[$j]['hrms_id']);
			if($idvalue[$i]['update']!=0)
	        {
	          $data[$key]['customer_id']=$idvalue[$i]['update'];
	          $i++;
	        }
	        else
	        {

	          $data[$key]['customer_id']=$newid++;
	        }

			if(in_array($data[$key]['customer_id'], $array))
			{
				unset($value['hrms_id']);
				$this->db->where('customer_id',$data[$key]['customer_id']);
			    $res=$this->db->update('customer_retention_details',$value);
			    unset($data[$key]);
			}
		}
		else
		{
			unset($data[$key]);
			$result[]=$hrmsidno;
		}
		$j++;
		$hrmsidno++;
		
 	}
foreach ($data as $key => $value) {
	if($value['customer_id']==0)
	{
		  unset($data[$key]);
	}
}
 	$this->db->insert_batch('customer_retention_details', $data);
 	if(count($result)==0)
 	{
 		return true;
 	}
 	else
 	{	
 		return $result;
 	}
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
    $query = $this->db->get('customer_retention_details');
    $res   = $query->result();        
    return $res;
}
function get_hrms_id($hrmsid)
{

	$id=$hrmsid['hrms_id'];
	
	$query = $this->db->query("SELECT count(*) as Total FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NOT NULL");
	$result1=$query->result_array();

	$query1 = $this->db->query("SELECT count(*) as Pending FROM customer_retention WHERE hrms_id='".$id."' AND call_date IS NULL");
	$result2=$query1->result_array();

	// $result = array_merge($result1,$result2);

	$results['Total']=$result1[0]['Total'];
	$results['Pending']=$result2[0]['Pending'];
	return $results;
}
function get_customer_retention_list($para)
{
	$list=$para['list'];
	$hrmsid=$para['hrmsid'];
	if($list=='pending')
	{
		$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number'");
		$this->db->from('customer_retention');
		$this->db->where('hrms_id',$hrmsid);
		$this->db->where('call_date IS NULL');
		$this->db->order_by("current_balance", "desc");
		
		$query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	}
	else if($list=='called')
	{
		$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number'");
		$this->db->from('customer_retention');
		$this->db->where('hrms_id',$hrmsid);
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
function view_customer()
{

		$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number', call_date as 'call'");
		$this->db->from('customer_retention');
		// $this->db->where('hrms_id',$hrmsid);
		// $this->db->where('call_date IS NULL');
		$this->db->order_by("current_balance", "desc");
		
		// $query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	
	$result = $this->db->get()->result_array();
	// echo '<pre>';
	// print_r($result);exit;

	return $result;
}
function view_customer_info($id)
{
	$this->db->select('cr.customer_name,cr.contact_no,cd.*');
    $this->db->from('customer_retention_details cd');
    $this->db->join('customer_retention cr','cd.customer_id=cr.id');
    $this->db->where('cr.id',$id);
    $result= $this->db->get()->result_array();

	return $result;
}
function calledlist()
{
	$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number', call_date as 'call'");
		$this->db->from('customer_retention');
		// $this->db->where('hrms_id',$hrmsid);
		$this->db->where('call_date IS NOT NULL');
		$this->db->order_by("current_balance", "desc");
		
		// $query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	
	$result = $this->db->get()->result_array();
	// echo '<pre>';
	// print_r($result);exit;

	return $result;
}
function notcalllist()
{
	$this->db->select("id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number', call_date as 'call'");
		$this->db->from('customer_retention');
		// $this->db->where('hrms_id',$hrmsid);
		$this->db->where('call_date IS NULL');
		$this->db->order_by("current_balance", "desc");
		
		// $query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance as '%Balance Drop',contact_no as 'Phone number' FROM customer_retention WHERE call_date IS NULL ORDER BY current_balance desc");
	
	$result = $this->db->get()->result_array();
	// echo '<pre>';
	// print_r($result);exit;

	return $result;
}
}
