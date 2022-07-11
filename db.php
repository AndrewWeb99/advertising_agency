<?php 

$dblogin = "root"; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
$dbpass = "root"; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ
$db = "amedia"; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
$dbhost="localhost";

$link = mysqli_connect($dbhost, $dblogin, $dbpass, $db);
	
if (mysqli_connect_errno())
{
	echo "Ошибка подключения к базе данных (" .mysqli_connect_errno () . "): " . mysqli_connect_error();
	exit();
}

mysqli_query($link, "SET NAMES utf8");

?>