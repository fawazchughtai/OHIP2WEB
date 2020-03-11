<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">System</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Submission</a></li>
						<li><a href="#">Upload Files</a></li>
                        
                    </ul>
                </nav>
                
                <section class="info-tiles">
					<div class="box">
                        <form action="<?php echo base_url(); ?>/api_upload.php" method="get">
							<div class="field ">
                                <label class="label">Files</label>
								<div class="control">
								<input class="input is-large" name="Files_Binary_File" type="file" required>
                                </div>
                            </div>
                            <div class="field">
								<label class="label">Description</label>
                                <div class="control">
                                    <input class="input is-large" value="<?php //echo $ListRows[$_f2]; ?>" name="txtdescription" type="text" required>
                                </div>
                            </div>
							
							<div class="field">
							  <label class="label">Resource Type</label>
							  <div class="control">
								<input class="input is-large" value="<?php //echo $ListRows[$_f2]; ?>" name="resourceType" type="text" required>
							  </div>
							</div>
							
							
							<div class="field is-grouped is-grouped-centered">
							  <p class="control">
								<button type="submit" class="button is-light is-primary">Upload</button>
							  </p>
							</div>
                        </form>
                    </div>
					
                </section>
				
			</div>
        