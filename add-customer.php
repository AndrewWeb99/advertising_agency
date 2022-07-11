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
				<h1>Добавление клиента</span></h1>
			</div>
			<div class="section-line">
			<section>
				<table class="table-info">	
					<tbody>
						<form method="POST" action="" enctype="multipart/form-data">
						<tr>
							<td><span class="col-title">Наименование</span></td>
							<td><input type="input" name="cst_name" value="" required=""></td>
						</tr>
						<tr>
							<td><span class="col-title">Юридический адрес</span></td>
							<td><input type="input" name="cst_address" value=""></td>
						</tr>
						<tr>
							<td><span class="col-title">IBAN-счет</span></td>
							<td><input type="input" name="cst_iban" value=""></td>
						</tr>
						<tr>
							<td><span class="col-title">Телефон</span></td>
							<td><input type="input" name="cst_phone" value="" placeholder="+7XXXXXXXXXX" required></td>
						</tr>
						<tr>
							<td><span class="col-title">E-mail</span></td>
							<td><input type="email" name="cst_email" value="" ></td>
						</tr>
						<tr>
							<td colspan="2">
							<input class="button submit-button" type="submit" name="save-customer" value="Сохранить данные"></td>
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
if (isset($_POST['save-customer'])):
	$result = add_customer();
	if ($result):
?>
	<script>
		alert('Клиент добавлен!');
		location.href = 'customers.php';
	</script>
	<?php else: ?>
	<script>
		alert('Произошла ошибка! Попробуйте еще раз');
	</script>
	<?php endif; ?>	
<?php endif; ?>
