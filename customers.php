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
				<h1>Клиенты</h1>
				<div class="header-buttons">
					<a href="add-customer.php">
						<div class="button add-order">
								<div class="button-icon">
									<img src="img/icons/add.svg">
								</div>
								<div class="button-title">
									Добавить клиента
								</div>
						</div>
					</a>
				</div>
			</div>
			<section class="orders">
				<table id="table-id">
					<thead>
					<tr>
						<th>#</th>
						<th>Наименование</th>
						<th>Юридический адрес</th>
						<th>IBAN-счет</th>
						<th>Телефон</th>
						<th>E-mail</th>
						<th>Изменить</th>
					</tr>
				</thead>
				<tbody>
					<?php $customers=get_customers(); ?>
					<?php foreach ($customers as $customer): ?>
					<tr>
						<td><?=$customer['cst_id']?></td>
						<td><?=$customer['cst_name']?></td>
						<td><?=$customer['cst_address']?></td>
						<td><?=$customer['cst_iban']?></td>
						<td><a href="tel:<?=$customer['cst_phone']?>"><?=$customer['cst_phone']?></a></td>
						<td><a href="mailto:<?=$customer['cst_email']?>"><?=$customer['cst_email']?></a></td>
						<td class="more-inform">
							<a href="edit-customer.php?id=<?=$customer['cst_id']?>">
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