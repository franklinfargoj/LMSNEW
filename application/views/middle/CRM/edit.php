<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Edit CRM</h3>

    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">
            <div class="float-right">
                <span class="lead-num"><a href="<?php echo site_url('crm');?>"><span><</span>Back</a></span>
            </div>
            <div class="product-category">
                <!-- <form> -->
                <?php
                $attributes = array(
                    'role' => 'form',
                    'id' => 'edit_form',
                    'class' => 'form',
                    'autocomplete' => 'off'
                );
                echo form_open(base_url().'/crm/edit/'.$this->uri->segment(3,0), $attributes);
                ?>
                <div class="form-control">
                    <?php
                    $attributes = array(
                        'class' => '',
                        'style' => ''
                    );
                    echo form_label('CRM Name:<span style="color:red;">*</span>', 'title', $attributes);

                    $data = array(
                        'type'  => 'textarea',
                        'name'  => 'title',
                        'id'    => 'title',
                        'class' => '',
                        'value' => $crmDetail[0]['title']
                    );
                    echo form_input($data);

                    // Assuming that the 'title' field value was incorrect:
                    echo form_error('title', '<span class="help-block">', '</span>');
                    ?>
                </div>
                <div class="form-control">
                    <?php
                    $attributes = array(
                        'class' => '',
                        'style' => ''
                    );
                    echo form_label('CRM Content:<span style="color:red;">*</span>', 'content', $attributes);

//                    $data = array(
//                        'type'  => 'text',
//                        'name'  => 'content',
//                        'id'    => 'content',
//                        'class' => '',
//                        'value' => $crmDetail[0]['content']
//                    );
//                    echo form_input($data);
                    ?>
                    <textarea rows="4" cols="50" name = "content" id="content" style="margin: 0px; width: 469px; height: 78px;">
                        <?php echo @$crmDetail[0]['content'];?>
                        </textarea>
                    <?php

                    // Assuming that the 'title' field value was incorrect:
                    echo form_error('content', '<span class="help-block">', '</span>');
                    ?>
                </div>
                <div class="form-control form-submit clearfix">
                    <a href="javascript:void(0);" class="reset">
                        Reset
                    </a>
                    <a href="javascript:void(0);" class="active">
                        <img alt ="left nav" src="<?php echo base_url().ASSETS;?>images/left-nav.png">
                        <span><input class="custom_button" type="submit" name="Submit" value="Submit"></span>
                        <img alt = "right nav" src="<?php echo base_url().ASSETS;?>images/right-nav.png">
                    </a>
                </div>
                <!-- </form> -->
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <span class="bg-bottom"></span>
</div>
<!-- END ADD PRODUCT CATEGORY-->

<script type="text/javascript">
    $.validator.addMethod("regx", function(value, element, regexpr) {
        return regexpr.test(value);
    });

    $("#edit_form").validate({

        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please Enter CRM"
            },
            content: {
                required: true
            }
        }
    });

</script>
