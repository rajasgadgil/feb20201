<?php
/**
 * Edit user details
 *
 */	
if(is_user_logged_in()){
	$myteknowusermanager=0;
	$companyusermanager=0;

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
		global $wpdb;
		$user=$_GET['user'];
		if($user!=""){
			$uid=decryption($user);
				if (($_SERVER["REQUEST_METHOD"] == "POST" )&&($_POST['txtFirstname']!="")) {

					$firstname =$_POST['txtFirstname'];
					$lastname = $_POST['txtLastname'];
					$companyname = $_POST['txtCompanyName'];
					$companyphone = $_POST['txtphone'];
					if($companyusermanager!=1){
						$companyassign = $_POST['txtcompanyassign']; 
					}
					$display_name=$firstname.' '.$lastname;
					if($companyassign==1){
						$role="prospect";
					}else{
						$role="company_user";
					}

					wp_update_user(array('ID' => $uid,'role' => $role, 'first_name' => $firstname, 'last_name' => $lastname, 'display_name' => $display_name));
					if($companyusermanager!=1){
						update_user_meta( $uid, 'companyassigned', $companyassign );
					}
					update_user_meta($uid, 'company_name', $companyname);
					update_user_meta($uid, 'companyphone', $companyphone);

					$path=get_home_url().'/user-space';
					echo ("<script>alert('User Updated Succesfully');
						window.location.href='$path';</script>");

				}
			$userdata=get_userdata($uid);
			$first_name=get_user_meta($uid,'first_name',true);
			$last_name=get_user_meta($uid,'last_name',true);
			$companyassigned=get_user_meta($uid,'companyassigned',true);
			$enterprise=get_user_meta($uid,'company_name',true);
			$phone=get_user_meta($uid,'companyphone',true);
			$useremail=$userdata->user_email;
					?>
<section class="userspace_container details_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h2>Update User</h2>	
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo get_home_url(); ?>/user-space" class="btn btn-primary btn-lg">Users List</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form class="updateuser col-sm-10 form-validate" method="post" action="">
							<div class="row">
								<div class="col-sm-6">
									<label>First Name <span class="star">*</span></label>
									<input type="text" id="txtFirstname" name="txtFirstname" class="form-control" value="<?php echo $first_name; ?>" data-rule-required="true" data-msg-required="Please enter first name ">
								</div>
								<div class="col-sm-6">
									<label>Last Name <span class="star">*</span></label>
									<input type="text" id="txtLastname" name="txtLastname" class="form-control" value="<?php echo $last_name; ?>" data-rule-required="true" data-msg-required="Please enter last name">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Enterprise <span class="star">*</span></label>
									<input type="text" id="txtCompanyName" name="txtCompanyName" value="<?php echo $enterprise; ?>" class="form-control" data-rule-required="true" data-msg-required="Please enter Enterprise">
								</div>
								<div class="col-sm-6">
									<label>Email <span class="star">*</span></label>
									<input type="email" id="txtEmail" name="txtEmail" class="form-control"  value="<?php echo $useremail; ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>Phone Number <span class="star">*</span></label>
									<input type="tel" id="txtphone" name="txtphone" class="form-control" data-rule-required="true" data-msg-required="Please enter phone number" value="<?php echo $phone;?>">
								</div>
								<?php
								if($companyusermanager!=1){ ?>
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
											$selected="";
											if($companyassigned==$companyid){
												$selected="selected";											
											}
											echo '<option value="'.$companyid.'" '.$selected.'>'.$companyname.'</option>';
										}
									}
									?>
									</select>
								</div>
								<?php } ?>
							</div>						 
								<input type="submit" value="Update User" class="btn btn-secondary btn-lg">

						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
					<?php
					
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