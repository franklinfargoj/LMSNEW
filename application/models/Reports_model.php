<?php

/**
 * Master_model Class
 *
 * @author Ashok Jadhav
 *
 */
class Reports_model extends CI_Model{

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
    /* Import CSV Function*/
    #####################################
    public function fetch_code($whereArray = array() ,$parent_table){
        $this->db->select('code');
        $this->db->from($parent_table);
        $this->db->where($whereArray);
        $resultArray = $this->db->get()->result_array();

        if (count($resultArray) > 0) {

            return true;

        }else {
            return false;
        }
    }
    public function check_code($whereArray = array(),$table_name ){
        $this->db->select('code');
        $this->db->from($table_name);
        $this->db->where($whereArray);
        $resultArray = $this->db->get()->result_array();

        if (count($resultArray) > 0) {
            return false;
        }else {
            return true;
        }
    }
    public function insert_uploaded_data_all($data,$escape = NULL)
    {
        foreach ($data as $i => $data1) {
            $data_zone[] = array(
                "name" => $data1['zone_name'],
                "code" => $data1['zone_code']
            );
        }
        foreach ($data as $i => $data2) {
            $data_state[] = array(
                "name" => $data2['state_name'],
                "code" => $data2['state_code'],
                "zone_code" => $data2['zone_code']
            );
        }
        foreach ($data as $i => $data3) {
            $data_district[] = array(
                "name" => $data3['district_name'],
                "code" => $data3['district_code'],
                "state_code" => $data3['state_code']
            );
        }
        foreach ($data as $i => $data4) {
            $data_branch[] = array(
                "name" => $data4['branch_name'],
                "code" => $data4['branch_code'],
                "district_code" => $data4['district_code']
            );
        }
        $this->db->insert_batch("db_zone",$data_zone);
        $this->db->insert_batch("db_state",$data_state);
        $this->db->insert_batch("db_district",$data_district);
        $this->db->insert_batch("db_branch",$data_branch);
        return true;
    }

}
