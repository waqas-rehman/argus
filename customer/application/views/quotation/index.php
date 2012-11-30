<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Quotations<span class="hide"></span></div>
			<div class="content">
				<?php
					if($msg)
					{
						if($msg == 1) echo '<div class="message green"><span>Record Deleted Successfully</span></div><br /><br />' ;
						if($msg == 2) echo '<div class="message red"><span>Failed to Delete Record</span></div><br /><br />' ;
					} 
				?>
				<?php if($quote_recs) { ?>
                <table cellspacing="0" cellpadding="0" border="0" class="all"> 
					<thead> 
						<tr>
							<th>Quotation #</th>
							<th>Creation Date</th>
                            <th>Action</th>
						</tr>
					</thead>
				    <tbody>
						<?php foreach($quote_recs as $rec): ?>
                        <tr>
							<td><?php echo $rec->purchase_order_number ; ?></td>
							<td><?php echo date("d/m/Y g:i a", strtotime($rec->creation_date)) ; ?></td>
							<td>
                            	<a href="<?php echo base_url("quotations/quotation_detail/".$rec->id) ; ?>">View</a>&nbsp;
                           		<a onclick="return confirm('Are you sure to remove this quotation completely?');" href="<?php echo base_url("quotations/delete_quotation/".$rec->id) ; ?>">Remove</a>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
					</tbody>
				</table>
                <?php } else { ?>
                	<h4>No quotations have been created. <a href="<?php echo base_url("quotations/quotation_form") ; ?>">Click here</a> to add one.</h4>
				<?php } ?>
			</div>
		</div>
	</div>
</div>