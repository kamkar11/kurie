<?php


if(isset($_POST['miasto'] , $_POST['ulica'] , $_POST['numer'] ,
    $_POST['region']  )){


    $result = $pdo->prepare('UPDATE magazyny SET miasto = :miasto, ulica = :ulica, numer = :numer,
                                                region = :region
                                                WHERE id_magazynu = :id ');

    $result->bindParam(':miasto',$_POST['miasto'] );
    $result->bindParam(':ulica',$_POST['ulica'] );
    $result->bindParam(':numer',$_POST['numer'] );
    $result->bindParam(':region',$_POST['region'] );

    $result->bindParam(':id',$_GET['id']);
    $result->execute();

    header('location: index.php?v=magazyny/magazyny');
}

/*
if(isset($_GET)){
    print_r($_GET);
}
*/

if(!isset($_GET['id'])){
    header('location: index.php?v=magazyny/magazyny');
}

$result = $pdo->prepare('SELECT * FROM magazyny WHERE ID_MAGAZYNU= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$magazyny = $result->fetch(); // przechowuje




 ?>


</br>
<h1>Edycja magazynu</h1>

<form method="post">
  <div class="form-group">
      <label>Miasto</label>
      <input type="text" name="miasto" value="<?php echo $magazyny['MIASTO'];  ?>" maxlength="30" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica" value="<?php echo $magazyny['ULICA'];  ?>" maxlength="30" class="form-control">

      <label>Numer</label>
      <input type="text" name="numer" value="<?php echo $magazyny['NUMER'];  ?>" maxlength="5" class="form-control">

      <label>Region</label>
      <input type="text" name="region" value="<?php echo $magazyny['REGION'];  ?>" maxlength="30" class="form-control">



  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
