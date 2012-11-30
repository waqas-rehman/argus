 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Product Manual (<?php echo $product_rec->product_name ; ?>)</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Product Manual</h1><span></span></div>
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
                
                <form id="product_manual_form" class="block-content form" action="<?php echo base_url("product/add_product_manual") ; ?>" method="post" enctype="multipart/form-data">
                	<fieldset>
                    	<legend>Product Mauual</legend>
						<?php if($product_rec->product_manual != "") { ?>
                        <br /><br />
                        <table class='table'>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Manual Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr class="gradeX">
                                <td><?php echo $product_rec->product_name ; ?></td>
                                <td class="center">
                                &nbsp;<a href="<?php echo base_url("product/download_manual/".$product_rec->id) ; ?>"><img title="Download Manual" src="<?php echo base_url("img/icons/packs/fugue/16x16/drive-download.png") ; ?>" /></a>
                                &nbsp;<a href="<?php echo base_url("product/remove_product_manual/".$product_rec->id) ; ?>" onclick="return confirm('Are you sure to remove this manual?')" ><img title="Delete Manual" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a></td>
                            </tr>
                        </tbody>
                    </table>
                        <br /><br />
                    <?php } else { ?>
                    	<div class='_50'><p><b>Currently this product has no manual.</b></p></div>
                    <?php } ?>
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_rec->id ; ?>" />
						
                        <div class='_100'><p><label for="product_manual">Product Manual</label><input type="file" id="product_manual" name="product_manual" value="" /></p></div>
					
                    </fieldset>
                    <div class='block-actions'>
						<!--<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>-->
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add/Update Product Manual</a></li>
                            <li class="divider-vertical"></li>
                            <li><a id="cancel_form" class="close-toolbox button" href="javascript:void(0);">Cancel</a></li>
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
		$("#product_manual_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("product") ; ?>" ;
	}) ;
}) ;
</script>