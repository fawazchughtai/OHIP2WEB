<div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">System</a></li>
                        <li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
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
							  
							</div>
                        </form>
                    </div>
					
                </section>
				
				<?php include('list_view.php'); ?>
            </div>
        