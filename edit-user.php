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
	
	<div class="main-wrap">
		<div class="main">
			<?php if (isset($_GET['login']) and ($_GET['login']==$_SESSION['login'] OR $_SESSION['login'] == 'admin') OR $_SESSION['usr_pos'] == 5): ?>
			<div class="main-header">
				<?php $user=view_user($_GET['login']); ?>
				<h1>Изменение данных</span></h1>
			</div>
			<div class="section-line">
			<section>
				<table class="table-info">	
					<tbody>
						<form method="POST" action="" enctype="multipart/form-data">
						<tr>
							<td><span class="col-title">Фото</span></td>
							<td class="user-edit">
								<img src="img/users/<?=$user['usr_img']?>">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="input" name="usr_img" value="<?=$user['usr_img']?>" readonly>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="file" name="new_usr_img" >
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Логин</span></td>
							<td>
								<input type="input" name="usr_login" disabled="" value="<?=$user['usr_login']?>">
							</td>
						</tr>
						<tr>
							<td>
								<span class="col-title">Новый пароль</span>
							</td>
							<td>
								<input type="password" name="usr_password" >
							</td>
						</tr>
						</tr>
						<tr>
							<td><span class="col-title">Имя</span></td>
							<td><input type="input" name="usr_name" value="<?=$user['usr_name']?>"></td>
						</tr>	
						<tr>
							<td><span class="col-title">Фамилия</span></td>
							<td><input type="input" name="usr_surname" value="<?=$user['usr_surname']?>"></td>
						</tr>
						<tr>
							<td><span class="col-title">Должность</span></td>
							<td>
								<select name="usr_pos" >
									<option value="<?=$user['pos_id']?>" hidden=""><?=$user['pos_name']?></option>
									<?php $positions=get_positions(); ?>
									<?php foreach ($positions as $position): ?>
										<option value="<?=$position['pos_id']?>"><?=$position['pos_name']?></option>
									<?php endforeach; ?>
								</select>

							</td>
						</tr>	
						<tr>
							<td><span class="col-title">Телефон</span></td>
							<td><input type="input" name="usr_phone" value="<?=$user['usr_phone']?>"></td>
						</tr>
						<tr>
							<td><span class="col-title">E-mail</span></td>
							<td><input type="email" name="usr_email" value="<?=$user['usr_email']?>"></td>
						</tr>	
						<tr>
							<td><span class="col-title">Статус</span></td>
							<td>
								<select name="usr_status" required="">
									<?php
										if ($user['usr_status'] == 1):?>
											<option value="1" hidden>Активен</option>
									<?php else: ?>
											<option value="0" hidden>Отключен</option>
									<?php endif; ?>
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
			<?php else: ?>
				<script>
					alert('Редактирование запрещено!');
					location.href = 'users.php';
				</script>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>

<?php 
	if (isset($_POST['save-user'])):
		$result = save_user($_GET['login']);
		if ($result):
	?>
		<script>
			alert('Изменения сохранены!');
			location.href = 'edit-user.php?login=<?=$_GET['login']?>';
		</script>
		<?php else: ?>
		<script>
			alert('Произошла ошибка! Попробуйте еще раз');
		</script>
		<?php endif; ?>	
<?php endif; ?>

