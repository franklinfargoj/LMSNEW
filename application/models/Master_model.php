<?php

/**
 * Master_model Class
 *
 * @author Ashok Jadhav
 *
 */
class Master_model extends CI_Model{
	
	/**
	 * construct
	 *
	 * initializes
	 * @author Ashok Jadhav
	 * @access private
	 * @param none
	 * @return void
	 *
	 */
	function __construct()
	{
		// Initialization of class
		parent::__construct();
	}

	#####################################
	/* Product Category Function*/
	#####################################

	/**
	 * add_product_category
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function add_product_category($data){
		return $this->insert(Tbl_Category,$data);
	}

	/**
	 * edit_product_category
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id,$data
	 * @return int
	 */
	public function edit_product_category($id,$data){
		$where['id'] = $id;
		return $this->update($where,Tbl_Category,$data);
	}

	/**
	 * delete_product_category
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return int
	 */
	public function delete_product_category($id){
		$where[] = $id;
		$data['is_deleted'] = 1;
		return $this->soft_delete($where,Tbl_Category,$data);
	}

	/**
	 * view_product_category
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return array
	 */
	public function view_product_category($id = null,$order_by = array()){
		$select = array('id','title','created_by','status');
		$where['is_deleted'] = 0;
		if(!empty($id)){
			$where['id'] = $id;
		}
		$join = array();
		return $this->view($select,$where,Tbl_Category,$join,$order_by);
	}
	

	#####################################
	/* Product Function*/
	#####################################

	/**
	 * add_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function add_product($data){
		return $this->insert(Tbl_Products,$data);
	}

	/**
	 * edit_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id,$data
	 * @return int
	 */
	public function edit_product($id,$data){
		$where['id'] = $id;
		return $this->update($where,Tbl_Products,$data);
	}

	/**
	 * delete_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return int
	 */
	public function delete_product($id){
		$where[] = $id;
		$data['is_deleted'] = 1;
		return $this->soft_delete($where,Tbl_Products,$data);
	}

	/**
	 * view_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return array
	 */
	public function view_product($id = null,$where = array(),$order_by = array()){
		$select = array(Tbl_Products.'.id',Tbl_Products.'.map_with',Tbl_Products.'.map_with_amount',Tbl_Products.'.title',Tbl_Products.'.default_assign',Tbl_Products.'.created_by',Tbl_Products.'.status',Tbl_Products.'.turn_around_time',Tbl_Category.'.title AS category','category_id');
		$where[Tbl_Products.'.is_deleted'] = 0;
		if(!empty($id)){
			$where[Tbl_Products.'.id'] = $id;
		}
		$join = array('table' => Tbl_Category,'on_condition' => Tbl_Products.'.category_id = '.Tbl_Category.'.id','type' => '');
		return $this->view($select,$where,Tbl_Products,$join,$order_by);
	}

	#####################################
	/* Product Guide */
	#####################################

	/**
	 * add_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function add_product_guide($data){
		return $this->insert(Tbl_ProductDetails,$data);
	}

	/**
	 * edit_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id,$data
	 * @return int
	 */
	public function edit_product_guide($id,$data){
		$where['id'] = $id;
		return $this->update($where,Tbl_ProductDetails,$data);
	}

	/**
	 * delete_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return int
	 */
	public function delete_product_guide($id){
		$where[] = $id;
		$data['is_deleted'] = 1;
		return $this->soft_delete($where,Tbl_ProductDetails,$data);
	}

	/**
	 * view_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return array
	 */
	public function view_product_guide($productId,$id = null,$order_by = array()){
		$select = array(Tbl_ProductDetails.'.id',Tbl_ProductDetails.'.title',Tbl_ProductDetails.'.description_text',Tbl_ProductDetails.'.created_by',Tbl_Products.'.title AS product_name','product_id');
		$where[Tbl_ProductDetails.'.product_id'] = $productId;
		$where[Tbl_ProductDetails.'.is_deleted'] = 0;
		if(!empty($id)){
			$where[Tbl_ProductDetails.'.id'] = $id;
		}
              $order_by="FIELD(".Tbl_ProductDetails.".title,'Quick Guide','Terms','Fee & Charges','Documents')";
		$join = array('table' => Tbl_Products,'on_condition' => Tbl_Products.'.id = '.Tbl_ProductDetails.'.product_id','type' => 'right');
		return $this->view($select,$where,Tbl_ProductDetails , $join,$order_by);
	}

