
<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Order Description<span class="hide"></span></div>
			<div class="content">
				
				<?php if($error) { echo '<div class="message red"><span>Order Description is required</span></div>' ; }?>
                
                <form id="description_form" action="" method="post">
                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id ; ?>" />
                    <?php if(($order_rec->order_description_radio == "") && ($order_rec->order_description == "" )) { ?>
                        <!--
                    	<div class="row">
                            <label>Want to add description?</label>
                            <div class="right">
                                <input type="radio" name="description_radio" id="description-radio-1" value="Yes" checked="checked" /> <label for="description-radio-1">Yes</label>
                                <input type="radio" name="description_radio" id="description-radio-2" value="No" /> <label for="description-radio-2">No</label>
                            </div>
                            <br />
                        </div> -->
                        
                        <div class="row">
                            <label>Order Description</label>
                            <div class="right">
                            <!-- class="wysiwyg" -->
                            <textarea id="order_description" name="order_description" rows="8" cols=""><?php echo set_value("order_description") ; ?></textarea></div>
                        </div>
                    
					<?php } else { ?>
                    	<!--
                        <div class="row">
                            <label>Want to add description?</label>
                            <div class="right">
                            <input type="radio" name="description_radio" id="description-radio-1" <?php // if($order_rec->order_description_radio == "Yes") { ?> checked="checked" <?php // } ?> value="Yes" /> <label for="description-radio-1">Yes</label>
                            <input type="radio" name="description_radio" id="description-radio-2" <?php // if($order_rec->order_description_radio == "No") { ?> checked="checked" <?php // } ?> value="No"/> <label for="description-radio-2">No</label>
                            </div>
                            <br />
                        </div> -->
                        
                        <div class="row">
                            <label>Order Description</label>
                            <!-- class="wysiwyg" -->
                            <div class="right"><textarea id="order_description" name="order_description" rows="8" cols=""><?php echo $order_rec->order_description ; ?></textarea></div>
                        </div>
                        
					<?php } ?>
                    
                    <input type="hidden" id="next_step" name="next_step" value="" />
					<div class="row">
						<label></label>
						<div class="right">
                        	<button id="upload_attachment" type="button"><span>Next &gt;&gt;</span></button>&nbsp;
                            <button id="save_and_submit" type="button"><span>Save</span></button>&nbsp;
                            <button id="cancel_form" type="button"><span>Cancel</span></button>&nbsp;&nbsp;
                            <a href="<?php echo base_url("orders/order_detail/".$order_id) ; ?>">Order Details</a>
                     	</div>
					</div>
				</form>
        	</div>
		</div>
	</div>
</div>

<script type="application/javascript">
$(function(){
	
	$("#upload_attachment").click(function(){
		$("#description_form").attr("action","<?php echo base_url("orders/add_description") ; ?>") ;
		$("#next_step").val("upload_attachment") ;
		$("#description_form").submit() ;
	});
	
	$("#save_and_submit").click(function(){
		$("#description_form").attr("action","<?php echo base_url("orders/add_description") ; ?>") ;
		$("#next_step").val("save") ;
		$("#description_form").submit() ;
	});
	
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("orders") ; ?>" ;
	});
	
});
</script>