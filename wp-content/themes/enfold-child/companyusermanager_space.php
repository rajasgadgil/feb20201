<section class="userspace_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Manages the Company Users</h2>
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
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/add-user" class="btn btn-primary btn-lg">Add User</a>
							</div>
						</div>
					</div>
					<?php
						$currentuserid=get_current_user_id();
						$currentusercompany=get_user_meta( $currentuserid, 'companyassigned', true );

						$args = array(
							'role__in'    =>  [ 'company_user' ],
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
									if($currentusercompany==$fetchusercompany){
									//get company name
									$companyname=$wpdb->get_results("SELECT * FROM wp_companydetails WHERE company_id='$fetchusercompany' ");
									if(sizeof($companyname)>0){
										$count=0;
										foreach($companyname as $company){
											$cname=$company->company_name;
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
												<a href="<?php echo get_home_url(); ?>/edit-user?user='<?php echo urlencode(encryption($fetchuserid)); ?>'" class="btn btn-primary btn-lg">Edit user</a>
												<a href="#" class="btn btn-primary btn-lg">Reinit Password</a>
										</td>
									</tr>
									<?php
									}
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
