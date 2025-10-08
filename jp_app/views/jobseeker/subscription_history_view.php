<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<style>
.history-table {
    background: white;
    border-radius: 5px;
    overflow: hidden;
}
.history-table table {
    margin-bottom: 0;
}
.history-table thead {
    background: #5bc0de;
    color: white;
}
.history-table thead th {
    border: none;
    padding: 15px;
    font-weight: 600;
}
.history-table tbody td {
    padding: 12px 15px;
    vertical-align: middle;
}
.no-records {
    text-align: center;
    padding: 40px;
    color: #999;
}
.no-records i {
    font-size: 48px;
    margin-bottom: 15px;
    display: block;
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
      
      <!--Subscription History-->
      <div class="formwraper">
        <div class="titlehead">Subscription History</div>
        <div class="formint">
          
          <?php if($current_subscription): ?>
          <div class="alert alert-info">
            <strong><i class="fa fa-info-circle"></i> Current Subscription</strong><br>
            Plan: <strong><?php echo ucfirst($current_subscription->subscription_type); ?></strong> | 
            Valid Until: <strong><?php echo date('d M Y', strtotime($current_subscription->end_date)); ?></strong> | 
            Status: <?php echo subscription_status_label($current_subscription->status); ?>
          </div>
          <?php endif; ?>
          
          <div class="history-table">
            <?php if($history && count($history) > 0): ?>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Plan Type</th>
                  <th>Amount</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Transaction ID</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $counter = 1;
                foreach($history as $row): 
                ?>
                <tr>
                  <td><?php echo $counter++; ?></td>
                  <td>
                    <?php if($row->subscription_type == 'premium'): ?>
                      <i class="fa fa-star" style="color:#f0ad4e;"></i> Premium
                    <?php else: ?>
                      <i class="fa fa-user"></i> Basic
                    <?php endif; ?>
                  </td>
                  <td>₹<?php echo number_format($row->amount, 2); ?></td>
                  <td><?php echo date('d M Y', strtotime($row->start_date)); ?></td>
                  <td><?php echo date('d M Y', strtotime($row->end_date)); ?></td>
                  <td><?php echo subscription_status_label($row->status); ?></td>
                  <td>
                    <?php if($row->transaction_id): ?>
                      <small><?php echo $row->transaction_id; ?></small>
                    <?php else: ?>
                      <span class="text-muted">N/A</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php else: ?>
            <div class="no-records">
              <i class="fa fa-history"></i>
              <h4>No Subscription History</h4>
              <p>You don't have any subscription history yet.</p>
              <a href="<?php echo base_url('jobseeker/add_subscription'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i> Get Premium Subscription
              </a>
            </div>
            <?php endif; ?>
          </div>
          
          <div class="clear">&nbsp;</div>
          
          <div style="text-align: center; margin-top: 20px;">
            <a href="<?php echo base_url('jobseeker/add_subscription'); ?>" class="btn btn-primary">
              <i class="fa fa-arrow-left"></i> Back to Subscriptions
            </a>
          </div>
          
          <div class="clear">&nbsp;</div>
        </div>
      </div>
    </div>
    <!--/Subscription History-->
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>