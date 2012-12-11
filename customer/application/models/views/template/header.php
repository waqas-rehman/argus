<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Argus Distribution: Customer Order Portal</title>
<style type="text/css">
		@import url("<?php echo base_url() ; ?>css/style.css");
		@import url("<?php echo base_url() ; ?>css/forms.css");
		@import url("<?php echo base_url() ; ?>css/forms-btn.css");
		@import url("<?php echo base_url() ; ?>css/menu.css");
		@import url("<?php echo base_url() ; ?>css/style_text.css");
		@import url("<?php echo base_url() ; ?>css/datatables.css");
		@import url("<?php echo base_url() ; ?>css/fullcalendar.css");
		@import url("<?php echo base_url() ; ?>css/pirebox.css");
		@import url("<?php echo base_url() ; ?>css/modalwindow.css");
		@import url("<?php echo base_url() ; ?>css/statics.css");
		@import url("<?php echo base_url() ; ?>css/tabs-toggle.css");
		@import url("<?php echo base_url() ; ?>css/system-message.css");
		@import url("<?php echo base_url() ; ?>css/tooltip.css");
		@import url("<?php echo base_url() ; ?>css/wizard.css");
		@import url("<?php echo base_url() ; ?>css/wysiwyg.css");
		@import url("<?php echo base_url() ; ?>css/wysiwyg.modal.css");
		@import url("<?php echo base_url() ; ?>css/wysiwyg-editor.css");
</style>
	
	<!--[if lte IE 8]>
		<script type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.backgroundPosition.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.ui.1.8.17.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.ui.select.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.ui.spinner.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/superfish.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/supersubs.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.datatables.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.smartwizard-2.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/pirobox.extended.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.elastic.source.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.customInput.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.metadata.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.filestyle.mini.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.filter.input.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.flot.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.graphtable-0.2.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/controls/wysiwyg.image.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/controls/wysiwyg.link.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/controls/wysiwyg.table.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/plugins/wysiwyg.rmFormat.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ; ?>js/costum.js"></script>
	
</head>

<body>

<script type="application/javascript">
/*
$(function(){
	$("#left").animate({width:"0px"}, 500);
	$("#right").animate({marginLeft:"20px"}, 500);
	$("#wrapper, #container").animate({backgroundPosition:"-230px 0px"}, 500);
	$(".hide-btn.top, .hide-btn.center, .hide-btn.bottom").animate({left: "-7px"}, 500, function() { $(window).trigger("resize");});
}) ; /**/
</script>
<style type="text/css">
	#left{width:0px !important ; }
	#right{ margin-left:20px !important ; }
</style>
<!-- To make side working, remove styles from divs and also remove <style> from above :) -->
<div id="wrapper" style="background-position: -230px 0px;">
	<div id="container" style="background-position: -230px 0px;">
    <!--
		<div class="hide-btn top"></div>
		<div class="hide-btn center"></div>
		<div class="hide-btn bottom"></div>-->
		<div id="top">
			<h1 id="logo"><a href="./"></a></h1>
			<div id="labels">
				<ul>
					<li><a href="#" class="user"><span class="bar">Welcome <?php echo $this->session->userdata("contact_person_name") ; ?></span></a></li>
                    <li><a href="#" class="settings"></a></li>
					<li class="subnav">
						<a href="#" class="messages"></a>
						<ul>
							<li><a href="#">New message</a></li>
							<li><a href="#">Inbox</a></li>
							<li><a href="#">Outbox</a></li>
							<li><a href="#">Trash</a></li>
						</ul>
					</li>
					<li><a href="<?php echo base_url("home/logout") ; ?>" class="logout"></a></li>
				</ul>
			</div>
            
			<div id="menu">
				<ul> 
					<li <?php if($session_data["current_tab"] == "dashboard") echo 'class="current"' ; ?>>
                    	<a href="<?php echo base_url("dashboard") ; ?>">Dashboard</a>
                    </li>
                    <li <?php if($session_data["current_tab"] == "orders") echo 'class="current"' ; ?>>
                    	<a href="<?php echo base_url("orders") ; ?>">Orders</a>
                    	<ul> 
							<li <?php if($session_data["sub_current_tab"] == "all_orders") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("orders") ; ?>">All Orders</a>
                            </li>
                            <li <?php if($session_data["sub_current_tab"] == "order_form") echo 'class="current"' ; ?>>
                          		<a href="<?php echo base_url("orders/order_form") ; ?>">New Order</a>
                            </li>
                        </ul>
                    </li>
					
                    <li <?php if($session_data["current_tab"] == "quotations") echo 'class="current"' ; ?>>
                    	<a href="<?php echo base_url("quotations/index") ; ?>">Quotations</a>
                    	<ul> 
						   <li <?php if($session_data["sub_current_tab"] == "all_quotation") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("quotations/index") ; ?>">All Quotations</a>
                            </li>
                            <li <?php if($session_data["sub_current_tab"] == "quotation_form") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("quotations/quotation_form") ; ?>">New Quotation</a>
							</li>
                        </ul>
                    </li>
                    
                    
                    <li <?php if($session_data["current_tab"] == "invoices") echo'class="current"' ; ?>>
                    	<a href="<?php echo base_url("invoices") ; ?>">Invoices</a>
                        <ul> 
							
                            <li <?php if($session_data["sub_current_tab"] == "all_invoices") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("invoices") ; ?>">All Invoices</a>
                            </li>
							
						</ul>
                    </li>
                    
                    <li <?php if($session_data["current_tab"] == "returns") echo'class="current"' ; ?>>
                    	<a href="<?php echo base_url("returns") ; ?>">Returns</a>
                        <ul> 
							<li <?php if($session_data["sub_current_tab"] == "all_returns") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("returns") ; ?>">All Returns</a>
                            </li>
							<li <?php if($session_data["sub_current_tab"] == "add_returns") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("returns/add_return") ; ?>">Add Returns</a>
                            </li>
						</ul>
                    </li>
                    
                    <li <?php if($session_data["current_tab"] == "products") echo'class="current"' ; ?>>
                    	<a href="<?php echo base_url("products") ; ?>">Product List</a>
                    </li>
                    
                    <li <?php if($session_data["current_tab"] == "account") echo'class="current"' ; ?>>
                    	<a href="<?php echo base_url("account") ; ?>">Account</a>
                        <ul> 
							
                            <li <?php if($session_data["sub_current_tab"] == "account_information") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("account") ; ?>">Edit Account Info</a>
                            </li>
							
                            <li <?php if($session_data["sub_current_tab"] == "change_password") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("account/change_password") ; ?>">Change Password</a>
                            </li>
                            
                            <li <?php if($session_data["sub_current_tab"] == "transactions") echo 'class="current"' ; ?>>
                            	<a href="<?php echo base_url("account/transactions") ; ?>">Transactions</a>
                            </li>
						</ul>
                    </li> 
				</ul>
			</div>
		</div>