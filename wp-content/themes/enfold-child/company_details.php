<?php

/**
 * Display company details
 *
 */	

if(is_user_logged_in()){
	$myteknowusermanager=0;
	$userid=get_current_user_id();
	$user = get_userdata( $userid );
	$user_roles = $user->roles;
	if ( in_array( 'myteknow_user_manager', $user_roles, true ) ) {
		$myteknowusermanager=1;
	}
	if($myteknowusermanager==1){
		global $wpdb;
		$company=$_GET['c'];
		if($company!=""){
			$cid=decryption($company);
			$results=$wpdb->get_results("SELECT company_name,siret,contact_name,contact_function,contact_email,contact_phone,contact_address,contact_postal_code,contact_city,created_on,created_by FROM wp_companydetails WHERE company_id='$cid'");			
			if($results){
				foreach($results as $cresult){
					$cname=$cresult->company_name;
					$csiret=$cresult->siret;
					$ccontactname=$cresult->contact_name;
					$ccontactfunction=$cresult->contact_function;
					$ccontactemail=$cresult->contact_email;
					$ccontactphone=$cresult->contact_phone;
					$ccontactaddress=$cresult->contact_address;
					$ccontactpostalcode=$cresult->contact_postal_code;
					$ccontactcity=$cresult->contact_city;
					$ccreatedon=$cresult->created_on;
					$ccreatedby=$cresult->created_by;
					$cuser_info = get_userdata($ccreatedby);
					$cfirst_name = $cuser_info->first_name;
					$clast_name = $cuser_info->last_name;

					?>
<section class="userspace_container details_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h2>Company Details</h2>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/manage-companies" class="btn btn-primary btn-lg">Manage Companies</a>
							</div>
						</div>
					</div>
					<div class="card-body">
							<div class="row">
								<div class="col-sm-3">
									<label>Raison sociale </label>
									<div><?php echo $cname;?></div>
								</div>
								<div class="col-sm-3">
									<label>SIRET</label>
									<div><?php echo $csiret;?></div>									
								</div>
								<div class="col-sm-3">
									<label>Created On</label>
									<div><?php echo date('d-M-Y',strtotime($ccreatedon));?></div>									
								</div>
								<div class="col-sm-3">
									<label>Created By</label>
									<div><?php echo $cfirst_name.' '.$clast_name;?></div>									
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<label>Contact</label>
									<div><?php echo $ccontactname;?></div>
								</div>
								<div class="col-sm-3">
									<label>Fonction</label>
									<div><?php echo $ccontactfunction;?></div>
								</div>
								<div class="col-sm-3">
									<label>Email</label>
									<div><?php echo $ccontactemail; ?></div>
								</div>
								<div class="col-sm-3">
									<label>Téléphone</label>
									<div><?php echo $ccontactphone; ?></div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-6">
									<label>Addresse</label>
									<div><?php echo $ccontactaddress; ?></div>
								</div>
								<div class="col-sm-3">
									<label>Code postal</label>
									<div><?php echo $ccontactpostalcode; ?></div>
								</div>
								<div class="col-sm-3">
									<label>Ville</label>
									<div><?php echo $ccontactcity;?></div>
								</div>
							</div>
							<hr>
						 	<a href="<?php echo get_home_url(); ?>/manage-companies" class="btn btn-secondary btn-lg">Go Back</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
					<?php
					
				}
			}
		}	
	?>
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