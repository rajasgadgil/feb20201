<?php
ob_start();
session_start();
require_once('../../../wp-load.php');
global $wpdb;
if($_REQUEST['assigncompany'])
{
	$assigncompany=$_REQUEST['assigncompany'];
	$assignto=$_REQUEST['assignto'];
	
	wp_update_user(array('ID' => $assignto, 'role' => 'company_user'));
	update_user_meta( $assignto, 'companyassigned', $assigncompany );
	
	$user_info = get_userdata($assignto);
	$first_name = $user_info->first_name;
	$last_name = $user_info->last_name;
	echo "Company assigned to User :".$first_name." ".$last_name;
}elseif($_REQUEST['grantcum']){
	$uid=$_REQUEST['grantcum'];
	wp_update_user(array('ID' => $uid, 'role' => 'company_user_manager'));
	$path=get_home_url().'/user-space';
	echo ("<script>window.location.href='$path';</script>");
}elseif($_REQUEST['grantcumadm']){
	$uid=$_REQUEST['grantcumadm'];
	wp_update_user(array('ID' => $uid, 'role' => 'company_user_manager'));
	$path=get_home_url().'/wp-admin/admin.php?page=manageusers';
	echo ("<script>window.location.href='$path';</script>");
}elseif($_REQUEST['revokecum']){
	$uid=$_REQUEST['revokecum'];
	wp_update_user(array('ID' => $uid, 'role' => 'company_user'));
	$path=get_home_url().'/user-space';
	echo ("<script>window.location.href='$path';</script>");
}elseif($_REQUEST['revokecumadm']){
	$uid=$_REQUEST['revokecumadm'];
	wp_update_user(array('ID' => $uid, 'role' => 'company_user'));
	$path=get_home_url().'/wp-admin/admin.php?page=manageusers';
	echo ("<script>window.location.href='$path';</script>");	
}elseif($_REQUEST['reinitpass']){
	$uid=decryption($_REQUEST['reinitpass']);
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	$temppass=$randomString;
	$userdata=get_userdata($uid);
	$useremail=$userdata->user_email;
	wp_set_password( $temppass, $uid );
	add_user_meta($uid, 'passwordreinitiated', '1');




	$to = $useremail;
	$subject = 'Password Reinitiated';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$body = "Hello,<br>We have just reinitited your password.<br>You can connect with you your temporary password:".$temppass."<br>After login you can save your new password.<br><br>Have a good day,<br>Myteknow User Maneger";
	wp_mail( $to, $subject,  $body, $headers);
	$path=get_home_url().'/user-space';
	echo ("<script>alert('Password reinitiated');window.location.href='$path';</script>");
}elseif($_REQUEST['reinitpassadm']){
	$uid=decryption($_REQUEST['reinitpassadm']);
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	$temppass=$randomString;
	$userdata=get_userdata($uid);
	$useremail=$userdata->user_email;
	wp_set_password( $temppass, $uid );
	add_user_meta($uid, 'passwordreinitiated', '1');




	$to = $useremail;
	$subject = 'Password Reinitiated';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$body = "Hello,<br>We have just reinitited your password.<br>You can connect with you your temporary password:".$temppass."<br>After login you can save your new password.<br><br>Have a good day,<br>Myteknow User Maneger";
	wp_mail( $to, $subject,  $body, $headers);
	$path=get_home_url().'/wp-admin/admin.php?page=manageusers';
	echo ("<script>alert('Password reinitiated');window.location.href='$path';</script>");
}else{
/*
	$company = "";
	if (isset($_POST['company'])) {
		$company = $_POST['company'];
	}

	// storing  request (ie, get/post) global array to a variable
	$requestData = $_REQUEST;

	// getting total number records without any search
									
	$args = array(
		'role__in'    =>  [ 'prospect','company_user' ],
		'orderby' => 'user_nicename',
		'order'   => 'ASC'
	);
	$users = get_users( $args );
	$totalData = sizeof($users);

	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
	if (!empty($requestData['search']['value'])) {
		// if there is a search parameter
		$args = array(
			'role__in'    =>  [ 'prospect','company_user' ],
			'orderby' => 'user_nicename',
			'order'   => 'ASC'
		);
			// if there is a search parameter
		$sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
		$query = mysqli_query($con, $sql) or die("ajax.php: get records"); // again run query with limit

	} else {

		$sql = "SELECT * FROM wp_companydetails";
		if ($company != "") {
			$sql .= " WHERE company_id=$company";
		}
		$sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
		$query = mysqli_query($con, $sql) or die("ajax.php: get records");
	}
	$data = array();
	$count = $requestData['start'] + 1;
	if ($listfor != "" || $auldid != "") {
		while ($row = mysqli_fetch_array($query)) {  // preparing an array
			$nestedData = array();
			$nestedData[] = $count++;
			$ct_24fval = $row['ct_24_cal'];
			$ct_24fval = number_format($ct_24fval, 2);
			if ($auldid == "") {
				$auldid = $row['aul_id'];
				$auldetails = json_decode(get_auction_list($con, $auldid));
				$actualgold = $auldetails->actual_gold;
				$buyingprice = $auldetails->buying_price;
			}

			$minprice = $row['min_price'];
			if ($minprice != "") {
				$margin = number_format((($actualgold*$ct_24fval) - $minprice), 2);
			}else{
				$margin="-";
			}
			if ($buyingprice != "") {
				$profit = number_format((($actualgold*$ct_24fval) - ($buyingprice*$ct_24fval)), 2);
			}else{
				$profit="-";
			}
			$distance = $row["distance"];
			if ($distance == "" || $distance == "0") {
				$distance = "Not Found";
			} else {
				$distance = $distance;
			}
			$auction_id = $row['auction_id'];
			if ($minprice == "") {
				$minprice = '<button type="button" class="btn btn-info btn-xs updateMinPrice" data-toggle="modal" data-target="#updateModal" data-aucid="' . $auction_id . '"><i class="fa fa-plus"></i> Add</button>';
			}
			$nestedData[] = $row["account_no"];
			$nestedData[] = $row["branch_address"];
			$nestedData[] = $ct_24fval;
			$nestedData[] = $actualgold*$ct_24fval;
			if ($minpricedisp != "false") {
				$nestedData[] = $minprice;
			}
			$nestedData[]=$margin;
			$nestedData[] = $buyingprice*$ct_24fval;
			$nestedData[] = $profit;
			$nestedData[] = $distance;
			$data[] = $nestedData;
		}$json_data= array(
			"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval($totalData),  // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
		);
		echo json_encode($json_data);  // send data as json format
	}
	else {
		$json_data = array(
			"draw"            => 1,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => 0,  // total number of records
			"recordsFiltered" => 0, // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => array()   // total data array
		);
		echo json_encode($json_data);  // send data as json format
	}
	*/
}
?>