
<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Upload P.O Document<span class="hide"></span></div>
			<div class="content">
            	<?php if($msg ==  1) { ?> <div class="message red"><span><ul><?php echo $errors ; ?></ul></span></div><?php } ?>
                
                <form id="file_upload_form" action="" class="valid" method="post" enctype="multipart/form-data">
					<input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id ; ?>" />
                    
                    <div class="row" style="height:40px !important;">
						<label>Do you want to upload a PO document? </label>
						<div class="right" style="padding-left:10px !important; ">
						<input type="radio" name="file_radio" id="file-radio-1" checked="checked" value="Yes" value="Yes" /><label for="file-radio-1">Yes</label>
						<input type="radio" name="file_radio" id="file-radio-2" value="No" /><label for="file-radio-2">No</label>
						</div>
                    </div>
                    
                    <div class="row">
						<label>File upload</label>
						<div class="right"><input type="file" id="order_file" name="order_file" /></div>
					</div>
                    
                    <?php if($order_rec->order_file != "") { ?>
                    <div class="row">
                    	<label></label>
                        <div class="right">
                        	<?php echo $order_rec->purchase_order_number.".".$file_ext ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        	<a href="<?php echo base_url("orders/download_manual/".$order_id."/order_file") ; ?>"><img title="Download File" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a>&nbsp;&nbsp;
                            <a href="<?php echo base_url("orders/remove_order_form/".$order_id."/order_file") ; ?>" onclick="return confirm('Are you sure to remove the file?');"><img title="Remove File" src="<?php echo base_url("gfx/icons/small/cross-script.png") ; ?>" /></a>
						</div>
					</div>
                    <?php } ?>
                    <div class="row">
						<label></label>
						<div class="right">
                        	<button id="save_and_submit" type="button"><span>Next &gt;&gt;</span></button>&nbsp;
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
	
	$("#save_and_submit").click(function(){
		$("#file_upload_form").attr("action","<?php echo base_url("orders/upload_order_file") ; ?>") ;
		$("#file_upload_form").submit() ;
	});
	
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; });
	
});
</script>