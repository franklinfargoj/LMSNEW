<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Edit Map</h3>

    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">

            <div class="float-right">
                <span class="lead-num"><a href="<?php echo site_url('MapWithMaster');?>"><span><</span>Back</a></span>
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
                echo form_open(base_url().'/MapWithMaster/edit/'.$this->uri->segment(3,0), $attributes);


                ?>
                <div class="form-control">
                    <?php
                    $attributes = array(
                        'class' => '',
                        'style' => ''
                    );
                    echo form_label('Title:<span style="color:red;">*</span>', 'title', $attributes);

                    $data = array(
                        'type'  => 'text',
                        'name'  => 'title',
                        'id'    => 'title',
                        'class' => 'form-control',
                        'placeholder' => '',
                        'value' => $mapDetail[0]['title']
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
                    echo form_label('Description:<span style="color:red;">*</span>', 'description_text', $attributes);
                    ?>
                    <textarea name = "description_text" rows="7" cols="80" style="width: 810px; height: 200px">
                                <?php echo $mapDetail[0]['description'];?>
                            </textarea>

                    <?php echo form_error('description_text', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-control">
                    <label>Status:<span style="color:red;">*</span></label>
                    <div class="radio-control">
                        <input type="radio" id= "active" name="status" value="active" <?php
                        echo set_value('status', $mapDetail[0]['status']) == 'active' ? "checked" : "";
                        ?> />
                        <label>Active</label>
                    </div>
                    <div class="radio-control">
                        <input type="radio" id= "inactive" name="status" value="inactive" <?php
                        echo set_value('status', $mapDetail[0]['status']) == 'inactive' ? "checked" : "";
                        ?> />
                        <label>Inactive</label>
                    </div>
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
<!-- END PRODUCT DESCRIPTION-->

<script src="<?php echo base_url().PLUGINS;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
/*    $(function () {
        // Replace the <textarea id="answer"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace('answer');
        CKEDITOR.replace( 'description_text', {
            uiColor: '#01559d'
        });
    });
    $.validator.addMethod("regx", function(value, element, regexpr) {
        return regexpr.test(value);
    });*/

    $("#edit_form").validate({

        rules: {
            title: {
                required: true
            },
            description_text: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please Enter Title"
            },
            description_text: {
                required: "Please Enter Description"
            }
        }
    });

</script>