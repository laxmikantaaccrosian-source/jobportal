<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Subscription Helper Functions
 * Place this file in: application/helpers/subscription_helper.php
 * Load in controller: $this->load->helper('subscription');
 */

/**
 * Check if user has premium subscription
 * @param int $seeker_id
 * @return boolean
 */
if (!function_exists('is_premium_user')) {
    function is_premium_user($seeker_id = NULL) {
        $CI =& get_instance();
        
        if($seeker_id === NULL) {
            $seeker_id = $CI->session->userdata('user_id');
        }
        
        if(!$seeker_id) {
            return FALSE;
        }
        
        $CI->load->model('subscription_model');
        return $CI->subscription_model->has_active_premium($seeker_id);
    }
}

/**
 * Get subscription details
 * @param int $seeker_id
 * @return object|null
 */
if (!function_exists('get_user_subscription')) {
    function get_user_subscription($seeker_id = NULL) {
        $CI =& get_instance();
        
        if($seeker_id === NULL) {
            $seeker_id = $CI->session->userdata('user_id');
        }
        
        if(!$seeker_id) {
            return NULL;
        }
        
        $CI->load->model('subscription_model');
        return $CI->subscription_model->get_subscription_by_seeker_id($seeker_id);
    }
}

/**
 * Display subscription badge
 * @param int $seeker_id
 * @return string HTML badge
 */
if (!function_exists('subscription_badge')) {
    function subscription_badge($seeker_id = NULL) {
        if(is_premium_user($seeker_id)) {
            return '<span class="badge badge-warning" style="background:#f0ad4e;"><i class="fa fa-star"></i> Premium</span>';
        }
        return '<span class="badge badge-default" style="background:#999;">Basic</span>';
    }
}

/**
 * Check if subscription is expiring soon (within 7 days)
 * @param int $seeker_id
 * @return boolean
 */
if (!function_exists('is_subscription_expiring_soon')) {
    function is_subscription_expiring_soon($seeker_id = NULL) {
        $subscription = get_user_subscription($seeker_id);
        
        if(!$subscription) {
            return FALSE;
        }
        
        $end_date = strtotime($subscription->end_date);
        $seven_days_later = strtotime('+7 days');
        
        return ($end_date <= $seven_days_later && $end_date >= time());
    }
}

/**
 * Get days remaining in subscription
 * @param int $seeker_id
 * @return int
 */
if (!function_exists('subscription_days_remaining')) {
    function subscription_days_remaining($seeker_id = NULL) {
        $subscription = get_user_subscription($seeker_id);
        
        if(!$subscription) {
            return 0;
        }
        
        $end_date = strtotime($subscription->end_date);
        $current_date = time();
        
        $diff = $end_date - $current_date;
        return max(0, floor($diff / (60 * 60 * 24)));
    }
}

/**
 * Format subscription expiry date
 * @param int $seeker_id
 * @return string
 */
if (!function_exists('subscription_expiry_date')) {
    function subscription_expiry_date($seeker_id = NULL, $format = 'd M Y') {
        $subscription = get_user_subscription($seeker_id);
        
        if(!$subscription) {
            return 'N/A';
        }
        
        return date($format, strtotime($subscription->end_date));
    }
}

/**
 * Check if user can apply for premium jobs
 * @param int $seeker_id
 * @return boolean
 */
if (!function_exists('can_apply_premium_jobs')) {
    function can_apply_premium_jobs($seeker_id = NULL) {
        return is_premium_user($seeker_id);
    }
}

/**
 * Get subscription type label
 * @param string $type
 * @return string
 */
if (!function_exists('subscription_type_label')) {
    function subscription_type_label($type) {
        $labels = array(
            'basic' => '<span class="label label-default">Basic</span>',
            'premium' => '<span class="label label-warning">Premium</span>'
        );
        
        return isset($labels[$type]) ? $labels[$type] : '<span class="label label-default">Unknown</span>';
    }
}

/**
 * Get subscription status label
 * @param string $status
 * @return string
 */
if (!function_exists('subscription_status_label')) {
    function subscription_status_label($status) {
        $labels = array(
            'active' => '<span class="label label-success">Active</span>',
            'expired' => '<span class="label label-danger">Expired</span>',
            'cancelled' => '<span class="label label-warning">Cancelled</span>'
        );
        
        return isset($labels[$status]) ? $labels[$status] : '<span class="label label-default">Unknown</span>';
    }
}

/**
 * Require premium subscription
 * Redirect to subscription page if not premium
 */
if (!function_exists('require_premium_subscription')) {
    function require_premium_subscription($redirect = TRUE) {
        $CI =& get_instance();
        
        if(!is_premium_user()) {
            if($redirect) {
                $CI->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>Premium Feature!</strong> This feature requires a premium subscription. Please upgrade your account.</div>');
                redirect('jobseeker/add_subscription');
            }
            return FALSE;
        }
        return TRUE;
    }
}

/* End of file subscription_helper.php */
/* Location: ./application/helpers/subscription_helper.php */