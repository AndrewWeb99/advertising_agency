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
				<h1>Добавление нового заказа</span></h1>
			</div>
				
			<div class="section-line">
			<section>
				<h2>Описание</h2>
				<table class="table-info">

					<tbody>
						<form method="POST" action="" enctype="multipart/form-data">
						
						<tr>
							<td><span class="col-title">Услуга</span></td>
							<td>
								<select name="ord_srv_id" required="">
									<?php $services = get_services(); ?>
									<option  value="" hidden="">Выберите услугу</option>
									<?php foreach ($services as $service): ?>
										<option value="<?=$service['srv_id']?>"><?=$service['srv_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><span class="col-title">Клиент</span></td>
							<td>
								<select name="ord_cst_id" class="customers-select" required="">
									<option value="" hidden="">Выберите клиента</option>
									<?php $customers = get_customers(); ?>
									<?php foreach ($customers as $customer): ?>
										<option value="<?=$customer['cst_id']?>"><?=$customer['cst_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Дедлайн</span></td>
							<td><input type="date" name="ord_deadline" value=""></td>
							<td><span class="col-title">Исполнитель</span></td>
							<td>
								<select name="ord_login" class="customers-select" required="">
									<option value="" hidden="">Выберите исполнителя</option>
									<?php $users = get_users(); ?>
									<?php foreach ($users as $user): ?>
										<option value="<?=$user['usr_login']?>"><?=$user['usr_name'].' '.$user['usr_surname']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Описание заказа</span></td>
							<td colspan="3">
								<textarea name="ord_desc"></textarea>
							</td>
						</tr>
						<tr>
							<td class="button-cell" colspan="4">
							<input class="button submit-button" type="submit" name="save-order" value="Сохранить данные"></td>
						</tr>
					</form>
					</tbody>
				</table>
			</section>
			</div>
		</div>
	</div>


</body>
</html>

<?php 
if (isset($_POST['save-order'])):
	$result = add_order();
	if ($result):
?>
	<script>
		alert('Заказ добавлен!');
		location.href = 'orders.php';
	</script>
	<?php else: ?>
	<script>
		alert('Произошла ошибка! Попробуйте еще раз');
	</script>
	<?php endif; ?>	
<?php endif; ?>