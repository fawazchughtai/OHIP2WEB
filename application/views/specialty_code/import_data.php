<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">System</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Specialty Code</a></li>
						<li><a href="#">Import</a></li>
                        
                    </ul>
                </nav>
                
                <section class="info-tiles">
					<div class="box">
                        <form action="<?php echo $__siteurl . $page_url; ?>/import" enctype="multipart/form-data" method="post">
							<div class="field ">
                                <label class="label">Files </label>
								<div class="control">
                                    <input type="file" name="file" id="file" required accept=".xls, .xlsx" required /></p>
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-centered">
							  <p class="control">
								<button class="button is-light is-primary">Import</button>
							  </p>
							  
							  <p class="control">
								<a class="button is-light is-primary" style="background-color: grey;" href="<?php echo base_url(); ?>download_sample/specialty_code.xlsx">Download</a>
							  </p>
							  
							  							  
							</div>
                        </form>
                    </div>
					
                </section>
				
				
                <div class="columns">
                    <div class="column is-12">
                        <div class="box">
                            <div class="card-table is-full">
                                <div class="content">
                                    <table class="table is-fullwidth ">
                                        <tbody>
                                            <tr>
                                                <th>Specialty Code</tt>
												<th>Specialty Description</tt>
                                                <th>Action</th>
                                            </tr>
                                            <?php
											$List = $this->iacsmodel->ReturnArrayValue("tblspecialtycodes", "1", "1", 'specialtydesc', 'asc'); 	
											foreach($List as $ListRows){
											?>
											
											<tr>
                                                <td><?php echo $ListRows['specialtycode']; ?> </td>
												<td><?php echo $ListRows['specialtydesc']; ?></td>
												
                                                <td>
													<a class="button is-small is-primary" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows['recid']; ?>"> <i class="fa fa-pencil"></i> Edit</a>
													<a class="button is-small is-danger" onclick="delete_data('<?php echo $page_url; ?>/delete', <?php echo $ListRows['recid'];?>);"><i class="fa fa-bell-o"></i> Delete</a>
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
            </div>
        