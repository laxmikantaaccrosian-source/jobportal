<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class government_jobs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ads_model');
        $this->load->library('user_agent');
        $this->ads = $this->ads_model->get_ads();
        $indeed_key = [INDEED_KEY];
        $this->load->library('indeed', $indeed_key);
    }

    public function index() {
        $data['title'] = 'Government Job Portal';
        $data['ads_row'] = $this->ads;
        $data['param'] = 'Government Jobs';

        // Path to your JSON file
        $json_path = APPPATH . 'data/jobs.json';

        // Check if file exists
        if (file_exists($json_path)) {
            // Read and decode JSON data
            $json_data = file_get_contents($json_path);
            $data['jobs'] = json_decode($json_data, true);
        } else {
            $data['jobs'] = [];
        }

        // Load view
        $this->load->view('government_jobs_view', $data);
    }
}
