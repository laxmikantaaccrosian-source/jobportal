<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH. 'views/razorpay/Razorpay.php';
// use Razorpay/Api/Api;

class Add_subscription extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->model('ads_model');
		$this->load->model('subscription_model');
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		// Check session
		if(!$this->session->userdata('user_id')){
			redirect('jobseeker/login');
		}
		
		$data['ads_row'] = $this->ads;
		$data['title'] = $this->session->userdata('first_name').' - Subscription';
		
		// Check current subscription status
		$data['current_subscription'] = $this->subscription_model->get_subscription_by_seeker_id($this->session->userdata('user_id'));
		$data['has_premium'] = $this->subscription_model->has_active_premium($this->session->userdata('user_id'));
		
		$this->load->view('jobseeker/add_subscription_view', $data);
	}
	
	public function process_payment()
	{
		// Check session
		if(!$this->session->userdata('user_id')){
			echo json_encode(array('status' => 'error', 'message' => 'Session expired. Please login again.'));
			exit;	
		}
		
		// Check if already has active premium
		if($this->subscription_model->has_active_premium($this->session->userdata('user_id'))){
			echo json_encode(array('status' => 'error', 'message' => 'You already have an active premium subscription.'));
			exit;
		}
		
		// Process payment - integrate with payment gateway here
		// For demonstration, we'll create subscription record
		
		$data_array = array(
			'seeker_ID' => $this->session->userdata('user_id'),
			'subscription_type' => 'premium',
			'amount' => 1000.00,
			'start_date' => date('Y-m-d H:i:s'),
			'end_date' => date('Y-m-d H:i:s', strtotime('+1 year')),
			'status' => 'active',
			'payment_method' => $this->input->post('payment_method'),
			'transaction_id' => 'TXN'.time().rand(1000,9999)
		);
		
		if($this->subscription_model->add($data_array)){
			$this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>Success!</strong> Your premium subscription has been activated successfully.</div>');
			echo json_encode(array('status' => 'success', 'message' => 'Subscription activated successfully!'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to activate subscription. Please try again.'));
		}
		exit;
	}
	
	public function cancel()
	{
		// Check session
		if(!$this->session->userdata('user_id')){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Session expired. Please login again.</div>');
			redirect('jobseeker/login');
		}
		
		if($this->subscription_model->cancel_subscription($this->session->userdata('user_id'))){
			$this->session->set_flashdata('msg', '<div class="alert alert-info"><strong>Cancelled!</strong> Your subscription has been cancelled successfully.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Failed to cancel subscription.</div>');
		}
		
		redirect('jobseeker/add_subscription');
	}
}

/* End of file add_subscription.php */
/* Location: ./application/controllers/jobseeker/add_subscription.php */