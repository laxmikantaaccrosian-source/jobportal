<div class="footerWrap">
  <div class="container">
    <div class="col-md-3">
      <img src="<?php echo base_url('public/images/logo3.png');?>" alt="USA jobs website" />
      <br><br>
      <p>Empowering Businesses with Innovative IT Solutions
         At Accrosian, we are a trusted IT software agency delivering custom software development, cloud services, data analytics, cybersecurity, and web development.<br>
         <br>
         Contact Us: (+91) 8917355825 | info@accrosian.com<br>
         Locations: Hyderabad & Bhubaneswar, India</p>
      
      <!--Social-->
        
        <div class="social">
        <a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        <a href="http://www.plus.google.com" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
        <a href="http://www.facebook.com" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        <a href="https://www.pinterest.com" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
        <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
        <a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
        </div>
        
      
    </div>
    <div class="col-md-2">
      <h5>Quick Links</h5>
      <ul class="quicklinks">
        <li><a href="<?php echo base_url('about-us.html');?>" title="About Us">About Us</a></li>
        <li><a href="<?php echo base_url('how-to-get-job.html');?>" title="How to get Job">How to get Job</a></li>
        <li><a href="<?php echo base_url('search-jobs');?>" title="New Job Openings">New Job Openings</a></li>
        <li><a href="<?php echo base_url('search-resume');?>" title="New Job Openings">Resume Search</a></li>
        <li><a href="<?php echo base_url('contact-us');?>" title="Contact Us">Contact Us</a></li>
      </ul>
    </div>
    
    <div class="col-md-3">
      <h5>Popular Industries</h5>
      <ul class="quicklinks">
        <?php
          $res_inds = $this->industries_model->get_top_industries();
          if($res_inds):
            foreach($res_inds as $row_inds):
        ?>
        <li><a href="<?php echo base_url('industry/'.$row_inds->slug);?>" title="<?php echo $row_inds->industry_name;?> Jobs"><?php echo $row_inds->industry_name;?> Jobs</a></li>
        <?php 

		  		endforeach;

		  	endif;

		  ?>
      </ul>
    </div>
    <div class="col-md-4">
      <h5>Popular Cities</h5>
      <ul class="citiesList">
        <li><a href="<?php echo base_url('search/new-york');?>" title="Jobs in New York">New York</a></li>
        <li><a href="<?php echo base_url('search/los-angeles');?>" title="Jobs in 	Los Angeles">Los Angeles</a></li>
        <li><a href="<?php echo base_url('search/chicago');?>" title="Jobs in Chicago">Chicago</a></li>
        <li><a href="<?php echo base_url('search/houston');?>" title="Jobs in Houston">Houston</a></li>
        <li><a href="<?php echo base_url('search/san-diego');?>" title="Jobs in San Diego">San Diego</a></li>
        <li><a href="<?php echo base_url('search/san-jose');?>" title="Jobs in San Jose">San Jose</a></li>
        <li><a href="<?php echo base_url('search/austin');?>" title="Jobs in Austin">Austin</a></li>
        <li><a href="<?php echo base_url('search/san-francisco');?>" title="Jobs in San Francisco">	San Francisco</a></li>
        <li><a href="<?php echo base_url('search/columbus');?>" title="Jobs in Columbus">Columbus</a></li>
        <li><a href="<?php echo base_url('search/boston');?>" title="Jobs in Boston">Boston</a></li>
        <li><a href="<?php echo base_url('search/washington');?>" title="Jobs in Washington">Washington</a></li>
        <li><a href="<?php echo base_url('search/las-vegas');?>" title="Jobs in Las Vegas">Las Vegas</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="clear"></div>
    <div class="copyright">
    <a href="<?php echo base_url('interview.html');?>" title="Preparing for Interview">Preparing for Interview</a> | 
    <a href="<?php echo base_url('cv-writing.html');?>" title="CV Writing">CV Writing</a> | 
    <a href="<?php echo base_url('how-to-get-job.html');?>" title="How to get Job">How to get Job</a> |
    <a href="<?php echo base_url('privacy-policy.html');?>" title="Policy">Policy</a>
    
    
    
      <div class="bttxt">Copyright <?php echo date('Y');?>. Design & Develop by: <a href="https://accrosian.com/" target="_blank">Accrosian</a></div>
    </div>
  </div>
</div>
</div>
<?php echo $ads_row->google_analytics;?> 