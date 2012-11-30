<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Products</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Product List</h1><span></span></div>
				<?php 
				if($msg)
				{
                	if($msg == 1)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Product record removed successfully</li></ul></div>' ;
					}
					if($msg == 2)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to remove Product record</li></ul></div>' ;
					}
				}
                ?>
                <div class='block-content'>
					
                    <table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th class='center'>Product Name</th>
                                <th class='center'>Product Group</th>
                                <th class='center'>Product Code</th>
                                <th class='center'>ADL Code</th>
                                <th class='center'>Product Price</th>
                                <th class='center'>Last Update</th>
                                <th class='center'>Action</th>
							</tr>
						</thead>
						<?php if($products) { ?>
                        <tbody>
                        	<?php foreach($products as $rec) : ?>
                            <tr class='gradeX'>
                            	<td class='center'><a href="#"><?php echo $rec->product_name ; ?></a></td>
                                <td class='center'><a href="#"><?php echo $rec->group_name ; ?></a></td>
                                <td class='center'><?php echo $rec->product_code ; ?></td>
                                <td class='center'><?php echo $rec->adl_code ; ?></td>
                                <td class='center'><?php echo $rec->product_price ; ?></td>
                                <td class='center'><?php echo date("d/m/Y g:i a", strtotime($rec->update_date)) ; ?></td>
								<td class='center'>
                                	<?php if($rec->product_manual != "") { ?>
                                    &nbsp;<a href="<?php echo base_url("product/product_manual/".$rec->id."/0") ; ?>"><img title="Update Product Manual" src="<?php echo base_url("img/icons/packs/fugue/16x16/envelope--plus.png") ; ?>" /></a>
                                    <?php } else { ?>
                                    &nbsp;<a href="<?php echo base_url("product/product_manual/".$rec->id."/0") ; ?>"><img title="Add Product Manual" src="<?php echo base_url("img/icons/packs/fugue/16x16/envelope--minus.png") ; ?>" /></a>
                                    <?php } ?>
                                    &nbsp;<a href="<?php echo base_url("product/product_details/".$rec->id."/0") ; ?>"><img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("product/remove_product/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                              	</td>
							</tr>
                            <?php endforeach ; ?>
 						</tbody>
						<?php } ?>
                    </table>
                  </div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
</div> <!--! end of #main-content -->