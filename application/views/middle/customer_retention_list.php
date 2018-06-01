<?php
    $controller =  $this->router->fetch_class();
    $method =  $this->router->fetch_method();
    ?>
<head>
    <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab a {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab a:hover {
    background-color: ;

}

/* Create an active/current tablink class */
.tab a.active {
    background-color:#C0C0C0;
    outline: none;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    margin-right: 10px;
    color:black;

}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
</head>
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
    <div class="inner-content customer-retention">
        <div class="container">
            <div class="lead-top clearfix">
                <div class="float-left">
                    <span class="total-lead">Total Customer</span>
                    <span class="lead-num"> : <?php echo count($customerlist);?></span>
                </div>
                        <div class="float-right">
            <span class="lead-num"><a href="<?php echo site_url('customerretentionlist');?>"><span><</span>Back</a></span>
        </div>
            </div>
            <div class="tab">
                 <a class="<?php echo ($controller == 'customerretentionlist' && $method == 'notcalled') ? 'active' : 'tablinks'?>" href="<?php echo site_url('customerretentionlist/notcalled')?>">
                    Not Called
                </a>
<a  class="<?php echo ($controller == 'customerretentionlist' && $method == 'called') ? 'active' : 'tablinks'?>" href="<?php echo site_url('customerretentionlist/called')?>">
                    Called
                </a>


</div>
          

            <table id="sample_3" class="display lead-table">
                <thead>

                    <tr>
                        <th style="text-align:center">Sr. No.</th>
                        <th>Customer Name</th>
                        <th>% Balance Drop</th>
                        <?php if($type=='called') { ?>
                        <th>Called</th>
                        <?php } ?>
                        <?php if($type=='notcalled') { ?>
                        <th>Status</th>
                        <?php } ?>
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
                                <?php if($type=='notcalled') echo ucwords('Not called');?>
                                <?php if($type=='called')echo date('dS-F-Y', strtotime($value['call'])); ?>
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
