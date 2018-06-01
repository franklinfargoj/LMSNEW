<div class="lead-data">
<span class="bg-top"></span>
<div class="inner-content">
<div class="container clearfix">

	<div class="lead-section" style="width:800px; margin:0 auto;">
		<h3 class="title" align="center"><strong>Customer Retention</strong></h3>
		<div class="lead-count-wrapper" style="margin: 0 auto;width: 64%;">
			
			<div class="lead-count red ravisha">
				<span class="big"><?php echo $totallead['Total'] ; ?></span>	
				<span class="small" >Leads</span>	
			</div>

			<div class="lead-count blue ravisha">
				<span class="big"><?php echo $totallead['Pending'] ; ?></span>	
				<span class="small">Pending</span>	
			</div>
			<div style="margin-left: 24px;width:86%;"><font size="4" color="green">Total No.of Leads</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font size="4" color="red">Pending Calls</font></div>

			<div class="view-content ravishbtn" style="margin-top: 60px;text-align: center;width: 98%;">
			<a href="<?php echo site_url('customerretentionlist/notcalled')?>">VIEW</a>
			</div>
		</div>
	</div>
</div>
</div>
<span class="bg-bottom"></span>
</div>