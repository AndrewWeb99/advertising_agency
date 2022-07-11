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
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

</head>
<body>
	<?php require 'blocks/sidebar.php'; ?>
	<?php require 'blocks/navbar.php'; ?>
	
	<?php if($_SESSION['usr_pos']==1): ?>
	<div class="main-wrap">
		<div class="main">
			<?php if(isset($_POST['report-period'])) {
				$period=$_POST['report-period']; }
				else {
					$period = "7";
				} ?>

			<div class="main-header">
				<h1>Отчет по заказам за <?=$period?> дней
				</h1>

			<form method="POST">
				<div class="header-buttons" style="display: flex;">
					<select name="report-period">
					<option value="7">За 7 дней</option>
					<option value="30">За 30 дней</option>
					<option value="90">За три месяца</option>
					<option value="365">За год</option>
				</select>
				<input style="margin-left: 10px"; class="button" type="submit" name="period-apply" value="Вывести отчет">
				</div>
			</form>
			</div>
				
				
			
			<div class="section-line">
				<section>
					<h2>Количество заказов</h2>
						<canvas id="myChart"></canvas>
				</section>
				<section>
					<h2>Постоянные клиенты</h2>
						<canvas id="myChart-2"></canvas>
				</section>
			</div>
			<div class="section-line">
				<section>
					<h2>Время выполнения заказа</h2>
					<canvas id="myChart-5"></canvas>
				</section>
				
				<section>
					<h2>Загруженность сотрудников</h2>
						<canvas id="myChart-4"></canvas>
				</section>
			</div>
			<div class="section-line">
				<section>
					<h2>Популярные услуги</h2>
						<canvas id="myChart-3"></canvas>
				</section>
				<section>
					
				</section>
			</div>
		</div>
	</div>
		<?php else: ?>
		<script>
			alert("Доступ запрещен!");
		</script>
<?php endif; ?>
</body>
</html>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    	labels: ['<?php echo get_statuses()[0]["sts_name"];?>',  '<?php echo get_statuses()[1]["sts_name"];?>', '<?php echo get_statuses()[2]["sts_name"];?>', '<?php echo get_statuses()[3]["sts_name"];?>', '<?php echo get_statuses()[4]["sts_name"];?>', '<?php echo get_statuses()[5]["sts_name"];?>', '<?php echo get_statuses()[6]["sts_name"];?>', '<?php echo get_statuses()[7]["sts_name"];?>'],
	    datasets: [
		    {	

    			backgroundColor: ['#e00046', '#00b8d3', '#e5bc01', '#7f3510', '#e58c17', '#9829cc', '#00d36d', '#8b9399'],
		        data: ['<?php echo get_orders_count_period(1, $period);?>', '<?php echo get_orders_count_period(2, $period);?>', '<?php echo get_orders_count_period(3, $period);?>', '<?php echo get_orders_count_period(4, $period);?>', '<?php echo get_orders_count_period(5, $period);?>', '<?php echo get_orders_count_period(6, $period);?>', '<?php echo get_orders_count_period(7, $period);?>', '<?php echo get_orders_count_period(8, $period);?>']
		    }
	    ]
	}
});

</script>

<script>
var ctx = document.getElementById('myChart-2').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
   	data: {
   	labels: ['<?php echo get_regular_cst($period)[0]["cst_name"];?>','<?php echo get_regular_cst($period)[1]["cst_name"];?>','<?php echo get_regular_cst($period)[2]["cst_name"];?>','<?php echo get_regular_cst($period)[3]["cst_name"];?>','<?php echo get_regular_cst($period)[4]["cst_name"];?>','<?php echo get_regular_cst($period)[5]["cst_name"];?>','<?php echo get_regular_cst($period)[6]["cst_name"];?>', '<?php echo get_regular_cst($period)[7]["cst_name"];?>', '<?php echo get_regular_cst($period)[8]["cst_name"];?>', '<?php echo get_regular_cst($period)[9]["cst_name"];?>'],
    datasets: [{
    	label: 'Количество заказов',
    	backgroundColor: '#9ad0f5',
        data: ['<?php echo get_regular_cst($period)[0]["ord_count"];?>','<?php echo get_regular_cst($period)[1]["ord_count"];?>','<?php echo get_regular_cst($period)[2]["ord_count"];?>','<?php echo get_regular_cst($period)[3]["ord_count"];?>','<?php echo get_regular_cst($period)[4]["ord_count"];?>','<?php echo get_regular_cst($period)[5]["ord_count"];?>','<?php echo get_regular_cst($period)[6]["ord_count"];?>', '<?php echo get_regular_cst($period)[7]["ord_count"];?>', '<?php echo get_regular_cst($period)[8]["ord_count"];?>', '<?php echo get_regular_cst($period)[9]["ord_count"];?>']
    }]
	}
});

