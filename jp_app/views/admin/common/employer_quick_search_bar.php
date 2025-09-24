<style>
.row.search-bar-row {
  padding:10px; !important;
  margin: 0 !important;
  background-color: #3C8DBC !important;
  border: 1px solid #ddd;
  border-bottom: none;
}

.row.search-bar-row .form-control {
  height: 30px;
  font-size: 15px;
  padding: 3px 6px;
}

.row.search-bar-row .btn {
  height: 30px;
  font-size: 13px;
  padding: 3px 10px;
}

</style>
<form name="search_form" id="search_form" method="get" action="<?php echo base_url('admin/employers/search');?>">
  <div class="row search-bar-row">
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="first_name" id="first_name" type="text" placeholder="Search By Name" value="<?php echo isset($search_data["first_name"]) ? $search_data["first_name"] : ''; ?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="email" id="email" type="text" placeholder="Search By Email" value="<?php echo isset($search_data["email"]) ? $search_data["email"] : ''; ?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="company_name" id="company_name" type="text" placeholder="Search By Company" value="<?php echo isset($search_data["company_name"]) ? $search_data["company_name"] : ''; ?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="city" id="city" type="text" placeholder="Search By City" value="<?php echo isset($search_data["city"]) ? $search_data["city"] : ''; ?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <select class="form-control" name="top_employer" id="top_employer">
        <option value="">Select Top Employer</option>
        <option value="yes" <?php echo (isset($search_data["top_employer"]) && $search_data["top_employer"] == 'yes') ? 'selected' : ''; ?>>Yes</option>
        <option value="no" <?php echo (isset($search_data["top_employer"]) && $search_data["top_employer"] == 'no') ? 'selected' : ''; ?>>No</option>
      </select>
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="btn" name="submit" value="Search" type="submit">
      &nbsp;&nbsp;
      <input class="btn" name="button" value="View All" type="button" onClick="document.location='<?php echo base_url('admin/employers');?>';">
    </div>
  </div>
</form>



