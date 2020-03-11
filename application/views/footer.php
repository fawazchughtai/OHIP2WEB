
		</div>
    </div>
<?php /*    <script async type="text/javascript" src="<?php echo base_url();?>asset/js/bulma.js"></script> */ ?>
	
	<script>
	//	$('#html').jstree();
		function delete_data(url_path, recindex)
		{
			var x = confirm('Are you sure you want to delete?');
			if(x == true)
			{
				window.location.href = '<?php echo $__siteurl;?>'+url_path+'/'+recindex;
			}
		}
		
		$( function() {
			$( "#service_date" ).datepicker();
			$( "#admission_date" ).datepicker();

		} );

function load_sidebar()
{
	$('#sidebar_ajax').jstree("refresh");

	$('#sidebar_ajax').jstree({
	  'core' : {
		'data' : {
		  'url' : '<?php echo base_url(); ?>admin/load_Sidebar_ajax/',
		  'data' : function (node) {
			return { 'id' : node.id };
		  }
		}
	  }
	});	
}

	</script>

</body>

</html>
