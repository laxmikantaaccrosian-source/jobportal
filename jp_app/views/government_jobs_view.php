<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="Government Jobs, Govt Jobs, Public Sector Jobs" />
<meta name="description" content="Find latest government job openings. Apply for govt jobs online at <?php echo SITE_NAME;?>." />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<style>
.govt-job-card {
    border: 1px solid #e0e0e0;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    background: #fff;
    transition: all 0.3s ease;
}
.govt-job-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}
.job-header {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.sector-year {
    color: #0066cc;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}
.post-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
  
}
.job-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 5px;
    margin: 10px 0;
}
.detail-item {
    padding: 10px;
    background: #f9f9f9;
    border-radius: 4px;
}
.detail-label {
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.detail-value {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}
.date-expired {
    color: #dc3545;
}
.date-active {
    color: #28a745;
}
.view-details-btn {
    background: #0066cc;
    color: #fff;
    padding: 10px 25px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
    transition: background 0.3s ease;
}
.view-details-btn:hover {
    background: #0052a3;
    color: #fff;
    text-decoration: none;
}
.filter-section {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.filter-section select {
    margin-right: 10px;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 

<!--Search Block-->
<div class="top-colSection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="candidatesection">          
          <div class="col-md-9">            
            <?php echo form_open_multipart('government-jobs/search',array('name' => 'gjsearch', 'id' => 'gjsearch'));?>            
            <div class="input-group">      
              <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search by sector, post name, or keyword" value="" />
              <span class="input-group-btn">
                <input type="submit" name="search_submit" class="btn" id="search_submit" value="Search" />
              </span>
            </div>            
            <?php echo form_close();?> 
          </div>
          <div class="col-md-3">           
            <input type="button" value="Browse All Jobs" title="Government Jobs" class="postjobbtn" alt="Government Jobs" onClick="document.location='<?php echo base_url('government-jobs');?>'" />
            <div class="clear"></div>
          </div>            
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--/Search Block--> 

<!--Government Jobs Block-->
<div class="innerpageWrap">
<div class="container">
  <div class="row"> 
    
    <!--Main Col-->
    <div class="col-md-10"> 
      
      <!--Filter Section-->
      <div class="filter-section">
        <?php echo form_open(base_url('government-jobs'), array('method' => 'get'));?>
        <div class="row">
          <div class="col-md-4">
            <select name="sector" class="form-control">
              <option value="">All Sectors</option>
              <?php if($sectors): foreach($sectors as $sector): ?>
              <option value="<?php echo $sector->sector_name;?>" <?php echo ($filters['sector'] == $sector->sector_name) ? 'selected' : '';?>><?php echo $sector->sector_name;?></option>
              <?php endforeach; endif;?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="year" class="form-control">
              <option value="">All Years</option>
              <?php if($years): foreach($years as $year): ?>
              <option value="<?php echo $year->year;?>" <?php echo ($filters['year'] == $year->year) ? 'selected' : '';?>><?php echo $year->year;?></option>
              <?php endforeach; endif;?>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" name="post" class="form-control" placeholder="Post Name" value="<?php echo $filters['post'];?>" />
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Filter</button>
          </div>
        </div>
        <?php echo form_close();?>
      </div>
      
      <!--Jobs List-->
      <div class="searchpage">
        <div class="toptitlebar">
          <div class="row">
            <div class="col-md-6"><b>Government Jobs</b></div>
            <div class="col-md-6 text-right"><strong>Jobs <?php echo $from_record.' - '.$page;?> of <?php echo $total_rows;?></strong></div>
          </div>
        </div>
        
        <?php if($result): foreach($result as $row): 
          $is_expired = (strtotime($row->last_date) < time());
        ?>
        <div class="govt-job-card">
          <div class="job-header">
            <div class="sector-year"><?php echo $row->sector_name;?> - <?php echo $row->year;?></div>
            <div class="post-name"><?php echo $row->post_name;?></div>
          </div>
          
          <div class="job-details-grid">
            <div class="detail-item">
              <div class="detail-label">Apply Date</div>
              <div class="detail-value"><?php echo date('M d, Y', strtotime($row->apply_date));?></div>
            </div>
            <div class="detail-item">
              <div class="detail-label">Last Date</div>
              <div class="detail-value <?php echo $is_expired ? 'date-expired' : 'date-active';?>">
                <?php echo date('M d, Y', strtotime($row->last_date));?>
                <?php if($is_expired): ?><span style="font-size:11px;"> (Expired)</span><?php endif;?>
              </div>
            </div>
            <div class="detail-item">
              <div class="detail-label">Total Vacancy</div>
              <div class="detail-value"><?php echo $row->total_vacancy;?> Posts</div>
            </div>
            <div class="detail-item">
              <div class="detail-label">Age Limit</div>
              <div class="detail-value"><?php echo $row->age_limit;?></div>
            </div>
          </div>
          
          <?php if($row->job_description): ?>
          <p style="margin: 15px 0; color: #666;"><?php echo word_limiter(strip_tags($row->job_description), 30);?></p>
          <?php endif;?>
          
          <a href="<?php echo base_url('government-jobs/detail/'.$row->slug);?>" class="view-details-btn">View Full Details</a>
        </div>
        <?php endforeach; else: ?>
        <div class="err" align="center" style="padding: 40px;">
          <p><strong>No government jobs found. Please check back later.</strong></p>
        </div>
        <?php endif;?>
      </div>
      
      <!--Pagination-->
      <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
    </div>
    
    <?php 
    // $this->load->view('common/right_ads');
    ?>
  </div>
</div>
</div>
<!--/Government Jobs Block-->

<?php 
// $this->load->view('common/bottom_ads');
?>

<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>