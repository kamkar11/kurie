<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=magazyny/magazyny');
}

$result = $pdo->prepare('DELETE FROM magazyny WHERE id_magazynu = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();

// czy jesteś pewny że chcesz usunąć ????????!!!

header('location: index.php?v=magazyny/magazyny');



 ?>
