<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Government_jobs extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('government_jobs_model');
        $this->ads = '';
        if ($this->load->is_loaded('ads_model')) {
            $this->ads = $this->ads_model->get_ads();
        }
    }
    
    // Main listing page
    public function index() {
        $data['ads_row'] = $this->ads;
        
        // Get filters from GET/POST
        $filters = array(
            'sector' => $this->input->get_post('sector'),
            'year' => $this->input->get_post('year'),
            'post' => $this->input->get_post('post')
        );
        
        // Pagination configuration
        $total_rows = $this->government_jobs_model->count_all_jobs($filters);
        $config = pagination_configuration(base_url("government-jobs"), $total_rows, 20, 2, 5, true);
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        
        // Get jobs
        $data['result'] = $this->government_jobs_model->get_all_jobs($config["per_page"], $page, $filters);
        
        // Get filter options
        $data['sectors'] = $this->government_jobs_model->get_unique_sectors();
        $data['years'] = $this->government_jobs_model->get_unique_years();
        
        // Pagination info
        $current_records = ($this->uri->segment(2)) ? intval($this->uri->segment(2)) + $config["per_page"] : $config["per_page"];
        $current_records = ($current_records > $total_rows) ? $total_rows : $current_records;
        
        $data['total_rows'] = $total_rows;
        $data['page'] = $current_records;
        $data['from_record'] = $page + 1;
        $data['filters'] = $filters;
        $data['title'] = 'Government Jobs - Latest Govt Job Openings';
        
        $this->load->view('government_jobs_view', $data);
    }
    
    // Search government jobs
    public function search() {
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('government-jobs'), '');
            return;
        }
        
        $keyword = $this->input->post('keyword');
        $string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $keyword);
        $param = strtolower(preg_replace('/\s+/', '-', $string1));
        
        redirect(base_url('government-jobs/search/' . $param), '');
    }
    
    // Search results page
    public function search_results() {
        $data['ads_row'] = $this->ads;
        
        $param = str_replace('-', ' ', $this->uri->segment(3));
        $param = strip_tags($param);
        
        // Pagination
        $total_rows = $this->government_jobs_model->count_search_results($param);
        $config = pagination_configuration(base_url("government-jobs/search/" . $this->uri->segment(3)), $total_rows, 20, 4, 5, true);
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
        
        // Get search results
        $data['result'] = $this->government_jobs_model->search_jobs($param, $config["per_page"], $page);
        
        // Get filter options
        $data['sectors'] = $this->government_jobs_model->get_unique_sectors();
        $data['years'] = $this->government_jobs_model->get_unique_years();
        
        // Pagination info
        $current_records = ($this->uri->segment(4)) ? intval($this->uri->segment(4)) + $config["per_page"] : $config["per_page"];
        $current_records = ($current_records > $total_rows) ? $total_rows : $current_records;
        
        $data['total_rows'] = $total_rows;
        $data['page'] = $current_records;
        $data['from_record'] = $page + 1;
        $data['keyword'] = $param;
        $data['title'] = $param . ' - Government Jobs Search';
        
        $this->load->view('government_jobs_search_view', $data);
    }
    
    // Job detail page
    public function detail($slug = '') {
        if (empty($slug)) {
            redirect(base_url('government-jobs'), '');
            return;
        }
        
        $data['ads_row'] = $this->ads;
        $data['job'] = $this->government_jobs_model->get_job_by_slug($slug);
        
        if (!$data['job']) {
            show_404();
            return;
        }
        
        $data['title'] = $data['job']->post_name . ' - ' . $data['job']->sector_name;
        $this->load->view('government_job_detail_view', $data);
    }
}