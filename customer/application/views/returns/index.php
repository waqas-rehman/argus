<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Returns<span class="hide"></span></div>
			<div class="content">
				<?php
					if($msg)
					{
						if($msg == 2) echo '<div class="message green"><span>Request submitted successfully</span></div>' ;
						if($msg == 3) echo '<div class="message red"><span>Failed to submit request</span></div>' ;
						
						if($msg == 4) echo '<div class="message green"><span>Record deleted successfully</span></div>' ;
						if($msg == 5) echo '<div class="message red"><span>Failed to delete record</span></div>' ;
					} 
				?>
				<?php if($returns_rec) { ?>
                <table cellspacing="0" cellpadding="0" border="0" class="all"> 
					<thead> 
						<tr>
							<th>RMA #</th>
							<th>Status</th>
							<th>Return Submission Date</th>
                            <th>Action</th>
						</tr>
					</thead>
				    <tbody>
						<?php foreach($returns_rec as $rec): ?>
                        <tr>
							<td><?php echo $rec->rma_number ; ?></td>
							<td><?php echo $rec->status ?></td>
							<td><?php echo date("d/m/Y", strtotime($rec->insert_date)) ; ?></td>
							<td>
								<?php if($rec->status == "Submit" || $rec->status == "Closed") {  ?>
									<a href="<?php echo base_url("returns/view_return/".$rec->id) ; ?>">View</a>&nbsp;
								<?php } else {  ?>
									<a href="<?php echo base_url("returns/view_return/".$rec->id) ; ?>">View</a>&nbsp;
									<a href="<?php echo base_url("returns/return_detail/".$rec->id) ; ?>">Edit</a>&nbsp;
									<a onclick="return confirm('Are you sure to remove this record?');" href="<?php echo base_url("returns/delete_returns/".$rec->id) ; ?>">Remove</a>
								<?php } ?>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
					</tbody>
				</table>
                <?php } else { ?>
                	<h4>Currently No Returns is added by you. <a href="<?php echo base_url("returns/add_return") ; ?>">Click here</a> to add.</h4>
				<?php } ?>
			</div>
		</div>
	</div>
</div>