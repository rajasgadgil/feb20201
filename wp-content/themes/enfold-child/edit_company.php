<?php
/**
 * Edit company details
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
				if (($_SERVER["REQUEST_METHOD"] == "POST" )&&($_POST['company_name']!="")) {
					global $wpdb;
					$current_date_time=date("Y-m-d_H-i-s");
					//company table
					$company_table= $wpdb->prefix . "companydetails";

					$wpdb->update($company_table,array(
						'company_name' =>$_POST['company_name'],
						'siret'=>$_POST['company_siret'],
						'contact_name'=>$_POST['company_contactname'],
						'contact_function'=>$_POST['company_contactfunction'],
						'contact_email' =>$_POST['company_contactemail'],
						'contact_phone' =>$_POST['company_contactphone'],
						'contact_address' =>$_POST['company_contactaddr'],
						'contact_postal_code'=>$_POST['company_contactpostalcode'],
						'contact_city' =>$_POST['company_contactcity'],
						'modified_by' =>$userid,			
						'modification_date'=>$current_date_time),
						array('company_id'=>$cid),
						array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'),
						array('%d'));
						
						$path=get_home_url().'/manage-companies';
						echo ("<script>alert('Company Updated Succesfully');
							window.location.href='$path';</script>");

				}

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
					?>
<section class="userspace_container details_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h2>Update Company</h2>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/manage-companies" class="btn btn-primary btn-lg">Manage Companies</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form class="updatecompany col-sm-10 form-validate" method="post" action="">
							<div class="row">
								<div class="col-sm-6">
									<label>Raison sociale <span class="star">*</span></label>
									<input type="text" id="company_name" name="company_name" value="<?php echo $cname; ?>" class="form-control" data-rule-required="true" data-msg-required="Veuillez saisir le nom de l'entreprise">
								</div>
								<div class="col-sm-6">
									<label>SIRET <span class="star">*</span></label>
									<input type="text" id="company_siret" name="company_siret" value="<?php echo $csiret; ?>" class="form-control" data-rule-required="true" data-msg-required="Veuillez entrer SIRE">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Contact <span class="star">*</span></label>
									<input type="text" id="company_contactname" name="company_contactname" value="<?php echo $ccontactname; ?>" class="form-control" data-rule-required="true" data-msg-required="Veuillez saisir le nom du contact">
								</div>
								<div class="col-sm-6">
									<label>Fonction <span class="star">*</span></label>
									<input type="text" id="company_contactfunction" name="company_contactfunction" value="<?php echo $ccontactfunction;?>" class="form-control" data-rule-required="true" data-msg-required="Veuillez entrer la fonction de contact">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Email <span class="star">*</span></label>
									<input type="email" id="company_contactemail" name="company_contactemail" value="<?php echo $ccontactemail; ?>" class="form-control" data-rule-required="true" data-msg-required="Entrez votre e-mai" data-rule-email="true" data-msg-email="Email invalide">
								</div>
								<div class="col-sm-6">
									<label>Téléphone <span class="star">*</span></label>
									<input type="tel" id="company_contactphone" name="company_contactphone" value="<?php echo $ccontactphone; ?>" class="form-control" data-rule-required="true" data-msg-required="Entrez le numéro de contact">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Addresse <span class="star">*</span></label>
									<textarea id="company_contactaddr" name="company_contactaddr" class="form-control" rows="4" data-rule-required="true" data-msg-required="Entrer l'adresse"><?php echo $ccontactaddress; ?></textarea>
								</div>
								<div class="col-sm-6">
									<label>Code postal <span class="star">*</span></label>
									<input type="text" id="company_contactpostalcode" name="company_contactpostalcode" value="<?php echo $ccontactpostalcode;?>" class="form-control" data-rule-required="true" data-msg-required="Entrez le code postal">
									<label>Ville <span class="star">*</span></label>
									<input type="text" id="company_contactcity" name="company_contactcity" class="form-control" value="<?php echo $ccontactcity; ?>" data-rule-required="true" data-msg-required="Entrez la ville">
								</div>
							</div>						 
								<input type="submit" value="Mettre à jour l'entreprise" class="btn btn-secondary btn-lg">
						</form>
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