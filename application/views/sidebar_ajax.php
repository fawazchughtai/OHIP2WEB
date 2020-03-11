	<ul data-jstree='{ "opened" : false }'>
		<li>
		Open Claims $<?php echo number_format($this->General_model->Claim_Value(0),2); ?>  Claim=<?php echo $this->General_model->Claim_Counter(0); ?>
		
		<ul class="menu-list" data-jstree='{ "opened" : true}'>
			<?php
			//$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from tblclaim_entry_master WHERE c_e_status = 0 group by service_date";
			$db_name = $this->session->userdata("db_name");
			$this->db->query('use '.$db_name.'');
			
			$sql_Side="select service_date, 0 as tf, count(source_id) as Claim_Total from processed_service_record WHERE status = 0 group by service_date";
							
			$query_Side=$this->db->query($sql_Side);
			$_Side_List = $query_Side->result_array();
			//$NR = $query_Side->num_rows;
			foreach($_Side_List as $_Side_ListRows){
			?>
			<li><a><?php echo date('m/d/Y', strtotime($_Side_ListRows['service_date'])); ?> 
			$<?php echo number_format($this->General_model->Claim_Value_date(0, $_Side_ListRows['service_date']),2); ?> 
			Claims=<?php 
			$sql_Side22="select patient_id, source_id from processed_service_record WHERE status = 0 AND service_date='".$_Side_ListRows['service_date']."' group by source_id";
						$query_Side22=$this->db->query($sql_Side22);
						$_Side_List22 = $query_Side22->result_array();
						$NR=0;
						foreach($_Side_List22 as $_Side_ListRows22){
						//echo "___".$_Side_ListRows2['chartid']; 
						$NR = $NR +1;
						?>
						<?php } 
						echo $NR;
						?>
				</a>
				<ul class="menu-list">
					<?php
						//$sql_Side2="select chartid, Claim_id,claim_entry_id from tblclaim_entry_master WHERE c_e_status = 0 AND service_date='".$_Side_ListRows['service_date']."'";
						$sql_Side="select patient_id, source_id from processed_service_record WHERE status = 0 AND service_date='".$_Side_ListRows['service_date']."' ";
						$sql_Side2="select patient_id, source_id from processed_service_record WHERE status = 0 AND service_date='".$_Side_ListRows['service_date']."' group by source_id";
						$query_Side2=$this->db->query($sql_Side2);
						$_Side_List2 = $query_Side2->result_array();
						foreach($_Side_List2 as $_Side_ListRows2){
						//echo "___".$_Side_ListRows2['chartid']; 
						?>
						
						<li data-jstree='{"icon":"fa fa-pencil"}' onclick="	location.href = '<?php echo base_url(); ?>admin/claim_entry/review/<?php echo $_Side_ListRows2['source_id']; ?>';">
							<a href="<?php echo base_url(); ?>admin/claim_entry/review/<?php echo $_Side_ListRows2['source_id']; ?>">
							<?php echo $this->iacsmodel->ReturnRowValue("patients", "lname", "id", $_Side_ListRows2['patient_id']); ?>, 
								<?php echo $this->iacsmodel->ReturnRowValue("patients", "fname", "id", $_Side_ListRows2['patient_id']); ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
		</ul>
		</li>
	</ul>
	<ul><li>Requires Correction Claim</li></ul>
	<ul><li>Created Claim</li></ul>
	<ul><li>Submitted Claim</li></ul>
	<ul><li>Paid Claims</li></ul>
