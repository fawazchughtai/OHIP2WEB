<div class="columns">
	<div class="column is-12">
		<div class="box">
			<div class="card-table is-full">
				<div class="content">
					<table class="table is-fullwidth ">
						<tbody>
							<tr>
								<th>Chart #</tt>
								<th>Health Register #</tt>
								<th>Last Name</tt>
								<th>First Name</tt>
								<th>Action</th>
							</tr>
							<?php
							$List = $this->iacsmodel->ReturnArrayValue("tblpatient", "1", "1", "chartid", 'asc'); 	
							foreach($List as $ListRows){
							?>
							
							<tr>
								<td><?php echo $ListRows['chartid']; ?> </td>
								<td><?php echo $ListRows['hrno']; ?></td>
								<td><?php echo $ListRows['lname']; ?></td>
								<td><?php echo $ListRows['fname']; ?></td>
								
								<td>
									<a class="button is-small is-primary" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows['chartid']; ?>"> <i class="fa fa-pencil"></i> Edit</a>
									<a class="button is-small is-danger" onclick="delete_data('<?php echo $page_url; ?>/delete', <?php echo $ListRows['chartid'];?>);"><i class="fa fa-trash"></i> Delete</a>
									
									<a class="button is-small is-success" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows['chartid']; ?>"> <i class="fa fa-pencil"></i> Claim</a>
									<a class="button is-small is-warning" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows['chartid']; ?>"> <i class="fa fa-history"></i> History</a>
									
								</td>
							</tr>
							
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
