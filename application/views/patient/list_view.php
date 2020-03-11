
<div class="columns">
	<div class="column is-12">
		<div class="box">
			<div class="card-table is-full">
				<div class="content">
					<table class="table is-fullwidth " id="example">
						<thead>
						
							<tr>
								<th>Chart #</th>
								<th>Health Register #</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Action</th>
							</tr>
							</thead>
							
							<tbody>
							<?php
							$List = $this->iacsmodel->ReturnArrayValue("patients", "1", "1", "id", 'asc'); 	
							foreach($List as $ListRows){
							?>
							
							<tr>
								<td><?php echo $ListRows['id']; ?> </td>
								<td><?php echo $ListRows['ohip']; ?></td>
								<td><?php echo $ListRows['lname']; ?></td>
								<td><?php echo $ListRows['fname']; ?></td>
								
								<td style="width:300px;">
									<a class="button is-small is-primary" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows['id']; ?>"> <i class="fa fa-pencil"></i> Edit</a>
									<a class="button is-small is-danger" onclick="delete_data('<?php echo $page_url; ?>/delete', <?php echo $ListRows['id'];?>);"><i class="fa fa-trash"></i> Delete</a>
									
									<a class="button is-small is-success" href="<?php echo $__siteurl; ?>claim_entry?pid=<?php echo $ListRows['ohip']; ?>&sid=C771A&did=1&sd=06/30/2019&sd_t=0&mrecord=0&Cid=5&serviceqty=0"> Claim<i class="fa fa-pencil"></i> 
									<a class="button is-small is-warning" href="<?php echo $__siteurl; ?>transaction_history?pid=<?php echo $ListRows['id']; ?>&txtfilter=1"> <i class="fa fa-history"></i> History</a>
									
								</td>
							</tr>
							
							<?php } ?>
						</tbody>
						<tfoot>
						
							<tr>
								<th>Chart #</th>
								<th>Health Register #</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Action</th>
							</tr>
						</tfoot>
							
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
