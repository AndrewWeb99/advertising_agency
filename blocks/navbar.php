<div class="navbar-wrap">
	<div class="navbar"> 
		<span class="title">Система автоматизации учета заказов</span>
			<div class="nav-icons">
				<ul>
					<!-- <li>
						<a href=""><img src="img/icons/bell.svg"></a>
					</li> -->
					<li  class="user-photo" >
						<img src="img/users/<?=$_SESSION['usr_img'];?>">
					</li>
					<li class=dropdown>
						<?=$_SESSION['usr_name'].' '.$_SESSION['usr_surname'];?>
						<div class="dropdown-content">
							<ul>
								<a href="edit-user.php?login=<?=$_SESSION['login']?>"><li>Редактировать</li></a>
								<a href="sign-out.php"><li>Выйти</li></a>
							</ul>
						</div>
					</li>
				</ul>
			</div>
	</div>
</div>
