<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends CI_Model {
    public function get_all_leads(){
        $query = "SELECT leads_id,first_name,last_name,email, DATE_FORMAT(registered_datetime,'%Y-%m-%d') as date_joined FROM leads";
        return $this->db->query($query)->result_array();
    }


    // public function get_all_leads_by_names($lead){
    //     $query = "SELECT leads_id,first_name,last_name,email,CONCAT(first_name,' ',last_name) as full_name, DATE_FORMAT(registered_datetime,'%Y-%m-%d') as date_joined FROM leads WHERE first_name like ? OR last_name like ? AND (registered_datetime >= ? AND registered_datetime <= ?)";
    //     $values = array("%{$lead['name']}%","%{$lead['name']}%",$lead['from'],$lead['to']);
    //     return $this->db->query($query,$values)->result_array();
    // }

    public function get_all_leads_by_names($lead){
        $query = "SELECT leads_id,first_name,last_name,email,CONCAT(first_name,' ',last_name) as full_name, DATE_FORMAT(registered_datetime,'%Y-%m-%d') as date_joined FROM leads WHERE first_name like ? OR last_name like ?";
        $values = array("%{$lead['name']}%","%{$lead['name']}%");
        return $this->db->query($query,$values)->result_array();
    }


    public function get_all_leads_by_date($lead){
        $query = "SELECT leads_id,first_name,last_name,email,CONCAT(first_name,' ',last_name) as full_name, DATE_FORMAT(registered_datetime,'%Y-%m-%d') as date_joined FROM leads WHERE registered_datetime >= ? AND registered_datetime <= ?";
        $values = array($lead['from'],$lead['to']);
        return $this->db->query($query,$values)->result_array();
    }


    public function get_all_leads_with_date_params($dates){
        $query = "SELECT CONCAT(clients.first_name,' ',clients.last_name) AS client_name, COUNT(sites.domain_name) AS number_of_leads FROM leads 
        INNER JOIN sites INNER JOIN clients
            ON sites.site_id = leads.site_id AND clients.client_id = sites.client_id
        WHERE registered_datetime >= ? AND registered_datetime <= ?
        GROUP BY client_name; ";

        $values = array($dates['from'],$dates['to']); 
        return $this->db->query($query, $values)->result_array();
    }
    
}

?>