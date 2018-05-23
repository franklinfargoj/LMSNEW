<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url().ASSETS;?>css/toggle.css" rel="stylesheet">
<link href="<?php echo base_url().ASSETS;?>css/jquery.dataTables.min.css" rel="stylesheet">
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PRODUCT CATEGORY -->
<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">CRM</h3>
    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">
            <div class="lead-top clearfix">
                <div class="float-left">
                    <span class="total-lead">CRM Pages</span>
                    <span class="lead-num"> :
                        <?php echo count($crmlist);?>
                    </span>
                </div>
                <div class="float-right">
                    <span class="lead-num"><a href="<?php echo site_url('crm/add');?>">Add</a></span>
                </div>
            </div>
            <table id="sample_3" class="display lead-table">
                <thead>
                <tr>
                    <th style="text-align:center">Sr. No.</th>
                    <th style="text-align:left">Title</th>
                    <th style="text-align:left">Content</th>
                    <th style="text-align:left">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($crmlist){
                    $i = 0;
                    foreach ($crmlist as $key => $value) {
                        ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo ++$i;?>
                            </td>
                            <td style="text-align:left">
                                <?php echo ucwords($value['title']);?>
                            </td>
                            <td style="text-align:left">
                                <?php echo ucwords($value['content']);?>
                            </td>
                            <td style="text-align:left">
                                <a class="" href="<?php echo site_url('crm/edit/'. encode_id($value['id']));?>">
                                    Edit
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
<!-- END PRODUCT CATEGORY-->
<script src="<?php echo base_url().ASSETS;?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().ASSETS;?>js/config.datatable.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var table = $('#sample_3');
        var columns = [3];

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
