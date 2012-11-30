 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Create Invoice</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Create Invoice</h1><span></span></div>
                <!-- <div class="info_msg">Info message</div>
                <div class="success_msg">Successful operation message</div>
                <div class="warning_msg">Warning message</div>-->
                <?php
					if($msg)
					{
						if($msg == 1)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Product manual removed successfully</li></ul></div>' ;
						}
                		if($msg == 2)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to remove product manual</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li style="color:#F00 !important">'.$errors.'</li></ul></div>' ;
						}
						if($msg == 4)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Product manual uploaded successfully</li></ul></div>' ;
						}
						if($msg == 5)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to upload product manual</li></ul></div>' ;
						}
					}
				?>
                
                <form id="order_invoice_form" class="block-content form" action="<?php echo base_url("invoices/upload_order_invoice") ; ?>" method="post" enctype="multipart/form-data">
                	<fieldset>
                    	<legend>Create Invoice</legend>
						<?php if($order_rec->invoice != "") { ?>
                        <br /><br />
                        <table class='table'>
                        <thead>
                            <tr>
                                <th>Order Invoice</th>
                                <th>Order Invoice Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr class="gradeX">
                                <td><?php echo $order_rec->purchase_order_number.".".$file_ext ; ?></td>
                                <td class="center">
                                &nbsp;<a href="<?php echo base_url("invoices/download_manual/".$order_rec->id."/upload_invoice") ; ?>"><img title="Download Invoice" src="<?php echo base_url("img/icons/packs/fugue/16x16/drive-download.png") ; ?>" /></a>
                                &nbsp;<a href="<?php echo base_url("invoices/remove_order_invoice/".$order_rec->id) ; ?>" onclick="return confirm('Are you sure to remove this invoice?')" ><img title="Delete Invoice" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a></td>
                            </tr>
                        </tbody>
                    </table>
                        <br /><br />
                    <?php } else { ?>
                    	<div class='_50'><p><b>Currently no invoice is uploaded.</b></p></div>
                    <?php } ?>
                        <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_rec->id ; ?>" />
                    	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $order_rec->customer_id ; ?>" />
                        <div class='_100'>
                        	<p>
                            	<label for="order_file">Add/Update Order Invoice</label>
                                <input type="file" id="order_invoice" name="order_invoice" value="" />
                            </p>
                        </div>
					
                    </fieldset>
                    <div class='block-actions'>
						<!--<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>-->
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add/Update Order Invoice</a></li>
                            <li class="divider-vertical"></li>
                            <li><a id="cancel_form" class="close-toolbox button" href="javascript:void(0);">Confirm</a></li>
						</ul>
					</div>
				</form>
				</div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
</div> <!--! end of #main-content -->
<script type="text/javascript">
$(function(){
	$("#clear_form").click(function(){
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#submit_form").click(function(){
		$("#order_invoice_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("invoices") ; ?>" ;
	}) ;
}) ;
</script>