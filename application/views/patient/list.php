<div class="column is-9">
	<nav class="breadcrumb" aria-label="breadcrumbs">
		<ul>
			<li><a href="#">OHIP</a></li>
			<li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
		</ul>
	</nav>
	
	<section class="info-tiles">
		<div class="box">
				<div class="field is-grouped is-grouped-centered">
				  <p class="control">
					<a class="button is-primary" href="<?php echo $__siteurl . $page_url; ?>/add">New Patient</a>
				  </p> 
				  <?php /*
				  <p class="control">
					<a class="button is-light" href="<?php echo $__siteurl . $page_url; ?>/import_data">Import</a>
				  </p>
				  */ ?>
				</div>
		</div>
	</section>
	
	<?php include('list_view.php'); ?>
	
	
</div>
