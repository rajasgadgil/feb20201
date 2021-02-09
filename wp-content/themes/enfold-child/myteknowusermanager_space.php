<section class="userspace_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Manages the Company Users & profiles</h2>
				<?php

				?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h3>Registered Users</h3>
								<!--<h3 class="companysel">Select a Company :</h3>	
								<select name="companydisp" id="companydisp" class="jsCompany">
								<?php 
								$companylist=$wpdb->get_results("SELECT * FROM wp_companydetails order by company_id asc");
								if(sizeof($companylist)>0){
									$count=0;
									foreach($companylist as $company){
										$companyid=$company->company_id;
										$companyname=$company->company_name;
										echo '<option value="'.$companyid.'">'.$companyname.'</option>';
									}
								}
								?>
								</select>-->
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/add-user" class="btn btn-primary btn-lg">Add User</a>
								<a href="<?php echo get_home_url(); ?>/manage-companies" class="btn btn-primary btn-lg">Manage Companies</a>
							</div>
						</div>
					</div>
					<?php
						$args = array(
							'role__in'    =>  [ 'prospect','company_user','company_user_manager' ],
							'orderby' => 'user_nicename',
							'order'   => 'ASC'
						);
						$users = get_users( $args );

					?>
					<div class="card-body">
						<div class="table-responsive">
								<table class="table table-bordered  userspacetable">
									<thead>
										<tr>
											<th>User Name</th>
											<th>User Email</th>
											<th>Company</th>
											<th>User Role</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
								<?php	

								foreach ( $users as $user ) {
									$fetchuserid=$user->ID;
									$fetchusercompany=get_user_meta($fetchuserid,'companyassigned',true);
									//get company name
									$companyname=$wpdb->get_results("SELECT * FROM wp_companydetails WHERE company_id='$fetchusercompany' ");
									if(sizeof($companyname)>0){
										$count=0;
										foreach($companyname as $company){
											$cname=$company->company_name;
										}
									}									
									//check company has company user manager
									$companyhasusermanager=0;
									$args1 = array(
										'role__in'    =>  [ 'company_user_manager' ],
										'orderby' => 'user_nicename',
										'order'   => 'ASC'
									);
									$users1 = get_users( $args1 );	
									foreach ( $users1 as $user1 ) {									
										$newuserid=$user1->ID;
										$fetchnewusercompany=get_user_meta($newuserid,'companyassigned',true);
										if($fetchusercompany==$fetchnewusercompany){
											$companyhasusermanager=1;
										}
									}									
									?>
									<tr>
										<td><?php echo $user->display_name;?></td>
										<td><?php echo $user->user_email;?></td>
										<td><?php echo $cname;?></td>
										<td>
											<?php
												$user_roles = $user->roles;
												foreach($user_roles as $urole){
													if($urole=="company_user"){
														echo "Company User";
													}elseif($urole=="company_user_manager"){
														echo "Company User Manager";
													}else{
														echo ucfirst($urole);
													}
												}	
											?>
										</td>
										<td>
											<?php if($urole=="prospect"){ ?>
												<select class="jsAssignusercompany" name="usercompany">
													<option value="">Assign Company</option>
													<?php 
													$companylist=$wpdb->get_results("SELECT * FROM wp_companydetails WHERE myteknow='1' order by company_id asc");
													if(sizeof($companylist)>0){
														$count=0;
														foreach($companylist as $company){
															$companyid=$company->company_id;
															$companyname=$company->company_name;
															echo '<option value="'.$companyid.'">'.$companyname.'</option>';
														}
													}
													?>
												</select>
												<input type="hidden" class="jsUser" name="userid" value="<?php echo $fetchuserid;?>">
												<!--<a href="#" class="btn btn-primary btn-lg">Assign Company</a>-->
											<?php }if($urole=="company_user" && $companyhasusermanager==0){ 
											?>
												<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?grantcum=<?php echo $fetchuserid; ?>" class="btn btn-primary btn-lg">Grant Company User Manager</a>
											<?php }elseif($urole=="company_user_manager"){ 
											?>
												<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?revokecum=<?php echo $fetchuserid; ?>" class="btn btn-primary btn-lg">Revoke Company User Manager</a>
											<?php } ?>
												<a href="<?php echo get_home_url(); ?>/edit-user?user='<?php echo urlencode(encryption($fetchuserid)); ?>'" class="btn btn-primary btn-lg">Edit user</a>
												<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?reinitpass=<?php echo urlencode(encryption($fetchuserid)); ?>" class="btn btn-primary btn-lg">Reinit Password</a>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
								</table>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
