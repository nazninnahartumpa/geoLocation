<?php
include_once('db.php');
$obj=new Database();
$obj->dbInfo('localhost', 'root','','geo');
$conn=$obj->connect();

$data['name']=$_GET['name'];
$data['position']=$_GET['lat'].','.$_GET['long'];

$table='user';
$obj->insert($conn,$table,$data);
mysqli_close($conn);
header('Location: index.php');
