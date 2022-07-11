<div class="section-line">
	<section class="db-status-1">
		<h2>Новые заказы</h2>
		<div class="db-element">
			<span class="db-text">Всего</span>
			<span class="db-number"><?=get_orders_count(1);?></span>
			<span class="db-text">заказов</span>
		</div>
	</section>
	<section  class="db-status-2">
		<h2>На разработке дизайна</h2>
		<div class="db-element">
			<span class="db-text">Всего</span>
			<span class="db-number"><?=get_orders_count(2);?></span>
			<span class="db-text">заказов</span>
		</div>
	</section>
	<section  class="db-status-3">
		<h2>На согласовании</h2>
		<div class="db-element">
			<span class="db-text">Всего</span>
			<span class="db-number"><?=get_orders_count(3);?></span>
			<span class="db-text">заказов</span>
		</div>
	</section>
	<section class="db-status-4">
		<h2>На производстве</h2>
		<div class="db-element">
			<span class="db-text">Всего</span>
			<span class="db-number"><?=get_orders_count(5);?></span>
			<span class="db-text">заказов</span>
		</div>
	</section>
	<section class="db-status-5">
		<h2>На монтаже</h2>
		<div class="db-element">
			<span class="db-text">Всего</span>
			<span class="db-number"><?=get_orders_count(6);?></span>
			<span class="db-text">заказов</span>
		</div>
	</section>
</div>
<div class="section-line">
	<section class="urgent-orders-section">
		<h2>Срочные заказы</h2>
		<table class="urgent-orders">
			<thead>
			<tr>
				<th>#</th>
				<th>Дата заказа</th>
				<th>Дедлайн</th>
				<th>Услуга</th>
				<th>Клиент</th>
				<th>Статус</th>
			</tr>
			</thead>
					<?php $orders=get_urgent_orders(); ?>
					<?php foreach ($orders as $order): ?>
					<tr>

						<td><a href="view-order.php?id=<?=$order['ord_id']?>"><?=$order['ord_id']?></a>
							<?php if($order['prt_id']>1): ?>
					<img title="<?=$order['prt_name']?>" class="priority" src="img/icons/priority-<?=$order['prt_id']?>.svg">
					<?php endif; ?>
						</td>
						<td><?=date('d.m.Y', strtotime($order['ord_date']))?></td>
						<td  <?php if(date('Y-m-d')>=$order['ord_deadline']) {echo "class=\"row-status-1\"";} ?>><?=date('d.m.Y', strtotime($order['ord_deadline']))?></td>
						<td><?=$order['srv_name']?></td>
						<td><a href="edit-customer.php?id=<?=$order['cst_id']?>"><?=$order['cst_name']?></a></td>
						<td><span class="order-status cell-status-<?=$order['ord_sts_id']?>"><?=$order['sts_name']?></span></td>
					</tr>
					<?php endforeach; ?>
			<tr>
			</tr>
		</table>
	</section>
	<section class="db-comment-section">
		<h2>Последние комментарии</h2>
		<!-- <?php foreach ($comments as $comment): ?>
		<?php echo $comment['cmn_text']; ?>
		<?php endforeach; ?> -->

		<table class="table-info">
			<tbody>
				<?php $comments=get_last_comments(); ?>
				<?php foreach ($comments as $comment): ?>
				<tr class="comment">
					<td>
						<div class="comment-content db-comment-content">
							<div class="comment-head"><span class="comment-author db-comment"><?=$comment['usr_name'].' '.$comment['usr_surname'] ?> к <a href="view-order.php?id=<?=$comment['cmn_ord_id']?>">заказу №<?=$comment['cmn_ord_id']?></a></span><span class="comment-date db-comment"><?=date('d.m.Y H:i', strtotime($comment['cmn_date']))?></span></div>
							<div class="comment-text db-comment"><?=$comment['cmn_text']?></div>
							<div class="comment-files db-comment"><a class= "file-download"href="img/orders/<?=$comment['cmn_fls'];?>" download><?=$comment['cmn_fls'];?></a></div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
	
</div>