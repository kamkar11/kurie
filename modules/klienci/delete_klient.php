<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=klienci/klienci');
}
/*
$result = $pdo->prepare('DELETE FROM klienci WHERE id_klienta = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();
*/

$stmt = oci_parse($conn, "begin DELETE_KLIENT(:id); end;");

oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);




header('location: index.php?v=klienci/klienci');

 ?>
