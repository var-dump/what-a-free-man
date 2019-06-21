<?php
require("sql.php");

$city_id = $_POST['val'];
$res = $PDO->query("select * from town where father=".$city_id);
$data = $res->fetchAll(PDO::FETCH_ASSOC);
if($data == '' || $data == null || empty($data))$data = 1;
echo json_encode($data);
// echo $res_pid;
?>