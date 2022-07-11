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
				<h1>
					<?php if($order['prt_id']>1): ?>
					<img title="<?=$order['prt_name']?>" class=priority-header src="img/icons/priority-<?=$order['prt_id']?>.svg">
					<?php endif; ?>
					Заказ №<?=$order['ord_id']?> от <?=date('d.m.Y', strtotime($order['ord_date']))?> <span class="order-status cell-status-<?=$order['ord_sts_id']?>"><?=$order['sts_name']?></span></h1>
				<a href="edit-order.php?id=<?=$order['ord_id']?>">
					<div class="button add-order">
							<div class="button-icon">
								<img src="img/icons/edit.svg">
							</div>
							<div class="button-title">
								Изменить заказ
							</div>
					</div>
				</a>
			</div>
			<div class="section-line">
			<section>
				<h2>Описание</h2>
				<table class="table-info">	
					<tbody>
						<tr>
							<td><span class="col-title">Тип услуги</span></td>
							<td><input type="input" id="srv_name" value="<?=$order['srv_name']?>" readonly></td>
							<td><span class="col-title">Клиент</span></td>
							<td><a href="edit-customer.php?id=<?=$order['cst_id']?>"><input type="input" id="cst_name" value="<?=$order['cst_name']?>" readonly></a>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Дата заказа</span></td>
							<td><input type="date" id="ord_date" value="<?=$order['ord_date']?>" readonly></td>
							<td><span class="col-title">Телефон</span></td>
							<td><a href="tel:<?=$order['cst_phone']?>"  title="Позвонить"><input type="input" id="cst_phone" value="<?=$order['cst_phone']?>" readonly></a>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Дедлайн</span></td>
							<td><input type="date" id="ord_deadline" value="<?=$order['ord_deadline']?>" readonly></td>
							<td><span class="col-title">E-mail</span></td>
							<td><a href="mailto:<?=$order['cst_email']?>" title="Написать"><input type="input" id="cst_email" value="<?=$order['cst_email']?>" readonly></a>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Описание заказа</span></td>
							<td colspan="3">
								<textarea readonly=""><?=$order['ord_desc'];?></textarea>
							</td>
						</tr>
						<tr>
							<td><span class="col-title">Исполнитель</span></td>
							<td>
								<input type="input "readonly="" value="<?=$order['usr_name'].' '.$order['usr_surname'];?>">
							</td>
							<td><span class="col-title">Дата завершения</span></td>
							<td><input type="date" id="ord_compl_date" value="<?=$order['ord_compl_date']?>" readonly></td>
							
						</tr>
					</tbody>
				</table>
			</section>
			</div>
			<div class="section-line">
				<section>
					<div class="section-title">
						<h2>Комментарии</h2>
					</div>
						<table class="table-info">
							<tbody>
								<?php $comments = get_comments($_GET['id']); ?>
								<?php foreach ($comments as $comment): ?>
								<tr class="comment">
									<td>
										<div class="comment-photo">
										<img src="img/users/<?=$comment['usr_img'];?>"></div>
									</td>
									<td>
										<div class="comment-content">
											<div class="comment-head"><span class="comment-author"><?=$comment['usr_name'].' '.$comment['usr_surname'] ?></span><span class="comment-date"><?=date('d.m.Y H:i', strtotime($comment['cmn_date']))?></span></div>
											<div class="comment-text"><?=$comment['cmn_text']?></div>
											<div class="comment-files"><a class= "file-download"href="img/orders/<?=$comment['cmn_fls'];?>" download><?=$comment['cmn_fls'];?></a></div>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
								<form method="POST" action="" enctype="multipart/form-data">
									<tr class="comment">
										<td>
											<div class="comment-photo">
											<img src="img/users/<?=$_SESSION['usr_img'];?>"></div>
										</td>
										<td>
											<textarea placeholder="Написать комментарий" required="" name="cmn_text"></textarea>
										</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2">
											<input type="file" name="cmn_fls">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input class="button submit-button" type="submit" name="send-comment" value="Отправить">
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
if (isset($_POST['send-comment'])):
	$result = add_comment($_GET['id']);
	if ($result):
?>
	<script>
		alert('Комментарий отправлен!');
		location.href = "view-order.php?id=<?=$_GET['id']?>";
	</script>
	<?php else: ?>
	<script>
		alert('Произошла ошибка! Попробуйте еще раз');
	</script>
	<?php endif; ?>	
<?php endif; ?>