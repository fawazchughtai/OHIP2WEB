<div class="columns">
                    <div class="column is-12">
                        <div class="box">
                            <div class="card-table is-full">
                                <div class="content">
                                    <table class="table is-fullwidth " id="example">
										<thead>
                                        
                                            <tr>
                                                <th>Province</tt>
												<th>Code</tt>
                                                <th>Action</th>
                                            </tr>
									</thead>
									
<tbody>                                        
										<?php
											$List = $this->iacsmodel->ReturnArrayValue("$_Tbl", "1", "1", "$_f3", 'asc'); 	
											foreach($List as $ListRows){
											?>
											
											<tr>
                                                <td><?php echo $this->iacsmodel->ReturnRowValue("cdprovince", "ProvName", "ProvCode",$ListRows[$_f4]); ?></td>
                                                
												<td><?php echo $ListRows[$_fl]; ?> </td>
												<td>
													<a class="button is-small is-primary" href="<?php echo $__siteurl . $page_url; ?>/edit/<?php echo $ListRows[$_f3]; ?>"> <i class="fa fa-pencil"></i> Edit</a>
													<a class="button is-small is-danger" onclick="delete_data('<?php echo $page_url; ?>/delete', <?php echo $ListRows[$_f3];?>);"><i class="fa fa-trash"></i> Delete</a>
												</td>
                                            </tr>
                                            
											<?php } ?>
                                        </tbody>
										<tfoot>
                                            <tr>
                                                <th>Province</tt>
												<th>Code</tt>
                                                <th>Action</th>
                                            </tr>
									</tfoot>
									
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
				</div>
				