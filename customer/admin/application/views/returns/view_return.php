<div id="main-content">
	<div class="container_12">
    	<div class="grid_12"><h1>Return Details</h1></div>
        <div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Return Details - RMA Number <?php echo $return_rec->rma_number ; ?></h1><span></span></div>
				<?php 
				if($msg)
				{
					if($msg == 5)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 5)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 6)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 7)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					
                	if($msg == 10)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Basic Information updated successfully</li></ul></div>' ;
					}
					
					if($msg == 11)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Products updated successfully</li></ul></div>' ;
					}
					
					if($msg == 12)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Description updated successfully</li></ul></div>' ;
					}
					
					if($msg == 13)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order File updated successfully</li></ul></div>' ;
					}
					
					if($msg == 14)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Status update successfully</li></ul></div>' ;
					}
				}
                ?>
				<form id='form' class="block-content form" action="" method='post'>
				<fieldset>
					<legend>Return Details</legend>
					<div class='_100'><p><b>Return Status: </b><?php echo $return_rec->status ; ?> (<a href="<?php echo base_url("returns/edit_returns/".$return_rec->id) ; ?>">Change</a>)</p></div>
					<div class='_100'><p><b>RMA Number: </b><?php echo $return_rec->rma_number ; ?></p></div>
					<div class='_100'><p><b>Customer Representative: </b><?php echo $return_rec->customer_representative ; ?></p></div>
					<div class='_100'><p><b>Credit Required: </b><?php echo $return_rec->credit_required ; ?></p></div>
					<div class='_100'><p><b>Repair Required: </b><?php echo $return_rec->repair_required ; ?></p></div>
					<div class='_100'><p><b>Invoice Number: </b><?php echo $return_rec->invoice_number ; ?></p></div>
					<div class='_100'><p><b>Report Required: </b><?php echo $return_rec->report_required ; ?></p></div>
					<div class='_100'><p><b>Site Address: </b><?php echo $return_rec->site_address ; ?></p></div>
					<div class='_100'><p><b>Installation Date: </b><?php echo date("d/m/Y", strtotime($return_rec->installation_date)) ; ?></p></div>
					<div class='_100'><p><b>Last Maintaince Date: </b><?php echo date("d/m/Y", strtotime($return_rec->last_maintaince_date)) ; ?></p></div>
					<div class='_100'><p><b>Installation Details: </b></p><p><?php echo $return_rec->installation_details ; ?></p></div>
					<div class='_100'><p><b>Environmental Conditions: </b></p><p><?php echo $return_rec->environmental_conditions ; ?></p></div>
					<div class='_100'><p><b>Additional Description: </b></p><p><?php echo $return_rec->additional_description ; ?></p></div>
					
					<div class='_100'><p><b>Insertion Date: </b></p><p><?php echo date("d/m/Y", strtotime($return_rec->insert_date)) ; ?></p></div>
					<div class='_100'><p><b>Updation Date: </b></p><p><?php echo date("d/m/Y", strtotime($return_rec->update_date)) ; ?></p></div>
					
				</fieldset>
				
				<fieldset>
					<legend>Products Details</legend><br />
                    <label for="product_details">List of products being returned and their individual date codes</label>
                    <table class='table'> <!-- id='table-example' -->
						<thead>
                        	<tr>
                            	<th>Product Group</th>
                                <th>Products</th>
                                <th>Quantity</th>
                                <th>Date Code</th>
							</tr>
						</thead>
						
						<tbody>
						 	<?php if($products_rec) { $x = 1 ; foreach($products_rec as $rec): ?>
                            <tr id="tr_<?php echo $x ; ?>">
								<td id="group_<?php echo $x ; ?>">
									<input type="hidden" id="product_group<?php echo $x ; ?>" name="product_group[]" value="<?php echo $rec->group_id ; ?>"  class="product_group"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->group_name ; ?>			
                                </td>
                                <td id="product_<?php echo $x ; ?>">
                                    <input type="hidden" id="products<?php echo $x ; ?>" name="products[]" value="<?php echo $rec->product_id ; ?>"  class="products_dropdown"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_name ; ?>
                                </td>
                                <td id="quantity_<?php echo $x ; ?>">
                                    <input type="hidden" id="product_quantity<?php echo $x ; ?>"  name="product_quantity[]" value="<?php echo $rec->product_quantity ; ?>" class="product_quantity" number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_quantity ; ?>
                                </td>
                                
								<td id="quantity_<?php echo $x ; ?>">
                                    <input type="hidden" id="date_code<?php echo $x ; ?>"  name="date_code[]" value="<?php echo $rec->date_code ; ?>" class="date_code" number="<?php echo $x ; ?>" />
                                    <?php echo $rec->date_code ; ?>
                                </td>
                            </tr>
                            <?php $x = $x + 1 ; endforeach ; } ?>
                        
                        </tbody>
                    </table>
                    <br />
				</fieldset>
				
                <div class="block-actions">
                    <ul class="actions-left"><li><a id="back" class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                    <ul class="actions-right"><li><a id="edit_order_file" class="close-toolbox button" href="javascript:void(0);">Edit &gt;&gt;</a></li></ul>
                </div>
                
                <script type="application/javascript">
                	$("#edit_order_file").click(function(){
						 window.location.href = "<?php echo base_url("returns/edit_returns/".$return_rec->id) ; ?>" ;
					}) ;
                </script>
                
            </form> 
                
			</div>
	</div>
   	</div>
    <div class="clear height-fix"></div>
</div> <!-- end of #main-content -->
<script type="application/javascript">
$(function(){
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; }) ;
}) ;
</script>