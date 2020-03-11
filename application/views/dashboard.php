 <div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li class="is-active"><a href="#" aria-current="page">User Panel</a></li>
                    </ul>
                </nav>
                <section class="hero is-info welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Hello, <?php echo $this->session->userdata("fullname"); ?>.
                            </h1>
                            <h2 class="subtitle">
                                I hope you are having a great day!
                            </h2>
                        </div>
                    </div>
                </section>
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title">
								<?php
								$Claim_Total  = 0;
								
							$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from tblclaim_entry_master WHERE c_e_status = 0 group by service_date";
							$sql_Side="select count(*) as Claim_Total from processed_service_record WHERE status = 0 group by source_id";
							$query_Side=$this->db->query($sql_Side);
							$_Side_List = $query_Side->result_array();
							foreach($_Side_List as $_Side_ListRows){
								$Claim_Total = $_Side_ListRows['Claim_Total'];
							}
							if($Claim_Total == 0)
							{
								echo $Claim_Total;
							}else{
								echo $Claim_Total;
							}
							
							?></p>
                                <p class="subtitle">OPEN CLAIMS</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title"><?php
								$Claim_Total  = 0;
							//$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from tblclaim_entry_master WHERE c_e_status = 1 group by service_date";
							$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from processed_service_record
							WHERE status = 1 group by service_date";
							$query_Side=$this->db->query($sql_Side);
							$_Side_List = $query_Side->result_array();
							foreach($_Side_List as $_Side_ListRows){
								$Claim_Total = $_Side_ListRows['Claim_Total'];
							}
							if($Claim_Total == 0)
							{
								echo $Claim_Total;
							}else{
								echo $Claim_Total;
							}
							
							?></p>
                                <p class="subtitle">REQUIRES CORRECTION CLAIM</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title"><?php
							$Claim_Total = 0;
							$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from tblclaim_entry_master 
							WHERE c_e_status = 2 group by service_date";
							$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from processed_service_record
							WHERE status = 2 group by service_date";
							
							$query_Side=$this->db->query($sql_Side);
							$_Side_List = $query_Side->result_array();
							foreach($_Side_List as $_Side_ListRows){
								echo $Claim_Total = $_Side_ListRows['Claim_Total'];
							}
							if($Claim_Total == 0)
							{
								echo $Claim_Total;
							}else{
								echo $Claim_Total;
							}
							
							?></p>
                                <p class="subtitle">CREATED CLAIM</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title">0</p>
                                <p class="subtitle">SUBMITTED CLAIM</p>
                            </article>
                        </div>
						<div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title">0</p>
                                <p class="subtitle">PAID CLAIMS</p>
                            </article>
                        </div>
						
                    </div>
                </section>
                <div class="columns">
                    <div class="column is-6">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    OPEN CLAIMS 
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <tbody>
                                            <?php /*
							$sql_Side="select service_date, 0 as tf, count(*) as Claim_Total from tblclaim_entry_master 
							WHERE c_e_status = 0 group by service_date";
							
							$query_Side=$this->db->query($sql_Side);
							$_Side_List = $query_Side->result_array();
							foreach($_Side_List as $_Side_ListRows){
							?>
							
									<?php
										$sql_Side2="select chartid, Claim_id from tblclaim_entry_master WHERE c_e_status = 0 AND service_date='".$_Side_ListRows['service_date']."'";
										$query_Side2=$this->db->query($sql_Side2);
										$_Side_List2 = $query_Side2->result_array();
										foreach($_Side_List2 as $_Side_ListRows2){
										//echo "___".$_Side_ListRows2['chartid']; 
										?>
										<tr>
										<td width="5%"><i class="fa fa-bell-o"></i></td>
										<td>
											<?php echo $this->iacsmodel->ReturnRowValue("tblpatient", "lname", "chartid", $_Side_ListRows2['chartid']); ?>, 
											<?php echo $this->iacsmodel->ReturnRowValue("tblpatient", "fname", "chartid", $_Side_ListRows2['chartid']); ?>
										</td>
										
										<td>
											<a class="button is-small is-primary" href="<?php echo base_url(); ?>admin/claim_entry/review/<?php echo $_Side_ListRows2['Claim_id']; ?>">
												<i class="fa fa-pencil"></i>Edit 
												</a>
										</td>
										<tr>
									<?php } ?>
								
							
							<?php } 
							
							*/ ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item">View All</a>
                            </footer>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Claim # Search
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-large" type="text" placeholder="">
                                        <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                        <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Patient Search
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-large" type="text" placeholder="">
                                        <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                        <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        