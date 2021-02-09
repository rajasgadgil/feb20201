<?php
ob_start();
add_action('admin_menu', 'myteknow_adminmenu' );
function myteknow_adminmenu() {
  add_menu_page( 'Manage Users', 'Manage Users','myteknow_admin', 'manageusers', 'users_callback','',200);
  add_submenu_page( 'manageusers','Add User', 'Add User','myteknow_admin', 'adduser', 'adduser_callback','',200);
  add_submenu_page( 'Edit User','Edit User', 'Edit User','myteknow_admin', 'edituser', 'edituser_callback','',200);
}

/*user listing page backend*/
function users_callback(){
	global $wpdb;
	$args = array(
		'role__in'    =>  [ 'prospect','company_user','company_user_manager' ],
		'orderby' => 'user_nicename',
		'order'   => 'ASC'
	);
	$users = get_users( $args );

  ?>
  <div class="wrap adminaddons">
    <h2>Registered Users</h2>
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
					<?php }if($urole=="company_user" && $companyhasusermanager==0){ 
					?>
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?grantcumadm=<?php echo $fetchuserid; ?>" class="btn btn-primary btn-lg">Grant Company User Manager</a>
					<?php }elseif($urole=="company_user_manager"){ 
					?>
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?revokecumadm=<?php echo $fetchuserid; ?>" class="btn btn-primary btn-lg">Revoke Company User Manager</a>
					<?php } ?>
						<a href="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=edituser&user='<?php echo urlencode(encryption($fetchuserid)); ?>'" class="btn btn-primary btn-lg">Edit user</a>
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?reinitpassadm=<?php echo urlencode(encryption($fetchuserid)); ?>" class="btn btn-primary btn-lg">Reinit Password</a>
				</td>
			</tr>
			<?php
		}
		?>
      </tbody>
    </table>
    
  </div>
  <?php
}
/*Add user page*/
function adduser_callback(){
	global $wpdb;
	$userid=get_current_user_id();
	if (($_SERVER["REQUEST_METHOD"] == "POST" )&&($_POST['txtFirstname']!="")) {

        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $username = $_POST['txtEmail'];
        $firstname =$_POST['txtFirstname'];
        $lastname = $_POST['txtLastname'];
        $companyname = $_POST['txtCompanyName'];
        $companyphone = $_POST['txtphone'];
		$companyassign = $_POST['txtcompanyassign']; 
		
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

			$path=get_home_url().'/wp-admin/admin.php?page=manageusers';
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
/*Add user page*/
function edituser_callback(){
	global $wpdb;

	$userid=get_current_user_id();
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

					$path=get_home_url().'/wp-admin/admin.php?page=manageusers';
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
				<h2>Update User</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
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
?>