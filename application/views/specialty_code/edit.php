<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">System</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Specialty Code</a></li>
						<li><a href="#">Update</a></li>
                        
                    </ul>
                </nav>
                
                <section class="info-tiles">
					<div class="box">
                        <form action="<?php echo $__siteurl . $page_url; ?>/update" method="post">
							<?php
							$List = $this->iacsmodel->ReturnArrayValue_Master("tblspecialtycodes", "recid", $id, 'specialtydesc', 'asc'); 	
							foreach($List as $ListRows){
							?>
							<div class="field ">
                                <label class="label">Specialty Code </label>
								<div class="control">
                                    <input class="input is-large" value="<?php echo $ListRows['specialtycode']; ?>" name="txt1" type="text" required>
                                </div>
                            </div>
                            <div class="field">
								<label class="label">Specialty Description</label>
                                <div class="control">
                                    <input class="input is-large" value="<?php echo $ListRows['specialtydesc']; ?>" name="txt2" type="text" required>
									<input value="<?php echo $ListRows['recid']; ?>" name="id" type="hidden">
									
                                </div>
                            </div>
							<div class="field is-grouped is-grouped-centered">
							  <p class="control">
								<button class="button is-light is-primary">Save</button>
							  </p>
							  <p class="control">
								<a class="button is-light" href="<?php echo $__siteurl . $page_url; ?>/import_data">Import</a>
							  </p>
							<?php } ?>
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
													<a class="button is-small is-danger" onclick="delete_data('<?php echo $page_url; ?>/delete', <?php echo $ListRows['recid'];?>);"><i class="fa fa-trash"></i> Delete</a>
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
        