<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Subscription Configuration File
 * Place this file in: application/config/subscription_config.php
 * Load in controller: $this->config->load('subscription_config');
 */

/*
|--------------------------------------------------------------------------
| Subscription Plans
|--------------------------------------------------------------------------
| Define your subscription plans here
*/
$config['subscription_plans'] = array(
    'basic' => array(
        'name' => 'Basic Plan',
        'price' => 0,
        'duration_days' => 0, // Forever
        'features' => array(
            'Create and manage profile',
            'Search for jobs',
            'Apply for unlimited jobs',
            'Upload resume',
            'Receive job alerts',
            'Basic skill management',
            'Track applications'
        )
    ),
    'premium' => array(
        'name' => 'Premium Plan',
        'price' => 1000,
        'duration_days' => 365, // 1 year
        'features' => array(
            '100% Job Assurance Guarantee',
            'Guaranteed Interview Calls',
            'Priority job matching',
            'Direct employer connections',
            'Resume highlighted to employers',
            'Dedicated placement support',
            'Career counseling sessions',
            'Interview preparation assistance',
            'Premium customer support (24/7)',
            'All basic features included'
        )
    )
);

/*
|--------------------------------------------------------------------------
| Payment Gateway Settings
|--------------------------------------------------------------------------
| Configure your payment gateway credentials
*/
$config['payment_gateway'] = array(
    'enabled' => FALSE, // Set TRUE when ready to use payment gateway
    'gateway' => 'razorpay', // Options: razorpay, payu, paytm, stripe
    'mode' => 'test', // test or live
    
    // Razorpay
    'razorpay_key_id' => 'YOUR_RAZORPAY_KEY_ID',
    'razorpay_key_secret' => 'YOUR_RAZORPAY_KEY_SECRET',
    
    // PayU
    'payu_merchant_key' => 'YOUR_PAYU_MERCHANT_KEY',
    'payu_salt' => 'YOUR_PAYU_SALT',
    
    // Paytm
    'paytm_merchant_id' => 'YOUR_PAYTM_MERCHANT_ID',
    'paytm_merchant_key' => 'YOUR_PAYTM_MERCHANT_KEY',
    
    // Stripe
    'stripe_publishable_key' => 'YOUR_STRIPE_PUBLISHABLE_KEY',
    'stripe_secret_key' => 'YOUR_STRIPE_SECRET_KEY'
);

/*
|--------------------------------------------------------------------------
| Subscription Features Access Control
|--------------------------------------------------------------------------
| Define which features require premium subscription
*/
$config['premium_features'] = array(
    'apply_premium_jobs' => TRUE,
    'direct_employer_contact' => TRUE,
    'priority_listing' => TRUE,
    'resume_highlight' => TRUE,
    'advanced_search' => FALSE, // Set TRUE to require premium for advanced search
    'unlimited_applications' => FALSE, // Set TRUE to limit basic user applications
    'cv_download' => FALSE // Set TRUE to require premium for CV downloads
);

/*
|--------------------------------------------------------------------------
| Email Notifications
|--------------------------------------------------------------------------
| Configure email notifications for subscriptions
*/
$config['subscription_emails'] = array(
    'send_welcome_email' => TRUE,
    'send_expiry_reminder' => TRUE,
    'send_renewal_reminder' => TRUE,
    'send_cancellation_email' => TRUE,
    'expiry_reminder_days' => 7, // Send reminder 7 days before expiry
    'admin_notification' => TRUE,
    'admin_email' => 'admin@yourdomain.com'
);

/*
|--------------------------------------------------------------------------
| Subscription Limits
|--------------------------------------------------------------------------
| Set limits for different subscription types
*/
$config['subscription_limits'] = array(
    'basic' => array(
        'job_applications_per_day' => 0, // 0 = unlimited
        'profile_views' => 0, // 0 = unlimited
        'saved_jobs' => 0 // 0 = unlimited
    ),
    'premium' => array(
        'job_applications_per_day' => 0, // unlimited
        'profile_views' => 0, // unlimited
        'saved_jobs' => 0 // unlimited
    )
);

/*
|--------------------------------------------------------------------------
| Currency Settings
|--------------------------------------------------------------------------
| Configure currency display
*/
$config['subscription_currency'] = array(
    'symbol' => '₹',
    'code' => 'INR',
    'position' => 'before' // before or after
);

/*
|--------------------------------------------------------------------------
| Trial Period Settings
|--------------------------------------------------------------------------
| Configure free trial period for premium subscription
*/
$config['subscription_trial'] = array(
    'enabled' => FALSE,
    'duration_days' => 7,
    'allowed_trials_per_user' => 1
);

/*
|--------------------------------------------------------------------------
| Auto-Renewal Settings
|--------------------------------------------------------------------------
| Configure automatic subscription renewal
*/
$config['subscription_auto_renewal'] = array(
    'enabled' => FALSE,
    'renewal_reminder_days' => 15 // Send renewal reminder 15 days before expiry
);

/*
|--------------------------------------------------------------------------
| Discount/Coupon Settings
|--------------------------------------------------------------------------
| Enable or disable coupon functionality
*/
$config['subscription_coupons'] = array(
    'enabled' => FALSE,
    'allow_multiple_uses' => FALSE,
    'expiry_notification' => TRUE
);

/* End of file subscription_config.php */
/* Location: ./application/config/subscription_config.php */