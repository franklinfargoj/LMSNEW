
<!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url().ASSETS;?>css/jquery.dataTables.min.css" rel="stylesheet">
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PRODUCT -->
<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Customer Retention</h3>
    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">
            <div class="lead-top clearfix">
                <div class="float-left">
                    <span class="total-lead">Total Customer</span>
                    <span class="lead-num"> : <?php echo count($customerlist);?></span>
                </div>
               
            </div>
            <table id="sample_3" class="display lead-table">
                <thead>

                    <tr>
                        <th style="text-align:center">Sr. No.</th>
                        <th>Customer Name</th>
                        <th>% Balance Drop</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php if($customerlist){
                            $i = 0;
                            foreach ($customerlist as $key => $value) {
                        ?>  
                        <tr>
                            <td style="text-align:center">
                                 <?php echo ++$i;?>
                            </td>
                            <td>
                                 <?php echo ucwords($value['Customer Name']);?>
                            </td>
                            <td>
                                 <?php echo ucwords($value['%Balance Drop']);?>
                            </td>
                            <td>
                                <?php if($value['call']==NULL) echo ucwords('Not called'); else echo ucwords('Called');?>
                            </td>
                            <td>
                                <a class="" href="<?php echo site_url('customerretentionlist/view/'. $value['id'])?>">
                                     View
                                </a> 
                            </td>

                        </tr>   
                        <?php   
                            }
                        }?>
                </tbody>
            </table>
        </div>
    </div>
    <span class="bg-bottom"></span>
</div>
<!-- END PRODUCT-->
<script src="<?php echo base_url().ASSETS;?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().ASSETS;?>js/config.datatable.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() { 
        var table = $('#sample_3');
        var columns = [3,4];

        //Initialize datatable configuration
        initTable(table,columns);

        $('.delete').click(function(){
            var url = $(this).data('url');
            var result = confirm("Are you sure want to delete?"); 
            if(result == true){
                window.location.href = url;
            }
        });
    });
</script>
