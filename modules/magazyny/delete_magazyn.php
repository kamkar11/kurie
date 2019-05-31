<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=magazyny/magazyny');
}
/*
$result = $pdo->prepare('DELETE FROM magazyny WHERE id_magazynu = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();
*/

$stmt = oci_parse($conn, "begin DELETE_MAGAZYN(:id); end;");

oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);



header('location: index.php?v=magazyny/magazyny');



 ?>
