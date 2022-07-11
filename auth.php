<?php
	require_once 'db.php'; 
	session_start();

	if(isset($_SESSION['auth'])) {
		header("location: index.php");
	}

?>

<?php require_once 'functions.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Рекламное агентство Art Front в г. Петропавловск</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="icon" type="image/png" href="favicon.png">

</head>
<body>
	<div class="auth-wrap">
	<div class="auth-form">
		<div class="auth-logo">
			<div class="auth-logo-img">
				<img src="img/logo.png">
			</div>
			<div class="auth-logo-text">
				<span class="logo-name">ART FRONT</span>
				<span class="logo-desc">РЕКЛАМНОЕ АГЕНТСТВО</span>
			</div>
		</div>
		<form method="POST">
			<input type="input" name="login" placeholder="Ваш логин" required>
			<input type="password" name="password" placeholder="Ваш пароль" required>
			<input type="submit" name="sign-in" value="Войти">
		</form>
		<div class="error">
			<span>Неверный логин или пароль</span>
		</div>
	</div>
	<div class="copyright">
		<span>Система автоматизации учета заказов</span>
		<span>&copy; 2022 Августинович Анастасия</span>
	</div>
</div>
</body>
</html>

<?php



	if(isset($_POST['sign-in'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];

		$sql = "SELECT `usr_login`, `usr_password`, `usr_name`, `usr_surname`, `usr_status`, `usr_img`, `usr_pos` FROM `users` WHERE usr_login = '$login' AND usr_password = sha1('$password')";

		$result=mysqli_query($link, $sql);
		$data = mysqli_fetch_assoc($result);

		if($data AND $data['usr_status'] == 1) :
			$_SESSION['auth'] = true;
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['usr_name'] = $data['usr_name'];
			$_SESSION['usr_surname'] = $data['usr_surname'];
			$_SESSION['usr_img'] = $data['usr_img'];
			$_SESSION['usr_pos'] = $data['usr_pos'];
		?>
		<script>
			location.href="index.php";
		</script>
		<? else : ?>
			<script>
				var a = document.querySelector(".error");
				a.style.display = "block";
			</script>
		<?php endif;
	}

?>