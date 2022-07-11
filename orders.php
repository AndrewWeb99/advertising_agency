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
				<h1>Текущие заказы
				</h1>
				<div class="header-buttons">
					<a href="add-order.php">
						<div class="button add-order">
								<div class="button-icon">
									<img src="img/icons/add.svg">
								</div>
								<div class="button-title">
									Добавить заказ
								</div>
						</div>
					</a>
					<a href="archive-orders.php">
						<div class="button archive-orders">
								<div class="button-icon">
									<img src="img/icons/archive.svg">
								</div>
								<div class="button-title">
									Архивные заказы
								</div>
						</div>
					</a>
				</div>
			</div>
			<section class="orders">
				<?php require 'blocks/filter.php'; ?>
				<table id="table-id">
					<thead>
					<tr>
						<th>#</th>
						<th>Дата заказа</th>
						<th>Дедлайн</th>
						<th>Услуга</th>
						<th>Клиент</th>
						<th>Статус</th>
						<th>Последнее изменение</th>
						<th>Исполнитель</th>
						<th>Действие</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($_POST['apply-filter'])): ?>
					<?php $orders=get_filter_orders(); ?>
					<?php else: ?>
					<?php $orders=get_orders(); ?>
					<?php endif; ?>
					<?php foreach ($orders as $order): ?>
					<tr>
						<td><a href="view-order.php?id=<?=$order['ord_id']?>"><?=$order['ord_id']?></a>
							<?php if($order['prt_id']>1): ?>
					<img title="<?=$order['prt_name']?>" class="priority" src="img/icons/priority-<?=$order['prt_id']?>.svg">
					<?php endif; ?>
							      
						</td>
						<td><?=date('d.m.Y', strtotime($order['ord_date']))?></td>
						<td <?php if(date('Y-m-d')>=$order['ord_deadline']) {echo "class=\"row-status-1\"";} ?>><?=date('d.m.Y', strtotime($order['ord_deadline']))?></td>
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