<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="<?php echo $job->post_name;?>, <?php echo $job->sector_name;?>, Government Jobs" />
<meta name="description" content="<?php echo $job->post_name;?> in <?php echo $job->sector_name;?>. Total Vacancy: <?php echo $job->total_vacancy;?>. Apply before <?php echo date('M d, Y', strtotime($job->last_date));?>." />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<style>
.job-detail-container {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.job-title-section {
    border-bottom: 3px solid #0066cc;
    padding-bottom: 20px;
    margin-bottom: 30px;
}
.job-main-title {
    color: #0066cc;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 10px;
}
.job-subtitle {
    font-size: 20px;
    color: #666;
    margin-bottom: 5px;
}
.important-dates {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 20px;
    margin: 20px 0;
    border-radius: 4px;
}
.important-dates h3 {
    color: #856404;
    font-size: 18px;
    margin-bottom: 15px;
}
.date-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}
.date-item {
    background: #fff;
    padding: 15px;
    border-radius: 4px;
}
.date-label {
    font-size: 13px;
    color: #666;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.date-value {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}
.details-section {
    margin: 30px 0;
}
.details-section h3 {
    font-size: 20px;
    color: #333;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
.detail-row {
    display: flex;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}
.detail-row:last-child {
    border-bottom: none;
}
.detail-label-col {
    flex: 0 0 200px;
    font-weight: 600;
    color: #555;
}
.detail-value-col {
    flex: 1;
    color: #333;
}
.apply-section {
    background: #e8f4f8;
    border: 2px solid #0066cc;
    padding: 25px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: center;
}
.apply-btn {
    background: #0066cc;
    color: #fff;
    padding: 15px 40px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    transition: all 0.3s ease;
}
.apply-btn:hover {
    background: #0052a3;
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,102,204,0.3);
}
.apply-btn.disabled {
    background: #999;
    cursor: not-allowed;
}
.expired-notice {
    background: #f8d7da;
    border: 2px solid #dc3545;
    color: #721c24;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    font-weight: bold;
    margin: 20px 0;
}
.back-btn {
    display: inline-block;
    margin-bottom: 20px;
    color: #0066cc;
    text-decoration: none;
    font-weight: 600;
}
.back-btn:hover {
    text-decoration: underline;
}
.description-content {
    line-height: 1.8;
    color: #444;
}
.download-btn {
    background: #17a2b8;
    color: #fff;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
    transition: all 0.3s ease;
}
.download-btn:hover {
    background: #138496;
    color: #fff;
    text-decoration: none;
}
.notification-section {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 20px;
    border-radius: 4px;
    margin-top: 15px;
}
</style>
</style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 

<!--Job Detail Block-->
<div class="innerpageWrap">
<div class="container">
  <div class="row"> 
    
    <!--Main Col-->
    <div class="col-md-10"> 
      
      <a href="<?php echo base_url('government-jobs');?>" class="back-btn">← Back to All Government Jobs</a>
      
      <div class="job-detail-container">
        
        <!-- Title Section -->
        <div class="job-title-section">
          <div class="job-main-title"><?php echo $job->post_name;?></div>
          <div class="job-subtitle"><?php echo $job->sector_name;?> - <?php echo $job->year;?></div>
        </div>
        
        <!-- Important Dates -->
        <div class="important-dates">
          <h3>Important Dates</h3>
          <div class="date-grid">
            <div class="date-item">
              <div class="date-label">Application Start Date</div>
              <div class="date-value"><?php echo date('d M Y', strtotime($job->apply_date));?></div>
            </div>
            <div class="date-item">
              <div class="date-label">Last Date to Apply</div>
              <div class="date-value" style="color: <?php echo (strtotime($job->last_date) < time()) ? '#dc3545' : '#28a745';?>;">
                <?php echo date('d M Y', strtotime($job->last_date));?>
              </div>
            </div>
          </div>
        </div>
        
        <?php if(strtotime($job->last_date) < time()): ?>
        <div class="expired-notice">
          ⚠ This job posting has expired. Applications are no longer being accepted.
        </div>
        <?php endif;?>
        
        <!-- Job Details -->
        <div class="details-section">
          <h3>Job Details</h3>
          
          <div class="detail-row">
            <div class="detail-label-col">Total Vacancy:</div>
            <div class="detail-value-col"><strong><?php echo $job->total_vacancy;?></strong> Posts</div>
          </div>
          
          <div class="detail-row">
            <div class="detail-label-col">Age Limit:</div>
            <div class="detail-value-col"><?php echo $job->age_limit;?></div>
          </div>
          
          <?php if(!empty($job->qualification)): ?>
          <div class="detail-row">
            <div class="detail-label-col">Qualification:</div>
            <div class="detail-value-col"><?php echo $job->qualification;?></div>
          </div>
          <?php endif;?>
          
          <?php if(!empty($job->salary)): ?>
          <div class="detail-row">
            <div class="detail-label-col">Salary/Pay Scale:</div>
            <div class="detail-value-col"><?php echo $job->salary;?></div>
          </div>
          <?php endif;?>
        </div>
        
        <!-- Job Description -->
        <?php if(!empty($job->job_description)): ?>
        <div class="details-section">
          <h3>Job Description</h3>
          <div class="description-content">
            <?php echo nl2br($job->job_description);?>
          </div>
        </div>
        <?php endif;?>

        <!-- Download Notification -->
        <?php if(!empty($job->official_notification)): ?>
        <div class="details-section">
          <h3>Official Notification</h3>
          <div class="notification-section">
            <p>Download the official notification for more details:</p>
            <a href="<?php echo base_url('public/uploads/notifications/'.$job->official_notification);?>" target="_blank" class="download-btn">
              <i class="fa fa-download"></i> Download Official Notification
            </a>
            <p class="text-muted" style="margin-top: 10px; font-size: 12px;">
              <small>File: <?php echo $job->official_notification;?></small>
            </p>
          </div>
        </div>
        <?php endif;?>
        
        <!-- Apply Section -->
        <?php if(strtotime($job->last_date) >= time()): ?>
        <div class="apply-section">
          <h3 style="margin-bottom: 10px;">Ready to Apply?</h3>
          <p>Click the button below to visit the official application page</p>
          <?php if($job->application_link): ?>
          <a href="<?php echo $job->application_link;?>" target="_blank" class="apply-btn">Apply Online Now</a>
          <?php else: ?>
          <a href="<?php echo base_url('contact-us');?>" class="apply-btn">Contact Us for Application</a>
          <?php endif;?>
        </div>
        <?php endif;?>
        
        
        
      </div>
      
    </div>
    
    <?php 
    // $this->load->view('common/right_ads');
    ?>
  </div>
</div>
</div>
<!--/Job Detail Block-->

<?php 
// $this->load->view('common/bottom_ads');
?>

<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>