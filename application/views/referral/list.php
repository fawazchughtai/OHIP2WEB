<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li class="is-active"><a href="#" aria-current="page">Physician</a></li>
                    </ul>
                </nav>
                
                <section class="info-tiles">
					<div class="box">
                        <form action="<?php echo $__siteurl . $page_url; ?>/save" method="post">
							<div class="field ">
                                <label class="label">Physician Name </label>
								<div class="control">
                                    <input class="input is-large" name="txt1" type="text" required>
                                </div>
                            </div>
                            <div class="field">
								<label class="label">Provider Number</label>
                                <div class="control">
                                    <input class="input is-large" name="txt2"  maxlength="6" type="text" required>
                                </div>
                            </div>
							<div class="field is-grouped is-grouped-centered">
							  <p class="control">
								<button class="button is-light is-primary">Save</button>
							  </p>
							  <p class="control">
								<a class="button is-light" href="<?php echo $__siteurl . $page_url; ?>/import_data">Import</a>
							  </p>
							  
							</div>
                        </form>
                    </div>
					
                </section>
				
				<?php include('list_view.php'); ?>
                
				
            </div>
        