<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_government_jobs extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Check if admin is logged in (matching your admin structure)
        if (!$this->session->userdata('is_admin_login')) {
            redirect(base_url('admin'));
        }
        
        $this->load->model('government_jobs_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('text'); // For word_limiter function
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    // List all government jobs
    public function index() {
        // Pagination
        $total_rows = $this->government_jobs_model->count_all_jobs_admin();
        $config = pagination_configuration(base_url("admin/government-jobs"), $total_rows, 20, 3, 5, true);
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        
        // Get jobs
        $data['jobs'] = $this->government_jobs_model->get_all_jobs_admin($config["per_page"], $page);
        
        $data['total_rows'] = $total_rows;
        $data['title'] = 'Manage Government Jobs';
        
        $this->load->view('admin/government_jobs_list', $data);
    }
    
    // Add new government job
    public function add() {
        $data['title'] = 'Add Government Job';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('sector_name', 'Sector Name', 'required|trim');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('post_name', 'Post Name', 'required|trim');
            $this->form_validation->set_rules('apply_date', 'Apply Date', 'required');
            $this->form_validation->set_rules('last_date', 'Last Date', 'required');
            $this->form_validation->set_rules('total_vacancy', 'Total Vacancy', 'required|numeric');
            $this->form_validation->set_rules('age_limit', 'Age Limit', 'required|trim');
            
            if ($this->form_validation->run() === TRUE) {
                // Create slug
                $slug = $this->create_unique_slug($this->input->post('post_name') . ' ' . $this->input->post('year'));
                
                // Handle file upload for notification
                $notification_file = '';
                if (!empty($_FILES['official_notification']['name'])) {
                    $notification_file = $this->upload_notification();
                }
                
                $insert_data = array(
                    'sector_name' => $this->input->post('sector_name'),
                    'year' => $this->input->post('year'),
                    'post_name' => $this->input->post('post_name'),
                    'job_description' => $this->input->post('job_description'),
                    'apply_date' => $this->input->post('apply_date'),
                    'last_date' => $this->input->post('last_date'),
                    'total_vacancy' => $this->input->post('total_vacancy'),
                    'age_limit' => $this->input->post('age_limit'),
                    'qualification' => $this->input->post('qualification'),
                    'salary' => $this->input->post('salary'),
                    'application_link' => $this->input->post('application_link'),
                    'official_notification' => $notification_file,
                    'slug' => $slug,
                    'status' => $this->input->post('status')
                );
                
                if ($this->government_jobs_model->insert_job($insert_data)) {
                    $this->session->set_flashdata('success', 'Government job added successfully!');
                    redirect(base_url('admin/government-jobs'));
                } else {
                    $data['error'] = 'Failed to add job. Please try again.';
                }
            }
        }
        
        $this->load->view('admin/government_job_form', $data);
    }
    
    // Edit government job
    public function edit($id = '') {
        if (empty($id)) {
            redirect(base_url('admin/government-jobs'));
        }
        
        $data['job'] = $this->government_jobs_model->get_job_by_id($id);
        
        if (!$data['job']) {
            $this->session->set_flashdata('error', 'Job not found!');
            redirect(base_url('admin/government-jobs'));
        }
        
        $data['title'] = 'Edit Government Job';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('sector_name', 'Sector Name', 'required|trim');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('post_name', 'Post Name', 'required|trim');
            $this->form_validation->set_rules('apply_date', 'Apply Date', 'required');
            $this->form_validation->set_rules('last_date', 'Last Date', 'required');
            $this->form_validation->set_rules('total_vacancy', 'Total Vacancy', 'required|numeric');
            $this->form_validation->set_rules('age_limit', 'Age Limit', 'required|trim');
            
            if ($this->form_validation->run() === TRUE) {
                // Create slug if post name or year changed
                $slug = $data['job']->slug;
                if ($this->input->post('post_name') != $data['job']->post_name || 
                    $this->input->post('year') != $data['job']->year) {
                    $slug = $this->create_unique_slug($this->input->post('post_name') . ' ' . $this->input->post('year'), $id);
                }
                
                // Handle file upload for notification
                $notification_file = $data['job']->official_notification;
                if (!empty($_FILES['official_notification']['name'])) {
                    $notification_file = $this->upload_notification();
                    // Delete old file if exists
                    if ($data['job']->official_notification && file_exists('./public/uploads/notifications/' . $data['job']->official_notification)) {
                        unlink('./public/uploads/notifications/' . $data['job']->official_notification);
                    }
                }
                
                $update_data = array(
                    'sector_name' => $this->input->post('sector_name'),
                    'year' => $this->input->post('year'),
                    'post_name' => $this->input->post('post_name'),
                    'job_description' => $this->input->post('job_description'),
                    'apply_date' => $this->input->post('apply_date'),
                    'last_date' => $this->input->post('last_date'),
                    'total_vacancy' => $this->input->post('total_vacancy'),
                    'age_limit' => $this->input->post('age_limit'),
                    'qualification' => $this->input->post('qualification'),
                    'salary' => $this->input->post('salary'),
                    'application_link' => $this->input->post('application_link'),
                    'official_notification' => $notification_file,
                    'slug' => $slug,
                    'status' => $this->input->post('status')
                );
                
                if ($this->government_jobs_model->update_job($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Government job updated successfully!');
                    redirect(base_url('admin/government-jobs'));
                } else {
                    $data['error'] = 'Failed to update job. Please try again.';
                }
            }
        }
        
        $this->load->view('admin/government_job_form', $data);
    }
    
    // Delete government job
    public function delete($id = '') {
        if (empty($id)) {
            redirect(base_url('admin/government-jobs'));
        }
        
        $job = $this->government_jobs_model->get_job_by_id($id);
        
        if (!$job) {
            $this->session->set_flashdata('error', 'Job not found!');
            redirect(base_url('admin/government-jobs'));
        }
        
        // Delete notification file if exists
        if ($job->official_notification && file_exists('./public/uploads/notifications/' . $job->official_notification)) {
            unlink('./public/uploads/notifications/' . $job->official_notification);
        }
        
        if ($this->government_jobs_model->delete_job($id)) {
            $this->session->set_flashdata('success', 'Government job deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete job!');
        }
        
        redirect(base_url('admin/government-jobs'));
    }
    
    // Helper function to create unique slug
    private function create_unique_slug($string, $exclude_id = 0) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
        
        // Check if slug exists
        $this->db->where('slug', $slug);
        if ($exclude_id > 0) {
            $this->db->where('id !=', $exclude_id);
        }
        $result = $this->db->get('government_jobs');
        
        if ($result->num_rows() > 0) {
            $slug = $slug . '-' . time();
        }
        
        return $slug;
    }
    
    // Helper function to upload notification PDF
    private function upload_notification() {
        $config['upload_path'] = './public/uploads/notifications/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 5120; // 5MB
        $config['file_name'] = time() . '_' . $_FILES['official_notification']['name'];
        
        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('official_notification')) {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        }
        
        return '';
    }
}