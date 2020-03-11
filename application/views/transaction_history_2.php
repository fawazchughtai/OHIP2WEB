<?php 
$link = "";
$rows = $s_amount = $s_qty = 0; 
$from=isset($_GET['from']) ? $_GET['from'] : date('m/d/Y');
$to=isset($_GET['to']) ? $_GET['to'] : date('m/d/Y');

$pid=isset($_GET['pid']) ? $_GET['pid'] : '';

$txtfilter=isset($_GET['txtfilter']) ? $_GET['txtfilter'] : '';

if($txtfilter == ''){
	$sub_query = "";
}else{
	$to = date('Y-m-d', strtotime($to));
	$from = date('Y-m-d', strtotime($from));
	if($pid <> ''){
		$sub_query = " And chartid='".$pid."'";	
		$link = "?pid=".$pid."&txtfilter=1";
	}else{
		$sub_query = " And m.service_date between '".$from."' and '".$to."'";	
	}	
		
}
?>
<div class="column is-10">
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
								<p style="font-weight:900;"> 
								<a href="<?php echo base_url(); ?>admin/transaction_history">Open Claims</a> | 	
 								<a href="<?php echo base_url(); ?>admin/transaction_history/2">Submitted Claims</a>
								
								</p>
								<table class="table is-fullwidth ">
									<tbody>
										<tr>
											<th>Last Name</th>
											<th>First Name</th>
											<th>Service Date</th>
											<th>Service Code</th>
											<th># Service</th>
											<th>Service Fees</th>
											<th>Amount Submitted</th>
											<th>Amount Paid</th>
											<th>Error</th>
											
										</tr>
										<?php
										$sql="select chartid, m.service_date, service_code, serviceqty, txtunitfee, txttotalfee
										from tblclaim_entry_master m INNER join tblclaim_entry_body b on b.claim_entry_id = m.Claim_id 
										WHERE m.c_e_status = 0".$sub_query;
										$query=$this->db->query($sql);
										$List = $query->result_array();
										foreach($List as $ListRows){
											$rows = $rows + 1;
											$chartid = $ListRows['chartid'];
										?>
										
										<tr>
											<td><?php echo $this->General_model->ReturnRowValue("tblpatient", "lname", "chartid", "$chartid"); ?></td>
											<td><?php echo $this->General_model->ReturnRowValue("tblpatient", "fname", "chartid", "$chartid"); ?></td>
											
											<td><?php echo date('d, M, Y', strtotime($ListRows['service_date'])); ?> </td>
											<td><?php echo $ListRows['service_code']; ?> </td>
											<td><?php echo $ListRows['serviceqty'];
											$s_qty = $s_qty + $ListRows['serviceqty']; ?> </td>
											<td>$ <?php echo $ListRows['txtunitfee']; ?> </td>
											<td>$ <?php echo $ListRows['txttotalfee'];
											$s_amount = $s_amount + $ListRows['txttotalfee']; ?> </td>
											<td><?php //echo $s_amount = $s_amount + $ListRows['txttotalfee']; ?> </td>
											<td><?php //echo $s_amount = $s_amount + $ListRows['txttotalfee']; ?> </td>
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
				<div class="column is-5">
					<div class="box"style="height: 250px;">
						<div class="card-table is-full">
							<div class="content">
								<form action="<?php echo base_url(); ?>admin/transaction_history/2" method="get">
									<p>From <input class="input is-midden" id="service_date" type="text" name="from" value="<?php echo date('m/d/Y'); ?>"> </p>
									<p>To <input class="input is-midden" id="admission_date" type="text" name="to" value="<?php echo date('m/d/Y'); ?>"></p>
									<p>
									<input type="hidden" name="txtfilter" value="filter">
									<input type="submit" class="button is-light is-primary" value="Refresh">
									<a href="<?php echo base_url(); ?>admin/transaction_history/2" class="button is-light is-primary">Show All</a>
									<a href="" class="button is-light is-primary">Print</a>
									</p>
								</form>
								
							</div>
						</div>
					</div>
				</div>
				<div class="column is-6">
					<div class="box" style="height: 170px;">
						<div class="card-table is-full">
							<div class="content">
								<div id="" style="float:left;">
									<p>Total Count</p>
									<p><strong><?php  echo $rows; ?></strong></p>
									<p>Total Service Units</p>
									<p><strong><?php echo $s_qty; ?></strong></p>
								</div>
								<div id="" style="float:right;">
									<p>Total Submitted</p>
									<p><strong>$ <?php  echo $s_amount; ?></strong></p>
									<p>Total Paid</p>
									<p><strong>$ 0.00<?php  //echo $s_amount; ?></strong></p>

								</div>
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
				
</div>
        