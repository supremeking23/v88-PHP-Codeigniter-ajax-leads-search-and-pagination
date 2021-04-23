<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model {
    public function get_all_clients(){
        $query = "SELECT id,first_name,last_name,email, DATE_FORMAT(joined_datetime,'%Y-%m-%d') as date_joined FROM clients";
        return $this->db->query($query)->result_array();
    }


    
}

?>