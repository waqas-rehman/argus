<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <!-- DNS prefetch -->
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Argus Distribution - Admin End</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="<?php echo base_url() ; ?>css/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?php echo base_url() ; ?>js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body class="special-page">

  <!-- Begin of #container -->
  <div id="container">
  	
  	<!-- Begin of LoginBox-section -->
    <section id="login-box">
    	
    	<div class="block-border">
    		
            <div class="block-header"><h1>Username/Password Retrieval</h1></div>
            
    		<form id="login-form" class="block-content form" action="<?php echo base_url() ; ?>home/send_email" method="post">

            <?php if($error) { ?>
            	<?php if($error == 1) { ?>
                	<p class="inline-small-label"><img src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-button.png") ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:14px !important;">Email address does not exists</b></p>
                <?php } if($error == 2) { ?>
                	<p class="inline-small-label"><img src="<?php echo base_url("img/icons/packs/fugue/16x16/arrow-curve-000-double.png") ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:14px !important;">Email sent successfully</b></p>
                <?php } if($error == 3) { ?>
                	<p class="inline-small-label"><img src="<?php echo base_url("img/icons/packs/fugue/16x16/arrow-curve-000-double.png") ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:14px !important;">Email sent successfully</b></p>
				<?php } ?>
			<?php } ?>
                
                <p class="inline-small-label">
					<label for="email_address">Email Address</label>
					<input type="text" id="email_address" name="email_address" value="" class="required" autocomplete="off" />
				</p>
				<div class="clear"></div>
				
				<!-- Begin of #block-actions -->
    			<div class="block-actions">
					<ul class="actions-left">
						<li><a class="button" id="back" name="recover_password" href="javascript:void(0);">&lt;&lt; Back</a></li>
						<li class="divider-vertical"></li>
						<li><a class="button red" id="reset-login" href="javascript:void(0);">Cancel</a></li>
					</ul>
					<ul class="actions-right">
						<li><input type="submit" class="button" value="Receive Email" /></li>
					</ul>
				</div> <!--! end of #block-actions -->
    		</form>
    		
    		
    	</div>
    </section> <!--! end of #login-box -->
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo base_url() ; ?>js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="<?php echo base_url() ; ?>js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="<?php echo base_url() ; ?>js/common.js"></script> <!-- Generic functions -->
  <script defer src="<?php echo base_url() ; ?>js/script.js"></script> <!-- Generic scripts -->
  
  <script type="text/javascript">
	$().ready(function() {
		
		/*
		 * Validate the form when it is submitted
		 */
		var validatelogin = $("#login-form").validate({
			invalidHandler: function(form, validator) {
      			var errors = validator.numberOfInvalids();
      			if (errors) {
        			var message = errors == 1
			          ? 'You missed 1 field. It has been highlighted.'
			          : 'You missed ' + errors + ' fields. They have been highlighted.';
        			$('#login-form').removeAlertBoxes();
        			$('#login-form').alertBox(message, {type: 'error'});
        			
      			} else {
       			 	$('#login-form').removeAlertBoxes();
      			}
    		}
		});
		
		jQuery("#reset-login").click(function() {
			validatelogin.resetForm();
		});
				
	});
  </script>
  
  <script type="application/javascript">
	$(function(){
		$("#back").click(function(){ window.location.href = "<?php echo base_url("home") ?>" ; }) ; 
	}) ;
  </script>
  
  <!-- end scripts-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>