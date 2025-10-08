<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription_model extends CI_Model {
    
    private $table = 'subscriptions';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Add new subscription
     * @param array $data
     * @return boolean
     */
    public function add($data) {
        return $this->db->insert($this->table, $data);
    }
    
    /**
     * Get subscription by seeker ID
     * @param int $seeker_id
     * @return object|null
     */
    public function get_subscription_by_seeker_id($seeker_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('seeker_ID', $seeker_id);
        $this->db->where('status', 'active');
        $this->db->where('end_date >=', date('Y-m-d H:i:s'));
        $this->db->order_by('ID', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            return $query->row();
        }
        return NULL;
    }
    
    /**
     * Check if user has active premium subscription
     * @param int $seeker_id
     * @return boolean
     */
    public function has_active_premium($seeker_id) {
        $this->db->select('ID');
        $this->db->from($this->table);
        $this->db->where('seeker_ID', $seeker_id);
        $this->db->where('subscription_type', 'premium');
        $this->db->where('status', 'active');
        $this->db->where('end_date >=', date('Y-m-d H:i:s'));
        $query = $this->db->get();
        
        return ($query->num_rows() > 0) ? TRUE : FALSE;
    }
    
    /**
     * Update subscription
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function update($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Cancel subscription by seeker ID
     * @param int $seeker_id
     * @return boolean
     */
    public function cancel_subscription($seeker_id) {
        $data = array(
            'status' => 'cancelled',
            'cancelled_date' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('seeker_ID', $seeker_id);
        $this->db->where('status', 'active');
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Get subscription history by seeker ID
     * @param int $seeker_id
     * @return array
     */
    public function get_subscription_history($seeker_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('seeker_ID', $seeker_id);
        $this->db->order_by('start_date', 'DESC');
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    
    /**
     * Count active subscriptions
     * @return int
     */
    public function count_active_subscriptions() {
        $this->db->where('status', 'active');
        $this->db->where('end_date >=', date('Y-m-d H:i:s'));
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Delete subscription (for testing purposes)
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        $this->db->where('ID', $id);
        return $this->db->delete($this->table);
    }
}

/* End of file subscription_model.php */
/* Location: ./application/models/subscription_model.php */