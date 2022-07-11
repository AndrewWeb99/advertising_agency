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
			<?php if (isset($_GET['id'])): ?>
			<div class="main-header">
				<?php $order=view_order($_GET['id']); ?>
				<h1>Изменение данных заказа №<?=$order['ord_id']?> от <?=date('d.m.Y', strtotime($order['ord_date']))?></h1>
			</div>
			<div class="section-line">
			<section>
				<h2>Описание</h2>
				<table class="table-info">	
					<tbody>
						<form method="POST" action="" enctype="multipart/form-data">
						
						<tr>
							<td><span class="col-title">Тип услуги</span></td>
							<td>
								<select name="ord_srv_id" required="" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>>
									<?php $services = get_services(); ?>
									<option  value="<?=$order["ord_srv_id"]?>" hidden=""><?=$order["srv_name"]?></option>
									<?php foreach ($services as $service): ?>
										<option value="<?=$service['srv_id']?>"><?=$service['srv_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><span class="col-title">Клиент</span></td>
							<td>
								<select name="ord_cst_id" class="customers-select" required="" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>>
									<option value="<?=$order["ord_cst_id"]?>" hidden=""><?=$order["cst_name"]?></option>
									<?php $customers = get_customers(); ?>
									<?php foreach ($customers as $customer): ?>
										<option value="<?=$customer['cst_id']?>"><?=$customer['cst_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Дедлайн</span></td>
							<td><input type="date" name="ord_deadline" value="<?=$order['ord_deadline']?>" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>></td>
							<td><span class="col-title">Статус</span></td>
							<td>
								<select name="ord_sts_id" class="status-select" required="" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>>
									<option value="<?=$order['ord_sts_id']?>" hidden=""><?=$order['sts_name']?></option>
									<?php $statuses = get_statuses(); ?>
									<?php foreach ($statuses as $status): ?>
										<option value="<?=$status['sts_id']?>"><?=$status['sts_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

						<tr>
							<td><span class="col-title">Приоритет</span></td>
							<td>
								
								<select name="ord_priority" class="status-select" required=""  <?php if($_SESSION['usr_pos']!=1){ echo "disabled";}?>>
									<option value="<?=$order['ord_priority']?>" hidden=""><?=$order['prt_name']?></option>
									<?php $priorities = get_priorities(); ?>
									<?php foreach ($priorities as $priority): ?>
										<option value="<?=$priority['prt_id']?>"><?=$priority['prt_name']?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><span class="col-title">Исполнитель</span></td>
							<td>
								<select name="ord_login" class="customers-select" required=""  <?php if($_SESSION['usr_pos']!=1){ echo "disabled";}?>>
									<option value="<?=$order['ord_login']?>" hidden=""><?=$order['usr_name'].' '.$order['usr_surname']?></option>
									<?php $users = get_users(); ?>
									<?php foreach ($users as $user): ?>
										<option value="<?=$user['usr_login']?>"><?=$user['usr_name'].' '.$user['usr_surname']?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td><span class="col-title" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>>Описание заказа</span></td>
							<td colspan="3">
								<textarea name="ord_desc" <?php if($_SESSION['usr_pos']==1){ echo "disabled";}?>><?=$order['ord_desc'];?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<input class="button submit-button" type="submit" name="save-order" value="Сохранить">
							</td>
						</tr>
						</form>
					</tbody>
				</table>
			</section>
			</div>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>


<?php 
if (isset($_POST['save-order'])):
	$result = save_order($_GET['id']);
	if ($result):
?>
	<script>
		alert('Изменения сохранены!');
		location.href = 'view-order.php?id=<?=$_GET['id']?>';
	</script>
	<?php else: ?>
	<script>
		alert('Произошла ошибка! Попробуйте еще раз');
	</script>
	<?php endif; ?>	
<?php endif; ?>
