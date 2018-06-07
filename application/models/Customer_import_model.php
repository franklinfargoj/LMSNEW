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
////////////////////////////for apis///////////////////////////////////////////////////
function get_hrms_id($hrmsid)
{

	$id=$hrmsid['hrms_id'];
	
	$query = $this->db->query("SELECT count(*) as Total FROM customer_retention WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($id, '0')."'");
	$result1=$query->result_array();

	$query1 = $this->db->query("SELECT count(*) as Pending FROM customer_retention WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($id, '0')."' AND call_date IS NULL");
	$result2=$query1->result_array();

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
		$query = $this->db->query("SELECT id,customer_name as 'Customer Name',((max_balance_in_last_one_year-current_balance)/max_balance_in_last_one_year)*100
		as '%Balance Drop',contact_no as 'Phone number',DATE_FORMAT(call_date, '%D-%M-%Y') as 'call_date' FROM customer_retention 
		 WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."' AND  call_date IS NULL ORDER BY current_balance desc");
	}
	else if($list=='called')
	{
		$query = $this->db->query("SELECT id,customer_name as 'Customer Name',((max_balance_in_last_one_year-current_balance)/max_balance_in_last_one_year)*100
		as '%Balance Drop',contact_no as 'Phone number',DATE_FORMAT(call_date, '%D-%M-%Y') as 'call_date' FROM customer_retention 
		 WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."' AND  call_date IS NOT NULL ORDER BY current_balance desc");

	}
	$result = $query->result_array();

	return $result;
}
function get_customer_retention_detail($para)
{
	$this->db->select("cr.customer_name,DATE_FORMAT(call_date, '%D-%M-%Y') as 'call_date',cr.contact_no,cd.*");
    $this->db->from('customer_retention_details cd');
    $this->db->join('customer_retention cr','cd.customer_id=cr.id');
    $this->db->where($para);
    $result= $this->db->get()->result_array();
	return $result;
}
function update_customer_retention_remark($para)
{
	$date = date('Y-m-d H:i:s');
	$res=$this->db->query("UPDATE customer_retention_details AS cd,
						customer_retention AS cr SET  `remarks` ='".$para['remark']."',
					`call_date` = '".$date." ' WHERE  cr.id=cd.customer_id AND  `cd`.`customer_id`=".$para['customer_id']);

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

///////customer Retention for the web/////////////////////

function view_customer()
{
	$user=get_session();
	$hrmsid=$user['hrms_id'];

	$query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance 
				as '%Balance Drop', call_date as 'call' FROM customer_retention 
				WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."' ORDER BY current_balance desc");
	$result = $query->result_array();
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
	$user=get_session();
	$hrmsid=$user['hrms_id'];

	$query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance 
		as '%Balance Drop',call_date as 'call' FROM customer_retention 
		 WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."' AND  call_date IS NOT NULL ORDER BY current_balance desc");
	$result = $query->result_array();

	return $result;
}
function notcalllist()
{
	$user=get_session();
	$hrmsid=$user['hrms_id'];
	$query = $this->db->query("SELECT id,customer_name as 'Customer Name',current_balance
		 as '%Balance Drop',call_date as 'call' FROM customer_retention 
		 WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."' AND call_date IS NULL ORDER BY current_balance desc");
	$result = $query->result_array();
	return $result;
}

function total_lead()
{
	$user=get_session();
	$hrmsid=$user['hrms_id'];

	$query = $this->db->query("SELECT count(*) as Total FROM customer_retention WHERE TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."'");
	$result1=$query->result_array();

	$query1 = $this->db->query("SELECT count(*) as Pending FROM customer_retention WHERE  TRIM( LEADING  0 FROM hrms_id)='".ltrim($hrmsid, '0')."'  AND call_date IS NULL");
	$result2=$query1->result_array();
	$results['Total']=$result1[0]['Total'];
	$results['Pending']=$result2[0]['Pending'];
	return $results;
}
}
