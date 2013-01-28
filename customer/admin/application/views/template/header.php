<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <title>Argus Distributions</title>
  <meta charset="utf-8">
  
  <!-- DNS prefetch -->
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="<?php echo base_url("css/style.css") ; ?>"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="<?php echo base_url("css/960.fluid.css") ; ?>"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="<?php echo base_url("css/main.css") ; ?>"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="<?php echo base_url("css/buttons.css") ; ?>"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/lists.css") ; ?>"> <!-- Lists, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/icons.css") ; ?>"> <!-- Icons, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/notifications.css") ; ?>"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/typography.css") ; ?>"> <!-- Typography -->
  <link rel="stylesheet" href="<?php echo base_url("css/forms.css") ; ?>"> <!-- Forms, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/tables.css") ; ?>"> <!-- Tables, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/charts.css") ; ?>"> <!-- Charts, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/jquery-ui-1.8.15.custom.css") ; ?>"> <!-- jQuery UI, optional -->
  <link rel="stylesheet" href="<?php echo base_url("css/html_notifications.css") ; ?>"> <!-- Notifications, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?php echo base_url() ; ?>js/libs/modernizr-2.0.6.min.js"></script>
  
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo base_url() ; ?>js/libs/jquery-1.6.2.min.js"><\/script>')</script>
  
  
</head>

<body id="top">
  <!-- Begin of #container -->
  <div id="container">
  	<!-- Begin of #header -->
    <div id="header-surround"><header id="header">
    	<!-- Place your logo here -->
		<img src="<?php echo base_url() ; ?>img/logo.png" alt="Grape" class="logo">
		<!-- Divider between info-button and the toolbar-icons -->
		<div class="divider-header divider-vertical"></div>
		<!-- 
		<a href="javascript:void(0);" onClick="$('#info-dialog').dialog({ modal: true });"><span class="btn-info"></span></a>
        <div id="info-dialog" title="About" style="display: none;">
			<p>About info goes here.</p>
			<p></p>
		</div> -->
		
		<!--
		<ul class="toolbox-header">
			<li>
				<a rel="tooltip" title="Write a Message" class="toolbox-action" href="javascript:void(0);"><span class="i-24-inbox-document"></span></a>
				<div class="toolbox-content">
					<div class="block-border">
						<div class="block-header small">
							<h1>Write a Message</h1>
						</div>
						<form id="write-message-form" class="block-content form" action="" method="post">							
							<p class="inline-mini-label"><label for="recipient">Recipient</label><input type="text" name="recipient" class="required" /></p>
							<p class="inline-mini-label"><label for="subject">Subject</label><input type="text" name="subject" /></p>
                            <div class="_100"><p class="no-top-margin"><label for="message">Message</label><textarea id="message" name="message" class="required" rows="5" cols="40"></textarea></p></div>
							<div class="clear"></div>
							<div class="block-actions">
								<ul class="actions-left"><li><a class="close-toolbox button red" id="reset2" href="javascript:void(0);">Cancel</a></li></ul>
								<ul class="actions-right"><li><input type="submit" class="button" value="Send Message" /></li></ul>
							</div>
						</form>
					</div>
				</div>
			</li>
		</ul>
		-->
		<!-- Begin of #user-info -->
		<div id="user-info">
			<p>
				<span class="messages">Hello <a href="javascript:void(0);"><?php echo $this->session->userdata("name") ; ?></a> <!--( <a href="javascript:void(0);"><img src="<?php // echo base_url() ; ?>img/icons/packs/fugue/16x16/mail.png" alt="Messages" /> 3 new messages</a> ) --></span>
				<a href="javascript:void(0);" id="profile-button" class="toolbox-action button">Profile</a>
                <a href="<?php echo base_url("home/logout") ; ?>" class="button red">Logout</a>
				<script type="application/javascript">
                	$(function(){
						$("#profile-button").click(function(){
							window.location.href = "<?php echo base_url("account") ; ?>" ;
						}) ;
					}) ;
                </script>
            </p>
		</div> <!--! end of #user-info -->
		
    </header></div> <!--! end of #header -->
    
    <div class="fix-shadow-bottom-height"></div>