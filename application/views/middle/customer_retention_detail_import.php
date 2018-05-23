<html>
<head>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Upload Customer Retention Details</h3>
    </div>
</div>

<form action="<?php echo base_url().'customerretentiondetailimport/import';?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<table>
<tr>
<td> Choose your file: </td>
<td><input type="file" class="form-control" name="file" id="file"  align="center"/>
	<div class="valid-msg"><span>*</span>Only csv</div>
</td>
<td><div class="col-lg-offset-3 col-lg-9">    <button type="submit" name="Import" class="btn btn-info"  >   Save  </button>
</div></td></tr></table> 
</form>
