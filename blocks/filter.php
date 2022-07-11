<div class="orders-filter-header">
					<a href="#" onclick="show_filters();">
						<div class="button filter">
								<div class="button-icon">
									<img src="img/icons/filter.svg">
								</div>
								<div class="button-title">
									Фильтр
								</div>
						</div>
					</a>
					</div>

				<form method="POST">
					<div class="order-filters">
					<div class="filter-table">
						<div class="filter-section">
							<div class="filter-element">
								<span class="filter-title">Дата заказа</span>
								<div class="filter-options">
									От<input type="date" name="ord_date_s">
									До<input type="date" name="ord_date_f">
								</div>
							</div>
							<div class="filter-element">
								<span class="filter-title">Дедлайн</span>
								<div class="filter-options">
									От<input type="date" name="ord_deadline_s">
									До<input type="date" name="ord_deadline_f">
								</div>
							</div>
						</div>
						<div class="filter-section">
							<div class="filter-element">
								<span class="filter-title">Приоритет</span>
								<div class="filter-options">
									<?php $priorities = get_priorities(); ?>
										<?php foreach ($priorities as $priority): ?>
											<div class="filter-options-line">
											<input type="checkbox" id="ord-prt-<?=$priority['prt_id']?>" name="ord_prt[]" value="<?=$priority['prt_id']?>"><label for="ord-prt-<?=$priority['prt_id']?>"><?=$priority['prt_name']?></label>
											</div>
										<?php endforeach; ?>
								</div>
							</div>
							<div class="filter-element">
								<span class="filter-title">Услуга</span>
								<div class="filter-options">
									<?php $services = get_services(); ?>
										<?php foreach ($services as $service): ?>
											<div class="filter-options-line">
											<input type="checkbox" id="ord-srv-<?=$service['srv_id']?>" name="ord_srv[]" value="<?=$service['srv_id']?>"><label for="ord-srv-<?=$service['srv_id']?>"><?=$service['srv_name']?></label>
											</div>
										<?php endforeach; ?>
								</div>
							</div>
							
						</div>
						<div class="filter-section">
							<div class="filter-element">
								<span class="filter-title">Статус</span>
								<div class="filter-options">
									<?php $status = get_statuses(); ?>
										<?php for ($i=0; $i<6; $i++): ?>
											<div class="filter-options-line">
											<input type="checkbox" id="ors-sts-<?=$status[$i]['sts_id']?>" name="ord_sts[]" value="<?=$status[$i]['sts_id']?>"><label for="ors-sts-<?=$status[$i]['sts_id']?>"><?=$status[$i]['sts_name']?></label>
											</div>
										<?php endfor; ?>
								</div>
							</div>
							</div>
						<div class="filter-section">
							<div class="filter-element">
								<span class="filter-title">Клиент</span>
								<div class="filter-options">
									<select name="ord_cst_id" class="customers-select" >
										<option value="" hidden="">Выберите клиента</option>
										<?php $customers = get_customers(); ?>
										<?php foreach ($customers as $customer): ?>
											<option value="<?=$customer['cst_id']?>"><?=$customer['cst_name']?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="filter-element">
								<span class="filter-title">Исполнитель</span>
								<div class="filter-options">
								<select name="usr_login" class="customers-select" >
									<option value="" hidden="">Выберите исполнителя</option>
									<?php $users = get_users(); ?>
									<?php foreach ($users as $user): ?>
										<option value="<?=$user['usr_login']?>"><?=$user['usr_name'].' '.$user['usr_surname']?></option>
									<?php endforeach; ?>
								</select>
								</div>
							</div>
						</div>
					</div>
					<div class="filter-section filter-submit">
						<input class="button submit-button" name="apply-filter" type="submit" value="Применить фильтр">
					</div>
					</div>

				</form>
				<script>
					function show_filters() {
						var orderFilters=document.querySelector(".order-filters");
						if (orderFilters.style.display == "block"){
							orderFilters.style.display = "none";
						}
						else {
							orderFilters.style.display = "block";
						}
					}
				</script>