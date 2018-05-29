<div class="page-title">
    <div class="container clearfix">
        <h3 class="text-center">Customer Information</h3>
        
    </div>
</div>
<div class="page-content">
    <span class="bg-top"></span>
    <div class="inner-content">
        <div class="container">
        <div class="float-right">
            <span class="lead-num"><a href="<?php echo site_url('customerretentionlist');?>"><span><</span>Back</a></span>
        </div>
            <div id="accordion" class="faq-accordion faq-a">
                <?php 
                    if($customerinfo){
                        
                ?>
                        <h3>Customer Name : <?php echo ucwords($customerinfo[0]['customer_name']);?></h3>  
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <h4>Internet Banking</h4>
                                        Has the customer registered?
                                    </td>
                                    <td>
                                        <input disabled type="radio" name="ib" <?php if($customerinfo[0]['internet_banking']==1) echo 'checked'; ?>>Yes
                                        <input disabled type="radio" name="ib" <?php if($customerinfo[0]['internet_banking']==0) echo 'checked'; ?>>No
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        Number of Transactions in last 3 months 
                                    </td>
                                    <td>
                                        <input readonly type="text" name="iib" value=<?php echo $customerinfo[0]['three_months_internet_transaction']; ?>>
                                    </td>
                                </tr>
                       <!-- //////////////////////////////////////////////////////////// -->
                             
                                <tr>
                                    <td>
                                        <h4>Mobile Banking</h4>
                                        Has the customer registered?
                                    </td>
                                    <td>
                                        <input disabled type="radio" name="mb" <?php if($customerinfo[0]['mobile_banking']==1) echo 'checked'; ?>>Yes
                                        <input disabled  type="radio" name="mb"   <?php if($customerinfo[0]['mobile_banking']==0) echo 'checked'; ?>>No
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        Number of Transactions in last 3 months 
                                    </td>
                                    <td>
                                        <input readonly type="text" name="imb"  value=<?php echo $customerinfo[0]['three_months_mobile_transaction']; ?>>
                                    </td>
                                </tr>

                       <!-- //////////////////////////////////////////////////////////// -->
                             
                                <tr>
                                    <td>
                                        <h4>Debit Card</h4>
                                        Has the customer conducted any NEFT / RTGSin branch or online?
                                    </td>
                                    <td>
                                        <input disabled  type="radio" name="db"  <?php if($customerinfo[0]['debit_card']==1) echo 'checked'; ?>>Yes
                                        <input disabled  type="radio" name="db"  <?php if($customerinfo[0]['debit_card']==0) echo 'checked'; ?>>No
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        Number of Transaction using debit card at POS
                                    </td>
                                    <td>
                                        <input readonly type="text" name="idb" value=<?php echo $customerinfo[0]['transaction_debit_card_POS']; ?>>
                                    </td>
                                </tr>
                               
                       <!-- //////////////////////////////////////////////////////////// -->
                             
                                <tr>
                                    <td>
                                        <h4>NEFT / RTGS</h4>
                                        Has the customer registered?
                                    </td>
                                    <td>
                                        <input disabled  type="radio" name="nb"   <?php if($customerinfo[0]['neft_rtgs']==1) echo 'checked'; ?>>Yes
                                        <input disabled  type="radio" name="nb"  <?php if($customerinfo[0]['neft_rtgs']==0) echo 'checked'; ?>>No
                                    </td> 
                                </tr>

                                <tr>
                                    <td>
                                        Is the customer moving money from Dena bank account to Non-Dena own Account
                                    </td>
                                    <td>
                                       
                                        <input disabled  type="radio" name="ivb"   <?php if($customerinfo[0]['moving_money_dena_to_non_dena']==1) echo 'checked'; ?>>Yes
                                        <input disabled  type="radio" name="ivb"   <?php if($customerinfo[0]['moving_money_dena_to_non_dena']==0) echo 'checked'; ?>>No
                                    </td>
                                </tr>
                                 <tr>
                                    <td><h4>Remarks</h4></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>
                                        <form method="POST" action=<?php echo base_url()."customerretentionlist/update/"; ?>>
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                <input type="hidden" name="custmid" value=<?php echo $customerinfo[0]['id']; ?>>
                                        <textarea name="remark"><?php echo $customerinfo[0]['remarks']; ?></textarea><br>
                                        <input type="submit">
                                    </form>
                                    </td>
                                    <td></td>
                                 </tr>
                                 
                            </table>

                        </div>
                <?php 
                        
                    }
                ?>
            </div>
        </div>
    </div>
    <span class="bg-bottom"></span>
</div>

<script src = "<?php echo base_url().ASSETS;?>/js/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#accordion" ).accordion();
    });
</script>
    
    