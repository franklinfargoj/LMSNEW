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

}
