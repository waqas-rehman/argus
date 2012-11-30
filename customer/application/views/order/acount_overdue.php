<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Error<span class="hide"></span></div>
			<div class="content">
				<?php
					if($msg)
					{
						if($msg == 1)
							echo '<div class="message red"><span>Your account is now either on stop due to overdue invoices or you have reached your credit limit.</span></div>' ;
							echo '<div class="message red"><span>Please clear the outstanding balance(s) before trying to place a new order.</span></div>' ;
							echo '<div class="message red"><span>If you believe that you are seeing this message in error, please contact us on 0844 678 0088.</span></div>' ;
					} 
				?>
				
                	<h4 align="center"><a href="<?php echo base_url("dashboard/index") ; ?>">Click here</a> to Back.</h4>
				
			</div>
		</div>
	</div>
</div>