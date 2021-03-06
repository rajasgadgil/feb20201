<?php
/* Template Name: Login Page */
?>


<?php
if (!$user_ID) {

  if ($_POST) {

    global $wpdb;

    //We shall SQL escape all inputs
    $username = $wpdb->escape($_REQUEST['username']);
    $password = $wpdb->escape($_REQUEST['password']);
    //   $remember = $wpdb->escape($_REQUEST['rememberme']);

    //   if($remember) $remember = "true";
    //   else $remember = "false";

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    //   $login_data['remember'] = $remember;

    $user_verify = wp_signon($login_data, true);
    //  wp_set_current_user( $userID, $user_login );
    //  wp_set_auth_cookie( $userID, true, false );
    if (is_wp_error($user_verify)) {
      $error_type = $user_verify->get_error_message();
      wp_redirect(site_url() . "/login/?login=failed&reason=" . $error_type);
    } else {
      $code = get_user_meta($user_verify->ID, 'account_activated', true);
      if ($code == '0') {
        wp_logout();
        wp_redirect(site_url() . '/login/?login=failed&reason=account not inactive');
      } else {
        $redirecturl = get_site_url();
        wp_redirect(site_url() . '/user-space/');
      }
    }
  } else {
      
    get_header();
  
      
      
  }
?>




  <form method="post" class="col-md-6 offset-md-3 p-0">
    <input id="email" type="username" placeholder="adresse e-mail" class="form-control" name="username" required style="font-size: 1em!important;">
      <br>
    <input id="password" type="password" placeholder="mot de passe" class="form-control" name="password" required>
    <input type="checkbox" id="rememberme" name="rememberme"> Remember Me<br>
    <hr>
    <input id="submit" type="submit" name="submit" value="Submit" class="float-left">
    <a href="https://aeon2.blvckpixel.com/reset-password-2/" class="float-right">Mot de passe oublié</a>
  </form>
  <br>
  <div class="col-md-6 offset-md-3 p-5">
    <?php
    if ($_GET['login'] == 'failed') {
      echo '<p class="text-danger">' . $_GET['reason'] . '</p>';
    }
    ?>
  </div>


<?php

}else{
        get_header();
    ?>
<div class="container" style="text-align: center;">
<?php
    echo "You are already signed in!";
    ?>
    <br>
    <a href="/user-space">Visit User-space</a>
       <br>
       <br>
</div>
<?php
    
}
get_footer(); ?>