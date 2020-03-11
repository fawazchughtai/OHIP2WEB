<?php $user = $this->session->userdata("user"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OHIP Web Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/admin.css">
	<?php // async defer ?>
	<script  src="<?php echo base_url();?>asset/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>asset/css/jquery-ui.css">
	<script src="<?php echo base_url();?>asset/jquery-ui.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>asset/jquery.dataTables.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo base_url();?>asset/jstree/themes/default/style.min.css" />
	<script src="<?php echo base_url();?>asset/jstree/jstree.min.js"></script>
	
	<script type="text/javascript" class="init">
	

$(document).ready(function() {
	$('#page_finder').hide();
	$('#example').DataTable( {
		"fnDrawCallback": function( oSettings ) {
		  //alert( 'DataTables has redrawn the table' );
		  $('#page_finder').show();
		  $('#page_finder_loading').hide();
		  
		  
		}
	} );
	//$('#html').jstree();
	load_sidebar();
} );


	</script>

	<Style>
	.f-12{
		font-size: 12px;
	}
	.f-10{
		font-size: 10px;
	}
	
	.disabledDiv {
		pointer-events: none;
		opacity: 0.4;
	}
	.is-active{	
		text-transform: uppercase;
	}
		
	i    
	{
		width: 18px;
	}
.cmb_style
{
	font-size: 12px !important; height: 36px !important;
}
	</style>
</head>

<body>


    <nav class="navbar is-white">
        <div class="container">
            <div class="navbar-brand">
                
                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="navMenu" class="navbar-menu" >
                <div class="navbar-start">
                    <?php if($user <> 'admin'){ ?>
					<a class="navbar-item" href="<?php echo $__siteurl; ?>home">Dashboard</a>
					
                    <a class="navbar-item" href="<?php echo $__siteurl; ?>patient">Patient</a>
                    <div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
						  OHIP
						</a>
						<div class="navbar-dropdown">
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>claim_entry">Claim Entry / Review</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>Submission">Submission</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>transaction_history">Transaction History</a>
						  
						</div>
					</div>					
                    <a class="navbar-item" href="<?php echo $__siteurl; ?>referral">Referral</a>	
					<?php } ?>
					<?php if($user == 'admin'){ ?>
					  <div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
						  System
						</a>

						<div class="navbar-dropdown">
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>services">Services</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>diagnosis">Diagnosis</a>
						  
						  <hr class="navbar-divider">
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>province">Province</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>plan">Plan</a>
						  
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>mri_code">MRI Code</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>specialty_code">Specialty Code</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>status">Status</a>
						</div>
					  </div>
					   
					<?php }else{ ?>	 
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
						  System
						</a>

						<div class="navbar-dropdown">
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>services">Services</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>diagnosis">Diagnosis</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>province">Province</a>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>plan">Plan</a>
						</div>
					  </div>
					   
					<?php } ?>
					
					<?php  if($user <> 'admin'){ ?>
					<a class="navbar-item" href="<?php echo $__siteurl; ?>user_management">User Management</a>
					<!--a class="navbar-item" href="<?php echo $__siteurl; ?>#">Report</a-->
					
					<a class="navbar-item" href="<?php echo $__siteurl; ?>setting">Setting</a>
					  <?php } ?>
					<?php /* if($user == 'Admin'){ ?>
						  <a class="navbar-item" href="<?php echo $__siteurl; ?>user_list">User List</a>
					<?php } */ ?>
					<a class="navbar-item" href="<?php echo $__siteurl; ?>change_password">Change Password</a>
					<a class="navbar-item" href="<?php echo $__siteurl; ?>logout">Logout</a>
				
            </div>

            </div>
        </div>
    </nav>
    <!-- END NAV -->
	
    <div class="container">
        <div class="columns">
		<?php  if($user <> 'admin'){ ?>
            <div class="column is-3 " id="claims_management_tree_view">
                <?php include('sidebar.php'); ?>
            </div>
		<?php  } ?>
<SCRIPT>
document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
</SCRIPT>