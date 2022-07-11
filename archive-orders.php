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
				<h1>Архивные заказы</h1>
			</div>
			<section class="orders">
				<table id="table-id">
					<thead>
					<tr>
						<th>#</th>
						<th>Дата заказа</th>
						<th>Дата завершения</th>
						<th>Тип услуги</th>
						<th>Клиент</th>
						<th>Статус</th>
						<th>Последнее изменение</th>
						<th>Исполнитель</th>
						<th>Действия</th>
					</tr>
				</thead>
				<tbody>

					<?php $orders=get_archive_orders(); ?>
					<?php foreach ($orders as $order): ?>
					<tr class="row-status-<?=$order['ord_sts_id']?>">

						<td><a href="view-order.php?id=<?=$order['ord_id']?>"><?=$order['ord_id']?></a></td>
						<td><?=date('d.m.Y', strtotime($order['ord_date']))?></td>
						<td><?=date('d.m.Y', strtotime($order['ord_compl_date']))?></td>
						<td><?=$order['srv_name']?></td>
						<td><a href="edit-customer.php?id=<?=$order['cst_id']?>"><?=$order['cst_name']?></a></td>
						<td><span class="order-status cell-status-<?=$order['ord_sts_id']?>"><?=$order['sts_name']?></span></td>
						<td><?=date('d.m.Y H:i', strtotime($order['ord_edited']))?></td>
						<td><?=$order['usr_name']?></td>
						<td class="more-inform">
							<a href="view-order.php?id=<?=$order['ord_id']?>">
								<img src="img/icons/info.svg">
							</a>
							<a href="edit-order.php?id=<?=$order['ord_id']?>">
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