	#####################################
	/* Manage Points */
	#####################################

	/**
	 * add_product
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function add_points($data){
		return $this->insert(Tbl_Manage_Points,$data);
	}

	public function points_distrubute($data){
		$where = array('product_id' => $data['product_id'],'active' => 1);
		$current_distrubution = $this->view_points_distrubute($where);
		if(count($current_distrubution) > 0){
			$data1 = array('active' => 0);
			$this->update($where,Tbl_Points_Distributor,$data1);	
		}
		return $this->insert(Tbl_Points_Distributor,$data);
	}

	public function view_points_distrubute($where = array()){
		$select = array('id','product_id','generator_contrubution','convertor_contrubution','active');
		return $this->view($select,$where,Tbl_Points_Distributor,$join = array(),$order_by = array());
	}

	public function view_points($where = array(),$order_by = array()){
		$select = array('id','product_id','from_range','to_range','points');
		return $this->view($select,$where,Tbl_Manage_Points,$join = array(),$order_by);
	}


	#####################################
	/* Private Function*/
	#####################################
	private function insert($table,$data){
		$response = array();
		$this->db->db_debug = FALSE; //enable debugging for queries
		$this->db->insert($table,$data);
		$errors = $this->db->error();
		if($errors['code']){
			$response['status'] = 'error';
			$response['code'] = $errors['code'];
		}else{
			$response['status'] = 'success';
			$response['insert_id'] = $this->db->insert_id();
		}
		return $response;
	}

	private function update($where,$table,$data){
		$this->db->where($where);
		$this->db->update($table,$data);
		$errors = $this->db->error();
		if($errors['code']){
			$response['status'] = 'error';
			$response['code'] = $errors['code'];
		}else{
			$response['status'] = 'success';
			$response['affected_rows'] = $this->db->affected_rows();
		}
		return $response;
	}


