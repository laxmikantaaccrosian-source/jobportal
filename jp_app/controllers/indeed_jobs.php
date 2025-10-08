<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Indeed_Jobs extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ads_model');
        $this->load->library('user_agent');
        $this->ads = $this->ads_model->get_ads();
        $indeed_key = [INDEED_KEY];
        $this->load->library('indeed', $indeed_key);
    }
    
    public function index() {
        $q = $this->input->get('q', TRUE);
        $l = $this->input->get('l', TRUE);
        $co = $this->input->get('co', TRUE) ?: 'US';
        $data['ads_row'] = $this->ads;
        $result_set = [];
        
        if (!empty($q) && !empty($l)) {
            $result_set = $this->get_jobs($q, $l, $co);
        }
        
        $data['title'] = !empty($q) ? $q . ' Jobs' : 'Indeed Jobs';
        $data['result'] = is_array($result_set) && isset($result_set['results']) ? $result_set['results'] : [];
        $data['param'] = $q ?: '';
        
        $this->load->view('indeed_jobs_view', $data);
    }
    
    private function get_jobs($q = '', $l = '', $co = 'US') {
        $params = [
            'q' => $q,
            'l' => $l,
            'limit' => 20,
            'highlight' => 1,
            'co' => $co,
            'userip' => $this->input->ip_address(),
            'useragent' => $this->agent->agent_string()
        ];
        
        log_message('debug', 'Indeed API params: ' . print_r($params, true));
        
        try {
            // $results = $this->indeed->search($params);
            // log_message('debug', 'Indeed API response: ' . print_r($results, true));
            // return is_array($results) ? $results : [];


            $results = $this->indeed->search($params);

            // echo "<pre>";
            //  print_r($params);
            // print_r($results);
            // echo "</pre>";
            // exit;

            return is_array($results) ? $results : [];
            



        } catch (Exception $e) {
            log_message('error', 'Indeed API error: ' . $e->getMessage());
            return [];
        }
    }
}