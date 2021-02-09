<?php

/**
Add User
 *
 */
global $wpdb;
if(is_user_logged_in()){
	$myteknowusermanager=0;
	$companyusermanager=0;
						

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
	if ( in_array( 'company_user_manager', $user_roles, true ) ) {
		$companyusermanager=1;
	}

	if(($myteknowusermanager==1) || ($companyusermanager==1)){
	if (($_SERVER["REQUEST_METHOD"] == "POST" )&&($_POST['txtFirstname']!="")) {

        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $username = $_POST['txtEmail'];
        $firstname =$_POST['txtFirstname'];
        $lastname = $_POST['txtLastname'];
        $companyname = $_POST['txtCompanyName'];
        $companyphone = $_POST['txtphone'];
		if($companyusermanager==1){
			$currentusercompany=get_user_meta( $userid, 'companyassigned', true );
			$companyassign = $currentusercompany; 
		}else{
			$companyassign = $_POST['txtcompanyassign']; 
		}
		
		if (email_exists($email)) {			
			$path=get_home_url().'/add-user';
			echo ("<script>alert('Email already exists');
					window.location.href='$path';</script>");
        }else{
			if($companyassign==1){
				$role="prospect";
			}else{
				$role="company_user";
			}
			$userdata = array(
				'user_email' => $email,
				'user_login' => $email,
				'first_name' => $firstname,
				'last_name' => $lastname,
				'user_pass' => $password,
				'user_nicename'=>$firstname.'_'.$lastname,
				'role' => $role
			);
            $user = wp_insert_user($userdata);
            wp_update_user(array('ID' => $user, 'role' => $role));
            add_user_meta($user, 'company_name', $companyname);
            add_user_meta($user, 'companyphone', $companyphone);
            add_user_meta($user, 'companyassigned', $companyassign);

            // getting registered user data
            $user_info = get_userdata($user);

            $v_code = md5(time());

            $string = array('id' => $user_info->ID, 'code' => $v_code);

            add_user_meta($user_info->ID, 'account_activated', 0);
            add_user_meta($user_info->ID, 'activation_code', $v_code);

            $url = get_site_url() . '/activate/?act=' . base64_encode(serialize($string));

            // email template
            $html = 'Please click the following link to verify account: ' . $url;
            wp_mail($user_info->user_email, 'Verify Email', $html);

			$path=get_home_url().'/user-space';
			echo ("<script>alert('User Created Succesfully');
					window.location.href='$path';</script>");

		}

	}
	
	?>
<section class="userspace_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Add User</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h3>Add User </h3>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/user-space" class="btn btn-primary btn-lg">Users List</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if($message!=""){ ?>
						<div class="alert alert-info"><?php echo $message; ?></div>
						<?php } ?>

						<form class="createuser col-sm-10 form-validate" method="post" action="">
							<div class="row">
								<div class="col-sm-6">
									<label>First Name <span class="star">*</span></label>
									<input type="text" id="txtFirstname" name="txtFirstname" class="form-control" data-rule-required="true" data-msg-required="Please enter first name ">
								</div>
								<div class="col-sm-6">
									<label>Last Name <span class="star">*</span></label>
									<input type="text" id="txtLastname" name="txtLastname" class="form-control" data-rule-required="true" data-msg-required="Please enter last name">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Enterprise <span class="star">*</span></label>
									<input type="text" id="txtCompanyName" name="txtCompanyName" class="form-control" data-rule-required="true" data-msg-required="Please enter Enterprise">
								</div>
								<div class="col-sm-6">
									<label>Email <span class="star">*</span></label>
									<input type="email" id="txtEmail" name="txtEmail" class="form-control" data-rule-required="true" data-msg-required="Please enter email" data-rule-email="true" data-msg-email="Invalid Email">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Password <span class="star">*</span></label>
									<input type="password" id="txtPassword" name="txtPassword" class="form-control" data-rule-required="true" data-msg-required="Please enter password" >
								</div>
								<div class="col-sm-6">
									<label>Phone Number <span class="star">*</span></label>
									<input type="tel" id="txtphone" name="txtphone" class="form-control" data-rule-required="true" data-msg-required="Please enter phone number">
								</div>
							</div>
							<?php 					
							if($companyusermanager!=1){
							?>
							<div class="row">
								<div class="col-sm-6">
									<label>Select Company<span class="star">*</span></label>
									<select name="txtcompanyassign" id="txtcompanyassign" class="" class="form-control">
									<?php 
								
									$companylist=$wpdb->get_results("SELECT * FROM wp_companydetails WHERE myteklist=0 order by company_id asc");
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
								</div>
							</div>
							<?php } ?>		
								<input type="submit" value="Add User" class="btn btn-secondary btn-lg">

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
}?>