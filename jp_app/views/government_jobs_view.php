<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('common/meta_tags'); ?>
  <meta name="keywords" content="<?php echo $param;?> Jobs" />
  <meta name="description" content="<?php echo $param;?> Jobs ,Find best Jobs. Jobs at <?php echo SITE_NAME;?>." />
  <title><?php echo $title;?></title>
  <?php $this->load->view('common/before_head_close'); ?>
  
  <style>
    body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
    .job-box { background: #fff; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
    .job-header { background-color: #ff9800; color: #fff; padding: 10px 15px; border-radius: 6px 6px 0 0; font-weight: bold; }
    .job-body { padding: 15px; font-size: 14px; color: #333; }
    .job-body div { margin-bottom: 6px; }
    .apply-btn { background-color: #ff9800; border: none; color: #fff; font-weight: 600; padding: 8px 18px; border-radius: 4px; text-decoration: none; display: inline-block; }
    .apply-btn:hover { background-color: #e68900; color: #fff; }
  </style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<div class="container mt-4">
  <h3 class="mb-3 text-center">Latest Government Jobs</h3>

  <?php if (!empty($jobs)): ?>
    <?php foreach ($jobs as $job): ?>
      <div class="job-box">
        <div class="job-header"><?php echo $job['job_name']; ?></div>
        <div class="job-body">
          <div><strong>Name of the Post:</strong> <?php echo $job['post_name']; ?></div>
          <div><strong>Apply Date:</strong> <?php echo $job['apply_date']; ?></div>
          <div><strong>Last Date to Apply:</strong> <?php echo $job['last_date']; ?></div>
          <div><strong>Total Vacancy:</strong> <?php echo $job['total_vacancy']; ?></div>
          <div><strong>Age Limit:</strong> <?php echo $job['age_limit']; ?></div>
          <div class="text-center mt-3">
            <a href="#" class="apply-btn">Apply Now</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-center text-muted">No jobs added yet.</p>
  <?php endif; ?>
</div>

<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script type="text/javascript">
select_value('co','<?php echo $this->input->get('co');?>');
</script>
</body>
</html>
