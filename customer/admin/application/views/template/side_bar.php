<!-- Begin of Sidebar -->
<aside id="sidebar">
	<!-- Search -->
    <div id="search-bar">
		<form id="search-form" name="search-form" action="<?php echo base_url("customer") ; ?>" method="post">
			<input type="text" id="query" name="query" value="" autocomplete="off" placeholder="Search" />
		</form>
	</div> <!--! end of #search-bar -->
    
	<!-- Begin of #login-details -->
	<section id="login-details">
    	<img class="img-left framed" width="120px" height="48px" src="<?php echo base_url() ; ?>img/logo_argus2.png" alt="Hello Admin" />
		<div style="clear:both;"></div>
		<h3>Logged in as</h3>
    	<h2><a class="user-button" href="javascript:void(0);"><?php echo $this->session->userdata("name") ; ?>&nbsp;<span class="arrow-link-down"></span></a></h2>
    	<ul class="dropdown-username-menu">
    		<li><a href="<?php echo base_url("account") ; ?>">Profile</a></li>
    		<li><a href="<?php echo base_url("home/logout") ; ?>">Logout</a></li>
    	</ul>
    	<div class="clearfix"></div>
  	</section> <!--! end of #login-details -->
    
    <!-- Begin of Navigation -->
    <nav id="nav">
		<ul class="menu collapsible shadow-bottom">
	    	<li>
            	<a href="<?php echo base_url("dashboard") ; ?>">
                	<img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/dashboard.png">Dashboard</span>
                </a>
            </li>
	    	
            <li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/newspaper.png">Orders</a>
	    		<ul class="sub">
	    			<li><a href="<?php echo base_url("orders") ; ?>">All Orders</a></li>
	    			<li><a href="<?php echo base_url("invoices") ; ?>">All Invoices</a></li>
					<li><a href="<?php echo base_url("invoices/payments") ; ?>">Payments and Credit Notes</a></li>
	    		</ul>
	    	</li>
			
			<li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/newspaper.png">Returns</a>
	    		<ul class="sub">
	    			<li><a href="<?php echo base_url("returns") ; ?>">All Returns</a></li>
	    		</ul>
	    	</li>
			
	    	<li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/user-white.png">Customers</a>
	    		<ul class="sub">
	    			<li><a href="<?php echo base_url("customer") ; ?>">All Customers</a></li>
	    			<li><a href="<?php echo base_url("customer/customer_form") ; ?>">Add New Customer</a></li>
	    		</ul>
	    	</li>
            
            <li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/box.png">Products</a>
	    		<ul class="sub">
	    			<li><a href="<?php echo base_url("product") ; ?>">All Products</a></li>
	    			<li><a href="<?php echo base_url("product/product_form") ; ?>">Add New Product</a></li>
					<li><a href="<?php echo base_url("product/product_group") ; ?>">View/Add Product Groups</a></li>
	    		</ul>
	    	</li>
            
	    	<li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/gear.png">Settings</a>
	    		<ul class="sub">
	    			<li><a href="<?php echo base_url("settings/vat_rates") ; ?>">VAT Codes</a></li>
	    			<li><a href="javascript:void(0);">Locations</a></li>
	    		</ul>
	    	</li>
	    	<li>
	    		<a href="javascript:void(0);"><img src="<?php echo base_url() ; ?>img/icons/packs/fugue/16x16/exclamation.png">Audit Log</a>
	    		<ul class="sub">
	    			<li><a href="javascript:void(0);">Display Audit Log</a></li>
	    		</ul>
	    	</li>
	    </ul>
	</nav> <!--! end of #nav -->
</aside> <!--! end of #sidebar -->

<!-- Begin of #main -->
<div id="main" role="main">
	<!-- Begin of titlebar/breadcrumbs -->
	<div id="title-bar">
		<ul id="breadcrumbs">
			<li><a href="index.html" title="Home"><span id="bc-home"></span></a></li>
		</ul>
	</div> <!--! end of #title-bar -->
<div class="shadow-bottom shadow-titlebar"></div>