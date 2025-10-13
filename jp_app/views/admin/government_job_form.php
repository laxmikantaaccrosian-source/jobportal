<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
</head>
<body class="skin-blue">
<?php $this->load->view('admin/common/after_body_open'); ?>
<?php $this->load->view('admin/common/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php $this->load->view('admin/common/left_side'); ?>
<aside class="right-side">
  <section class="content-header">
    <h1><?php echo $title;?></h1>
  </section>

<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo $title;?></h3>
        <div class="pull-right">
          <a href="<?php echo base_url('admin/government-jobs');?>" class="btn btn-default btn-sm">
            <i class="fa fa-arrow-left"></i> Back to List
          </a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="box-body">
          
          <?php if(isset($error)): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $error;?>
          </div>
          <?php endif;?>
          
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          
          <?php 
            $form_action = isset($job) ? base_url('admin/government-jobs/edit/'.$job->id) : base_url('admin/government-jobs/add');
            echo form_open_multipart($form_action, array('class' => 'form-horizontal'));
          ?>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Sector Name <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="sector_name" class="form-control" 
                     value="<?php echo set_value('sector_name', isset($job) ? $job->sector_name : '');?>" 
                     placeholder="e.g., Railway Recruitment Board, SSC, UPSC" required>
              <small class="help-block">Enter the government department or organization name</small>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Year <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="number" name="year" class="form-control" 
                     value="<?php echo set_value('year', isset($job) ? $job->year : date('Y'));?>" 
                     min="2020" max="2099" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Post Name <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="post_name" class="form-control" 
                     value="<?php echo set_value('post_name', isset($job) ? $job->post_name : '');?>" 
                     placeholder="e.g., Junior Engineer, Clerk, Officer" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Job Description</label>
            <div class="col-sm-9">
              <textarea name="job_description" class="form-control" rows="5" 
                        placeholder="Enter detailed job description, eligibility, selection process, etc."><?php echo set_value('job_description', isset($job) ? $job->job_description : '');?></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Apply Date <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="date" name="apply_date" class="form-control" 
                     value="<?php echo set_value('apply_date', isset($job) ? $job->apply_date : '');?>" required>
              <small class="help-block">Application start date</small>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Last Date to Apply <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="date" name="last_date" class="form-control" 
                     value="<?php echo set_value('last_date', isset($job) ? $job->last_date : '');?>" required>
              <small class="help-block">Last date for application submission</small>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Total Vacancy <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="number" name="total_vacancy" class="form-control" 
                     value="<?php echo set_value('total_vacancy', isset($job) ? $job->total_vacancy : '');?>" 
                     min="1" placeholder="e.g., 500" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Age Limit <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="age_limit" class="form-control" 
                     value="<?php echo set_value('age_limit', isset($job) ? $job->age_limit : '');?>" 
                     placeholder="e.g., 18-35 years" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Qualification</label>
            <div class="col-sm-9">
              <textarea name="qualification" class="form-control" rows="3" 
                        placeholder="e.g., Bachelor's Degree, B.Tech, 10th Pass, etc."><?php echo set_value('qualification', isset($job) ? $job->qualification : '');?></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Salary/Pay Scale</label>
            <div class="col-sm-9">
              <input type="text" name="salary" class="form-control" 
                     value="<?php echo set_value('salary', isset($job) ? $job->salary : '');?>" 
                     placeholder="e.g., $40,000 - $60,000 or Level 7 Pay Matrix">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Application Link</label>
            <div class="col-sm-9">
              <input type="url" name="application_link" class="form-control" 
                     value="<?php echo set_value('application_link', isset($job) ? $job->application_link : '');?>" 
                     placeholder="https://example.com/apply">
              <small class="help-block">Direct link to the official application page</small>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Official Notification</label>
            <div class="col-sm-9">
              <?php if(isset($job) && $job->official_notification): ?>
              <p class="form-control-static">
                Current file: <a href="<?php echo base_url('public/uploads/notifications/'.$job->official_notification);?>" target="_blank">
                  <?php echo $job->official_notification;?>
                </a>
              </p>
              <?php endif;?>
              <input type="file" name="official_notification" class="form-control" accept=".pdf,.doc,.docx">
              <small class="help-block">Upload official notification PDF (Max 5MB)</small>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <select name="status" class="form-control" required>
                <option value="active" <?php echo (isset($job) && $job->status == 'active') ? 'selected' : '';?>>Active</option>
                <option value="inactive" <?php echo (isset($job) && $job->status == 'inactive') ? 'selected' : '';?>>Inactive</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> <?php echo isset($job) ? 'Update Job' : 'Add Job';?>
              </button>
              <a href="<?php echo base_url('admin/government-jobs');?>" class="btn btn-default">
                <i class="fa fa-times"></i> Cancel
              </a>
            </div>
          </div>
          
          <?php echo form_close();?>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php $this->load->view('admin/common/footer'); ?>
<?php $this->load->view('admin/common/before_body_close'); ?>
</body>
</html>