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
			<div class="main-header">
				<h1>Пользователи</h1>
				<div class="header-buttons">
					<a href="add-user.php">
						<div class="button add-order">
								<div class="button-icon">
									<img src="img/icons/add.svg">
								</div>
								<div class="button-title">
									Добавить пользователя
								</div>
						</div>
					</a>
				</div>
			</div>
			<section class="orders">
				<table id="table-id">
					<thead>
					<tr>
						<th>Фото</th>
						<th>Имя</th>
						<th>Фамилия</th>
						<th>Должность</th>
						<th>Телефон</th>
						<th>E-mail</th>
						<th>Статус</th>
						<th>Изменить</th>
					</tr>
				</thead>
				<tbody>
					<?php $users=get_all_users(); ?>
					<?php foreach ($users as $user): ?>
					<tr>
						<td class="user-img"><img src="img/users/<?=$user['usr_img'];?>"></td>
						<td><?=$user['usr_name']?></td>
						<td><?=$user['usr_surname']?></td>
						<td><?=$user['pos_name']?></td>
						<td><a href="tel:<?=$user['usr_phone']?>"><?=$user['usr_phone']?></a></td>
						<td><a href="mailto:<?=$user['usr_email']?>"><?=$user['usr_email']?></a></td>
						<td>
							<?php
								if ($user['usr_status'] == 1) { echo "Активен";}
									else echo "Отключен";
							?>
						</td>
						<td class="more-inform">
							<a href="edit-user.php?login=<?=$user['usr_login']?>">
								<img src="img/icons/edit.svg">
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
				</table>
			</section>

		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.0.2/tablesort.min.js"></script>
	<script>
		new Tablesort(document.getElementById('table-id'));
	</script>
</body>
</html>