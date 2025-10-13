<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<style>
.job-status-active {
    color: #28a745;
    font-weight: bold;
}
.job-status-inactive {
    color: #dc3545;
    font-weight: bold;
}
.expired-label {
    background: #dc3545;
    color: #fff;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 11px;
}
.active-label {
    background: #28a745;
    color: #fff;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 11px;
}
</style>
</head>
<body class="skin-blue">
<?php $this->load->view('admin/common/after_body_open'); ?>
<?php $this->load->view('admin/common/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php $this->load->view('admin/common/left_side'); ?>
<aside class="right-side">

<div class="main-content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo $title;?></h3>
          <div class="pull-right">
            <a href="<?php echo base_url('admin/government-jobs/add');?>" class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i> Add New Government Job
            </a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          
          <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success');?>
          </div>
          <?php endif;?>
          
          <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('error');?>
          </div>
          <?php endif;?>
          
          <?php if($jobs): ?>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="20%">Sector Name</th>
                  <th width="5%">Year</th>
                  <th width="20%">Post Name</th>
                  <th width="10%">Apply Date</th>
                  <th width="10%">Last Date</th>
                  <th width="8%">Vacancy</th>
                  <th width="8%">Status</th>
                  <th width="14%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($jobs as $job): 
                  $is_expired = (strtotime($job->last_date) < time());
                ?>
                <tr>
                  <td><?php echo $job->id;?></td>
                  <td><?php echo $job->sector_name;?></td>
                  <td><?php echo $job->year;?></td>
                  <td>
                    <?php echo word_limiter($job->post_name, 5);?>
                    <?php if($is_expired): ?>
                    <br><span class="expired-label">EXPIRED</span>
                    <?php else: ?>
                    <br><span class="active-label">ACTIVE</span>
                    <?php endif;?>
                  </td>
                  <td><?php echo date('M d, Y', strtotime($job->apply_date));?></td>
                  <td><?php echo date('M d, Y', strtotime($job->last_date));?></td>
                  <td><?php echo $job->total_vacancy;?></td>
                  <td>
                    <span class="job-status-<?php echo $job->status;?>">
                      <?php echo ucfirst($job->status);?>
                    </span>
                  </td>
                  <td>
                    <a href="<?php echo base_url('government-jobs/detail/'.$job->slug);?>" 
                       class="btn btn-info btn-xs" target="_blank" title="View">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="<?php echo base_url('admin/government-jobs/edit/'.$job->id);?>" 
                       class="btn btn-warning btn-xs" title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?php echo base_url('admin/government-jobs/delete/'.$job->id);?>" 
                       class="btn btn-danger btn-xs" 
                       onclick="return confirm('Are you sure you want to delete this job?');" 
                       title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          
          <!-- Pagination -->
          <div class="text-center">
            <?php echo $links;?>
          </div>
          
          <?php else: ?>
          <div class="alert alert-info">
            <strong>No government jobs found.</strong> Click the "Add New Government Job" button to create one.
          </div>
          <?php endif;?>
          
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