<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<style>
.subscription-box {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    min-height: 650px;
}
.subscription-box:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #5bc0de;
}
.subscription-box.premium {
    border-color: #f0ad4e;
    background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%);
}
.subscription-box.premium:hover {
    border-color: #f0ad4e;
    box-shadow: 0 5px 20px rgba(240, 173, 78, 0.3);
}
.subscription-box.active-plan {
    border-color: #5cb85c;
    background: linear-gradient(135deg, #e8f5e9 0%, #ffffff 100%);
}
.plan-header {
    text-align: center;
    margin-bottom: 25px;
}
.plan-title {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}
.plan-price {
    font-size: 42px;
    font-weight: bold;
    color: #5bc0de;
    margin: 15px 0;
}
.plan-price.premium-price {
    color: #f0ad4e;
}
.plan-price .currency {
    font-size: 24px;
    vertical-align: super;
}
.plan-price .period {
    font-size: 16px;
    color: #777;
    font-weight: normal;
}
.features-list {
    list-style: none;
    padding: 0;
    margin: 25px 0;
}
.features-list li {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    font-size: 15px;
    color: #555;
}
.features-list li:last-child {
    border-bottom: none;
}
.features-list li i {
    color: #5cb85c;
    margin-right: 10px;
    font-size: 18px;
}
.features-list li.premium-feature i {
    color: #f0ad4e;
}
.subscription-badge {
    display: inline-block;
    padding: 5px 15px;
    background: #5cb85c;
    color: white;
    border-radius: 20px;
    font-size: 12px;
    margin-bottom: 15px;
    text-transform: uppercase;
}
.subscription-badge.premium-badge {
    background: #f0ad4e;
}
.subscription-badge.active-badge {
    background: #5cb85c;
}
.highlight-box {
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 5px;
    padding: 15px;
    margin-top: 20px;
    text-align: center;
}
.highlight-box strong {
    color: #856404;
    font-size: 16px;
}
.subscription-info-box {
    background: #d9edf7;
    border: 1px solid #bce8f1;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    color: #31708f;
}
</style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
  <div class="row">
  	
   <div class="col-md-3"> 
      <div class="dashiconwrp">
        <div class="wrap_enable"><?php $this->load->view('jobseeker/common/jobseeker_menu');?></div>
      </div>
    </div>
  
    <div class="col-md-9"> 
      <?php echo $this->session->flashdata('msg');?>
      
      <!--Subscription Section-->
      <div class="formwraper">
        <div class="titlehead">Choose Your Subscription Plan</div>
        <div class="formint">
          
          <?php if($has_premium && $current_subscription): ?>
          <div class="subscription-info-box">
            <strong><i class="fa fa-info-circle"></i> Active Subscription</strong>
            <p style="margin: 10px 0 0 0;">
              You have an active <strong>Premium</strong> subscription valid until 
              <strong><?php echo date('d M Y', strtotime($current_subscription->end_date)); ?></strong>
            </p>
          </div>
          <?php else: ?>
          <p class="normal-details" style="font-size:13px; margin-bottom: 30px;">
            Select the plan that best suits your job search needs. Upgrade to Premium for guaranteed job placement assistance and priority support.
          </p>
          <?php endif; ?>
          
          <div class="row">
            <!-- Free/Basic Plan -->
            <div class="col-md-6">
              <div class="subscription-box <?php echo (!$has_premium)?'active-plan':''; ?>">
                <div class="plan-header">
                  <span class="subscription-badge <?php echo (!$has_premium)?'active-badge':''; ?>">
                    <?php echo (!$has_premium)?'CURRENT PLAN':'BASIC PLAN'; ?>
                  </span>
                  <div class="plan-title">Free Membership</div>
                  <div class="plan-price">
                    <span class="currency">₹</span>0
                    <span class="period">/ Forever</span>
                  </div>
                </div>
                
                <ul class="features-list">
                  <li><i class="fa fa-check-circle"></i> Create and manage your profile</li>
                  <li><i class="fa fa-check-circle"></i> Search for jobs</li>
                  <li><i class="fa fa-check-circle"></i> Apply for unlimited jobs</li>
                  <li><i class="fa fa-check-circle"></i> Upload your resume</li>
                  <li><i class="fa fa-check-circle"></i> Receive job alerts</li>
                  <li><i class="fa fa-check-circle"></i> Basic skill management</li>
                  <li><i class="fa fa-check-circle"></i> Receive Interview Calls</li>
                  <li><i class="fa fa-check-circle"></i> Track your applications</li>
                  <li><i class="fa fa-check-circle"></i> Access to job board</li>
                </ul>
                
                <div style="text-align: center; margin-top: 25px;">
                  <?php if(!$has_premium): ?>
                  <button class="btn btn-success btn-lg" disabled style="width: 80%;">
                    <i class="fa fa-check"></i> Current Plan
                  </button>
                  <?php else: ?>
                  <button class="btn btn-default btn-lg" disabled style="width: 80%;">
                    <i class="fa fa-check"></i> Basic Plan
                  </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            
            <!-- Premium Plan -->
            <div class="col-md-6">
              <div class="subscription-box premium <?php echo ($has_premium)?'active-plan':''; ?>">
                <div class="plan-header">
                  <span class="subscription-badge <?php echo ($has_premium)?'active-badge':'premium-badge'; ?>">
                    <?php echo ($has_premium)?'CURRENT PLAN':'PREMIUM PLAN'; ?>
                  </span>
                  <div class="plan-title">Premium Membership</div>
                  <div class="plan-price premium-price">
                    <span class="currency"></span>Contact Us
                    <!-- <span class="currency">₹</span>99
                    <span class="period">/ Year</span> -->
                  </div>
                </div>
                
                <ul class="features-list">
                  <li class="premium-feature"><i class="fa fa-star"></i> <strong>100% Job Assurance</strong></li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Priority job matching</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Direct employer connections</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Resume highlighted to employers</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Dedicated placement support</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Career counseling sessions</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Interview preparation assistance</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> Premium customer support (24/7)</li>
                  <li class="premium-feature"><i class="fa fa-star"></i> All basic features included</li>
                </ul>
                
                <?php 
                // if(!$has_premium): 
                ?>
                <!-- <div class="highlight-box">
                  <strong><i class="fa fa-shield"></i>Placement Guarantee!</strong>
                  <p style="margin: 10px 0 0 0; font-size: 13px;">Get guaranteed interviews and dedicated support until you land your dream job.</p>
                </div> -->
                <?php
                //  endif; 
                ?>
                
                <div style="text-align: center; margin-top: 25px;">
                  <?php if($has_premium): ?>
                  <button class="btn btn-success btn-lg" disabled style="width: 80%;">
                    <i class="fa fa-check"></i> Active Premium
                  </button>
                  <div style="margin-top: 15px;">
                    <a href="<?php echo base_url('jobseeker/add_subscription/cancel');?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Are you sure you want to cancel your premium subscription?');">
                      Cancel Subscription
                    </a>
                  </div>
                  <?php else: ?>
                  <button class="btn btn-warning btn-lg" id="subscribe-btn" style="width: 80%; font-size: 18px;">
                    <i class="fa fa-credit-card"></i> Contact Us
                  </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          
          <div class="clear">&nbsp;</div>
          
          <!-- Additional Information -->
          <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
              <div style="background: #f9f9f9; padding: 20px; border-radius: 5px;">
                <h4 style="margin-top: 0;"><i class="fa fa-info-circle"></i> Why Choose Premium?</h4>
                <div class="row">
                  <div class="col-md-4">
                    <h5><i class="fa fa-briefcase" style="color: #f0ad4e;"></i> Job Assurance</h5>
                    <p style="font-size: 13px;">Our premium members get job placement Assurance with dedicated support throughout the process.</p>
                  </div>
                  <div class="col-md-4">
                    <h5><i class="fa fa-phone" style="color: #f0ad4e;"></i> Interview Guarantee</h5>
                    <p style="font-size: 13px;">Get interview calls from top companies matching your profile and skills.</p>
                  </div>
                  <div class="col-md-4">
                    <h5><i class="fa fa-users" style="color: #f0ad4e;"></i> Priority Support</h5>
                    <p style="font-size: 13px;">Receive priority customer support and personalized career counseling from our experts.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="clear">&nbsp;</div>
          <div class="clear">&nbsp;</div>
        </div>
      </div>
    </div>
    <!--/Subscription Detail-->
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>

<script type="text/javascript">
$(document).ready(function(){
    $('#subscribe-btn').click(function(){
        var btn = $(this);
        var confirmed = confirm('You are about to subscribe to Premium Plan for ₹1,000/year.\n\nThis will give you:\n• 100% Job Assurance\n• Guaranteed Interview Calls\n• Priority Support\n\nDo you want to proceed to payment?');
        
        if(confirmed){
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            
            // In production, integrate with payment gateway
            // For demo, we'll process directly
            $.ajax({
                url: '<?php echo base_url('jobseeker/add_subscription/process_payment');?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    payment_method: 'demo',
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response){
                    if(response.status == 'success'){
                        alert('Success! ' + response.message);
                        window.location.reload();
                    } else {
                        alert('Error: ' + response.message);
                        btn.prop('disabled', false).html('<i class="fa fa-credit-card"></i> Subscribe Now');
                    }
                },
                error: function(xhr, status, error){
                    alert('An error occurred. Please try again.\n\nError: ' + error);
                    btn.prop('disabled', false).html('<i class="fa fa-credit-card"></i> Subscribe Now');
                }
            });
        }
    });
});
</script>
</body>
</html>