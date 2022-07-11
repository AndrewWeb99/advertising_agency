<?php

function get_orders() {

	$sql = 'SELECT * FROM orders, services, customers, users, statuses, priority WHERE ord_cst_id = cst_id AND ord_srv_id = srv_id AND ord_login = usr_login AND ord_priority=prt_id AND ord_sts_id=sts_id AND ord_sts_id < 7 ORDER BY ord_deadline ASC, ord_priority DESC , ord_date ASC  ';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function view_order($id) {
	global $link;

	$sql='SELECT * FROM orders, services, customers, users, statuses, priority WHERE ord_cst_id = cst_id AND ord_srv_id = srv_id AND ord_login = usr_login AND ord_sts_id=sts_id AND ord_priority = prt_id AND ord_id = '. $id;
	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_assoc($result);

	return $data;
}

function get_customers() {
	$sql = 'SELECT * FROM customers ORDER BY `cst_name` ASC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function view_customer($id) {
	global $link;

	$sql='SELECT * FROM customers WHERE cst_id = '. $id;
	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_assoc($result);

	return $data;

}

function save_customer($id) {
	global $link;

	$cst_id = $id;
	$cst_name = $_POST['cst_name'];
	$cst_address = $_POST['cst_address'];
	$cst_iban = $_POST['cst_iban'];
	$cst_phone = $_POST['cst_phone'];
	$cst_email = $_POST['cst_email'];

	$sql = "UPDATE `customers` SET `cst_name` = '$cst_name', `cst_address` = '$cst_address', `cst_iban` = '$cst_iban', `cst_email` = '$cst_email', `cst_phone` = '$cst_phone' WHERE `customers`.`cst_id` = '$cst_id'";

	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}

function add_customer() {
	global $link;

	$cst_name = $_POST['cst_name'];
	$cst_address = $_POST['cst_address'];
	$cst_iban = $_POST['cst_iban'];
	$cst_phone = $_POST['cst_phone'];
	$cst_email = $_POST['cst_email'];

	$sql = "INSERT INTO `customers` (`cst_name`, `cst_address`, `cst_iban`, `cst_email`, `cst_phone`) VALUES ('$cst_name', '$cst_address', '$cst_iban', '$cst_email', '$cst_phone')";

	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}


function get_services () {
	$sql = 'SELECT srv_id, srv_name FROM services ORDER BY `srv_name` ASC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_statuses() {
	$sql = 'SELECT sts_id, sts_name FROM statuses';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function add_order() {
	global $link;

	$ord_cst_id =  $_POST['ord_cst_id'];
	$ord_srv_id = $_POST['ord_srv_id'];
	$ord_login = $_POST['ord_login'];
	$ord_date = date('Y-m-d');
	$ord_deadline = $_POST['ord_deadline'];
	$ord_desc = $_POST['ord_desc'];

	$sql = "INSERT INTO `orders` (`ord_cst_id`, `ord_srv_id`, `ord_login`, `ord_date`, `ord_deadline`, `ord_desc`) VALUES ('$ord_cst_id', '$ord_srv_id', '$ord_login', '$ord_date', '$ord_deadline', '$ord_desc')";

	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}

function get_archive_orders() {
	$sql = 'SELECT * FROM orders, services, customers, users, statuses WHERE ord_cst_id = cst_id AND ord_srv_id = srv_id AND ord_login = usr_login AND ord_sts_id=sts_id AND ord_sts_id >= 7 ORDER BY ord_id DESC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function save_file() {
	if($_FILES['order-file']['size'] > 0){
		$errors = array();
		$file_name = $_FILES['order-file']['name'];
		$file_size = $_FILES['order-file']['size'];
		$file_tmp = $_FILES['order-file']['tmp_name'];
		$file_type = $_FILES['order-file']['type'];
		$file_exp = strtolower(end(explode('.', $file_name)));
		$new_file_name = uniqid(order_).'.'.$file_exp;


		$expansions = array("jpeg", "jpg", "png", "cdr", "psd", "eps", "doc", "docx", "xls");

		if (!in_array($file_exp, $expansions)) {
			$errors[] = 'Выберите изображение в формате jpeg, jpg, png';
		}

		if ($file_size > 2097152) {
			$errors[] = 'Слишком большой файл';
		}

		if (empty($errors)) {
			move_uploaded_file($file_tmp, "img/orders/".$new_file_name);
		}
		else {
			print_r($errors);
		}
	}
}

function get_comments($id) {
	$sql = 'SELECT `cmn_id`, `cmn_ord_id`, `cmn_date`, `cmn_usr_login`, `cmn_text`, `cmn_fls`, `usr_name`, `usr_surname`, `usr_img` FROM `comments`, `users` WHERE cmn_usr_login = usr_login AND cmn_ord_id = ' .$id . ' ORDER BY cmn_date ASC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function add_comment($id) {
	global $link;

	$cmn_ord_id = $id;
	$cmn_usr_login = $_SESSION['login'];
	$cmn_text = strip_tags($_POST['cmn_text']);
	$cmn_text = htmlspecialchars($cmn_text);

	if($_FILES['cmn_fls']['size'] > 0){
		$errors = array();
		$file_name = $_FILES['cmn_fls']['name'];
		$file_size = $_FILES['cmn_fls']['size'];
		$file_tmp = $_FILES['cmn_fls']['tmp_name'];
		$file_type = $_FILES['cmn_fls']['type'];
		$file_exp = strtolower(end(explode('.', $file_name)));
		$new_file_name = uniqid(order_).'.'.$file_exp;


		// $expansions = array("jpeg", "jpg", "png", "cdr", "psd", "eps", "doc", "docx", "xls");

		// if (!in_array($file_exp, $expansions)) {
		// 	$errors[] = 'Выберите изображение в формате jpeg, jpg, png';
		// }

		// if ($file_size > 2097152) {
		// 	$errors[] = 'Слишком большой файл';
		// }

		if (empty($errors)) {
			move_uploaded_file($file_tmp, "img/orders/".$new_file_name);
		}
		else {
			print_r($errors);
		}
	}


	$sql = "INSERT INTO `comments`(`cmn_ord_id`, `cmn_usr_login`, `cmn_text`, `cmn_fls`) VALUES ('$cmn_ord_id', '$cmn_usr_login', '$cmn_text', '$new_file_name')";


	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}

function save_order($id) {
	global $link;

	$sql = "UPDATE `orders` SET";

	if(isset($_POST["ord_cst_id"])){$ord_cst_id = $_POST["ord_cst_id"]; $sql = $sql." `ord_cst_id`=  '$ord_cst_id', ";};
	if(isset($_POST["ord_srv_id"])){$ord_srv_id = $_POST["ord_srv_id"]; $sql = $sql." `ord_srv_id`= '$ord_srv_id',";};
	if(isset($_POST["ord_login"])){$ord_login = $_POST["ord_login"];} else $ord_login=$_SESSION['login'];
	if(isset($_POST["ord_deadline"])){$ord_deadline = $_POST["ord_deadline"]; $sql = $sql." `ord_deadline`= '$ord_deadline',";};
	if(isset($_POST["ord_desc"])){$ord_desc = $_POST["ord_desc"]; $sql = $sql." `ord_desc`= '$ord_desc',";};
	if(isset($_POST["ord_sts_id"])){$ord_sts_id = $_POST["ord_sts_id"]; $sql = $sql." `ord_sts_id`= '$ord_sts_id',";};
	if(isset($_POST["ord_priority"])){$ord_priority = $_POST["ord_priority"]; $sql = $sql." `ord_priority`= '$ord_priority',";};

	if($ord_sts_id >= 6) { 
		$ord_compl_date = "'".date("Y-m-d")."'";
	} 
	else {
		$ord_compl_date = 'NULL';
	}

	$sql=$sql." `ord_login`= '$ord_login', `ord_compl_date`= $ord_compl_date, `ord_edited`=current_timestamp() WHERE ord_id = " . $id;

	//$sql = "UPDATE `orders` SET `ord_cst_id`= '$ord_cst_id',`ord_srv_id`= '$ord_srv_id',`ord_login`= '$ord_login',`ord_deadline`= '$ord_deadline',`ord_compl_date`= $ord_compl_date,`ord_desc`= '$ord_desc',`ord_sts_id`= '$ord_sts_id', `ord_edited`=current_timestamp(), `ord_priority` = '$ord_priority' WHERE ord_id = " . $id;
	
	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}

	}

function get_users() {
	$sql = 'SELECT `usr_login`, `usr_name`, `usr_surname`, `usr_status`, `usr_phone`, `usr_email`, `usr_pos`, `usr_img`, `pos_name`, `pos_id` FROM users, positions WHERE `usr_pos`=`pos_id` AND usr_status=1 ORDER BY `usr_name` ASC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_all_users() {
	$sql = 'SELECT `usr_login`, `usr_name`, `usr_surname`, `usr_status`, `usr_phone`, `usr_email`, `usr_pos`, `usr_img`, `pos_name`, `pos_id` FROM users, positions WHERE `usr_pos`=`pos_id` ORDER BY `usr_name` ASC';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function view_user($login) {
	global $link;

	$sql='SELECT `usr_login`, `usr_name`, `usr_surname`, `usr_status`, `usr_phone`, `usr_email`, `usr_pos`, `usr_img`, `pos_id`, `pos_name`  FROM users, positions WHERE `usr_pos`=`pos_id` AND `usr_login`="'. $login . '"';

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_assoc($result);

	return $data;
}

function save_user($login)
{
	global $link;


	$usr_password =  $_POST['usr_password'];
	$usr_name = $_POST['usr_name'];
	$usr_surname =  $_POST['usr_surname'];
	$usr_pos = $_POST['usr_pos'];
	$usr_phone = $_POST['usr_phone'];
	$usr_email = $_POST['usr_email'];
	$usr_status = $_POST['usr_status'];
	$usr_img = $_POST['usr_img'];

	if($_FILES['new_usr_img']['size'] > 0){
		$errors = array();
		$file_name = $_FILES['new_usr_img']['name'];
		$file_size = $_FILES['new_usr_img']['size'];
		$file_tmp = $_FILES['new_usr_img']['tmp_name'];
		$file_type = $_FILES['new_usr_img']['type'];
		$file_exp = strtolower(end(explode('.', $file_name)));
		$new_file_name = uniqid(user_).'.'.$file_exp;


		$expansions = array("jpeg", "jpg", "png", "cdr", "psd", "eps", "doc", "docx", "xls");

		if (!in_array($file_exp, $expansions)) {
			$errors[] = 'Выберите изображение в формате jpeg, jpg, png';
		}

		if (empty($errors)) {
			move_uploaded_file($file_tmp, "img/users/".$new_file_name);
		}
		else {
			print_r($errors);
		}
	}
	else {
		$new_file_name = $usr_img;
	}

	if ($usr_password <> ""){

	$sql = "UPDATE `users` SET `usr_password`= sha1('$usr_password'),`usr_status`='$usr_status',`usr_name`='$usr_name',`usr_surname`='$usr_surname',`usr_pos`='$usr_pos',`usr_img`='$new_file_name',`usr_email`='$usr_email',`usr_phone`='$usr_phone' WHERE `usr_login`='". $login . "'";
	} 
	else {
		$sql = "UPDATE `users` SET `usr_status`='$usr_status',`usr_name`='$usr_name',`usr_surname`='$usr_surname',`usr_pos`='$usr_pos',`usr_img`='$new_file_name',`usr_email`='$usr_email',`usr_phone`='$usr_phone' WHERE `usr_login`='". $login . "'";
	}

	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}

function add_user() {
	global $link;

	$usr_login = $_POST['usr_login'];
	$usr_password =  $_POST['usr_password'];
	$usr_name = $_POST['usr_name'];
	$usr_surname =  $_POST['usr_surname'];
	$usr_pos = $_POST['usr_pos'];
	$usr_phone = $_POST['usr_phone'];
	$usr_email = $_POST['usr_email'];
	$usr_status = $_POST['usr_status'];

	if($_FILES['usr_img']['size'] > 0){
		$errors = array();
		$file_name = $_FILES['usr_img']['name'];
		$file_size = $_FILES['usr_img']['size'];
		$file_tmp = $_FILES['usr_img']['tmp_name'];
		$file_type = $_FILES['usr_img']['type'];
		$file_exp = strtolower(end(explode('.', $file_name)));
		$new_file_name = uniqid(user_).'.'.$file_exp;


		$expansions = array("jpeg", "jpg", "png");

		if (!in_array($file_exp, $expansions)) {
			$errors[] = 'Выберите изображение в формате jpeg, jpg, png';
		}

		if (empty($errors)) {
			move_uploaded_file($file_tmp, "img/users/".$new_file_name);
		}
		else {
			print_r($errors);
		}
	}
	else {
		$new_file_name = 'user_0.jpg';
	}
	$sql = "INSERT INTO `users` (`usr_login`, `usr_password`, `usr_status`, `usr_name`, `usr_surname`, `usr_pos`, `usr_img`, `usr_email`, `usr_phone`) VALUES ('$usr_login', sha1('$usr_password'), '$usr_status', '$usr_name', '$usr_surname', '$usr_pos', '$new_file_name', '$usr_email', '$usr_phone')";

	$result = mysqli_query($link, $sql);

	if($result) {
		return true;
	}
	else {
		return false;
	}
}

function get_filter_orders() {

	$sql = 'SELECT * FROM orders, services, customers, users, statuses, priority WHERE ord_cst_id = cst_id AND ord_srv_id = srv_id AND ord_login = usr_login AND ord_sts_id=sts_id AND ord_priority=prt_id  ';

	if ($_POST['ord_date_s'] <> "") {
		$ord_date_s = $_POST['ord_date_s'];
		$sql = $sql . " AND ord_date >= '$ord_date_s'";
	}

	if ($_POST['ord_date_f'] <> "") {
		$ord_date_f = $_POST['ord_date_f'];
		$sql = $sql . " AND ord_date <= '$ord_date_f'";
	}


	if ($_POST['ord_deadline_s'] <>"") {
		$ord_deadline_s = $_POST['ord_deadline_s'];
		$sql = $sql . " AND ord_deadline >= '$ord_deadline_s'";
	}

	if ($_POST['ord_deadline_f'] <> "") {
		$ord_deadline_f = $_POST['ord_deadline_f'];
		$sql = $sql . " AND ord_deadline <= '$ord_deadline_f'";
	}	

	if(!empty($_POST['ord_srv'])) {

		$sql = $sql.' AND (ord_srv_id =' .$_POST['ord_srv'][0]; 
		$N=count($_POST['ord_srv']);
		for ($i=1; $i<$N; $i++){
			$sql = $sql.' OR ord_srv_id =' .$_POST['ord_srv'][$i] .''; 
		}
		$sql = $sql.')';
	}

	if($_POST['ord_cst_id']<>'') {
		$ord_cst_id = $_POST['ord_cst_id'];
		$sql = $sql.' AND ord_cst_id = '.$ord_cst_id;
	}

	if(!empty($_POST['ord_sts'])) {

		$sql = $sql.' AND (ord_sts_id =' .$_POST['ord_sts'][0]; 
		$N=count($_POST['ord_sts']);
		for ($i=1; $i<$N; $i++){
			$sql = $sql.' OR ord_sts_id =' .$_POST['ord_sts'][$i] .''; 
		}
		$sql = $sql.')';
	}

		if(!empty($_POST['ord_prt'])) {

		$sql = $sql.' AND (ord_priority =' .$_POST['ord_prt'][0]; 
		$N=count($_POST['ord_prt']);
		for ($i=1; $i<$N; $i++){
			$sql = $sql.' OR ord_priority =' .$_POST['ord_prt'][$i] .''; 
		}
		$sql = $sql.')';
	}

	if($_POST['usr_login']<>'') {
		$usr_login = $_POST['usr_login'];
		$sql = $sql.' AND usr_login = "'.$usr_login.'"';
	}

	$sql = $sql.' AND ord_sts_id <7 ORDER BY ord_priority DESC, ord_deadline ASC, ord_date ASC  ';


	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $data;

}

function get_orders_count($id) {
	$sql = 'SELECT * FROM orders WHERE ord_sts_id = ' .$id;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_num_rows($result);

	return $data;
}

function get_last_comments() {
	$sql = 'SELECT `cmn_id`, `cmn_ord_id`, `cmn_date`, `cmn_usr_login`, `cmn_text`, `cmn_fls`, `usr_name`, `usr_surname`, `usr_img` FROM `comments`, `users` WHERE cmn_usr_login = usr_login  ORDER BY cmn_date DESC LIMIT 10';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_urgent_orders() {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'+ 3 days'));
	$sql = "SELECT * FROM orders, services, customers, users, statuses, priority WHERE ord_priority=prt_id AND ord_cst_id = cst_id AND ord_srv_id = srv_id AND ord_login = usr_login AND ord_sts_id=sts_id AND ord_sts_id < 7 AND ord_deadline < '$finish_date'  ORDER BY ord_deadline ASC, ord_priority DESC,  ord_date ASC  ";

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $data;
}

function get_positions() {

	global $link;

	$sql='SELECT * FROM positions';


	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_orders_count_period($id, $period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT * FROM orders WHERE ord_sts_id = ' .$id .' AND ord_date >  "'.$finish_date.'"';

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_num_rows($result);

	return $data;
}

function get_regular_cst($period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT cst_name, MAX(ord_date) as "max_ord_date", COUNT(ord_id) as "ord_count" FROM `orders`, `customers` WHERE cst_id=ord_cst_id  AND ord_date >  "'.$finish_date.'" GROUP BY cst_id, "max_ord_date" ORDER BY "ord_count" DESC';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_pop_srv($period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT COUNT(ord_srv_id) as srv_count, srv_name, MAX(ord_date) FROM `orders`, `services`  WHERE ord_srv_id=srv_id AND ord_date >  "'.$finish_date.'"  GROUP BY ord_srv_id ORDER BY "srv_count" DESC';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}


function get_priorities() {
	$sql = 'SELECT * FROM priority';
	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_workload($usr_login, $sts_id) {
	$sql = 'SELECT COUNT(ord_sts_id) as count FROM `orders`, `statuses` WHERE ord_sts_id=sts_id AND ord_login="'.$usr_login.'" AND sts_id="'.$sts_id.'" GROUP BY ord_login, ord_sts_id';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	if (!empty(($data)))
		return $data[0]['count'];
	else
		return 0;
}

function get_avg_duration($period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT srv_name, ord_srv_id, AVG(DATEDIFF(ord_compl_date,ord_date)) as duration FROM `orders`, `services` WHERE srv_id=ord_srv_id AND ord_sts_id >6 AND ord_compl_date >  "'.$finish_date.'"  GROUP BY ord_srv_id';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_min_duration($period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT srv_name, ord_srv_id, MIN(DATEDIFF(ord_compl_date,ord_date)) as duration FROM `orders`, `services` WHERE srv_id=ord_srv_id AND ord_sts_id >6 AND ord_compl_date >  "'.$finish_date.'"  GROUP BY ord_srv_id';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}

function get_max_duration($period) {
	$today_date = date("Y-m-d");
	$finish_date = date("Y-m-d", strtotime($today_date.'- '.$period.' days'));
	$sql = 'SELECT srv_name, ord_srv_id, MAX(DATEDIFF(ord_compl_date,ord_date)) as duration FROM `orders`, `services` WHERE srv_id=ord_srv_id AND ord_sts_id >6 AND ord_compl_date >  "'.$finish_date.'"  GROUP BY ord_srv_id';

	//echo $sql;

	global $link;

	$result=mysqli_query($link, $sql);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $data;
}
?>