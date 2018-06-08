<html>
<head>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <style>
.vl {
    border-left: 1px solid #d8d8d8;
    height: 200px;
}
</style>
</head>
<body>
<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Upload Users</h3>
    </div>
</div>

<form action="<?php echo base_url().'csvimport/import';?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<table>
<tr>
<td>Choose your file:<hr><input type="file" class="form-control" name="file" id="file"  align="center"/>
	<div class="valid-msg"><span>*</span>Only csv</div>
<button type="submit" name="Import" class="btn btn-success" > Submit </button>
</td>
<td><div class="vl"></div></td>

<td><div class="upload-xl">
                <a href="<?php echo base_url('uploads/sample/employee_v1.4.csv')?>">
                    <img src="<?php echo base_url().ASSETS;?>images/csv-img.png" alt="csv" height="100" weight="100">
                    <span>Download Sample File</span>
                </a>
            </div></td>

</tr></table> 
</form>
