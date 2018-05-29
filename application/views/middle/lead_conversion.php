<?php
/**
 * Created by PhpStorm.
 * User: webwerks
 * Date: 23/10/17
 * Time: 5:07 PM
 */
?>
<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Leads Generated (This Year)</h3>
    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content text-s">
        <div class="container">
            <div class="lead-gen-box">
<p> Leads generated by me : <b>  <?php echo $total_generated;?></b></p>
<p>Leads converted out of generated : <b><?php echo $total_converted;?></b></p>
<p>Conversion : <b><?php echo round(($total_converted/$total_generated)*100);?> %</b></p>
			</div>
            </div>
        </div>
    <span class="bg-bottom"></span>
</div>

