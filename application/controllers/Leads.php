<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Leads extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index_json(){
        $data["leads"] = $this->lead->get_all_leads();
        echo json_encode($data);
    }
    

	public function index(){	
        $this->load->view("leads/index");
	}

	public function search(){
		$name = $this->input->post("search");
		$details = array(
			"name" => $name,
		);

		$data["leads"] = $this->lead->get_all_leads_by_names($details);
		echo json_encode($data);
	}

}
