<?php
$pid=isset($_GET['pid']) ? $_GET['pid'] : '0';
$sid=isset($_GET['sid']) ? $_GET['sid'] : '0';
$did=isset($_GET['did']) ? $_GET['did'] : '0';
$sd=isset($_GET['sd']) ? $_GET['sd'] : '0';
$sd_t=isset($_GET['sd_t']) ? $_GET['sd_t'] : '0';
$mrecord=isset($_GET['mrecord']) ? $_GET['mrecord'] : '0';
$Cid=isset($_GET['Cid']) ? $_GET['Cid'] : '0';
$serviceqty=isset($_GET['serviceqty']) ? $_GET['serviceqty'] : '0';

?>
<div class="columns">
	<div class="column is-12">
		<?php if($_Tbl == 'tblpatient'){ ?>
			<div class="box">
				<div class="field is-grouped is-grouped-centered">
				  <p class="control">
					<a class="button is-primary" href="<?php echo $__siteurl; ?>/patient/add">New Patient</a>
				  </p> 
				</div>
			</div>
		<?php } ?>
		<div class="box">
			<div class="card-table is-full">
				<div class="content" >
					<div id="page_finder_loading" >
					<center>
					<img src="<?php echo base_url(); ?>asset/loading_img.gif">
					</center>
					</div>
				<div id="page_finder" style="display:none;">
				
					<table class="table is-fullwidth " id="example">
						<thead>
							<tr>
								<th>Code</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$List = $this->iacsmodel->ReturnArrayValue("$_Tbl", "1", "1", "$_f3", 'asc'); 	
							foreach($List as $ListRows){
							?>
							
							<tr>
								<td><?php echo $ListRows[$_fl]; ?> </td>
								<td><?php echo $ListRows[$_f2]; ?></td>
								
								<td>
									<a class="button is-small is-primary" 
									href="<?php echo $__siteurl; ?>claim_entry<?php 
									if($types == 'services'){ echo "?pid=".$pid."&sid=".$ListRows[$_fl]."&did=".$did."&sd=".$sd."&sd_t=".$sd_t."&mrecord=$mrecord&Cid=$Cid&serviceqty=$serviceqty";  }
									if($types == 'diagnosis'){ echo "?pid=".$pid."&sid=".$sid."&did=".trim($ListRows[$_f3])."&sd=".$sd."&sd_t=".$sd_t."&mrecord=$mrecord&Cid=$Cid&serviceqty=$serviceqty";  }
									if($types == 'Patient'){ echo "?pid=".$ListRows[$_fl]."&sid=".$sid."&did=".$did."&sd=".$sd."&sd_t=".$sd_t."&mrecord=$mrecord&Cid=$Cid&serviceqty=$serviceqty";  } ?>">
									<i class="fa fa-check"></i> Select</a>
								</td>
							</tr>
							
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Code</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
