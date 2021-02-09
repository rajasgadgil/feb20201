<?php

/**
 * Template Name: Add Company
 *
 */
ob_start();
session_start();
get_header(); 
	

if(is_user_logged_in()){
	$myteknowusermanager=0;
	$message="";
	if($_SESSION['message']!=""){
		$message=$_SESSION['message'];
		unset($_SESSION['message']);
	}
	$userid=get_current_user_id();
	$user = get_userdata( $userid );
	$user_roles = $user->roles;
	if ( in_array( 'myteknow_user_manager', $user_roles, true ) ) {
		$myteknowusermanager=1;
	}
	if($myteknowusermanager==1){
	if (($_SERVER["REQUEST_METHOD"] == "POST" )&&($_POST['company_name']!="")) {
        global $wpdb;
		$current_date_time=date("Y-m-d_H-i-s");
		//check if company exists
		$cname=$_POST['company_name'];
		$results=$wpdb->get_results("SELECT company_id FROM wp_companydetails WHERE company_name='$cname'");
		if(!$results){
			//company table
			$company_table= $wpdb->prefix . "companydetails";
			if($wpdb->insert($company_table,array(
				'company_name' =>$_POST['company_name'],
				'company_type' =>'real',
				'siret'=>$_POST['company_siret'],
				'contact_name'=>$_POST['company_contactname'],
				'contact_function'=>$_POST['company_contactfunction'],
				'contact_email' =>$_POST['company_contactemail'],
				'contact_phone' =>$_POST['company_contactphone'],
				'contact_address' =>$_POST['company_contactaddr'],
				'contact_postal_code'=>$_POST['company_contactpostalcode'],
				'contact_city' =>$_POST['company_contactcity'],
				'created_by' =>$userid,			
				'created_on'=>$current_date_time,
				'myteknow'=>'1'),
				array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'))== false) { 
					$_SESSION['message']="Something went wrong.Please try again";
				}else {
					$_SESSION['message']="Company Created Successfully";
				}	
		}else{
			$_SESSION['message']="Company Already exists";
		}
		$path=get_home_url().'/add-company';
		header("Location: $path");	

	}
	
	?>
<section class="userspace_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Add Company</h2>
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
								<h3>Add Company </h3>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/manage-companies" class="btn btn-primary btn-lg">Manage Companies</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if($message!=""){ ?>
						<div class="alert alert-info"><?php echo $message; ?></div>
						<?php } ?>

						<form class="createcompany col-sm-10 form-validate" method="post" action="">
							<div class="row">
								<div class="col-sm-6">
									<label>Raison sociale <span class="star">*</span></label>
									<input type="text" id="company_name" name="company_name" class="form-control" data-rule-required="true" data-msg-required="Veuillez saisir le nom de l'entreprise">
								</div>
								<div class="col-sm-6">
									<label>SIRET <span class="star">*</span></label>
									<input type="text" id="company_siret" name="company_siret" class="form-control" data-rule-required="true" data-msg-required="Veuillez entrer SIRE">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Contact <span class="star">*</span></label>
									<input type="text" id="company_contactname" name="company_contactname" class="form-control" data-rule-required="true" data-msg-required="Veuillez saisir le nom du contact">
								</div>
								<div class="col-sm-6">
									<label>Fonction <span class="star">*</span></label>
									<input type="text" id="company_contactfunction" name="company_contactfunction" class="form-control" data-rule-required="true" data-msg-required="Veuillez entrer la fonction de contact">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Email <span class="star">*</span></label>
									<input type="email" id="company_contactemail" name="company_contactemail" class="form-control" data-rule-required="true" data-msg-required="Entrez votre e-mai" data-rule-email="true" data-msg-email="Email invalide">
								</div>
								<div class="col-sm-6">
									<label>Téléphone <span class="star">*</span></label>
									<input type="tel" id="company_contactphone" name="company_contactphone" class="form-control" data-rule-required="true" data-msg-required="Entrez le numéro de contact">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Addresse <span class="star">*</span></label>
									<textarea id="company_contactaddr" name="company_contactaddr" class="form-control" rows="4" data-rule-required="true" data-msg-required="Entrer l'adresse"></textarea>
								</div>
								<div class="col-sm-6">
									<label>Code postal <span class="star">*</span></label>
									<input type="text" id="company_contactpostalcode" name="company_contactpostalcode" class="form-control" data-rule-required="true" data-msg-required="Entrez le code postal">
									<label>Ville <span class="star">*</span></label>
									<input type="text" id="company_contactcity" name="company_contactcity" class="form-control" data-rule-required="true" data-msg-required="Entrez la ville">
								</div>
							</div>						 
								<input type="submit" value="enregistrer une entreprise" class="btn btn-secondary btn-lg">

						</form>
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

get_footer(); ?>