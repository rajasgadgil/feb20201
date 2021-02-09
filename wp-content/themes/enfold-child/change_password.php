<?php
/***********
Change Password
*****************/
if(is_user_logged_in()){
	if(isset($_POST['current_password'])){
          $_POST = array_map('stripslashes_deep', $_POST);
          $current_password = sanitize_text_field($_POST['current_password']);
          $new_password = sanitize_text_field($_POST['new_password']);
          $confirm_new_password = sanitize_text_field($_POST['confirm_new_password']);
          $user_id = get_current_user_id();
          $errors = "";
          $current_user = get_user_by('id', $user_id);

			if($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
			} else {
				$errors = 'Current password is incorrect';
			}
			if($new_password != $confirm_new_password){
				$errors = 'Password does not match';
			}
			if($errors==""){
				wp_set_password( $new_password, $current_user->ID );
				$havemeta = get_user_meta($user_id, 'passwordreinitiated', true); 
				if ($havemeta){
					update_user_meta($user_id, 'passwordreinitiated', '0');
				}
				$dispmsg="Password successfully changed";
			} else {
				$dispmsg=$errors;
			}
    }
?>
<section class="userspace_container details_container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card outercard">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<h2>Change Password</h2>	
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php
							if($dispmsg!=""){
								echo '<div class="alert alert-info">'.$dispmsg.'</div>';
							}
						?>
						<form action="" method="post" class="form-validate">
							<div class="row">
								<div class="col-sm-4">
									<label for="current_password">Enter your current password:</label>
									<input id="current_password" type="password" name="current_password" title="current_password" placeholder="" class="form-control" data-rule-required="true" data-msg-required="Please enter current password">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<label for="new_password">New password:</label>
									<input id="new_password" type="password" name="new_password" title="new_password" placeholder="" class="form-control" data-rule-required="true" data-msg-required="Please enter new password" data-rule-minlength="6" data-msg-minlength="Password is too short, minimum of 6 characters">
								</div>
								<div class="col-sm-4">
									<label for="confirm_new_password">Confirm new password:</label>
									<input id="confirm_new_password" type="password" name="confirm_new_password" title="confirm_new_password" placeholder="" class="form-control" data-rule-required="true" data-msg-required="Please confirm new password">
								</div>	
							</div>
							<input type="submit" value="Change Password" class="btn btn-secondary btn-lg">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
}else{
	wp_redirect(home_url());
}
?>