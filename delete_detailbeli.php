<?php
    require_once 'dbcon.php';
    $id_detailbeli = $_GET['id_detailbeli'];
    $id_beli = $_GET['id_beli'];
    $conn->query("delete from detailbeli where id_detailbeli='$id_detailbeli'") or die(mysql_error());
	echo "<script>window.location.href='detail_beli.php?id_beli=".$id_beli."';</script>";
?>