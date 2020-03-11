<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li class="is-active"><a href="#" aria-current="page">Physician</a></li>
						<li><a href="#">Update</a></li>
                        
                    </ul>
                </nav>
                
                <section class="info-tiles">
					<div class="box">
                        <form action="<?php echo $__siteurl . $page_url; ?>/update" method="post">
							<?php
							$List = $this->iacsmodel->ReturnArrayValue("$_Tbl", "$_f3", $id, "$_f3", 'asc'); 	
							foreach($List as $ListRows){
							?>
							<div class="field ">
                                <label class="label">Physician Name </label>
								<div class="control">
								<input class="input is-large" value="<?php echo $ListRows[$_fl]; ?>" name="txt1" type="text" required>
                                </div>
                            </div>
                            <div class="field">
								<label class="label">Provider Number</label>
                                <div class="control">
                                    <input class="input is-large" value="<?php echo $ListRows[$_f2]; ?>" maxlength="6" name="txt2" type="text" required>
									<input value="<?php echo $ListRows[$_f3]; ?>" name="id" type="hidden">
									
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
				
			<?php include('list_view.php'); ?>	
            
			</div>
        