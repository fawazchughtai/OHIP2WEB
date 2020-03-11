<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">System</a></li>
                        <li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
                    </ul>
                </nav>
			<div class="columns">
				<div class="column is-12">
					<div class="box">
						<div class="card-table is-full">
							<div class="content">
								<p style="font-weight:900;"> Open Claims</p>
								<table class="table is-fullwidth ">
									<tbody>
										<tr>
											<th>Month</th>
											<th>Year</th>
											<th>Total Service</th>
											<th>Total Fees</th>
											<th>Action</th>
										</tr>
										<?php
										$sql="select Year(m.service_date) as sdy, MONTHNAME(m.service_date) as sdm, sum(serviceqty) as sq, sum(txttotalfee) as st 
										from tblclaim_entry_master m INNER join tblclaim_entry_body b on b.claim_entry_id = m.Claim_id WHERE m.c_e_status = 0 group by sdy,sdm";
										
										$sql = "select Year(service_date) as sdy, MONTHNAME(service_date) as sdm, sum(num_serv) as sq, sum(Submitted_Fee) as st
										From processed_service_record WHERE status = 0 group by sdy,sdm";
										$query=$this->db->query($sql);
										$List = $query->result_array();
										foreach($List as $ListRows){
										?>
										
										<tr>
											<td><?php echo date('M', strtotime($ListRows['sdm'])); ?> </td>
											<td><?php echo $ListRows['sdy']; ?> </td>
											<td><?php echo $ListRows['sq']; ?> </td>
											<td><?php echo $ListRows['st']; ?> </td>
											
											<td><a href="<?php echo base_url(); ?>admin/submission_files" class="button is-primary">Create</a></td>
										</tr>
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
			<div class="columns">
				<div class="column is-12">
					<div class="box">
						<div class="card-table is-full">
							<div class="content">
								<p style="font-weight:900;"> Created Claims</p>
								<table class="table is-fullwidth ">
									<tbody>
										<tr>
											<th>Total Service</th>
											<th>Total Fees</th>
											<th>File Name</th>
											<th>UnSubmit Claims</th>
											<th>Uploaded to MOH</th>
										</tr>
										<?php
										$sql="select Year(m.service_date) as sdy, MONTHNAME(m.service_date) as sdm, sum(serviceqty) as sq, sum(txttotalfee) as st 
										from tblclaim_entry_master m INNER join tblclaim_entry_body b on b.claim_entry_id = m.Claim_id WHERE m.c_e_status = 1 group by sdy,sdm";
										
										$sql = "select Year(service_date) as sdy, MONTHNAME(service_date) as sdm, sum(num_serv) as sq, sum(Submitted_Fee) as st
										From processed_service_record WHERE status = 1 group by sdy,sdm";
										
										$query=$this->db->query($sql);
										$List = $query->result_array();
										foreach($List as $ListRows){
										?>
										
										<tr>
											<td><?php //echo date('M', strtotime($ListRows['sdm'])); ?> </td>
											<td><?php echo $ListRows['sdy']; ?> </td>
											<td><?php echo $ListRows['sq']; ?> </td>
											<td><?php echo $ListRows['st']; ?> </td>
										</tr>
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
				
</div>
        