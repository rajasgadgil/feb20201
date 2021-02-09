<?php

/**
 * Manage Companies
 *
 */
global $wpdb;
if(is_user_logged_in()){
	$myteknowusermanager=0;
	$userid=get_current_user_id();
	$user = get_userdata( $userid );
	$user_roles = $user->roles;
	if ( in_array( 'myteknow_user_manager', $user_roles, true ) ) {
		$myteknowusermanager=1;
	}
	if($myteknowusermanager==1){
	?>
<section class="userspace_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Manages Companies</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h3>Companies </h3>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/add-company" class="btn btn-primary btn-lg">Add Company</a>
							</div>
						</div>
					</div>
					<?php
						$companies=$wpdb->get_results("SELECT company_id,company_name,contact_name,contact_email,contact_phone,created_on FROM wp_companydetails WHERE myteknow='1'");
					?>
					<div class="card-body">
						<div class="table-responsive">
								<table class="table table-bordered  userspacetable">
									<thead>
										<tr>
											<th>Raison sociale</th>
											<th>Contact</th>
											<th>Email</th>
											<th>Téléphone</th>
											<th>Created On</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if($companies){
											foreach($companies as $company){
											?>
											<tr>
												<td><?php echo $company->company_name; ?></td>
												<td><?php echo $company->contact_name; ?></td>
												<td><?php echo $company->contact_email; ?></td>
												<td><?php echo $company->contact_phone; ?></td>
												<td><?php echo date('d-m-Y',strtotime($company->created_on)); ?></td>
												<td><a href="<?php echo get_home_url(); ?>/edit-company?c='<?php echo urlencode(encryption($company->company_id)); ?>'" class="btn btn-primary btn-lg">Edit</a>
												<a href="<?php echo get_home_url(); ?>/view-company?c='<?php echo urlencode(encryption($company->company_id)); ?>'" class="btn btn-primary btn-lg">View</a></td>
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
	<?php
}

}else{
	?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Please login to view this page</h2>
			</div>
		</div>
	</div>
</section>
<?php
}
?>