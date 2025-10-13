<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Government_jobs_model extends CI_Model {
    
    private $table = 'government_jobs';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get all active government jobs with pagination
    public function get_all_jobs($limit = 20, $offset = 0, $filters = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        
        // Apply filters
        if (!empty($filters['sector'])) {
            $this->db->like('sector_name', $filters['sector']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('year', $filters['year']);
        }
        if (!empty($filters['post'])) {
            $this->db->like('post_name', $filters['post']);
        }
        
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    // Count total active jobs
    public function count_all_jobs($filters = array()) {
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        
        // Apply filters
        if (!empty($filters['sector'])) {
            $this->db->like('sector_name', $filters['sector']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('year', $filters['year']);
        }
        if (!empty($filters['post'])) {
            $this->db->like('post_name', $filters['post']);
        }
        
        return $this->db->count_all_results();
    }
    
    // Get job by slug
    public function get_job_by_slug($slug) {
        $this->db->where('slug', $slug);
        $this->db->where('status', 'active');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Get job by ID
    public function get_job_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Search government jobs
    public function search_jobs($keyword, $limit = 20, $offset = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->like('sector_name', $keyword);
        $this->db->or_like('post_name', $keyword);
        $this->db->or_like('job_description', $keyword);
        $this->db->group_end();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    // Count search results
    public function count_search_results($keyword) {
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->like('sector_name', $keyword);
        $this->db->or_like('post_name', $keyword);
        $this->db->or_like('job_description', $keyword);
        $this->db->group_end();
        
        return $this->db->count_all_results();
    }
    
    // Get unique sectors for filter
    public function get_unique_sectors() {
        $this->db->distinct();
        $this->db->select('sector_name');
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        $this->db->order_by('sector_name', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get unique years for filter
    public function get_unique_years() {
        $this->db->distinct();
        $this->db->select('year');
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        $this->db->order_by('year', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
    
    // Admin functions
    public function insert_job($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update_job($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete_job($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    // Get all jobs for admin (including inactive)
    public function get_all_jobs_admin($limit = 20, $offset = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_all_jobs_admin() {
        return $this->db->count_all($this->table);
    }
}