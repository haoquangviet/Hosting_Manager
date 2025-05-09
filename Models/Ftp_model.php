<?php

namespace Hosting_Manager\Models;

use App\Models\Crud_model;

class Ftp_model extends Crud_model {

    protected $table = null;

    function __construct() {
        // Define the table for diagrams
        $this->table = 'ftp_accounts';
        parent::__construct(table: $this->table);
    }

    /**
     * Retrieve list of diagrams based on options.
     *
     * @param array $options - associative array for filtering the query.
     *                         Possible keys: 'id', 'project_id', 'user_id'.
     * @return object - query result object.
     */
    public function get_details($options = array()) {
        $details_table = $this->table;
    
        // Initialize WHERE clause
        $where = "WHERE $details_table.deleted = 0";
    
        // Apply filters
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $details_table.id=" . intval($id);
        }
    
        $hosting_id = $this->_get_clean_value($options, "hosting_id");
        if ($hosting_id) {
            $where .= " AND $details_table.hosting_id=" . intval($hosting_id);
        }
    
    
        $name = $this->_get_clean_value($options, "search_by");
        if ($name) {
            $name = $this->db->escapeLikeString($name);
            $where .= " AND $details_table.account_name LIKE '%" . $name . "%' ESCAPE '!'";
        }

      

        
    
        // Handle ordering with validation
        $allowed_order_columns = ["id", "client_id", "category", "name", "expiry_date"]; // Add allowed columns
        $order_by = $this->_get_clean_value($options, "order_by");
        $order_dir = strtoupper($this->_get_clean_value($options, "order_dir"));
    
        if (!in_array($order_dir, ["ASC", "DESC"])) {
            $order_dir = "ASC";
        }
    
        if (!in_array($order_by, $allowed_order_columns)) {
            $order_by = "id"; // Default ordering
        }
    
        $order = "ORDER BY $details_table.$order_by $order_dir";
    
       
        // Pagination
        $limit = $this->_get_clean_value($options, "limit");
        $skip = $this->_get_clean_value($options, "skip");
        $offset = $skip ? intval($skip) : 0;
        $limit_offset = $limit ? "LIMIT $offset, $limit" : "";
    
        // Prepare SQL Query
        $sql = "SELECT SQL_CALC_FOUND_ROWS $details_table.* 
                FROM $details_table 
                $where 
                $order 
                $limit_offset";
    
        // Execute Query
        $query = $this->db->query($sql);
        if (!$query) {
            throw new \Exception("Database query failed: " . $this->db->error());
        }
    
        // Get total rows for pagination
        $total_rows = $this->db->query("SELECT FOUND_ROWS() as found_rows")->getRow();
    
        // Return results with pagination info
        return $limit ? array(
            "data" => $query->getResult(),
            "recordsTotal" => $total_rows->found_rows,
            "recordsFiltered" => $total_rows->found_rows,
        ) : $query->getResult();
    }
    
    
    

}
