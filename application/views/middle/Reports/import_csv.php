<?php
/**
 * Created by PhpStorm.
 * User: webwerks1
 * Date: 15/8/17
 * Time: 6:32 PM
 */
$form_attributes = array('id' => 'upload_lead', 'method' => 'POST','class' =>'form');
$data_input = array('id' => 'file', 'name'=>'filename','type' => 'file');
$lead_source[''] = 'Select Lead Source';
$lead_source['Tie Ups'] = 'Tie Ups';
$lead_source['Enquiry'] = 'Enquiry';
$lead_source['Analytics'] = 'Analytics';
$source_options[''] = 'Select Source';
//$source_options['Tie Ups'] = 'Tie Ups';
//$source_options['Enquiry'] = 'Enquiry';
//$source_options['Analytics'] = 'Analytics';
$source_options['state'] = 'State';
$source_options['zone'] = 'Zone';
$source_options['district'] = 'District';
$source_options['branch'] = 'Branch';
$source_options['all'] = 'All In One';
$data_submit = array(
    'name' => 'Submit',
    'id' => 'Submit',
    'type' => 'Submit',
    'content' => 'Submit',
    'value' => 'Submit'
);
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url().ASSETS;?>css/jquery.dataTables.min.css" rel="stylesheet">
<!-- END PAGE LEVEL STYLES -->

<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Import CSV</h3>
    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">
            <p id="note"><span style="color:red;">*</span> These fields are required</p>
            <div class="upload-content">

                <div class="upload-form">
                    <?php
                    $url = base_url('reports/csv_import');
                    echo form_open_multipart($url, $form_attributes);
                    ?>
                    <div class="form-control">
                        <label> Source:<span style="color:red;">*</span></label>
                        <?php echo form_dropdown('lead_source', $source_options,'','class="lead_source" id="lead_source"') ?>
                    </div>
                    <div class="form-control">
                        <label>Select File:<span style="color:red;">*</span></label>
                        <?php echo form_input($data_input);?>
                        <div class="valid-msg"><span>*</span>Only xls | xlsx</div>
                    </div>
                    <span>
                    </span>


                    <div class="form-control form-submit clearfix">
                        <a href="javascript:void(0);" class="active float-right">
                            <img alt="left nav" src="<?php echo base_url().ASSETS;?>/images/left-nav.png">
                            <span><input class="custom_button" name="Submit" value="Submit" type="submit"></span>
                            <img alt="right nav" src="<?php echo base_url().ASSETS;?>/images/right-nav.png">
                        </a>
                    </div>

                    <!--                <button class="btn-submit" type="submit"></button>-->
                    <?php echo form_close();?>
                </div>
                <div class="upload-xl">
                    <a id="sample" href="">
                        <img src="<?php echo base_url().ASSETS;?>images/excel-img.png" alt="excel">
                        <span>Download Sample File</span>
                    </a>
                </div>
            </div>


        </div>
    </div>
    <span class="bg-bottom"></span>
</div>
<script src="<?php echo base_url().ASSETS;?>js/jquery.dataTables.min.js"></script>
<!--<script src="--><?php //echo base_url().ASSETS;?><!--js/config.datatable.js"></script>-->
<script type="text/javascript">

    var table = $('#sample_3');
    var columns = [5];

    var inituploadTable = function (table,columns) {
        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */


        var oTable = table.DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": columns
            }],
            "order": [
                [0, 'desc']
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
        });

        // Apply the search
        oTable.columns().every(function (index) {
            table.find('thead tr:eq(0) th:eq(' + index + ') input').on('keyup change', function () {
                oTable.column($(this).parent().index() + ':visible').search(this.value).draw();
            });
            table.find('thead tr:eq(0) th:eq(' + index + ') select').on('change', function () {
                oTable.column($(this).parent().index() + ':visible').search(this.value).draw();
            });
        });
    }
    inituploadTable(table,columns);

    $('#upload_lead').validate({

        rules:{
            lead_source:{
                required:true
            },
            filename:{
                required:true
            }
        },messages:{
            lead_source:{
                required:'Please select lead source.'
            },
            filename:{
                required:'Please upload a file.'
            }
        }
    });
    $('#lead_source').change(function () {
        var end = this.value;
        if(end == 'state'){
            $("#sample").attr("href", "<?php echo base_url();?>uploads/sample/sample_state.xls");
        }else if(end == 'zone'){
            $("#sample").attr("href", "<?php echo base_url();?>uploads/sample/sample_zone.xls");
        }else if(end == 'branch'){
            $("#sample").attr("href", "<?php echo base_url();?>uploads/sample/sample_branch.xls");
        }else if(end == 'district'){
            $("#sample").attr("href", "<?php echo base_url();?>uploads/sample/sample_district.xls");
        }else if(end == 'all'){
            $("#sample").attr("href", "<?php echo base_url();?>uploads/sample/sample_all.xls");
        }
    });


</script>
