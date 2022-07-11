<?php require_once 'blocks/check-auth.php'; ?>
<?php require_once 'db.php'; ?>
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
	<?php require 'blocks/sidebar.php'; ?>
	<?php require 'blocks/navbar.php'; ?>
	<?php if($_SESSION['usr_pos']==5): ?>
	<div class="main-wrap">
		<div class="main">
			<div class="main-header">
				<h1>Добавление нового пользователя</span></h1>
			</div>
			<div class="section-line">
			<section>
				<table class="table-info">	
					<tbody>
						<form method="POST" action="" enctype="multipart/form-data">
						<tr>
							<td><span class="col-title">Фото</span></td>
							<td>
								<input type="file" name="usr_img" >
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Логин</span></td>
							<td>
								<input type="input" name="usr_login" value="" required="">
							</td>
						</tr>
						<tr>
							<td>
								<span class="col-title">Пароль</span>
							</td>
							<td>
								<input type="password" name="usr_password" required="">
							</td>
						</tr>
						</tr>
						<tr>
							<td><span class="col-title">Имя</span></td>
							<td><input type="input" name="usr_name" value="" required=""></td>
						</tr>	
						<tr>
							<td><span class="col-title">Фамилия</span></td>
							<td><input type="input" name="usr_surname" value="" required=""></td>
						</tr>
						<tr>
							<td><span class="col-title">Должность</span></td>
							<td>

								<select name="usr_pos" >
									<option value="" hidden="">Выберите должность</option>
									<?php $positions=get_positions(); ?>
									<?php foreach ($positions as $position): ?>
										<option value="<?=$position['pos_id']?>"><?=$position['pos_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>	
						<tr>
							<td><span class="col-title">Телефон</span></td>
							<td><input type="input" name="usr_phone" value="" required=""></td>
						</tr>
						<tr>
							<td><span class="col-title">E-mail</span></td>
							<td><input type="email" name="usr_email" value="" required=""></td>
						</tr>	
						<tr>
							<td><span class="col-title">Статус</span></td>
							<td>
								<select name="usr_status" required="">
										<option value="1">Активен</option>
										<option value="0">Отключен</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<input class="button submit-button" type="submit" name="save-user" value="Сохранить данные"></td>
						</tr>
					</form>	
					</tbody>
				</table>

			</section>
			</div>
		</div>
	</div>
	<?php else: ?>
		<script>
			alert("Доступ запрещен!");
		</script>
<?php endif; ?>
</body>
</html>



<?php 
	if (isset($_POST['save-user'])):
		$result = add_user();
		if ($result):
	?>
		<script>
			alert('Пользователь добавлен!');
			location.href = 'users.php';
		</script>
		<?php else: ?>
		<script>
			alert('Произошла ошибка! Попробуйте еще раз');
		</script>
		<?php endif; ?>	
<?php endif; ?>