	public function view($select,$where,$table,$join = array(),$order_by = array()){

		$this->db->select($select,TRUE);
		$this->db->from($table);

        if(!empty($join)){
            $this->db->join($join['table'],$join['on_condition'],$join['type']);
        }

		if(!empty($where)){
			$this->db->where($where);
		}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
			/*pe($order_by);
			exit;*/
		}else{
			$this->db->order_by('id','DESC');
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	private function soft_delete($where,$table,$data){
		$this->db->where_in('id',$where);
		$this->db->update($table,$data);
		return $this->db->affected_rows();
	}

	function get_enum_values( $table, $field )
	{
	    $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
	    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
	    $enum = explode("','", $matches[1]);
	    $enums = array();
	    $enums[''] = 'Select';
	    foreach ($enum as $key => $value) {
	    	$enums[$value] = $value;
	    }
	    return $enums;
	}

	public function delete_points($prod_id){
        $where[] = $prod_id;
        $data['is_deleted'] = '1';
        return $this->soft_delete($where,Tbl_Manage_Points,$data);
    }

	public function get_branchname($select,$where){

		$this->db->select($select,TRUE);
		$this->db->from('db_branch');
        if($where != null){
		$this->db->where($where);
        }
		$query = $this->db->get();
//		pe($this->db->last_query());die;
		return $query->result_array();
	}

	/**
	 * delete_rapc
	 * @author Ashok Jadhav
	 * @access public
	 * @param $id
	 * @return int
	 */
	public function delete_map($id){
		$where = array('id'=>$id);
		return $this->db->delete(Tbl_processing_center,$where);
	}

	/**
	 * add lead route
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function lead_route($where,$data){
		return $this->update($where,Tbl_analytics_lead_route,$data);
	}

	/**
	 * view lead route
	 * @author Ashok Jadhav
	 * @access public
	 * @param $data
	 * @return int
	 */
	public function view_lead_route($order_by = array()){
		$select = array('id','route_to');
		$where = array('route_to !=' => NULL);
		return $this->view($select,$where,Tbl_analytics_lead_route,$join = array(),$order_by);
	}

    public function get_zonename($select,$where){

        $this->db->select($select,TRUE);
        $this->db->from('db_zone');
            if($where != null){
            $this->db->where($where);
            }
        $query = $this->db->get();
//		pe($this->db->last_query());die;
        return $query->result_array();
    }

   public function designation_by_hrms_id($select,$where){
        $this->db->select($select,TRUE);
        $this->db->from('employee_dump');
         if($where != null){
         $this->db->where($where);
         }
        $query = $this->db->get();
		//pe($this->db->last_query());die;
        return $query->result_array();
    }

    public function get_bm($select,$where){

        $this->db->select($select,TRUE);
        $this->db->from('employee_dump');
        $this->db->where($where);
        $query = $this->db->get();
//		pe($this->db->last_query());die;
        return $query->result_array();
    }

    /**
     * view lead route list
     * @author Ashok Jadhav
     * @access public
     * @param $data
     * @return int
     */
    public function mapping_list($order_by = array()){
        $select = array('id','lead_source','route_to');
        $where = array();
        return $this->view($select,$where,Tbl_analytics_lead_route,$join = array(),$order_by);
    }

    /**
     * add_product
     * @author Ashok Jadhav
     * @access public
     * @param $data
     * @return int
     */
    public function add_lead_mapping($data){
        return $this->insert(Tbl_analytics_lead_route,$data);
    }

    /**
     * view lead route
     * @author Ashok Jadhav
     * @access public
     * @param $data
     * @return int
     */
    public function chkRecord($lead_source){
        $select = array('id','route_to');
        $where = array('lead_source' => $lead_source);
        return $this->view($select,$where,Tbl_analytics_lead_route,$join = array(),$order_by= array());
    }

    public function get_zoneid($select,$join,$where,$table){
        $order_by = array();
        return $this->view($select,$where,$table,$join,$order_by);
    }

    /**
     * employees_with_supervisor
     * @author Franklin Fargoj
     * @access public
     * @param $select,$where
     * @return array
     */
    public function employees_with_supervisor($select,$where){
        return $this->db->select($select)
            ->from(Tbl_emp_dump)
            ->where($where)
            ->get()
            ->result_array();
    }

    /**
     * view_product_category
     * @author Sumit Desai
     * @access public
     * @param $id
     * @return array
     */
    public function view_crm(){
        $this->db->select('id,title,content,slug');
        $this->db->from('db_crm');
        $query =  $this->db->get();
        return $query->result_array();
    }
    /**
     * edit_product_category
     * @author Sumit Desai
     * @access public
     * @param $data
     * @return int
     */
    public function add_crm($data){
        return $this->insert('db_crm',$data);
    }

    /**
     * edit_product_category
     * @author Sumit Desai
     * @access public
     * @param $id,$data
     * @return int
     */
    public function edit_crm($id,$data){
        $where['id'] = $id;
        return $this->update($where,'db_crm',$data);
    }

    public function get_crm_detail($slug){
        $this->db->select('id,title,content,slug');
        $this->db->from('db_crm');
        $this->db->where('slug',$slug);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function get_all_records($select,$from,$where='')
    {
        $this->db->select($select);
        $this->db->from($from);
        if($where!='')
        {
            $this->db->where($where);
        }

        $query =  $this->db->get();
        return $query->result_array();
    }

    /**
     * view_record_master_map
     * @author Franklin Fargoj
     * @access public
     * @param $data
     * @return array
     */
    public function view_record_master_map($id = null,$order_by = array())
    {
        $select = array('id','title','description','created_by','is_deleted','status');
        $where['is_deleted'] = 0;
        if(!empty($id)){
            $where['id'] = $id;
        }
        $join = array();
        return $this->view($select,$where,'db_map_with_master',$join,$order_by,$limit = 0);
    }

    /**
     * add_record_map
     * @author Franklin Fargoj
     * @access public
     * @param $data
     * @return int
     */
    public function add_record_map($data){
        return $this->insert('db_map_with_master',$data);
    }

    /**
     * delete_record
     * @author Franklin Fargoj
     * @access public
     * @param $id
     * @return int
     */
    public function delete_record($id){
        $where[] = $id;
        $data['is_deleted'] = 1;
        return $this->soft_delete($where,'db_map_with_master',$data);
    }

    /**
     * view_record
     * @author Franklin Fargoj
     * @access public
     * @param $id,$order_by
     * @return array
     */
    public function view_record($id = null,$order_by = array()){
        $select = array('id','title','description','created_by','status');
        $where['is_deleted'] = 0;
        if(!empty($id)){
            $where['id'] = $id;
        }
        $join = array();
        return $this->view($select,$where,'db_map_with_master',$join,$order_by,$limit = 0);
    }

    /**
     * edit_record
     * @author Franklin Fargoj
     * @access public
     * @param $id,$data
     * @return int
     */
    public function edit_record($id,$data){
        $where['id'] = $id;
        return $this->update($where,'db_map_with_master',$data);
    }
}