</script>

<script>
var ctx = document.getElementById('myChart-3').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
   	data: {
   	labels: ['<?php echo get_pop_srv($period)[0]["srv_name"];?>','<?php echo get_pop_srv($period)[1]["srv_name"];?>','<?php echo get_pop_srv($period)[2]["srv_name"];?>','<?php echo get_pop_srv($period)[3]["srv_name"];?>','<?php echo get_pop_srv($period)[4]["srv_name"];?>','<?php echo get_pop_srv($period)[5]["srv_name"];?>','<?php echo get_pop_srv($period)[6]["srv_name"];?>', '<?php echo get_pop_srv($period)[7]["srv_name"];?>', '<?php echo get_pop_srv($period)[8]["srv_name"];?>', '<?php echo get_pop_srv($period)[9]["srv_name"];?>'],
    datasets: [{
    	label: 'Количество заказов',
    	backgroundColor: '#ffb1c1',
        data: ['<?php echo get_pop_srv($period)[0]["srv_count"];?>','<?php echo get_pop_srv($period)[1]["srv_count"];?>','<?php echo get_pop_srv($period)[2]["srv_count"];?>','<?php echo get_pop_srv($period)[3]["srv_count"];?>','<?php echo get_pop_srv($period)[4]["srv_count"];?>','<?php echo get_pop_srv($period)[5]["srv_count"];?>','<?php echo get_pop_srv($period)[6]["srv_count"];?>', '<?php echo get_pop_srv($period)[7]["srv_count"];?>', '<?php echo get_pop_srv($period)[8]["srv_count"];?>', '<?php echo get_pop_srv($period)[9]["srv_count"];?>']
    }]
	}
});

</script>

<script>

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

var ctx = document.getElementById('myChart-4').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
   	data: {
   	labels: ['<?php echo get_statuses()[0]['sts_name']; ?>','<?php echo get_statuses()[1]['sts_name']; ?>','<?php echo get_statuses()[2]['sts_name']; ?>','<?php echo get_statuses()[4]['sts_name']; ?>','<?php echo get_statuses()[5]['sts_name']; ?>'],
	datasets: [
		<?php $users=get_users();
			$i=1;
		 	foreach ($users as $user) {
				echo "
			    {
			    	label: '$user[usr_name]',
			    	backgroundColor: getRandomColor(),
			        data: [".get_workload($user['usr_login'], 1).",".get_workload($user['usr_login'], 2)[0].",".get_workload($user['usr_login'], 3).",".get_workload($user['usr_login'], 5).",".get_workload($user['usr_login'], 6)."],
			        fill: false
			    }
			    ,";
			    $i++;
		    };
		   
	    ?>
   		]
	}
});

</script>

<script>
var ctx = document.getElementById('myChart-5').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
   	data: {
   	labels: [
   		<?php
   			$datasets=get_avg_duration($period);
   			foreach($datasets as $data){
   				echo " '$data[srv_name]', ";
   			}
   		?>
   	],
    datasets: [{
    	label: 'Среднее время выполнения заказа, дн',
    	backgroundColor: '#9ad0f5',
        data: [
   		<?php
   			$datasets=get_avg_duration($period);
   			foreach($datasets as $data){
   				echo " '$data[duration]', ";
   			}
   		?>]
    },
		{
		label: 'Минимальное время выполнения заказа, дн',
    	backgroundColor: '#00d36d',
        data: [
   		<?php
   			$datasets=get_min_duration($period);
   			foreach($datasets as $data){
   				echo " '$data[duration]', ";
   			}
   		?>]
   		},
   		{
		label: 'Максимальное время выполнения заказа, дн',
    	backgroundColor: '#e00046',
        data: [
   		<?php
   			$datasets=get_max_duration($period);
   			foreach($datasets as $data){
   				echo " '$data[duration]', ";
   			}
   		?>]
   		}
    ],
	},
});

</script>